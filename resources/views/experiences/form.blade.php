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
        $field_label = 'Nama Perusahaan';
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
        $field_name = 'year';
        $field_label = 'Tahun';
        $field_placeholder = $field_label;
        $required = "required";
        ?>
        {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
        {{ html()->number($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <?php
        $field_name = 'type';
        $field_label = 'Tipe';
        $field_placeholder = $field_label;
        $required = "required";
        ?>
        {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
        <div class="d-flex justify-content-center align-items-center">
          <select name="{{$field_name}}" class="form-control multi-select mr-2" value="{{ old($field_name) }}" placeholder="{{$field_placeholder}}" id="pickup-select">
              <option {{isset($module_data) && $module_data->type == '1' ? 'selected' : ''}} value="1">Catering</option>
              <option {{isset($module_data) && $module_data->type == '2' ? 'selected' : ''}} value="2">Rental</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <?php
        $field_name = 'description';
        $field_label = 'Deskripsi';
        $field_placeholder = $field_label;
        $required = "";
        ?>
        {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
        {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
  </div>
</div>