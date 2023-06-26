{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Buat Invoice</h4>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route("$module_name.create"))->class('form')->open() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    {{ html()->label('Tanggal', 'date') }} {!! fielf_required('required') !!}
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                        <input data-value="{{ date('d-M-Y') }}" name="date"
                                            class="datepicker-default form-control" id="datepicker" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'number';
                                    $field_label = 'Nomor';
                                    $field_placeholder = $field_label;
                                    $required = 'required';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'to_name';
                                    $field_label = 'Kepada';
                                    $field_placeholder = $field_label;
                                    $required = 'required';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'to_address';
                                    $field_label = 'Alamat';
                                    $field_placeholder = $field_label;
                                    $required = 'required';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'description';
                                    $field_label = 'Keterangan';
                                    $field_placeholder = $field_label;
                                    $required = 'required';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->textarea($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", "rows" => 5])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'quantity';
                                    $field_label = 'Jumlah';
                                    $field_placeholder = $field_label;
                                    $required = 'required';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'price';
                                    $field_label = 'Harga';
                                    $field_placeholder = $field_label;
                                    $required = 'required';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}

                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Rp. </span>
                                        </span>
                                        {{ html()->text($field_name)->placeholder('Contoh: 23.500')->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                        <span class="input-group-append">
                                            <span class="input-group-text">,-</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'tax';
                                    $field_label = 'Pajak';
                                    $field_placeholder = $field_label;
                                    $required = 'required';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required"])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'total';
                                    $field_label = 'Total';
                                    $field_placeholder = $field_label;
                                    $required = '';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'readonly'])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <?php
                                    $field_name = 'said';
                                    $field_label = 'Terbilang';
                                    $field_placeholder = $field_label;
                                    $required = '';
                                    ?>
                                    {{ html()->label($field_label, $field_name) }} {!! fielf_required($required) !!}
                                    {{ html()->text($field_name)->placeholder($field_placeholder)->class('form-control')->attributes(["$required", 'readonly'])->addClass($errors->has($field_name) ? 'is-invalid' : '') }}
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-dark" onclick="history.back(-1)"><i
                                        class="fa fa-reply"></i> Kembali</button>
                                <x-buttons.create title="Buat Invoice" />
                            </div>
                        </div>
                        {{ html()->form()->close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addition-scripts')
    <script src="https://unpkg.com/@develoka/angka-terbilang-js@1.4.1/index.min.js"></script>
    <script>
        $(function() {
            $(document).on('focusout', '#price', function() {
                const price = Number($(this).val().replace(/\D/g, ''));
                const quantity = Number($('#quantity').val());

                const total = price * quantity;
                const formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                const said = angkaTerbilang(total);
                $("#total").val(`${formatter.format(total).replace('Rp', 'Rp.').replace(',00', ',-')}`)
                $("#said").val(`${said.replace(/(^|\s)\S/g, function(t) { return t.toUpperCase() })} Rupiah`)
            })
        })
    </script>
@endpush
