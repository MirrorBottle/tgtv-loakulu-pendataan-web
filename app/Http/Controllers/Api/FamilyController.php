<?php

namespace App\Http\Controllers\Api;

use App\Helper\JsonResponse;
use App\Models\InventoryStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\FamilyResource;
use App\Http\Resources\Mobile\VillagerDetailResource;
use App\Http\Resources\Mobile\VillagerResource;
use App\Http\Resources\Mobile\InventoryItemResource;
use App\Models\Family;
use App\Models\Villager;
use App\Models\InventoryItem;
use Illuminate\Http\Response;

class FamilyController extends Controller
{

  public function index(Request $request)
  {
    $keyword = $request->keyword;
    $neighborhood_ids = $request->neighborhood_ids;
    $families = Family::select("*")
      ->when($request->filled('keyword'), function($q) use ($keyword) {
        $q
          ->where('number', "LIKE", "$keyword%");
      })
      ->when($request->filled('neighborhood_ids'), function($q) use ($neighborhood_ids) {
        $neighborhood_ids = explode(",", $neighborhood_ids);
        $q
          ->whereIn('neighborhood_id', $neighborhood_ids);
      })
      ->orderBy("number", "ASC")
      ->paginate($request->limit ?? 5);
    return FamilyResource::collection($families);
  }
}
