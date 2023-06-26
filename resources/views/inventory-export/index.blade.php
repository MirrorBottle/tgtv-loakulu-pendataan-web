{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                @php
                    $type_title = [
                      "inventory-logs-in" => "Stok Item Masuk",
                      "inventory-logs-out" => "Stok Item Keluar",
                      "inventory-stock" => "Histori Perubahan Stok Item",
                      "inventory-current-stock" => "Stok Terkini Item"

                    ][$type];
                @endphp
                <h4 class="card-title">{{$page_title}} ({{ $type_title }})</h4>
            </div>
            <div class="card-body">
              {{ html()->form('POST', route("$module_name.export", $type))->class('form')->open() }}
              <div class="row">
                  @include("$module_name.form", ["type" => $type])
                  <div class="col-12 mt-2">
                    <button type="button" class="btn btn-dark" onclick="history.back(-1)"><i class="fa fa-reply"></i> Kembali</button>
                    <x-buttons.create title="Export" />
                  </div>
              </div>
              {{ html()->form()->close() }}
          </div>
        </div>
    </div>
  </div>
</div>

@endsection
