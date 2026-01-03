<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.shared.title-meta', ['title' => $title])

    <!-- jvectormap -->
    {{--    // TODO: get where is necessary to use this --}}
    {{--    <link href="plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">--}}

    @include('layouts.shared.head-css')

    @stack('custom-css')
</head>

<body class="dark-sidenav theme-dark dark-body" data-bs-theme="dark">
@include('layouts.shared.left-sidebar')


<div class="page-wrapper">
    @include('layouts.shared.topbar')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">{{ $title }}</h4>

                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">RoySafaris</a></li>
                                    <li class="breadcrumb-item {{ isset($subtitle) ? 'active text-primary' : null  }}">
                                        <a href="javascript:void(0);">{{ $title }}</a>
                                    </li>

                                    @isset($subtitle)
                                        <li class="breadcrumb-item active">{{ $subtitle }}</li>
                                    @endisset
                                </ol>
                            </div>

                            @stack('action-buttons')
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            @stack('modal')
        </div>

        @include('layouts.shared.footer')
    </div>
</div>
{{-- End page wrapper --}}

@include('layouts.shared.footer-script')
{{--@include('layouts.shared.alert')--}}

</body>

</html>
