@props(["route"=>"", "icon"=>"flaticon-381-edit", "title", "small"=>"", "class"=>""])

@if($route)
    <a href='{{$route}}'
        class='btn btn-warning text-white {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
        data-toggle="tooltip"
        title="{{ $title }}"
    >
        <i class="{{$icon}}"></i>
        <span>{{ $slot }}</span>
    </a>
@else
    <button type="submit"
        class='btn btn-warning text-white {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
        data-toggle="tooltip"
        title="{{ $title }}"
    >
        <i class="{{$icon}}"></i>
        <span>{{ $slot }}</span>
    </button>
@endif
