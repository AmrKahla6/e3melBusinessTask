
@section('styles')
<style>
    .checked {
        color: orange;
    }
</style>
@show
@extends('layout')
@section('content')
<div class="container">
<div class="row">
  <div class="col">
      <select name="" id="category_id" class="form-control mt-2">
            <option value="" disabled selected>Choose Category</option>
            @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
      </select>
  </div>
  <div class="col">
    <select name="" id="rate_id" class="form-control mt-2">
        <option value="" disabled selected>Choose Rate</option>
        @for ($i = 5; $i >= 1; $i--)
          <option value="{{$i}}">{{$i}}</option>
        @endfor

    </select>
  </div>
  <div class="col">
    <select name="" id="" class="form-control mt-2">
        <option value="" disabled selected>Choose Levels</option>
    </select>
  </div>
</div>
</div>
<input type="hidden" value="" id="stack_category_id">
<input type="hidden" value="" id="stack_rate_id">
<div class="row row-cols-1 row-cols-md-3 g-4 m-4" id="card_data">
@if (count($courses) != 0)
    @include('welcome_paginate')
@endif
</div>
@endsection


@section('scripts')
<script>
$(".container").on("change", "#category_id", function(e){
  e.preventDefault()
  var product     = $("option:selected", this);
  var category_id = this.value;
  $('#stack_category_id').val(category_id);
  let rate_id = $('#stack_rate_id').val();
  fetch_data(1, category_id, rate_id);
});

$(".container").on("change", "#rate_id", function(e){
  e.preventDefault()
  var product     = $("option:selected", this);
  var rate_id     = this.value;
  $('#stack_rate_id').val(rate_id);
  let category_id = $('#stack_category_id').val();
  fetch_data(1, category_id, rate_id);
});

$(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    let category_id = $('#stack_category_id').val();
    let rate_id = $('#stack_rate_id').val();
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page, category_id, rate_id);
});

function fetch_data(page, category_id, rate_id){
  $.ajax({
      url:"fetch_data?page="+page,
      data: {category_id: category_id, rate_id: rate_id},
      success:function(data)
      {
          $('#card_data').html(data);
      }
  });
}
</script>
@endsection

