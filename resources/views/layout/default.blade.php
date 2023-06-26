<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ setting('app_name') }} | @yield('title', $page_title ?? '')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset(setting('favicon')) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset(setting('favicon')) }}" type="image/x-icon">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

	@if (isset($action))
        @if(!empty(config('dz.public.pagelevel.css.'.$action)))
            @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
                    <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
            @endforeach
        @endif
    @endif

	{{-- Global Theme Styles (used by all pages) --}}
	@if(!empty(config('dz.public.global.css')))
		@foreach(config('dz.public.global.css') as $style)
			<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
		@endforeach
	@endif
    @livewireStyles
    @stack('addition-styles')
    <style>
        .swal2-container {
            z-index: 99999!important;
        }
    </style>

</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{!! url('/dashboard'); !!}" class="brand-logo">
			<img class="logo-compact" src="{{ asset(setting('logo')) }}" alt="">
            <img class="brand-title" src="{{ asset(setting('logo')) }}" alt="">
            </a>

            <div id="nav-control" class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->

		@include('elements.header', ['page_title' => $page_title ?? "Dashboard"])

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('elements.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <x-flash />
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->

		@include('elements.footer')

        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
	@include('elements.footer-scripts')
    @livewireScripts
    @stack('addition-scripts')
</body>
</html>
