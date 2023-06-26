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
                  <th scope="row" st>Judul</th>
                </tr>
                <tr>
                  <td>
                    {{$module_data->name}}
                  </td>
                </tr>
                <tr>
                  <th scope="row">Status</th>
                </tr>
                <tr>
                  <td><span class="badge text-white bg-{{$module_data->is_active == 1 ? 'success' : 'danger'}}">
                    {{$module_data->is_active == 1 ? 'Aktif' : 'Nonaktif'}}
                   </span></td>
                </tr>
                <tr>
                  <th scope="row" st>Deskripsi</th>
                </tr>
                <tr>
                  <td>{{$module_data->description}}</td>
                </tr>
                <tr>
                  <th scope="row" st>Gambar</th>
                </tr>
                <tr>
                  <td>
                    <img src="{{asset($module_data->image)}}" alt="{{$module_data->title}}" class="img-fluid img-thumbnail">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection