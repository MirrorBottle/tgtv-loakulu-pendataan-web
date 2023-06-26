{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Histori Stok Masuk</h4>
                        <a href="{{ route("inventory-export.view", "inventory-logs-in") }}" class="btn btn-success btn-sm">
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
                                    <th>Daftar Item</th>
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
                ajax: '{{ route("$module_name.in_data") }}',
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
                        data: 'date',
                        name: 'date',
                        render: function(data, type, row, meta) {
                            const items = JSON.parse(row.items.replace(/&quot;/ig,'"'))
                            let el = items
                                .slice(0, 3)
                                .map(item => {
                                    return `<span>${item.item_name} (${item.increase} ${item.item_unit})</span>`
                                })
                                .join('<br>')
                            if(items.length > 3) {
                                el += '<br> <span>...</span>'
                            }
                            return el;
                        }
                    },
                    {
                        data: 'is_available',
                        name: 'is_available',
                        render: function(data, type, row, meta) {
                            switch (Number(row.validation_status)) {
                                case 1:
                                    return `<span class="badge text-white bg-primary">Belum Divalidasi</span>`
                                    break;
                                case 2:
                                    return ` <span class="badge text-white bg-success">Tervalidasi</span>`
                                    break;
                                case 3:
                                    return `<span class="badge text-white bg-danger">Ditolak</span>`
                                    break;
                                default:
                                    return `<span>-</span>`
                                    break;
                            }
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
