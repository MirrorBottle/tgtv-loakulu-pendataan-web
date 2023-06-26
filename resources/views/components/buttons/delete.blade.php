@props(["route"=>"", "index_route" =>"", "extra" => "", "icon"=>"flaticon-381-trash", "title", "small"=>"", "class"=>""])

@if($route)
<button data-route="{{$route}}" data-extra="{{$extra}}" data-index_list="{{$index_route}}" class='btn btn-danger delete-button {{($small=='true')? 'btn-sm' : ''}} {{$class}}' data-token=" {{csrf_token()}}" data-confirm="Are you sure?">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</button>
@else
<button type="submit" class='btn btn-danger {{($small=='true')? 'btn-sm' : ''}} {{$class}}' data-toggle="tooltip" title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</button>
@endif