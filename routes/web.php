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
//\Livewire\Volt\Volt::route('', 'tododetail')->name('todo.index');
\Livewire\Volt\Volt::route('todos/{todo}', 'tododetail')->name('todo.show');
