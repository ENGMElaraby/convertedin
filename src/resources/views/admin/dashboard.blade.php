@extends('admin.layouts.master')

@push('body')
    dashboard-analytics
@endpush

@push('css')
    <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css"
          class="dashboard-analytics"/>
@endpush

@push('js')
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
@endpush

@push('script')
@endpush

@section('content_area')
@endsection
