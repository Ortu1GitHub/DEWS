<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\ValidateStudentId;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/students')->controller(StudentsController::class)->group(function(){

Route::get('','getAll');

Route::middleware(ValidateStudentId::class)->group(function () {
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
});

Route::post('','create');

});
