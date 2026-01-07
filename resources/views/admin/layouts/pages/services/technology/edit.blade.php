<!-- Edit Technology Modal -->
<div class="modal fade" id="editTechnologyModal" tabindex="-1" aria-labelledby="editTechnologyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editTechnologyForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTechnologyLabel">Edit Technology</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="editTechId">

                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Technology Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_icon_class" class="form-label">Icon Class</label>
                        <input type="text" class="form-control" id="edit_icon_class" name="icon_class" placeholder="e.g., bx bx-code">
                    </div>

                    <div class="mb-3">
                        <label for="edit_sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="edit_sort_order" name="sort_order">
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select name="status" id="edit_status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Technology</button>
                </div>
            </div>
        </form>
    </div>
</div>
