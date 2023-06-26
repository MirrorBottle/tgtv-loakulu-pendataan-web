@props(["route"=>"", "icon"=>"flaticon-381-success-2", "title", "small"=>"", "class"=>"ml-2"])

@if($route)
    <a href='{{$route}}'
        class='btn btn-primary text-nowrap cursor-pointer btn-submit {{$class}}'
        data-toggle="tooltip"
        title="{{ $title }}">
        <i class="{{$icon}} mr-2"></i>
        <span>{{ $title }}</span>
    </a>
@else
    <button type="submit"
        class='btn btn-primary text-nowrap cursor-pointer btn-submit {{$class}}'
        data-toggle="tooltip"
        title="{{ $title }}">
        <i class="{{$icon}} mr-2"></i>
        <span>{{ $title }}</span>
    </button>
@endif
