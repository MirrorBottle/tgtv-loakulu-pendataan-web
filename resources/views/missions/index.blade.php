{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">Daftar {{$module_singular}}</h4>
                <a href="{{route("$module_name.create")}}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    Tambah {{$module_singular}}
                </a>
            </div>
            <div class="card-body">
              <table id="datatable" class="display">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Gambar</th>
                      <th>Judul</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                </thead>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection
@push('addition-scripts')
    <script>
      $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            responsive: true,
            ajax: '{{ route("$module_name.index_data") }}',
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, row, meta) {
                        return `
                            <img src="${row.image}" alt="${row.title}" class="img-fluid">
                        `
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                    render: function(data, type, row, meta) {
                        return `
                            <span class="badge text-white bg-${row.is_active == 1 ? 'success' : 'danger'}">
                                ${row.is_active == 1 ? 'Aktif' : 'Nonaktif'}
                            </span>
                        `
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    })
    </script>
@endpush