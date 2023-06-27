<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    {!! SEO::generate() !!}
    <link rel="shortcut icon" href="{{ asset(setting('favicon')) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset(setting('favicon')) }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">

    <!--

Tooplate 2115 Marvel

https://www.tooplate.com/view/2115-marvel

-->
</head>

<body>
    <div class="hero_area">
        <!-- slider section -->
        <section class=" slider_section position-relative pt-4">
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('web/images/Lambang_Kab._Kutai_Kertanegara.png') }}" alt=""
                    style="width: 10rem">
                <img src="{{ asset('web/images/Logo-Crop-White-1024x242.png') }}" alt="" class="mt-3"
                    style="width: 27rem">

                <div class="card mt-4" style="min-width: 70%">
                    <div class="card-header">
                        <h5>Upload File Data Penduduk</h5>

                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        {{ html()->form('POST', route('web.upload'))->class('form')->attributes(['enctype' => 'multipart/form-data'])->open() }}
                        <div class="form-group">
                            {{ html()->label('File (.xlsx / .xls)', 'file') }} {!! fielf_required('required') !!}
                            <div class="custom-file">
                                {{ html()->file('file')->accept('.xlsx,.xls,.csv')->class('custom-file-input')->attributes(['required'])->addClass($errors->has('file') ? 'is-invalid' : '') }}
                                <label class="custom-file-label" for="customFile">Pilih File</label>
                            </div>
                        </div>
                        <button type="submit" class='btn btn-success text-nowrap cursor-pointer btn-submit'>
                            <span>Upload</span>
                        </button>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        bsCustomFileInput.init();
    </script>
</body>

</html>
