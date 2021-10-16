<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\EducationsController;

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
    return view('auth.login');
});

Auth::routes();

Route::post('/profile', [PersonalInfoController::class, 'save'])->name('profile');
Route::get('/getprofile', [PersonalInfoController::class, 'show'])->name('getprofile');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//projects routes
Route::post('/ceate_projects', [ProjectsController::class, 'save'])->name('ceate_projects');
Route::get('/getprojects', [ProjectsController::class, 'show'])->name('getprojects');
Route::get('/deleteproject/{id}', [ProjectsController::class, 'delete'])->name('deleteproject');
//education
Route::post('/ceate_education', [EducationsController::class, 'save'])->name('ceate_education');