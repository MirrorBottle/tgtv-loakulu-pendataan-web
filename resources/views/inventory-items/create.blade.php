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
              {{ html()->form('POST', route("$module_name.store"))->class('form')->open() }}
              <div class="row">
                  @include("$module_name.form")
                  <div class="col-12 mt-2">
                    <button type="button" class="btn btn-dark" onclick="history.back(-1)"><i class="fa fa-reply"></i> Kembali</button>
                    <x-buttons.create title="Simpan" />
                  </div>
              </div>
              {{ html()->form()->close() }}
          </div>
        </div>
    </div>
  </div>
</div>

@endsection
