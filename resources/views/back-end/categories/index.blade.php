@extends('layout')

@section('content')

    <center> <h3 class="mt-3">Products</h3></center>
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
                <a class="btn btn-info btn-sm" href=""><i class="fa fa-edit"></i>Edit</a>
                <form method="post" action="" style="display: inline-block">
                @csrf()
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i>Delete</button>
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
</div>
@endsection
