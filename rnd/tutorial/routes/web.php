<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\TestController;
    use App\Http\Controllers\UserController;

    /*
   Route::get('/', function () {
        return view('welcome');
    }); */

    Route::get('/', [TestController::class, 'test']);
    Route::get('/names', [TestController::class, 'names']);
    Route::get('/names/create/{family}/{name}',[TestController::class, 'namesCreate'])->middleware('auth');
    Route::get('/families/create/{name}',[TestController::class, 'familyCreate'])->middleware('auth');
    Route::post('/names/delete',[TestController::class, 'namesDelete'])->middleware('auth');
    Route::get('/names/manage/surname', [TestController::class, 'manageSurname'])->middleware('auth');
    Route::post('/names/manage/surname/delete', [TestController::class, 'deleteSurname'])->middleware('auth');
    Route::post('/names/manage/surname', [TestController::class, 'newSurname'])->middleware('auth');
    Route::get('/names/manage/name/new', [TestController::class, 'newName'])->middleware('auth');
    Route::get('/profile', function () { return view('pages.profile'); })->middleware('auth');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->middleware('auth');

    Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');