@extends('layout')

@section('content')

    <center> <h3 class="mt-3">Courses</h3></center>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal">
        Add New Course
    </button>
<pre></pre>
<div class="container text-center">
    <div class="row">
 <!-- Optional JavaScript; choose one of the two! -->
 {{-- @include('partials._errors') --}}
 @if (count($rows) != 0)
 <table class="table table-striped" id="datatable">
     <thead>
       <tr>
         <th scope="col">#</th>
         <th scope="col">Course Name</th>
         <th scope="col">Course Description</th>
         <th scope="col">Course Category</th>
         <th scope="col">Course Iamge</th>
         <th>Operation</th>
       </tr>
     </thead>
     <tbody>
         @foreach ($rows as $key=>$item)
             <tr>
             <th scope="row">{{$key +1}}</th>
             <td>{{$item->name}}</td>
             <td>{{substr($item->description,0,20)}}</td>
             <td>{{$item->category->name}}</td>
             <td>
                 <img src="{{$item->image_path}}" class="img-thumbnail" width="100" height="100" alt="" srcset="">
             </td>
             <td>
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#courseModalEdit"
                        data-id="{{ $item->id }}" data-course_name="{{ $item->name }}" data-course_status="{{ $item->active }}"
                        data-description="{{ $item->description }}" data-hours="{{ $item->hours }}" data-levels="{{ $item->levels }}"
                        data-category="{{ $item->category->id }}" data-image="{{ $item->image_path }}" >
                    Edit
                </button>
                <form method="post" action="{{route('all-courses.softDelete',$item->id)}}" style="display: inline-block">
                @csrf
                @method('Delete')
                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i>Soft Delete</button>
                </form>
             </td>
             </tr>
         @endforeach
     </tbody>
 </table>
 @else
 <h4>No Records</h4>
@endif

</div>
@include('back-end.courses.create')
@include('back-end.courses.edit')
</div>
@endsection

@section('scripts')
    <script>
            //Edit Units
            $('#courseModalEdit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var course_name = button.data('course_name')
                var course_status = button.data('course_status')
                var description = button.data('description')
                var hours = button.data('hours')
                var levels = button.data('levels')
                var category = button.data('category')
                var image = button.data('image')

                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #courseName').val(course_name);
                modal.find('.modal-body #courseHours').val(hours);
                modal.find('.modal-body #courseCategory').val(category);
                modal.find('.modal-body #courseStatus').val(course_status);
                modal.find('.modal-body #courseLevels').val(levels);
                modal.find('.modal-body #courseDesc').val(description);
                modal.find('.modal-body #courseImage').attr('src',image);
            })
    </script>
@endsection
