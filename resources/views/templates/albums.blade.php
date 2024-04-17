@extends('templates.default')
@section('content')
    <h1> Albums </h1>
        <form>
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
            <ul class="list-group" id="ul-album-list">
                @foreach($albums as $album)
                    <li class="list-group-item d-flex justify-content-between">
                        <p> {{$album -> album_name}}</p>
                        <a href="/albums/{{$album->id}}" class="btn btn-danger"> DELETE </a>
                    </li>
                @endforeach
            </ul>
        </form>
@endsection
@section('footer')
    @parent
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("Il documento è pronto!");
            let ul_album_list = document.querySelector('#ul-album-list');
            ul_album_list.addEventListener("click", async function (evt) {
                evt.preventDefault();
                let url_album = evt.target.getAttribute('href');
                let li = evt.target.parentNode;
                let token = document.querySelector("#_token").value;
                try {
                    const response = await fetch(url_album, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    });
                    console.log(response);
                    if(!response.ok) {
                        throw new Error("Errore nella richiesta: " + response.status);
                    }
                    const data = await response.text();
                    if(data == 1) {
                        li.parentNode.removeChild(li);
                    } else {
                        alert('Problem contacting server')
                    }
                    console.log("Risposta ricevuta: ", data)
                } catch(error) {
                    console.log("Si e' verificato un errore: ", error);
                }
            })
        });
    </script>
@endsection
