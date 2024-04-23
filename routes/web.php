<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ProfileController;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
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
*/

Route::get('usersnoalbums', function () {
    $usersnoalbum = DB::table('users as u')->leftJoin('albums as a', 'u.id', 'a.user_id')
        ->select('u.id', 'email', 'name', 'album_name')->whereNull('album_name')
        ->get();
    return $usersnoalbum;
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/albums', AlbumsController::class);
    Route::delete('/albums/{album}', [AlbumsController::class, 'delete']);
    Route::get('/albums/{album}', [AlbumsController::class, 'show']);
    Route::get('/users', [AlbumsController::class, 'index']);
});

require __DIR__ . '/auth.php';
