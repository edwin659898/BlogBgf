<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialAuthController;
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

Route::get('/', HomeController::class)->name('home');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');


Route::get('/language/{locale}', function ($locale) {
    if (array_key_exists($locale, config('app.supported_locales'))) {
        session()->put('locale', $locale);
    }

    return redirect()->back();
})->name('locale');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});


// socialite routes
// Google
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
// Route::prefix('auth')->group(function () {
//     Route::get('/{key}/redirect', 'SocialiteController@redirectToGoogle')->name('socialite');
//     Route::get('/{key}/callback', 'SocialiteController@handleGoogleCallback');
// });

// Facebook
// Route::get('auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('facebook.login');
// Route::get('auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);
// Twitter
// Route::get('auth/twitter', [SocialAuthController::class, 'redirectToTwitter'])->name('twitter.login');
// Route::get('auth/twitter/callback', [SocialAuthController::class, 'handleTwitterCallback']);
// // GitHub
// Route::get('auth/github', [SocialAuthController::class, 'redirectToGithub'])->name('github.login');     