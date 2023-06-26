
@if($errors->any())
    <div class="container-fluid">
        <div class="alert alert-danger left-icon-big alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
            </button>
            <div class="media">
                <div class="alert-left-icon-big">
                    <span><i class="mdi mdi-alert"></i></span>
                </div>
                <div class="media-body">
                    <h5 class="mt-1 mb-2">Gagal!</h5>
                    {!! implode('', $errors->all('<p class="mb-1">:message</p>')) !!}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('status'))
    <div class="container-fluid">
        <div class="alert alert-success left-icon-big alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
            </button>
            <div class="media">
                <div class="alert-left-icon-big">
                    <span><i class="mdi mdi-check-circle-outline"></i></span>
                </div>
                <div class="media-body">
                    <h5 class="mt-1 mb-2">Sukses!</h5>
                    <p class="mb-0">{{ Session::get('status') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
