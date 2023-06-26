<div class="col-12">
  <div class="row">
    <div class="col-12">
      <div class="form-group">
          <?php
          $field_name = 'name';
          $field_label = 'Nama';
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
          $field_name = 'username';
          $field_label = 'Username';
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
          $field_name = 'email';
          $field_label = 'Email';
          $field_placeholder = $field_label;
          $required = "";
          ?>
          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
          {{ html()->email($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
          <?php
          $field_name = 'phone_number';
          $field_label = 'Kontak';
          $field_placeholder = $field_label;
          $required = "";
          ?>
          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
          {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
          <?php
          $field_name = 'role';
          $field_label = 'Hak Akses';
          $field_placeholder = $field_label;
          $required = "required";
          ?>
          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
          <div class="d-flex justify-content-center align-items-center">
            <select name="{{$field_name}}" class="form-control multi-select mr-2" value="{{ old($field_name) }}" placeholder="{{$field_placeholder}}">
              @foreach ($roles as $role)
                <option {{isset($module_data) && $module_data->roles()->first()->id === $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
              @endforeach
            </select>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
          <?php
          $field_name = 'password';
          $field_label = 'Password';
          $field_placeholder = $field_label;
          $required = isset($module_data) ? "" : "required";
          ?>
          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
          {{ html()->password($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
          <?php
          $field_name = 'password_confirmation';
          $field_label = 'Konfirmasi Password';
          $field_placeholder = $field_label;
          $required = isset($module_data) ? "" : "required";
          ?>
          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
          {{ html()->password($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
      </div>
    </div>
  </div>
</div>
