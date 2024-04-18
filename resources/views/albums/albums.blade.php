@extends('templates.default')
@section('content')
    <h1> Albums </h1>
    @if(session()->has('message'))
        <x-alert-info :message="session()->get('message')"/>
    @endif
        <form>
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
            <ul class="list-group" id="ul-album-list">
                @foreach($albums as $album)
                    <li class="list-group-item d-flex justify-content-between">
                        <p> {{$album -> album_name}}</p>
                        <div>
                            <a href="/albums/{{$album->id}}/edit " class="btn btn-primary"> UPDATE </a>
                            <a href="/albums/{{$album->id}}" class="btn btn-danger"> DELETE </a>
                        </div>
                    </li>

                @endforeach
            </ul>
        </form>
@endsection
@section('footer')
    @parent
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let ul_album_list = document.querySelector('#ul-album-list');
            let message = document.querySelector('div.alert-info');
            setTimeout(() => {
                message.remove();
            }, 3000);
            ul_album_list.addEventListener("click", async function (evt) {
                if (evt.target.classList.contains("btn-danger")) {
                    evt.preventDefault();
                    let url_album = evt.target.getAttribute('href');
                    let li = evt.target.parentNode.parentNode;
                    let token = document.querySelector("#_token").value;
                    try {
                        const response = await fetch(url_album, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            }
                        });
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
                }
            })
        });
    </script>
@endsection
