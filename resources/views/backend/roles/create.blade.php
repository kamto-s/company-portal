@extends('backend.layouts.app')
@section('title', 'Create Role')
@push('css')
    <link href="{{ asset('backend') }}/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">@yield('title')</h4>

                        <div class="page-title-right">
                            <ol class="m-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Company</a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('roles.index') }}">List Roles</a>
                                </li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">@yield('title')</h4>
                            <form>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-1 col-form-label">Role Name</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control" id="colFormLabel"
                                            placeholder="Enter Role Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <!-- third party js -->
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/buttons.flash.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/buttons.print.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/dataTables.select.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/pdfmake.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('backend') }}/assets/pages/datatables-demo.js"></script>
@endpush
