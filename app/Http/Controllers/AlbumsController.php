<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Raw Query
        /* $sql = 'select * FROM albums WHERE 1 = 1';
        $where = [];
        if ($request->has('id')) {
            $where['id'] = $request->get('id');
            $sql .= " AND ID=:id";
        }
        if ($request->has('album_name')) {
            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name=:album_name";
        }
        $sql .= " ORDER BY id DESC";
        $albums = DB::select($sql, $where);*/

        $albPerPage = config('gallery.alb_per_page');

        //Query Builder
        $queryBuilder = DB::table('albums')->orderBy('id', 'DESC');
        if ($request->has('id')) {
            $queryBuilder->where('id', '=', $request->input('id'));
        }
        if ($request->has('album_name')) {
            $queryBuilder->where('album_name', 'like', '%' . $request->input('album_name') . '%');
        }
        $albums = $queryBuilder->paginate($albPerPage);
        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.createalbum');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumRequest $request)
    {
        $data = $request->only(['album_name', 'description']);
        $data['user_id'] = 1;
        $data['album_thumb'] = '';

        // Raw Query
        /* $query = 'INSERT INTO albums (album_name, description, user_id, album_thumb) values (:album_name, :description, :user_id, :album_thumb)';
        $res = DB::insert($query, $data); */

        // Query Builder
        // $queryBuilder = DB::table('albums')->insert($data);

        // Eloquent Model
        // $eloquent = Album::insert($data);
        $eloquent = Album::create($data);

        $message = 'Album ' . $data['album_name'];
        $message .= $eloquent ? ' created' : ' not created';
        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        // Raw Query
        // $sql = 'select * FROM albums where id=:id';
        // return DB::select($sql, ['id' => $album]);

        // Eloquent Model
        return $album;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        // Raw Query
        // $sql = 'select * from albums where id=:id';
        // $albumEdit = Db::select($sql, ['id' => $album->id]);
        // return view('albums.editalbum', ['album' => $albumEdit[0]]);

        return view('albums.editalbum', ['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $data = $request->only(['album_name', 'description']);

        //Raw Query
        /* $data['id'] = $album->id;
        $sql = 'UPDATE albums set album_name=:album_name, description=:description where id=:id';
        $res = Db::update($sql, $data);*/

        // Query Builder
        // $queryBuilder = DB::table('albums')->where('id', '=', $album->id)->update($data);

        // Eloquent Model
        // $eloquent = Album::where('id', '=', $album->id)->update($data);
        $eloquent = $album->update($data);

        $message = 'Album ' . $album->id;
        $message .= $album ? ' updated' : ' not updated';
        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $album)
    {
        // Query Builder
        // Method 1: $queryBuilder = DB::table('albums')->delete($album);
        // Method 2: $queryBuilder = DB::table('albums')->whereId($id)->delete();
        // Method 3: $queryBuilder = DB::table('albums')->where('id', '=', $album)->delete();
        // return $queryBuilder;

        // Eloquent Model
        // Album::findOrFail($album)->delete();
        return Album::destroy($album);
    }

    public function delete(int $album)
    {
        // Raw Query
        /* $sql = 'DELETE FROM albums WHERE id=:id';
        return DB::delete($sql, ['id' => $album]); */
        return $this->destroy($album);
    }
}
