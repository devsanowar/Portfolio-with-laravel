<!-- Add Technology Modal -->
<div class="modal fade" id="addTechnologyModal" tabindex="-1" aria-labelledby="addTechnologyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.technology.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTechnologyLabel">Add Technology</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Technology Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="icon_class" class="form-label">Icon Class</label>
                        <input type="text" class="form-control @error('icon_class') is-invalid @enderror"
                            id="icon_class" name="icon_class" value="{{ old('icon_class') }}"
                            placeholder="e.g., bx bx-code">
                        @error('icon_class')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                            id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Technology</button>
                </div>
            </div>
        </form>
    </div>
</div>
