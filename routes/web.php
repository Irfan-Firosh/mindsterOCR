<?php

use App\Http\Controllers\testController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Nette\Utils\Json;

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


Route::post('/upload', [testController::class, 'upload'])->name('upload');

Route::get('/', [testController::class, 'index'])->name('home');
