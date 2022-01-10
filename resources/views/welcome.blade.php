
@section('styles')
    <style>
        .checked {
            color: orange;
        }
    </style>
@show
@extends('layout')
@section('content')
<div class="row row-cols-1 row-cols-md-3 g-4 m-4" id="card_data">
    @if (count($courses) != 0)
        @include('welcome_paginate')
    @endif
  </div>
@endsection


@section('scripts')
  <script>
      //Ajax code to paginate without reload page
      $(document).ready(function(){
        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        //Function to fetch date using ajax
        function fetch_data(page){
            $.ajax({
                url:"fetch_data?page="+page,
                success:function(data)
                {
                    $('#card_data').html(data);
                }
            });
        }
      });
  </script>
@endsection

