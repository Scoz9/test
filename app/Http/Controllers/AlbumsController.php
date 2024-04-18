<?php

namespace App\Http\Controllers;

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
        //Query with signpost
        $sql = 'select * FROM albums WHERE 1 = 1';
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
        $albums = DB::select($sql, $where);
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
    public function store(Request $request)
    {
        $data = $request->only(['album_name', 'description']);
        $data['user_id'] = 1;
        $data['album_thumb'] = '';
        $query = 'INSERT INTO albums (album_name, description, user_id, album_thumb) values (:album_name, :description, :user_id, :album_thumb)';
        $res = DB::insert($query, $data);
        $message = 'Album ' . $data['album_name'];
        $message .= $res ? ' created' : ' not created';
        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $album)
    {
        $sql = 'select * FROM albums where id=:id';
        return DB::select($sql, ['id' => $album]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $sql = 'select * from albums where id=:id';
        $albumEdit = Db::select($sql, ['id' => $album->id]);
        return view('albums.editalbum', ['album' => $albumEdit[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $data = $request->only(['album_name', 'description']);
        $data['id'] = $album->id;
        $sql = 'UPDATE albums set album_name=:album_name, description=:description where id=:id';
        $res = Db::update($sql, $data);
        $message = 'Album ' . $album->id;
        $message .= $res ? ' updated' : ' not updated';
        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }

    public function delete(int $album)
    {
        $sql = 'DELETE FROM albums WHERE id=:id';
        return DB::delete($sql, ['id' => $album]);
    }
}
