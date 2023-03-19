<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});



Route::get('/registro', [RegisterController::class, 'show']);
Route::post('/registro', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name("login");
Route::post('/login', [LoginController::class, 'login']);

Route::get("logout",[LogoutController::class,"logout"]);


Route::middleware('auth')->group(function() {
    Route::get('/sessions', function () {
        $sessions = DB::table('sessions')
                    ->where('user_id', auth()->id())
                    ->orderBy('last_activity', 'DESC')
                    ->get();
        return view('auth/sessions', ['sessions' => $sessions]);
    });

    Route::post('/delete-session', function(Request $request) {
        DB::table('sessions')
            ->where('id', $request->id)
            ->where('user_id', auth()->id())
            ->delete();
    });

    Route::post('/delete-all-session', function(Request $request) {
        DB::table('sessions')
            ->where('user_id', auth()->id())
            ->delete();
    });
});