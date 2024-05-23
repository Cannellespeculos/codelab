<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::name('home')->get('/', [PostController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    Lfm::routes();
});

Route::prefix('posts')->group(function () {
    Route::name('posts.display')->get('{slug}', [PostController::class, 'show']);
    Route::name('posts.search')->get('', [PostController::class, 'search']);
    Route::name('posts.comments')->get('{post}/comments', [CommentController::class, 'comments']);
    Route::name('posts.comments.store')->post('{post}/comments', [CommentController::class, 'store'])->middleware('auth');
});

Route::name('category')->get('category/{category:slug}', [PostController::class, 'category']);

Route::name('author')->get('author/{user}', [PostController::class, 'user']);

Route::name('tag')->get('tag/{tag:slug}', [PostController::class, 'tag']);

Route::name('front.comments.destroy')->delete('comments/{comment}', [CommentController::class, 'destroy']);

Route::resource('contacts', ContactController::class, ['only' => ['create', 'store']]);

Route::name('page')->get('page/{page:slug}', PageController::class);

Route::view('admin', 'back.layout');


Route::prefix('admin')->group(function () {
    Route::middleware('redac')->group(function () {
        Route::name('admin')->get('/', [AdminController::class, 'index']);
        Route::name('purge')->put('purge/{model}', [AdminController::class, 'purge']);
        Route::resource('posts', \App\Http\Controllers\Back\PostController::class)->except('show');
    });
    Route::middleware('admin')->group(function () {
        Route::name('posts.indexnew')->get('newposts', [\App\Http\Controllers\Back\PostController::class, 'index']);
    });
});

require __DIR__.'/auth.php';
