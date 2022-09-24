@php use App\Models\Admin; @endphp
@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
@endpush

@push('script')

    <script>
        $(document).ready(function () {
            $("#assigned_to_id").select2({
                dropdownParent: $('#parentOfSelect2'),
                tags: true,
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('admin.search.user') }}',
                    dataType: "json",
                    type: "GET",
                    quietMillis: 50,
                    data: function (term) {
                        console.log(term);
                        return {
                            input: term.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush

@section('content_area')
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="row">
                <div id="tooltips" class="col-lg-12 layout-spacing col-md-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Create New</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="needs-validation" method="post" novalidate id="storeForm"
                                  action="{{ route('admin.task.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3 mb-5">
                                        <label for="assigned_by_id">Admins</label>
                                        <select class="form-control" name="assigned_by_id" id="assigned_by_id" required>
                                            @foreach(Admin::all() as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-tooltip">
                                            Look good!
                                        </div>
                                        <div class="invalid-tooltip">
                                            Please fill this field.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5" id="parentOfSelect2">
                                        <label for="assigned_to_id">Assigned User</label>
                                        <select class="form-control"
                                                name="assigned_to_id"
                                                id="assigned_to_id" required>
                                        </select>
                                        <div class="valid-tooltip">
                                            Look good!
                                        </div>
                                        <div class="invalid-tooltip">
                                            Please fill this field.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-5">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title"
                                               name="title" maxlength="2"
                                               placeholder="Title"
                                               value="{{ old('title') }}" required>
                                        <div class="valid-tooltip">
                                            Look good!
                                        </div>
                                        <div class="invalid-tooltip">
                                            Please fill this field.
                                        </div>
                                    </div>
                                    <div class="col-6 mb-5">
                                        <label for="description">Title</label>
                                        <textarea name="description" required class="form-control"
                                                  id="description"></textarea>
                                        <div class="valid-tooltip">
                                            Look good!
                                        </div>
                                        <div class="invalid-tooltip">
                                            Please fill this field.
                                        </div>
                                    </div>
                                </div>
                                <button id="submit_saved" class="btn btn-primary mt-2" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
