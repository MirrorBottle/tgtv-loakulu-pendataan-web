{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Histori Stok Seluruh</h4>
                        <a href="{{ route("inventory-export.view", "inventory-stock") }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i>
                            Download Laporan
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Waktu</th>
                                    <th>Pengguna</th>
                                    <th>Nama Item</th>
                                    <th>Jumlah Item</th>
                                    <th>Stok Tersisa</th>
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
                ajax: '{{ route("$module_name.all_data") }}',
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'item_name',
                        name: 'item_name'
                    },
                    {
                        data: 'item_name',
                        name: 'item_name',
                        render: function(data, type, row, meta) {
                            return row.decrease == 0 ? `
                          <span class="text-success font-weight-bold">+${row.increase} ${row.item_unit}</span>
                          ` : `
                          <span class="text-danger font-weight-bold">-${row.decrease} ${row.item_unit}</span>
                          `
                        }
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        render: function(data, type, row, meta) {
                            return `<span class="text-primary font-weight-bold">${row.quantity} ${row.item_unit}</span>`
                        }
                    },
                ]
            });
        })
    </script>
@endpush
