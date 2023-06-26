{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">{{$page_title}}</h4>
            </div>
            <div class="card-body">
              <form method="post" action="{{ route('setting.store') }}" class="form-horizontal" role="form">
                {!! csrf_field() !!}

                @if(count(config('setting_fields', [])) )
                    @foreach(config('setting_fields') as $section => $fields)
                    @if (in_array($section, ["app", "social", "about", "experience", "contact"]))
                        <div class="card">
                            <div class="card-header">
                                <i class="{{ Arr::get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                                {{ $fields['title'] }}
                            </div>
                            <div class="card-body">
                                <p class="text-muted">{{ $fields['desc'] }}</p>

                                <div class="row">
                                    <div class="col">
                                        @foreach($fields['elements'] as $field)
                                            @includeIf('setting.fields.' . $field['type'] )
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endforeach

                @endif

                <div class="row m-b-md">
                    <div class="col-md-12">
                        <button class="btn-primary btn">
                            <i class='fas fa-save'></i> @lang('Save')
                        </button>
                    </div>
                </div>

            </form>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection
@push('addition-scripts')
    <script>
        function fmSetLink($url) {
            document.getElementById(inputId).value = $url;
        }
    </script>
@endpush