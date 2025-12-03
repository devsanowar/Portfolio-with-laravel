@extends('admin.layouts.app')
@section('title', 'All Skills')

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
                        <h5 class="">All Skills</h5>
                        <a href="{{ route('admin.skills.create') }}" class="btn btn-outline-primary px-5 rounded-0">
                            Add Skill
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="skillsTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Skill Name</th>
                                    <th>Skill Value (%)</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skills as $key => $skill)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $skill->skill_name }}</td>
                                        <td>{{ $skill->skill_value }}</td>
                                        <td class="text-center">
                                            @if($skill->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.skills.edit', $skill->id) }}"
                                               class="action-icon border border-primary text-primary me-2">
                                                <i class="bx bx-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.skills.destroy', $skill->id) }}"
                                                  method="POST"
                                                  class="deleteSkillForm d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="action-icon border border-danger text-danger deleteBtn"
                                                        data-id="{{ $skill->id }}">
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
        // DataTable init
        $('#skillsTable').DataTable();

        // Delete confirm
        $(document).on('click', '.deleteBtn', function() {
            let button = $(this);
            let form = button.closest('form');
            let rowId = button.data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this skill!",
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
