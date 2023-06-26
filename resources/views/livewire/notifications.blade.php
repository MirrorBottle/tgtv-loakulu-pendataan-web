<li class="nav-item dropdown notification_dropdown">
    <a class="nav-link  ai-icon" href="#" role="button" data-toggle="dropdown">
        <i class="flaticon-381-ring"></i>
        @if ($notifications->count() > 0)
            <div class="pulse-css"></div>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:{{$notifications->count() > 0 ? '380px' : '55px'}};">
            <ul class="timeline">
                @forelse ($notifications as $notification)
                <li style="cursor: pointer" wire:click="read({{$notification->id}})">
                    <div class="timeline-panel">
                        <div class="media-body">
                            <h6 class="mb-1">{{$notification->message}}</h6>
                            <small class="d-block">{{$notification->created_at->diffForHumans()}}</small>
                        </div>
                    </div>
                </li>
                @empty
                    <h4 class="text-muted text-center">Tidak ada notifikasi</h4>
                @endforelse
            </ul>
        </div>
        <a class="all-notification" href="#">Lihat Semua <i class="ti-arrow-right"></i></a>
    </div>
</li>