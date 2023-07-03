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
use App\Http\Resources\Mobile\NeighborhoodResource;
use App\Models\Family;
use App\Models\Villager;
use App\Models\InventoryItem;
use App\Models\UserNeighborhood;
use Illuminate\Http\Response;

class NeighborhoodController extends Controller
{


  public function list($id) {
    $user_neighborhoods = UserNeighborhood::where("user_id", $id)->get();
    return NeighborhoodResource::collection($user_neighborhoods);
  }

  public function info($id)
  {
    $ageLimit = 6;
    $neighborhoodIds = explode(",", $id);
    $birthDateLimit = Carbon::now()->subYears($ageLimit)->toDateString();
    $familyTotal = Family::whereIn("neighborhood_id", $neighborhoodIds)->count();
    $villagers = Villager::whereIn("neighborhood_id", $neighborhoodIds)->get();
    $villagerTotal = $villagers->count();


    $villagerMen = $villagers
      ->filter(function ($villager) {
        return $villager->gender == "L";
      })
      ->count();
    $villagerWomen = $villagers
      ->filter(function ($villager) {
        return $villager->gender == "P";
      })
      ->count();
    $villagerChildren = $villagers
      ->filter(function ($villager) use ($birthDateLimit) {
        return $villager->birth_date >= $birthDateLimit;
      })
      ->count();

    $birthTotal = $villagers
      ->filter(function ($villager) {
        return $villager->is_birth == 1;
      })
      ->count();

    $deathTotal = $villagers
      ->filter(function ($villager) {
        return $villager->is_death == 1;
      })
      ->count();

    $moveInTotal = $villagers
      ->filter(function ($villager) {
        return $villager->is_move_in == 1;
      })
      ->count();

    $moveOutTotal = $villagers
      ->filter(function ($villager) {
        return $villager->is_move_out == 1;
      })
      ->count();

    return response()->json([
      'data' => helperCamelizeArray(compact('familyTotal', 'villagerTotal', 'villagerWomen', 'villagerMen', 'villagerChildren', 'birthTotal', 'deathTotal', 'moveInTotal', 'moveOutTotal'))
    ]);
  }
}
