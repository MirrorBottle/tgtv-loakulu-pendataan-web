{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
            <!-- row -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
          <div class="profile-head">
            <div class="profile-info">
              <div class="profile-photo">
                <img src="{{ asset($user->profile_image_format) }}" class="img-fluid rounded-circle" alt="">
              </div>
              <div class="profile-details">
                <div class="profile-name px-3 pt-2">
                  <h4 class="text-primary mb-0">{{$user->name}}</h4>
                  <p>{{$user->roles->first()->name}}</p>
                </div>
                <div class="profile-email px-2 pt-2">
                  <h4 class="text-muted mt-4">{{$user->email}}</h4>
                </div>
              </div>
            </div>
          </div>

          <ul class="nav nav-pills mb-3 pb-4" id="pills-tab" role="tablist">
            <li class="nav-item mr-2">
              <a class="nav-link active" id="profile-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Profil</a>
            </li>
            <li class="nav-item mr-2">
              <a class="nav-link" id="change-password-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Ubah password</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="profile-tab">
              {{ html()->modelForm($user, 'PATCH', route("$module_name.update", $user))->class('form')->attributes(["enctype" => "multipart/form-data"])->open() }}
              <div class="row">
                <div class="col-12">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group mb-4">
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
                      <div class="form-group mb-4">
                        <?php
                        $field_name = 'username';
                        $field_label = 'Username';
                        $field_placeholder = $field_label;
                        $required = "required";
                        ?>
                        {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", "disabled"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group mb-4">
                        <?php
                        $field_name = 'phone_number';
                        $field_label = 'Nomor Whatsapp';
                        $field_placeholder = $field_label;
                        $required = "required";
                        ?>
                        {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                        {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group mb-4">
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
                    </div>
                  </div>
                  <div class="col-12 mt-2">
                      <div class="float-right">
                          <div class="form-group mb-4">
                              <x-buttons.create title="Simpan" />
                          </div>
                      </div>
                  </div>
              </div>
              {{ html()->form()->close() }}
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="change-password-tab">
              {{ html()->modelForm($user, 'PATCH', route("$module_name.change_password", $user))->class('form')->attributes(["enctype" => "multipart/form-data"])->open() }}
              <div class="row">
                <div class="col-12">
                  <div class="row">
                      <div class="col-12">
                        <div class="form-group mb-4">
                          <?php
                          $field_name = 'old_password';
                          $field_label = 'Password Lama';
                          $field_placeholder = $field_label;
                          $required = isset($module_data) ? "" : "required";
                          ?>
                          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                          {{ html()->password($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group mb-4">
                          <?php
                          $field_name = 'password';
                          $field_label = 'Password Baru';
                          $field_placeholder = $field_label;
                          $required = isset($module_data) ? "" : "required";
                          ?>
                          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                          {{ html()->password($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group mb-4">
                          <?php
                          $field_name = 'password_confirmation';
                          $field_label = 'Konfirmasi Password Baru';
                          $field_placeholder = $field_label;
                          $required = isset($module_data) ? "" : "required";
                          ?>
                          {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                          {{ html()->password($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mt-2">
                      <div class="float-right">
                          <div class="form-group mb-4">
                              <x-buttons.create title="Ubah Password" icon="las la-key" />
                          </div>
                      </div>
                  </div>
              </div>
              {{ html()->form()->close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
