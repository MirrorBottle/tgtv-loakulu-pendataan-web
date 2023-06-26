@php
$required = (Str::contains($field['rules'], 'required')) ? "required" : "";
$required_mark = ($required != "") ? '<span class="text-danger"> <strong>*</strong> </span>' : '';
@endphp


<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
  <label for="{{ $field['name'] }}"> <strong>{{ $field['label'] }}</strong></label> {!! $required_mark !!}
    <div class="input-group mb-3">
      <input type="text"
      name="{{ $field['name'] }}"
      value="{{ old($field['name'], setting($field['name'])) }}"
      class="form-control {{ Arr::get( $field, 'class') }} {{ $errors->has($field['name']) ? ' is-invalid' : '' }}"
      id="{{ $field['name'] }}"
      placeholder="{{ $field['label'] }}" {{ $required }}>
      <div class="input-group-append">
        <button class="btn btn-submit" type="button" id="{{ $field['name'] }}-button-image"><i class="fa fa-folder-open"></i> @lang('Browse')</button>
      </div>
    </div>
    @if ($errors->has($field['name'])) <small class="invalid-feedback">{{ $errors->first($field['name']) }}</small> @endif
</div>

@push('addition-styles')
<!-- File Manager -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push ('addition-scripts')
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('{{ $field['name'] }}-button-image').addEventListener('click', (event) => {
          event.preventDefault();
          inputId = '{{ $field['name'] }}';
          window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
      });
  });
</script>
@endpush