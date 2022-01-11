<!-- Modal -->
<div class="modal fade" id="courseModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('all-'.$routeName.'.store')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="text" class="form-control" name="name"  id="courseName" placeholder="Course Name" required>
                    </div>

                    <div class="form-group mb-2">
                        <input type="number" class="form-control" name="hours" value="{{ old('hours') }}" id="courseHours" placeholder="Course hours" required>
                    </div>

                    <div class="form-group mb-2">
                        <select name="cat_id" id="courseCategory" class="form-control" required>
                            <option value="" selected disabled>Choose Category</option>
                            @foreach ($rows as $item)
                                <option value="{{$item->category->id}}">{{$item->category->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-2">
                        <select name="active" id="courseStatus" class="form-control" required>
                            <option value="" selected disabled>Choose Status</option>
                            <option value="0">Active</option>
                            <option value="1">Hide</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <select name="levels" id="courseLevels" class="form-control" required>
                            <option value="" selected disabled>Choose Level</option>
                            <option value="beginner">beginner</option>
                            <option value="immediat">immediat</option>
                            <option value="high">high</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <textarea name="description" id="courseDesc" placeholder="Description Here" class="form-control" cols="30" rows="10">{{old('name')}}</textarea>
                    </div>

                    <div class="form-group mb-2">
                        <input type="file" name="image" class="form-control image">
                    </div>

                    <div class="form-group mb-2" >
                        <img src="" class="img-thumbnail image-preview" id="courseImage" style="width: 300px;">
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
