{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
              <h4 class="card-title">Detail {{$module_singular}}</h4>
              <a href="{{route("$module_name.index")}}" class="btn btn-primary btn-sm">
                  <i class="fas fa-arrow-left"></i>
                  Kembali
              </a>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
              <tbody>
                <tr>
                  <th scope="row" st>Nama</th>
                </tr>
                <tr>
                  <td>{{$module_data->name}}</td>
                </tr>
                <tr>
                  <th scope="row" st>Email</th>
                </tr>
                <tr>
                  <td>{{$module_data->email}}</td>
                </tr>
                <tr>
                  <th scope="row" st>Pesan</th>
                </tr>
                <tr>
                  <td>{{$module_data->message}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection