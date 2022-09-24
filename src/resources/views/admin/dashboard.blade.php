@extends('admin.layouts.master')

@push('body')
    dashboard-analytics
@endpush

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widgets/modules-widgets.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/widgets/modules-widgets.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
@endpush

@push('script')
@endpush

@section('content_area')
    <div class="row layout-top-spacing">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-two">

                <div class="widget-heading">
                    <h5 class="">Top 10 users</h5>
                </div>

                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <div class="th-content">User</div>
                                </th>
                                <th>
                                    <div class="th-content">Tasks Count</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="td-content customer-name">
                                            <span>{{ $user->getUser->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="td-content product-brand text-primary">{{ $user->total }}</div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
