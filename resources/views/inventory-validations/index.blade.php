{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Validasi</h4>
                        <x-buttons.custom-post
                            index-route='{!!route("$module_name.index")!!}'
                            route='{!!route("$module_name.bulk")!!}'
                            class='btn-success' 
                            icon='flaticon-381-success'
                            title="Dikonfirmasi"
                            small="true"
                        >
                            Konfirmasi Semua
                        </x-buttons.custom-post>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Waktu</th>
                                    <th>Pengguna</th>
                                    <th>Daftar Item</th>
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
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'code',
                        name: 'code',
                        render: function(data, type, row, meta) {
                            return `<b>${row.code}</b>`
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
                        data: 'items',
                        name: 'items',
                        render: function(data, type, row, meta) {
                            const items = JSON.parse(row.items.replace(/&quot;/ig, '"'))
                            let el = items
                                .map(item => {
                                    return `<span>${item.item_name} (${item.increase} ${item.item_unit})</span>`
                                })
                                .join('<br>')
                            return el;
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
