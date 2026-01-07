@extends('admin.layouts.app')
@section('title', 'Technologies')

@push('styles')
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush

@section('admin_content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="">Technologies</h5>
                        <!-- Add Technology Button -->
                        <button type="button" class="btn btn-outline-primary px-5 rounded-0" data-bs-toggle="modal" data-bs-target="#addTechnologyModal">
                            Add Technology
                        </button>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="technologyTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($technologies as $key => $tech)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tech->name }}</td>
                                    <td>
                                        @if($tech->icon_class)
                                            <i class="{{ $tech->icon_class }}"></i>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center"><span class="badge bg-success">{{ $tech->sort_order }}</span></td>
                                    <td class="text-center">
                                        @if($tech->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Edit Button -->
                                        <!-- Edit Button -->
                                    <button
                                        type="button"
                                        class="action-icon border border-primary text-primary me-2 editTechBtn"
                                        data-id="{{ $tech->id }}"
                                        data-name="{{ $tech->name }}"
                                        data-icon="{{ $tech->icon_class }}"
                                        data-sort="{{ $tech->sort_order }}"
                                        data-status="{{ $tech->status }}"
                                    >
                                        <i class="bx bx-edit"></i>
                                    </button>


                                        <!-- Delete Form -->
                                        <form action="{{ route('admin.technology.destroy', $tech->id) }}" method="POST" class="deleteTechForm" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-icon border border-danger text-danger deleteBtn" data-id="{{ $tech->id }}">
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

@include('admin.layouts.pages.services.technology.create')
@include('admin.layouts.pages.services.technology.edit')
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

<script>
$(document).ready(function() {
    $('#technologyTable').DataTable();
});

// Delete confirmation
$(document).on('click', '.deleteBtn', function() {
    let button = $(this);
    let form = button.closest('form');
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
        if(result.isConfirmed){
            form.submit();
        }
    });
});
</script>

<script>
    @if ($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('addTechnologyModal'));
        myModal.show();
    @endif
</script>

<script>
// Open edit modal and populate fields
$(document).on('click', '.editTechBtn', function() {
    let button = $(this);
    let id = button.data('id');

    $('#editTechId').val(id);
    $('#edit_name').val(button.data('name'));
    $('#edit_icon_class').val(button.data('icon'));
    $('#edit_sort_order').val(button.data('sort'));
    $('#edit_status').val(button.data('status'));

    // Set form action dynamically
    $('#editTechnologyForm').attr('action', '/admin/technology/' + id);

    // Show modal
    var myModal = new bootstrap.Modal(document.getElementById('editTechnologyModal'));
    myModal.show();
});

// AJAX submit for edit
$('#editTechnologyForm').on('submit', function(e){
    e.preventDefault();

    let form = $(this);
    let url = form.attr('action');
    let data = form.serialize();

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(res){
            if (res.status === 'success') {
                setTimeout(function() {
                    window.location.href = res.action_url;
                }, 1000);
                toastr.success(res.message || 'Technology updated successfully.');

                $('#editTechnologyModal').modal('hide');
            } else {
                toastr.error(res.message || 'Something went wrong.');
            }
        },
        error: function(err){
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
