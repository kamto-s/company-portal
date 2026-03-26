@extends('backend.layouts.app')
@section('title', 'Roles')
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
                                <li class="breadcrumb-item active">List @yield('title')</li>
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
                            <div class="mb-3 d-flex align-items-center justify-content-between">
                                <h4 class="m-0 card-title">@yield('title')</h4>
                                <a href="{{ route('roles.create') }}" class="btn btn-primary justify-content-between">
                                    <i class="mr-1 align-middle fas fa-plus-circle"></i> Create
                                </a>
                            </div>
                            <table id="basic-datatable" class="table nowrap hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                    </tr>

                                </tbody>
                            </table>

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
