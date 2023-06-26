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
    $neighborhood_ids = $request->neighborhood_ids;
    $villagers = Villager::select("*")
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
}
