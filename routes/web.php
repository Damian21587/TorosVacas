<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/optimize-all', function () {
    Artisan::call('optimize:clear');
    dd("All Caches cleared successfully!");
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
Route::group(['middleware' => 'revalidate'], function () {
    Route::get('/login', [App\Http\Controllers\GeneralController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\GeneralController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\GeneralController::class, 'logout'])->name('logout');

    Route::get('lang/{lang}', [\App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');

    Route::prefix('home')->namespace('Home')->name('home.')->group(function () {

    });

    Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('index');
        Route::name('manager.')->group(function () {
            Route::resource('/usuarios', \App\Http\Controllers\Admin\UserController::class,
                ['except' => ['show']]);
            Route::get('/usuarios/password-reset/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'editPassword'])
                ->name('usuarios.password-reset');
            Route::put('/usuarios/password-reset/{user}', [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])
                ->name('users.password-update');
            Route::resource('/roles', \App\Http\Controllers\Admin\RoleController::class,
                ['except' => ['show']]);
        });

        Route::name('infyOmGenerator.')->group(function () {
            Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');
            Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

            Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

            Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

            Route::post('/generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

            Route::post(
                '/generator_builder/generate-from-file',
                '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
            )->name('io_generator_builder_generate_from_file');
        });

        Route::name('content.')->group(function () {
            Route::resource('/game', App\Http\Controllers\Admin\GameController::class);
            /*Route::post('/game', [App\Http\Controllers\Admin\GameController::class, 'playBullsCows']);*/

        });
    });
});

