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
                                        <th>Action</th>
                                        <th>Target</th>
                                        <th>IP</th>
                                        <th>Time</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $log->causer->name ?? 'System' }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                            {{ str_contains($log->description, 'created') ? 'badge-success' : '' }}
                                            {{ str_contains($log->description, 'updated') ? 'badge-warning' : '' }}
                                            {{ str_contains($log->description, 'deleted') ? 'badge-danger' : '' }}">
                                                    {{ $log->description }}
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
                                <div class="modal fade bd-example-modal-lg" id="log-{{ $log->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Activity Detail</h5>
                                                <button type="button" class="close waves-effect waves-light"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @php
                                                    $actionType = '';
                                                    $badgeClass = '';
                                                    if (str_contains($log->description, 'created')) {
                                                        $actionType = 'Create';
                                                        $badgeClass = 'badge-success';
                                                    } elseif (str_contains($log->description, 'updated')) {
                                                        $actionType = 'Update';
                                                        $badgeClass = 'badge-warning';
                                                    } elseif (str_contains($log->description, 'deleted')) {
                                                        $actionType = 'Delete';
                                                        $badgeClass = 'badge-danger';
                                                    }
                                                @endphp
                                                <p>
                                                    <strong>Action Type:</strong>
                                                    <span class="badge {{ $badgeClass }}">{{ $actionType }}</span>
                                                </p>

                                                <p><strong>Target:</strong>
                                                    {{ $log->subject->name ?? class_basename($log->subject_type) }}</p>

                                                <h6>Changes:</h6>
                                                @if (isset($log->properties['attributes']))
                                                    <ul>
                                                        @foreach ($log->properties['attributes'] as $key => $value)
                                                            <li>
                                                                <b>{{ $key }}</b>:
                                                                {{ $log->properties['old'][$key] ?? '-' }} →
                                                                {{ $value }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @elseif(isset($log->properties['old']))
                                                    <ul>
                                                        @foreach ($log->properties['old'] as $key => $value)
                                                            <li><b>{{ $key }}</b>: {{ $value }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                <small class="text-muted">
                                                    IP: {{ $log->properties['meta']['ip'] ?? '-' }} |
                                                    Browser: {{ $log->properties['meta']['agent'] ?? '-' }}
                                                </small>

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
