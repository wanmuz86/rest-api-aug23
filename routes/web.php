<?php

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
// ROUTE -> HELLO WORLD String
Route::get('/hello', function(){
    return "Hello World";
});

// Route -> View // resources -> views -> goodbye.blade.php

Route::get('/goodbye', function(){
    return view('goodbye');
});

Route::get('/makan/{name}', function($name){
    return view('makan',["name"=>$name]);
});