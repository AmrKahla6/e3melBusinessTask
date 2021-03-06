@extends('layout')

@section('content')

    <center> <h3 class="mt-3">Categories</h3></center>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Category
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
         <th scope="col">Category Name</th>
         <th scope="col">Category Status</th>
         <th>Operation</th>
       </tr>
     </thead>
     <tbody>
         @foreach ($rows as $key=>$item)
             <tr>
             <th scope="row">{{$key +1}}</th>
             <td>{{$item->name}}</td>
             @if ($item->active == 0)
                <td style="color:green">Active</td>
             @else
                <td style="color:red">Disactive</td>
             @endif
             <td>
                {{-- <a class="btn btn-info btn-sm" href=""><i class="fa fa-edit"></i>Edit</a> --}}
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                        data-id="{{ $item->id }}" data-category_name="{{ $item->name }}" data-category_status="{{ $item->active }}">
                    Edit
                </button>
                <form method="post" action="{{route($routeName.'.softDelete',$item->id)}}" style="display: inline-block">
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
@include('back-end.categories.create')
@include('back-end.categories.edit')
</div>
@endsection

@section('scripts')
    <script>
            //Edit Units
            $('#exampleModal1').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var category_name = button.data('category_name')
                var category_status = button.data('category_status')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #category_name').val(category_name);
                modal.find('.modal-body #category_status').val(category_status);
            })
    </script>
@endsection
