<?php

namespace App\Http\Controllers\Api;

use App\Helper\JsonResponse;
use App\Models\InventoryStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\AnnouncementDetailResource;
use App\Http\Resources\Mobile\AnnouncementResource;
use App\Http\Resources\Mobile\InventoryItemResource;
use App\Models\Announcement;
use App\Models\InventoryItem;
use Illuminate\Http\Response;

class AnnouncementController extends Controller
{

  public function latest() {
    $announcements = Announcement::orderBy("id", "DESC")->limit(3)->get();
    return AnnouncementResource::collection($announcements);
  }

  public function index(Request $request)
  {
    $keyword = $request->keyword;
    $announcements = Announcement::when($request->filled('keyword'), function($q) use ($keyword) {
      $q->where('title', 'LIKE', "%$keyword%");
    })
      ->orderBy("id", "DESC")
      ->paginate($request->limit ?? 5);
    return AnnouncementResource::collection($announcements);
  }

  public function show($id)
  {
    $announcement = Announcement::find($id);
    return new AnnouncementDetailResource($announcement);
  }
}
