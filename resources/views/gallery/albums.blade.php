@extends('templates.default')
@section('content')
    <div class="row">
        @foreach ($albums as $album)
            <div class="col-sm-7 col-md-5 col-lg-4">
                <div class="card m-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $album->album_name }}</h5>
                        <p class="card-text">{{ $album->album_description }}</p>
                        <p class="card-text">
                            @foreach ($album->categories as $cat)
                                <a href="{{ route('gallery.categories.albums', $cat->id) }}"> {{ $cat->category_name }}</a>
                            @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        {{-- {{dd(DB::getQueryLog())}} --}}
    </div>
@endsection
