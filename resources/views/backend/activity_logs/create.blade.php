@extends('backend.layouts.app')
@section('title', 'Create Permission')
@push('css')
    <link href="{{ asset('backend') }}/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/sweetalert2custom/sweetalert2.min.css" rel="stylesheet" type="text/css">
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
                                    <a href="{{ route('users.index') }}">List Permissions</a>
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
                            <form method="POST" action="{{ route('permissions.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-1 col-form-label required">Name</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter Name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="guard_name" class="col-sm-1 col-form-label required">Guard Name</label>
                                    <div class="col-sm-11">
                                        <select class="form-control @error('guard_name') is-invalid @enderror"
                                            id="guard_name" name="guard_name">
                                            <option value="" disabled selected>-- Select Guard Name --</option>
                                            <option value="web">Web</option>
                                            <option value="api">Api</option>
                                        </select>
                                        @error('guard_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="group_name" class="col-sm-1 col-form-label required">Group Name</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control @error('group_name') is-invalid @enderror"
                                            id="group_name" name="group_name" placeholder="Enter Group Name"
                                            value="{{ old('group_name') }}">
                                        @error('group_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-5 mb-0 form-group">
                                    <a href="{{ route('permissions.index') }}"
                                        class="mr-2 align-middle btn btn-secondary"><i class="mr-1 fas fa-arrow-left"></i>
                                        Back</a>
                                    <button type="submit" class="align-baseline btn btn-primary"><i
                                            class="mr-1 fas fa-save"></i> Save
                                        Changes</button>
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

    <!-- SweetAlert2 -->
    <script src="{{ asset('backend') }}/plugins/sweetalert2custom/sweetalert2.all.min.js"></script>

    {{-- custom js --}}
    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Failed',
                text: 'Please check the form for errors and try again.',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endpush
