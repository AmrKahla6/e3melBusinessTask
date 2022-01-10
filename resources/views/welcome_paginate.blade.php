@foreach ($courses as $item)
<div class="col">
    <div class="card h-100">
        <img src="{{$item->image_path}}" class="card-img-top " alt="..." width="30" height="250">
        <div class="card-body">
        <h5 class="card-title">{{$item->name}}</h5>
        <p class="card-text">{{$item->description}}.</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">
                {{-- Show Rating --}}
                {!! str_repeat('<span class="fa fa-star checked"></span>', $item->rating) !!}
                {!! str_repeat('<span class="fa fa-star"></span>', 5 - $item->rating) !!}
                <span>{{$item->views}}</span>
            </small>
        </div>
    </div>
</div>
@endforeach
{!! $courses->links() !!}
