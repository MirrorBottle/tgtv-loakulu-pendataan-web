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
use App\Traits\PushNotificationTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{

  use PushNotificationTrait;

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

  public function store(Request $request)
  {
    $request->merge([
      "activity_date" => Carbon::createFromFormat("d-m-Y", $request->activity_date)->toDateString(),
    ]);
    $announcement = Announcement::create($request->all());

    $this->pushNotificationToTopic($announcement->title, Str::limit($announcement->content, 40, '...'), 'admins');
    return new AnnouncementDetailResource($announcement);
  }
}
