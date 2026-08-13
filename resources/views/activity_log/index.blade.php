@extends('admin.layout')

@section('admin-activity-log')
<div class="main-panel">
    <div class="content-wrapper">

        <x-toast />

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">

                        <!-- Header Toolbar -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="card-title card-title-dash mb-0">Activity Log</h3>
                                <p class="card-subtitle card-subtitle-dash">System activity and audit history</p>
                            </div>
                            <div>
                                <a href="{{ route('activity-log.export') }}" class="btn btn-outline-primary">
                                    <i class="mdi mdi-download"></i> Export CSV
                                </a>
                            </div>
                        </div>

                        <!-- Activity Log Table -->
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Action</th>
                                        <th>Category</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logs as $log)
                                    <tr>
                                        <td>
                                            <h6>{{ $log->created_at ? $log->created_at->format('d M Y, h:i A') : 'N/A' }}</h6>
                                        </td>
                                        <td>
                                            @php
                                                $actionClass = match(strtolower($log->Activity)) {
                                                    'create', 'add', 'insert' => 'badge-opacity-success',
                                                    'update', 'edit'         => 'badge-opacity-warning',
                                                    'delete', 'remove'       => 'badge-opacity-danger',
                                                    default                  => 'badge-opacity-info',
                                                };
                                            @endphp
                                            <span class="badge {{ $actionClass }}">
                                                {{ $log->Activity }}
                                            </span>
                                        </td>
                                        <td>
                                            <h6 class="fw-semibold mb-0">
                                                {{ $log->category_name }} 
                                                <span class="text-muted fs-7">(ID: {{ $log->category_id }})</span>
                                            </h6>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-wrap">{{ $log->details }}</p>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            No activity recorded yet. Create, update, or delete a product or category to generate log entries.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Laravel Pagination Links -->
                        <div class="d-flex justify-content-end mt-4">
                            {{ $logs->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection