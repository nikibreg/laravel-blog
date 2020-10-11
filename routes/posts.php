<?php

use Illuminate\Http\Request; 
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    $tasks = Post::orderBy('created_at', 'asc')->get();

    return view('posts.index', [
        'posts' => $tasks
    ]);
});

Route::get('/create', function () {
    return view('posts.create');
});

Route::post('/save', function (Request $request) {
    $post = new Post;
    $post->title = $request->title;
    $post->text = $request->text;
    $post->likes = $request->likes;
    $post->save();
    return redirect('/posts');
})->name('posts.save');