@extends('admin.layouts.app')

@push('MANDATORY_STYLES')

    @stack('css')
@endpush

@push('MANDATORY_SCRIPTS')
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
            App.init();
        });
    </script>
    @stack('js')
@endpush

@section('content')

    @include('admin.layouts.parts.loader')

    @include('admin.layouts.parts.navbar')

    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        @include('admin.layouts.parts.sidebar')
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content_area')
            </div>
            @include('admin.layouts.parts.footer')
        </div>
    </div>
@endsection
