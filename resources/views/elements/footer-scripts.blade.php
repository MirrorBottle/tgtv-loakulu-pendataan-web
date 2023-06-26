@if(!empty(config('dz.public.global.js')))
	@foreach(config('dz.public.global.js') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
@if(isset($action) && !empty(config('dz.public.pagelevel.js.'.$action)))
	@foreach(config('dz.public.pagelevel.js.'.$action) as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
{{-- Sweet alert --}}
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}" type="text/javascript"></script>

{{-- Other Scripts --}}
<script src="{{ asset('js/custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/deznav-init.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom/index.js') }}" type="text/javascript"></script>
<!--	{{-- Education Theme JS --}}
 @if(isset($action) && !empty(config('dz.public.education.pagelevel.js.'.$action)))
	@foreach(config('dz.public.education.pagelevel.js.'.$action) as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif	-->