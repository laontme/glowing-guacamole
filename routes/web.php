<?php

use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'landing')->name('landing');

Route::name('user.')
    ->controller(UserController::class)
    ->prefix('/user')
    ->group(function () {
        Route::view('/login', 'user.login')->name('login.form');
        Route::post('/login', 'login')->name('login');

        Route::middleware('auth')->group(function () {
            Route::view('/logout', 'user.logout')->name('logout.form');
            Route::post('/logout', 'logout')->name('logout');

            Route::view('/settings', 'user.settings')->name('settings.form');
            Route::post('/settings', 'settings')->name('settings');

            Route::get('/dashboard', 'dashboard')->name('dashboard');
        });
    });

Route::middleware('auth:token')->get('/test3', function (Request $request) {
    return response($request->user());
});

Route::name('todo.')
    ->prefix('/todo')
    ->middleware('auth')
    ->group(function () {
        Route::name('list.')
            ->prefix('/list')
            ->controller(TodoListController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{todoList}', 'show')->name('show');
                Route::get('/{todoList}/edit', 'edit')->name('edit');
                Route::patch('/{todoList}', 'update')->name('update');
                Route::delete('/{todoList}', 'destroy')->name('destroy');
            });
        Route::name('item.')
            ->prefix('/item')
            ->controller(TodoItemController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{todoItem}', 'show')->name('show');
                Route::get('/{todoItem}/edit', 'edit')->name('edit');
                Route::patch('/{todoItem}', 'update')->name('update');
                Route::delete('/{todoItem}', 'destroy')->name('destroy');
            });
    });
