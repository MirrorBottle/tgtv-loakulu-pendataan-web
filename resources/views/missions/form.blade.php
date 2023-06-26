<div class="col-12">
  <div class="row">
    <div class="col-12">
      <div class="form-group">
          <div class="custom-control custom-switch">
              <input name="is_active" type="checkbox" {{isset($module_data) ? ($module_data->is_active == 1 ? 'checked' : '') : 'checked' }} class="custom-control-input" id="customSwitch1">
              <label class="custom-control-label" for="customSwitch1">Aktif</label>
          </div>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <?php
        $field_name = 'name';
        $field_label = 'Judul';
        $field_placeholder = $field_label;
        $required = "required";
        ?>
        {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <?php
        $field_name = 'image';
        $field_lable = "Gambar";
        $field_placeholder = $field_lable;
        $required = "required";
        ?>
        {!! Form::label("$field_name", "$field_lable") !!} {!! fielf_required($required) !!}
        <div class="input-group mb-3">
          {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'aria-label'=>'Image', 'aria-describedby'=>'button-image']) }}
          <div class="input-group-append">
            <button class="btn btn-info" type="button" id="button-image"><i class="fas fa-folder-open"></i> @lang('Browse')</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <?php
        $field_name = 'description';
        $field_label = 'Deskripsi';
        $field_placeholder = $field_label;
        $required = "required";
        ?>
        {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
        {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
  </div>
</div>

@push('addition-styles')
<!-- File Manager -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push ('addition-scripts')
<script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('button-image').addEventListener('click', (event) => {
          event.preventDefault();
          window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
      });
  });

  // set file link
  function fmSetLink($url) {
      document.getElementById('image').value = $url;
  }
</script>
@endpush