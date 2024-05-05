@extends('templates.default')
@section('content')
    @if (session()->has('message'))
        <x-alert-info :message="session()->get('message')" />
    @endif
    <div class="row">
        <div class="col-sm-8">
            <h1> Category List </h1>
            <table class="table tablr-striped table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Albums</th>
                        <th>Albums</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $cat)
                        <tr id="tr-{{ $cat->id }}">
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->category_name }}</td>
                            <td>{{ $cat->created_at }}</td>
                            <td>{{ $cat->updated_at }}</td>
                            <td>
                                @if ($cat->albums_count > 0)
                                    <a href="{{ route('albums.index') }}?category_id={{ $cat->id }}">
                                        {{ $cat->albums_count }}</a>
                                @else
                                    {{ $cat->albums_count }}
                                @endif
                            </td>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-success m-1" href="{{ route('categories.edit', $cat->id) }}"
                                    title="update category">Update</a>
                                <form id="delete-form" action="{{ route('categories.destroy', $cat->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button id="btn-{{ $cat->id }}" class="btn btn-danger m-1"
                                        title="delete category">Delete</button>
                                </form>
                            </td>
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
        </div>
        <div class="col-sm-4">
            @include('categories.partials.categoryform')
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(5000);
            $('form .btn-danger ').on('click',function (ele) {
                ele.preventDefault();

                var f = this.parentNode;
                var categoryId = this.id.replace('btnDelete-','')*1;
                var Trid ='tr-'+ categoryId;
                var urlCategory = f.action;

                $.ajax(
                    urlCategory,
                    {
                        method: 'DELETE',
                        data : {
                            '_token' : window.Laravel.csrf_token
                        },
                        complete : function (resp) {
                            var response = JSON.parse(resp.responseText);
                            alert(response.message);
                            if(response.success){
                                //  alert(resp.responseText)
                                $('#'+Trid).fadeOut();
                                // $(li).remove();
                            } else {
                                alert('Problem contacting server');
                            }
                        }
                    }
                )
            });
            return false;
        });
    </script>
@endsection
