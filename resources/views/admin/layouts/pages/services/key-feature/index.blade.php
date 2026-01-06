@extends('admin.layouts.app')
@section('title', 'Key Features')
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
                        <h5 class="">Add Key Feature</h5>
                        <a href="{{ route('admin.key-feature.create') }}" class="btn btn-outline-primary px-5 rounded-0">Add Feature</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="keyFeatureTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Title</th>
                                    <th>Icon</th>
                                    <th>Description</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keyFeatures as $key => $feature)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $feature->title }}</td>
                                    <td>
                                        @if($feature->icon)
                                            <i class="{{ $feature->icon }}"></i>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{!! Str::limit($feature->description, 50) !!}</td>
                                    <td class="text-center"><span class="badge bg-success">{{ $feature->sort_order }}</span></td>

                                    <td class="text-center">
                                        @if($feature->status)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.key-feature.edit', $feature->id) }}"
                                            class="action-icon border border-primary text-primary me-2">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <!-- Delete Form -->
                                        <form action="{{ route('admin.key-feature.destroy', $feature->id) }}"
                                            method="POST" class="deleteFeatureForm" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="action-icon border border-danger text-danger deleteBtn"
                                                data-id="{{ $feature->id }}">
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
        $('#keyFeatureTable').DataTable();
    });

    $(document).on('click', '.deleteBtn', function() {
        let button = $(this);
        let form = button.closest('form');
        let rowId = button.data('id');

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
@endpush
