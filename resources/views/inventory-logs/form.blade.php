<div class="col-12">
  <div class="row">
    <div class="col-12">
      <div class="form-group">
          <div class="custom-control custom-switch">
              <input name="is_available" type="checkbox" {{isset($module_data) ? ($module_data->is_available == 1 ? 'checked' : '') : 'checked' }} class="custom-control-input" id="customSwitch1">
              <label class="custom-control-label" for="customSwitch1">Aktif</label>
          </div>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
          <?php
          $field_name = 'inventory_category_id';
          $field_label = 'Kategori';
          $field_placeholder = $field_label;
          $required = "required";
          ?>
          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
          <div class="d-flex justify-content-center align-items-center">
            <select name="{{$field_name}}" class="form-control multi-select mr-2" value="{{ old($field_name) }}" placeholder="{{$field_placeholder}}">
              @foreach ($categories as $category)
                <option {{isset($module_data) && $module_data->inventory_category_id === $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <?php
        $field_name = 'name';
        $field_label = 'Nama Item';
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
        $field_name = 'unit';
        $field_label = 'Satuan';
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