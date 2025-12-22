@extends('admin.layouts.app')
@section('title', 'All Skill Categories')

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
                            <h5 class="">All Skill Categories</h5>
                            <a href="{{ route('admin.skills.category.create') }}"
                                class="btn btn-outline-primary px-5 rounded-0">
                                Add Category
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="skillsTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category->title }}</td>



                                            <td class="text-center">
                                                @if (!empty($category->icon))
                                                    @if (Str::startsWith($category->icon, ['fa', 'fas', 'far', 'fal', 'fab']))
                                                        <i class="{{ $category->icon }}" style="font-size:20px;"></i>
                                                    @else
                                                        <img src="{{ asset($category->icon) }}" alt="icon"
                                                            style="height:28px;">
                                                    @endif
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>

                                            <td class="text-center">{{ $category->sort_order }}</td>

                                            <td class="text-center">
                                                @if ($category->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                {{-- Edit --}}
                                                <a href="{{ route('admin.skills.category.edit', $category->id) }}"
                                                    class="action-icon border border-primary text-primary me-2">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.skills.category.destroy', $category->id) }}"
                                                    method="POST" class="deleteSkillForm d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="action-icon border border-danger text-danger deleteBtn"
                                                        data-id="{{ $category->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- table-responsive -->
                    </div> <!-- card-body -->
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
            $('#skillsTable').DataTable();

            $(document).on('click', '.deleteBtn', function() {
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this category!",
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
        });
    </script>
@endpush
