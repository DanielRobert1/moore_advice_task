<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * ===================================================================
 * GUEST ROUTES
 * ===================================================================
 */
Route::group(['prefix' => 'tasks'], function(){
    Route::get('/', [TaskController::class, 'index'])->name('api.tasks.index');
    Route::get('show/{task}', [TaskController::class, 'show'])->name('api.tasks.show');
    Route::post('store', [TaskController::class, 'store'])->name('api.tasks.store');
    Route::put('update/{task}', [TaskController::class, 'update'])->name('api.tasks.update');
    Route::delete('{task}', [TaskController::class, 'destroy'])->name('api.tasks.delete');
});
