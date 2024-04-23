@extends('templates.default')
@section('content')
    <h1> Create New Album </h1>
    @include('partials.inputerrors')
    <form method="post" action="{{ route('albums.store') }}">
        @csrf
        <div class="form-group">
            <label for="album_name"> Name </label>
            <input require class="form-control" type="text" name="album_name" id="album_name" value="{{ old('album_name') }}">
        </div>
        <div class="form-group">
            <label for="description"> Description </label>
            <textarea class='form-control' name='description' id='description' value="{{ old('description') }}"></textarea>
        </div>
        <div>
            <button class="btn btn-primary"> Send </button>
        </div>
    </form>
@endsection
