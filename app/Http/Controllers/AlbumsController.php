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
        //Query con segnaposti
        $sql = 'select * FROM albums WHERE 1 = 1';
        $where = [];
        if($request->has('id')) {
            $where['id'] = $request->get('id');
            $sql .= " AND ID=:id";
        }
        if($request->has('album_name')) {
            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name=:album_name";
        }
        $sql .= " LIMIT 5";
        $albums = DB::select($sql, $where);
        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('albums.editalbum', ['album'=>$albumEdit[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //
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
