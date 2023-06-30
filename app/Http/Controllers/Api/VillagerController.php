<?php

namespace App\Http\Controllers\Api;

use App\Helper\JsonResponse;
use App\Models\InventoryStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\VillagerDetailResource;
use App\Http\Resources\Mobile\VillagerResource;
use App\Http\Resources\Mobile\InventoryItemResource;
use App\Models\Villager;
use App\Models\InventoryItem;
use Illuminate\Http\Response;

class VillagerController extends Controller
{

  public function index(Request $request)
  {
    $keyword = $request->keyword;
    $type = $request->type;
    $neighborhood_ids = $request->neighborhood_ids;
    $villagers = Villager::select("*")
      ->when($type != "move-out", function($query) {
        $query->where("is_move_out", 0);
      })
      ->when($type != "death", function($query) {
          $query->where("is_death", 0);
      })
      ->when($type == "men", function($query) {
          $query->where("gender", "L");
      })
      ->when($type == "women", function($query) {
          $query->where("gender", "P");
      })
      ->when($type == "children", function($query) {
          $ageLimit = 6;
          $birthDateLimit = Carbon::now()->subYears($ageLimit)->toDateString();
          $query->whereDate("birth_date", ">=", $birthDateLimit);
      })
      ->when($type == "birth", function($query) {
          $query->where("is_birth", 1);
      })
      ->when($type == "death", function($query) {
          $query->where("is_death", 1);
      })
      ->when($type == "move-in", function($query) {
          $query->where("is_move_in", 1);
      })
      ->when($type == "move-out", function($query) {
          $query->where("is_move_out", 1);
      })
      ->when($request->filled('keyword'), function($q) use ($keyword) {
        $q
          ->where('id_number', "$keyword")
          ->orWhere('name', 'LIKE', "%$keyword%");
      })
      ->when($request->filled('neighborhood_ids'), function($q) use ($neighborhood_ids) {
        $neighborhood_ids = explode(",", $neighborhood_ids);
        $q
          ->whereIn('neighborhood_id', $neighborhood_ids);
      })
      ->orderBy("name", "ASC")
      ->paginate($request->limit ?? 5);
    return VillagerResource::collection($villagers);
  }

  public function show($id)
  {
    $villager = Villager::find($id);
    return new VillagerDetailResource($villager);
  }

  public function family($family_id)
  {
    $villagers = Villager::where('family_id', $family_id)->get();
    return VillagerDetailResource::collection($villagers);
  }

  public function birth(Request $request) {
    $villager = Villager::create([
      "family_id"       => $request->familyId,
      "neighborhood_id" => $request->neighborhoodId,
      "id_number"       => $request->idNumber,
      "name"            => $request->name,
      "religion"        => $request->religion,
      "birth_place"     => $request->birthPlace,
      "birth_date"      => Carbon::createFromFormat("d-m-Y", $request->birthDate),
      "gender"          => $request->gender,
      "marital_status"  => "BK",
      "job"             => "BELUM BEKERJA",
      "education"       => "BELUM SEKOLAH",
      "father_name"     => $request->fatherName,
      "mother_name"     => $request->fatherName,
      "is_birth"        => 1,
      "born_at"         => Carbon::now()->toDateTimeString()
    ]);

    return new VillagerDetailResource($villager);
  }

  public function moveIn(Request $request) {
    $villager = Villager::where('id_number', $request->idNumber)->first();
    
    $villager = Villager::create([
      "family_id"       => $request->familyId,
      "neighborhood_id" => $request->neighborhoodId,
      "id_number"       => $request->idNumber,
      "name"            => $request->name,
      "religion"        => $request->religion,
      "birth_place"     => $request->birthPlace,
      "birth_date"      => Carbon::createFromFormat("d-m-Y", $request->birthDate),
      "gender"          => $request->gender,
      "marital_status"  => $request->maritalStatus,
      "job"             => $request->job,
      "education"       => $request->education,
      "father_name"     => $request->fatherName,
      "mother_name"     => $request->fatherName,
      "is_move_in"      => 1,
      "move_in_at"      => Carbon::now()->toDateTimeString()
    ]);

    return new VillagerDetailResource($villager);
  }

  public function moveOut($id) {
    $villager = Villager::find($id);
    $villager->update([
      'is_move_out' => 1,
      'move_out_at' => Carbon::now()->toDateTimeString()
    ]);

    return new VillagerDetailResource($villager);
  }

  public function death(Request $request) {
    $villager = Villager::find($request->id);
    $villager->update([
      'is_death' => 1,
      'cause_of_death' => $request->cause_of_death,
      'death_at' => Carbon::now()->toDateTimeString()
    ]);

    return new VillagerDetailResource($villager);
  }
}
