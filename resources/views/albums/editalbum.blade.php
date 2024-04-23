@extends('templates.default')
@section('content')
    <h1> Edit Album - {{ $album->album_name }}</h1>
    @include('partials.inputerrors')
    <form method="post" action="{{ route('albums.update', ['album' => $album->id]) }}">
        @method('PATCH')
        @csrf()
        {{--    {{method_field('PATCH')}}} --}}
        {{--    <input type="hidden" name="_method" value="PATCH"> --}}
        <div class="form-group">
            <label for="album_name"> Name </label>
            <input class="form-control" type="text" name="album_name" id="album_name" value="{{ $album->album_name }}">
        </div>
        <div class="form-group">
            <label for="description"> Description </label>
            <textarea class='form-control' name='description' id='description'>{{ $album->description }}
            </textarea>
        </div>
        <div>
            <button class="btn btn-primary"> Invia </button>
        </div>
    </form>
@endsection
