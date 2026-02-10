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
                        <button type="button" class="btn btn-outline-primary px-5 rounded-0"
                                data-bs-toggle="modal" data-bs-target="#addProcessModal">
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
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($processes as $key => $process)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $process->title }}</td>
                                    <td class="text-center">
                                        @if($process->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $process->created_at?->format('d M Y') }}</td>
                                    <td class="text-center">
                                        {{-- Edit --}}
                                        <button
                                            type="button"
                                            class="action-icon border border-primary text-primary me-2 editProcessBtn"
                                            data-id="{{ $process->id }}"
                                            data-title="{{ $process->title }}"
                                            data-description="{{ e($process->description) }}"
                                            data-status="{{ $process->status }}"
                                        >
                                            <i class="bx bx-edit"></i>
                                        </button>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.development-processes.destroy', $process->id) }}"
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
<div class="modal fade" id="addProcessModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('admin.development_process.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Add Development Process</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" value="{{ old('title') }}"
                 class="form-control @error('title') is-invalid @enderror">
          @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" rows="5"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
          @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status',0) == 0 ? 'selected' : '' }}>Inactive</option>
          </select>
          @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editProcessModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="editProcessForm" method="POST" class="modal-content">
      @csrf
      @method('PUT')

      <input type="hidden" id="editProcessId">

      <div class="modal-header">
        <h5 class="modal-title">Edit Development Process</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" id="edit_title" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" id="edit_description" rows="5" class="form-control"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" id="edit_status" class="form-select">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
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
        if(result.isConfirmed){
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

    // resource update URL: /admin/development-processes/{id}
    $('#editProcessForm').attr('action', '/admin/development-process/' + id);

    var modal = new bootstrap.Modal(document.getElementById('editProcessModal'));
    modal.show();
});
</script>

<script>
// OPTIONAL: AJAX submit for edit (same style as your sample)
$('#editProcessForm').on('submit', function(e){
    e.preventDefault();

    let form = $(this);
    let url = form.attr('action');
    let data = form.serialize();

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        headers: { 'Accept': 'application/json' },
        success: function(res){
            if (res.status === 'success') {
                setTimeout(function() {
                    window.location.href = res.action_url;
                }, 500);

                if (window.toastr) toastr.success(res.message || 'Updated successfully.');
                $('#editProcessModal').modal('hide');
            } else {
                if (window.toastr) toastr.error(res.message || 'Something went wrong.');
            }
        },
        error: function(err){
            let msg = err.responseJSON?.message || 'Something went wrong!';
            Swal.fire({ icon: 'error', title: 'Error', text: msg });
        }
    });
});
</script>
@endpush
