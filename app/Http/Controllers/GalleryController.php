<?php

namespace App\Http\Controllers;

use App\Models\{Album, Category};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index()
    {
        // DB::enableQueryLog();
        //$albums = Album::latest()->paginate(50);
        //$albums = Album::with('categories')->get()->toArray();
        $albums = Album::with('categories')->latest()->paginate(50);
        return view('gallery.albums')->with(['albums'=> $albums, 'category_id' => null]);
    }

    public function showCategoryAlbums(Category $category)
    {
        return view('gallery.albums')->with([
            'category_id' => $category->id, 'albums' => $category->albums()
            ->with('categories')->latest()->paginate()]); //tutti gli album di quella categoria
    }
}
