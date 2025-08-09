<?php

use App\Exceptions\UserException;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleFilterController;
use App\Http\Controllers\BoardMessageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// TESTS
// Route::get('/userNotFound', function () {
//     throw UserException::userEmailAlreadyRegistered();
// });

// BASE PAGES FOR ALL VISITORS
Route::get('/', function () {
    SEOMeta::setTitle('Home');
    return view('about')->with(['success' => null]);
})->name('/');

Route::get('biases', function () {
    SEOMeta::setTitle('Biases');
    return view('biases')->with(['success' => null]);
})->name('biases');

// USER – AUTH – EMAIL
Route::get('/register', function () {
    SEOMeta::setTitle('Register');
    return view('auth.register');
})->name('register');
Route::post('/register', [UserController::class, 'store'])->name('storeUser');

Route::get('/login', function () {
    SEOMeta::setTitle('Log in');
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/email/verify', function () {
    SEOMeta::setTitle('Verify email');
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/resend-verification/{user:id}', function (User $user) {
    $user->sendEmailVerificationNotification();
 
    return back()->with(['success' => 'Verification link sent!']);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with(['success' => 'Welcome to Truth Transparent, '.$request->user()->name.'!']);
})->middleware(['auth', 'signed'])->name('verify.email');

Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(['auth', 'verified']);
Route::put('/user/{user}/update', [UserController::class, 'update'])->name('users.update')->middleware(['auth', 'verified']);

// ARTICLES
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}/show', [ArticleController::class, 'show'])->name('articles.show');
// FILTERED ARTICLES
Route::post('/articles/consciousness', [ArticleFilterController::class, 'consciousness'])->name('articles.consciousness');
Route::post('/articles/money', [ArticleFilterController::class, 'money'])->name('articles.money');
Route::post('/articles/politics', [ArticleFilterController::class, 'politics'])->name('articles.politics');
Route::post('/articles/group', [ArticleFilterController::class, 'group'])->name('articles.group');
Route::post('/articles/love', [ArticleFilterController::class, 'love'])->name('articles.love');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['middleware' => 'is_author_admin'], function () {
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles/store', [ArticleController::class, 'store'])->name('article.store');
        Route::get('/articles/{article:slug}/edit', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('/articles/{article:id}/update', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/articles/{article}/delete', [ArticleController::class, 'destroy'])->name('article.delete');

        // ARTICLE IMAGES
        Route::post('/articles/images/store', [ImageController::class, 'store']);
    });

    Route::group(['middleware' => 'is_guest_at_least'], function () {
        Route::post('/comments/store', [CommentController::class, 'store'])->name('comment.store');
    });
});

// FORUM / THREADS
Route::get('/forum', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/{thread}/show', [ThreadController::class, 'show'])->name('threads.show');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['middleware' => 'is_guest_at_least'], function () {
        Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
        Route::post('/threads/store', [ThreadController::class, 'store'])->name('thread.store');
        Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('thread.edit');
        Route::put('/threads/{thread}/update', [ThreadController::class, 'update'])->name('thread.update');
        Route::delete('/threads/{thread}/delete', [ThreadController::class, 'destroy'])->name('thread.delete');
    });
});

// MESSAGE BOARD
Route::get('/messages/kjhsdgiuy7y&65$53dgsadfjkgf', [BoardMessageController::class, 'index'])->name('messages.index');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['middleware' => 'is_author_admin'], function () {
        Route::post('/messages/store', [BoardMessageController::class, 'store'])->name('messages.store');
        Route::delete('/messages/{message}/delete', [BoardMessageController::class, 'destroy'])->name('messages.delete');
    });
});