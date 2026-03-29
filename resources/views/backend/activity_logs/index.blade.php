@extends('backend.layouts.app')
@section('title', 'Activity Logs')
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
                            </div>

                            <table id="basic-datatable" class="table table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                        <th>Target</th>
                                        <th>IP</th>
                                        <th>Time</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        @php
                                            $desc = strtolower($log->description);

                                            $actionType = match (true) {
                                                str_contains($desc, 'create') => 'Create',
                                                str_contains($desc, 'update') => 'Update',
                                                str_contains($desc, 'delete') => 'Delete',
                                                str_contains($desc, 'login') => 'Login',
                                                str_contains($desc, 'logout') => 'Logout',
                                                default => ucfirst($log->description),
                                            };

                                            $badgeClass = match (true) {
                                                str_contains($desc, 'create') => 'badge-success',
                                                str_contains($desc, 'update') => 'badge-warning',
                                                str_contains($desc, 'delete') => 'badge-danger',
                                                str_contains($desc, 'login') => 'badge-success',
                                                str_contains($desc, 'logout') => 'badge-danger',
                                                default => 'badge-secondary',
                                            };
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $log->causer->name ?? 'System' }}</td>
                                            <td>{{ class_basename($log->subject_type) ?? '-' }}</td>
                                            <td>
                                                <span class="badge {{ $badgeClass }}">
                                                    {{ $actionType }}
                                                </span>
                                            </td>
                                            <td>{{ $log->subject->name ?? class_basename($log->subject_type) }}</td>
                                            <td>{{ $log->properties['meta']['ip'] ?? '-' }}</td>
                                            <td>{{ $log->created_at->diffForHumans() }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info waves-effect waves-light"
                                                    data-toggle="modal" data-target="#log-{{ $log->id }}">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Modal detail per log --}}
                            @foreach ($logs as $log)
                                <div class="modal fade bd-example-modal-lg" id="log-{{ $log->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Activity Detail</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                @php
                                                    $desc = strtolower($log->description);

                                                    $actionType = match (true) {
                                                        str_contains($desc, 'create') => 'Create',
                                                        str_contains($desc, 'update') => 'Update',
                                                        str_contains($desc, 'delete') => 'Delete',
                                                        str_contains($desc, 'login') => 'Login',
                                                        str_contains($desc, 'logout') => 'Logout',
                                                        default => ucfirst($log->description),
                                                    };

                                                    $badgeClass = match (true) {
                                                        str_contains($desc, 'create') => 'badge-success',
                                                        str_contains($desc, 'update') => 'badge-warning',
                                                        str_contains($desc, 'delete') => 'badge-danger',
                                                        str_contains($desc, 'login') => 'badge-success',
                                                        str_contains($desc, 'logout') => 'badge-danger',
                                                        default => 'badge-secondary',
                                                    };

                                                    $properties = $log->properties ?? [];
                                                    $meta = $properties['meta'] ?? [];
                                                    $attributes = $properties['attributes'] ?? [];
                                                    $old = $properties['old'] ?? [];
                                                @endphp

                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <strong>Actor</strong><br>
                                                        {{ $log->causer->name ?? '-' }}
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <strong>Date</strong><br>
                                                        {{ $log->created_at?->format('d M Y H:i:s') ?? '-' }}
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <strong>Action</strong><br>
                                                        <span class="badge {{ $badgeClass }}">
                                                            {{ $actionType }}
                                                        </span>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <strong>Type</strong><br>
                                                        {{ class_basename($log->subject_type) ?? '-' }}
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <strong>Target</strong><br>
                                                        {{ $log->subject->name ?? '-' }}
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <strong>IP Address</strong><br>
                                                        {{ $meta['ip'] ?? '-' }}
                                                    </div>
                                                </div>

                                                {{-- Changes --}}
                                                <div class="mb-3">
                                                    <strong>Changes</strong>
                                                    @if (!empty($attributes))
                                                        <ul class="mt-2 list-group">
                                                            @foreach ($attributes as $key => $value)
                                                                <li
                                                                    class="py-2 list-group-item d-flex justify-content-between align-items-center">
                                                                    <span><b>{{ ucfirst($key) }}</b></span>
                                                                    <span>
                                                                        <span class="text-danger">
                                                                            {{ $old[$key] ?? '-' }}
                                                                        </span>
                                                                        →
                                                                        <span class="text-success">
                                                                            {{ $value ?? '-' }}
                                                                        </span>
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <div class="mt-2 text-muted">
                                                            No changes data
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mt-3">
                                                    <strong>Browser</strong><br>
                                                    <small>{{ $meta['agent'] ?? '-' }}</small>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
    <script src="{{ asset('backend') }}/assets/pages/datatables-demo.js"></script>
@endpush
