<div class="col-12">
    <div class="row">
        <div class="col-12 mb-4">
            <h4>Detail Data</h4>
            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                <tbody>
                    <tr>
                        <th scope="row" st>ID</th>
                        <td>{{ $module_data->code }}</td>
                        <th scope="row" st>Pengguna</th>
                        <td>{{ $module_data->user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="4">Daftar Item</th>
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Kode </th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($module_data->stocks as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->item->code }} </td>
                                        <td>{{ $item->item->name }} </td>
                                        <td>{{ $item->decrease }} ({{ $item->item->unit }})</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </tr>
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            {{ html()->hidden('validation_status')->value(3) }}
            {{ html()->hidden('validated_at')->value(date('Y-m-d H:i:s')) }}
            {{ html()->hidden('admin_id')->value(auth()->user()->id) }}
            <div class="form-group">
                <?php
                $field_name = 'validation_note';
                $field_label = 'Alasan Penolakan';
                $field_placeholder = $field_label;
                $required = '';
                ?>
                {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
            </div>
        </div>
    </div>
</div>

@push('addition-styles')
    <!-- File Manager -->
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@push('addition-scripts')
    <script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();
                window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            });
        });

        // set file link
        function fmSetLink($url) {
            document.getElementById('image').value = $url;
        }
    </script>
@endpush
