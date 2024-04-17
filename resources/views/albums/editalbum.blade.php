@extends('templates.default')
@section('content')
    <h1> Edit Album - {{$album->album_name}}</h1>
    <form action="">
        <div class="form-group">
            <label for="name"> Name </label>
            <input class="form-control"
                   type="text" name="album_name"
                   id="album_name"
                   value="{{$album->album_name}}">
        </div>
        <div class="form-group">
            <label for="description"> Description </label>
            <textarea class='form-control'
                      name='description'
                      id='description'>{{$album->description}}
            </textarea>
        </div>
        <div>
            <button class="btn btn-primary"> Invia </button>
        </div>
    </form>
@endsection
