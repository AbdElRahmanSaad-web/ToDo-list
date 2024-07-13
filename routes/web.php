<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToDoController;
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



Route::controller(AuthController::class)->group(function(){
    Route::get('login', 'login_form')->name('get_login')->middleware('alreadyLoggedIn');
    Route::post('login', 'login')->name('post_login');
    Route::get('register', 'register_form')->name('get_register')->middleware('alreadyLoggedIn');
    Route::post('register', 'register')->name('post_register');
    Route::get('/','dashboard')->middleware('isLoggedIn');
    Route::get('/logout','logout')->name('logout');
});

Route::middleware(['web', 'auth'])->group(function() {
    Route::post('create_or_update', [ToDoController::class, 'create_or_update'])->name('create_or_update');
    Route::delete('todo/{id}', [ToDoController::class, 'destroy'])->name('destroy');
    Route::post('/filter-tasks', [ToDoController::class, 'filterTasks'])->name('filter.tasks');
    Route::get('tasks/{id}', [ToDoController::class, 'get_data']);
    Route::put('tasks/{id}', [ToDoController::class, 'create_or_update']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
