<div class="col-12">
    <div class="row">
        {{-- * DATE --}}
        <div class="col-12 {{ $type === 'inventory-current-stock' ? 'd-none' : '' }}">
            <div class="form-group">
                <p class="mb-1">Rentang Tanggal</p>
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                    <input class="form-control input-daterange-datepicker" type="text" name="daterange">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <p class="mb-1">Daftar Item</p>
                <div class="d-flex justify-content-center align-items-center">
                    <select name="items[]" class="form-control multi-select mr-2" multiple="multiple" id="pickup-select">
                        <option value="all" selected>Semua</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
