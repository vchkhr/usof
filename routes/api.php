<?php

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('posts', 'PostController');

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user-create', function (Request $request) {
    App\User::create([
        'name' => 'testname',
        'email' => 'testemail@e.c',
        'password' => Hash::make('testpass')
    ]);
});

auth()->user();
