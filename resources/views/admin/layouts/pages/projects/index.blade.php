@extends('admin.layouts.app')
@section('title', 'All Projects')

@push('styles')
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="">All Projects</h5>
                        <a href="{{ route('admin.project.create') }}" class="btn btn-outline-primary px-5 rounded-0">
                            Add Project
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Sort</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $key => $project)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $project->project_title }}</td>
                                    <td>{{ $project->icon_class }}</td>
                                    <td>{{ $project->sort_order }}</td>
                                    <td class="text-center">
                                        @if($project->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.project.edit', $project->id) }}"
                                           class="action-icon border border-primary text-primary me-2">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.project.destroy', $project->id) }}"
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('PUT') {{-- তোমার route PUT, তাই PUT দিলাম [web:203] --}}
                                            <button type="button"
                                                    class="action-icon border border-danger text-danger deleteBtn"
                                                    data-id="{{ $project->id }}">
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
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable();

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
            if (result.isConfirmed) form.submit();
        });
    });
});
</script>
@endpush
