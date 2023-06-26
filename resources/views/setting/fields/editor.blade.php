@php
$required = (Str::contains($field['rules'], 'required')) ? "required" : "";
$required_mark = ($required != "") ? '<span class="text-danger"> <strong>*</strong> </span>' : '';
@endphp


<div class="form-group">
  <?php
  $field_name = $field['name'];
  $field_label = $field['label'];
  $field_placeholder = $field_label;
  $required = (Str::contains($field['rules'], 'required')) ? "required" : "";
  ?>
  {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
  {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->value(old($field['name'], setting($field['name']))) }}
  @if ($errors->has($field['name'])) <small class="invalid-feedback">{{ $errors->first($field['name']) }}</small> @endif
</div>

@push('addition-styles')
<!-- File Manager -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push ('addition-scripts')

<script type="text/javascript" src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">
  CKEDITOR.replace("{{ $field['name'] }}", {
      filebrowserImageBrowseUrl: '/file-manager/ckeditor',
      language: '{{App::getLocale()}}',
      defaultLanguage: 'en'
  });
</script>
@endpush