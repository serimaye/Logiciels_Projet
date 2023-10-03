<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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
    return view ('welcome');
});

Route::get('dashboard', function () {
    return view ('dashboard');
});

Route::prefix('admin')->group(function() {

    Route::controller(App\Http\Controllers\CategoryController::class)->group(function (){

        Route::get('category','index');
        Route::get('category/create','create');
        Route::post('category','store')->name('categories.ajouter');
        Route::get('category/edit/{id}','edit');
        Route::put('category/{id}','update')->name('categories.ajouter');
        Route::get('category/delete/{id}','destroy')->name('categories.suppression');


    });

    Route::controller(App\Http\Controllers\LogicielController::class)->group(function (){

        Route::get('logiciels','index');
        Route::get('logiciels/create','create');
        Route::post('logiciels','store')->name('store');
        Route::get('logiciels/edit/{id}','edit');
        Route::put('logiciels/{id}','update')->name('update');

    });

    Route::controller(App\Http\Controllers\UserController::class)->group(function (){

        Route::get('users','index');
        Route::get('users/edit/{id}','edit');
        Route::put('users/{id}','update');
        Route::get('users/delete/{id}','destroy');


    });

});

Route::controller(App\Http\Controllers\AuthController::class)->group(function (){

    Route::get('login','login');
    Route::post('login','loginAction')->name('login.action');
    Route::get('register','register');
    Route::post('register','registerSave')->name('register.save');


});

//Routes pour gerer les logiciels

Route::get('/logiciels', [App\Http\Controllers\LogicielController::class, 'index']);
Route::post('/logiciels/enregistrer', [App\Http\Controllers\LogicielController::class, 'save'])->name('logiciels.save');
Route::delete('/logiciels/{id}', [App\Http\Controllers\LogicielController::class, 'suppression'])->name('logiciels.suppression');
Route::get('/logiciels/{id}', [App\Http\Controllers\LogicielController::class, 'show'])->name('logiciels.afficher');
Route::put('/logiciels/{id}', [App\Http\Controllers\LogicielController::class, 'modifier'])->name('logiciels.modifier');

//Routes pour gerer les categories de logiciels
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::post('/enregistrer', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.suppression');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.afficher');
Route::put('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.modifier');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
