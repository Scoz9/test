@extends('templates.default')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            <h1> {{ $category->category_name ? 'Modify category' : 'Create new category' }}</h1>
            @include('categories.partials.categoryform')
        </div>
    </div>
@endsection
