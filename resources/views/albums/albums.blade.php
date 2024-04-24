@extends('templates.default')
@section('content')
    <h1> Albums </h1>
    @if (session()->has('message'))
        <x-alert-info :message="session()->get('message')" />
    @endif
    <ul class="list-group" id="ul-album-list">
        @foreach ($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                <p> {{ $album->album_name }}</p>
                <div class="d-flex">
                    <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary"> UPDATE </a>
                    <form id="delete-form" method="POST" action="albums/{{ $album->id }}" class="form-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" id="{{ $album->id }}"> DELETE </button>
                    </form>
                </div>
            </li>
        @endforeach
        <li class="list-group-item">{{ $albums->links() }}</li>
    </ul>
@endsection
@section('footer')
    @parent
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let form = document.querySelector('#delete-form');

            if (form) {
                let deleteBtn = document.querySelector('.btn-danger');
                let message = document.querySelector('div.alert-info');
                let url_album = form.action;

                setTimeout(() => {
                    if (message)
                        message.remove();
                }, 3000);
                deleteBtn.addEventListener("submit", async function(evt) {
                    evt.preventDefault();
                    let li = form.closest('li');
                    try {
                        const response = await fetch(url_album, {
                            type: "POST",
                            data: {
                                _method: 'DELETE',
                            },
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                            }
                        });
                        if (!response.ok) {
                            throw new Error("Errore nella richiesta: " + response.status);
                        }
                        const data = await response.text();
                        if (data == 1) {
                            li.parentNode.removeChild(li);
                        } else {
                            alert('Problem contacting server')
                        }
                        console.log("Risposta ricevuta: ", data)
                    } catch (error) {
                        console.log("Si e' verificato un errore: ", error);
                    }
                });
            }
        });
    </script>
@endsection
