<div class="modal fade" id="editProcessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editProcessForm" method="POST" action="{{ route('admin.development_process.update', 0) }}"
                class="modal-content">
                @csrf
                @method('PUT')

                <input type="hidden" id="editProcessId">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Development Process</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    {{-- Service --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Service</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bx-link'></i></span>

                            <select name="service_id" id="edit_service_id" class="form-select">
                                <option value="">-- Select Service --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="text-danger error-text" data-error-for="service_id"></small>
                    </div>

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
