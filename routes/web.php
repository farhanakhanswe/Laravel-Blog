<?php

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;

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
    return redirect(route('articles.index'));
})->name('home');

Route::get('/dashboard', function () {

    $articles = Auth::user()->articles;
    return view('dashboard', compact('articles'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/articles', ArticleController::class)->only(['index','show']);

Route::middleware('auth')->group(function () {
    Route::resource('/dashboard/articles',ArticleController::class)->except(['index','show']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
