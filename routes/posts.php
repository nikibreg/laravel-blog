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
    $posts = Post::orderBy('created_at', 'asc')->get();

    return view('posts.index', [
        'posts' => $posts
    ]);
});

Route::get('/create', function () {
    return view('posts.create');
});

Route::get('/{id}', function ($id) {
    $post = Post::findOrFail($id);
    return view('posts.single', [
        'post' => $post
    ]);
});

Route::get('/{id}/update', function ($id) {
    $post = Post::findOrFail($id);
    return view('posts.update', [
        'post' => $post
    ]);
});

Route::post('/{id}/update', function ($id, Request $request) {
    $post = Post::findOrFail($id);
    $post->title = $request->title;
    $post->text = $request->text;
    $post->likes = $request->likes;
    $post->save();
    return redirect('/posts');
})->name('posts.update');

// Route::get('/{id}/delete', function () {
//     return view('posts.create');
// });

Route::get('/{id}/delete', function (Request $request, $id) {
    Post::findOrFail($id)->delete();
    return redirect('/posts');
})->name('posts.delete');

Route::post('/save', function (Request $request) {
    $post = new Post;
    $post->title = $request->title;
    $post->text = $request->text;
    $post->likes = $request->likes;
    $post->save();
    return redirect('/posts');
})->name('posts.save');

Route::post('/save', function (Request $request) {
    $post = new Post;
    $post->title = $request->title;
    $post->text = $request->text;
    $post->likes = $request->likes;
    $post->save();
    return redirect('/posts');
})->name('posts.save');