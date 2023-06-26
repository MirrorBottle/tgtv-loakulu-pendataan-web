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
            </div>
            <div class="card-body">
              <table id="datatable" class="display">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Pesan</th>
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'message',
                    name: 'message'
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