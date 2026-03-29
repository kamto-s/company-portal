@extends('backend.layouts.app')
@section('title', 'Categories')
@push('css')
    <link href="{{ asset('backend') }}/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/plugins/sweetalert2custom/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/assets/css/custom.css" rel="stylesheet" type="text/css" />
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
                                @can('category.create')
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary justify-content-between">
                                        <i class="mr-1 align-middle fas fa-plus-circle"></i> Create
                                    </a>
                                @endcan
                            </div>
                            <table id="basic-datatable" class="table table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th class="row">#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        @canany(['category.edit', 'category.delete'])
                                            <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $category->name }}</td>
                                            <td>
                                                @if ($category->status === 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">{{ $category->created_at->format('d-M-y h:i:s') }}
                                            </td>
                                            @canany(['category.edit', 'category.delete'])
                                                <td class="py-0 align-middle">
                                                    <div class="mb-2 btn-group">
                                                        <button type="button"
                                                            class="btn btn-link dropdown-toggle waves-effect waves-light"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                                class="bx bx-dots-vertical-rounded"></i></button>
                                                        <div class="dropdown-menu">
                                                            @can('category.edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('categories.edit', $category->id) }}">
                                                                    <i class="mr-2 fas fa-edit text-warning"></i>Edit
                                                                </a>
                                                            @endcan
                                                            @can('category.delete')
                                                                <a class="dropdown-item btn-delete" href="javascript:void(0)"
                                                                    data-id="{{ $category->id }}">
                                                                    <i class="mr-2 fas fa-trash-alt text-danger"></i>Delete
                                                                </a>
                                                                <form method="POST"
                                                                    action="{{ route('categories.delete', $category->id) }}"
                                                                    id="delete-form-{{ $category->id }}" style="display: none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No records found.</td>
                                        </tr>
                                    @endforelse
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

    <!-- SweetAlert2 confirm delete -->
    <script src="{{ asset('backend') }}/plugins/sweetalert2custom/sweetalert2.all.min.js"></script>
    <script>
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var dataId = $(this).data('id');
            var formId = 'delete-form-' + dataId;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById(formId);
                    if (form) {
                        form.submit();
                    } else {
                        Swal.fire('Error', 'Form not found', 'error');
                    }
                }
            });
        });
    </script>
@endpush
