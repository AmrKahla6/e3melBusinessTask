<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="categories/update" method="post">
            @csrf
            @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-control" id="category_name" name="name" value="{{ old('name') }}" id="Name" placeholder="Category Name" required>
                    </div>
                    <div class="form-group mb-2">
                        <select name="active" id="category_status" class="form-control" required>
                            <option value="" selected disabled>Choose Status</option>
                            <option value="0">Active</option>
                            <option value="1">Hide</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>
