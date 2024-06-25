<?php

use App\Http\Controllers\testController;
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

Route::get('/info', function() {
    $ch = curl_init();
    $url = "https://reqres.in/api/users?page=2";
    curl_setopt($ch, CURLOPT_URL, $url);
    $resp = curl_exec($ch);
    curl_close($ch);
    return json_decode($resp);
});

Route::get('/', [testController::class, 'index']);
