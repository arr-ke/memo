<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemorieController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ↓ユーザーのパス
Route::resource("user", UserController::class);

// ↓ログイン状態でしか見ることができない処理
Route::middleware('auth')->group(function () {
    // ↓メモリーのパス
    Route::resource("memorie", MemorieController::class);

    // メモ検索のパス
    Route::get("memoriesearch", [MemorieController::class, 'search'])->name('memorie.search');
});

// ログイン後のエラーパス
Route::get("memorieerror", [MemorieController::class, 'error'])->name('memorie.error');

// ログアウトのパス(変数名もつけています。)
Route::get("memorielogout", [MemorieController::class, 'logout'])->name('memorie.logout');

// ログインのパス
Route::post("userlogin", [UserController::class, 'login'])->name('user.login');

// ログイン前のエラーパス
Route::get("usererror", [UserController::class, 'error'])->name('user.error');
