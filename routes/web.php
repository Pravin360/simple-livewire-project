<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Admin\Dashboardcontroller;
use App\http\Livewire\Admin\Users\ListUsers;

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

Route::get('admin/dashboard',Dashboardcontroller::class)->name('admin.dashboard');
Route::get('admin/users', ListUsers::class)->name('admin.users');