@extends('admin.layouts.app')
@section('title', 'Development Processes')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">Development Processes</h5>
                            <button type="button" class="btn btn-outline-primary px-5 rounded-0" data-bs-toggle="modal"
                                data-bs-target="#addProcessModal">
                                Add Process
                            </button>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="processTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Service Name</th>
                                        <th>Description</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($processes as $key => $process)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $process->title }}</td>
                                            <td>{{ $process->service->service_name ?? '' }}</td>
                                            <td>{{ Str::limit($process->description, 30, '...') }}</td>
                                            <td class="text-center"><span
                                                    class="badge bg-success">{{ $process->sort_order }}</span></td>

                                            <td class="text-center">
                                                @if ($process->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{-- Edit --}}
                                                <button type="button"
                                                    class="action-icon border border-primary text-primary me-2 editProcessBtn"
                                                    data-id="{{ $process->id }}" data-title="{{ $process->title }}"
                                                    data-service_id="{{ $process->service_id }}"
                                                    data-description="{{ e($process->description) }}"
                                                    data-status="{{ $process->status }}">
                                                    <i class="bx bx-edit"></i>
                                                </button>

                                                {{-- Delete --}}
                                                <form
                                                    action="{{ route('admin.development_process.destroy', $process->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="action-icon border border-danger text-danger deleteBtn">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
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
    </div>

    {{-- Create Modal --}}
    @include('admin.layouts.pages.services.development_process.create')

    {{-- Edit Modal --}}
    @include('admin.layouts.pages.services.development_process.edit')
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            $('#processTable').DataTable();
        });

        // Delete confirmation (submit existing form)
        $(document).on('click', '.deleteBtn', function() {
            let form = $(this).closest('form');

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
                    form.submit();
                }
            });
        });
    </script>

    <script>
        // Open create modal if validation errors exist
        @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('addProcessModal'));
            myModal.show();
        @endif
    </script>

    <script>
        // Open edit modal + populate
        $(document).on('click', '.editProcessBtn', function() {
            let btn = $(this);
            let id = btn.data('id');

            $('#editProcessId').val(id);
            $('#edit_title').val(btn.data('title'));
            $('#edit_description').val(btn.data('description'));
            $('#edit_status').val(btn.data('status'));

            let serviceId = btn.data('service_id');
            $('#edit_service_id').val(serviceId ? serviceId : '');

            $('#editProcessForm').attr(
                'action',
                "{{ url('admin/services/development-process') }}/" + id
            );

            var modal = new bootstrap.Modal(document.getElementById('editProcessModal'));
            modal.show();
        });
    </script>

    <script>
        $('#editProcessForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                headers: {
                    'Accept': 'application/json'
                },
                success: function(res) {
                    if (res.status === 'success') {
                        if (window.toastr) toastr.success(res.message);
                        setTimeout(function() {
                            window.location.href = res.action_url;
                        }, 500);
                    }
                },
                error: function(err) {
                    let msg = err.responseJSON?.message || 'Something went wrong!';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg
                    });
                }
            });
        });
    </script>
@endpush
