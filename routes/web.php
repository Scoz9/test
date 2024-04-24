<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\CssSelector\Node\FunctionNode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/albums', function () {
    return  Album::paginate(5);
});
Route::get('/albums', function () {
    return  Album::with('photos')->paginate(80);
});
Route::get('/users', function () {
    return  User::get();
});
Route::get('/users', function () {
    return  User::with('albums')->paginate(80);
});

// Esempio Join
Route::get('usersnoalbums', function () {
    $usersnoalbum = DB::table('users as u')->leftJoin('albums as a', 'u.id', 'a.user_id')
        ->select('u.id', 'email', 'name', 'album_name')->whereNull('album_name')
        ->get();
    return $usersnoalbum;
});
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/albums', AlbumsController::class);
    Route::delete('/albums/{album}', [AlbumsController::class, 'delete']);
    Route::get('/users', [AlbumsController::class, 'index']);
});

// gallery
Route::group(['prefix' => 'gallery'], function () {
    Route::get('albums', [GalleryController::class, 'index']);
});
Route::resource('categories', CategoryController::class);

require __DIR__ . '/auth.php';
