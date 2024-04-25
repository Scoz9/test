@extends('templates.default')
@section('content')
    <table class="table tablr-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Albums</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->category_name }}</td>
                    <td>{{ $cat->created_at }}</td>
                    <td>{{ $cat->updated_at }}</td>
                    <td>{{ $cat->albums_count }}</td>
                </tr>
            @empty
                <tr>
                    <th colspan="5"> No categories</th>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5"> {{ $categories->links() }}</th>
            </tr>
        </tfoot>
    </table>
@endsection
