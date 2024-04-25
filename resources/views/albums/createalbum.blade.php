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
            <label for="categories"> Categories </label>
            <select name="categories[]" id="categories" class="form-control" multiple>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"> {{ $cat->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description"> Description </label>
            <textarea class='form-control' name='description' id='description' value="{{ old('description') }}"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary"> Send </button>
        </div>
    </form>
@endsection
