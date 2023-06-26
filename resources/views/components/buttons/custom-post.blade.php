@props(["route"=>"", "index_route" =>"", "extra" => "", "icon"=>"flaticon-381-trash", "title", "small"=>"", "class"=>""])

<button data-route="{{$route}}" data-extra="{{$extra}}" data-index_list="{{$index_route}}" class='btn btn-primary custom-post-button {{($small=='true')? 'btn-sm' : ''}} {{$class}}' data-token=" {{csrf_token()}}" data-confirm="Are you sure?">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</button>