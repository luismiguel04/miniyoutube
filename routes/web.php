<?php

use Illuminate\Support\Facades\Route;
use App\Models\video;
use APP\Models\Comentarios;

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
     return view('welcome');
    });
 /*  $videos= video::all();
  foreach($videos as $video){
      echo $video ->title.'<br>';
      echo $video ->user ->email. '<br>';
      foreach($video->comments as $comment){
        echo $comment->body;
        }
        echo '<hr>';


       }
       die();
return view(‘welcome’);
}); */



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('videos','App\Http\Controllers\VideoController');
