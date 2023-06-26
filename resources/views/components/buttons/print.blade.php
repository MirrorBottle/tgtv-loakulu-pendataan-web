@props(["route"=>"", "icon"=>"flaticon-381-print-1", "title", "small"=>"", "class"=>""])

<a  href='{{$route}}'
    target="_blank"
    class='btn btn-warning {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    data-toggle="tooltip"
    title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</a>
