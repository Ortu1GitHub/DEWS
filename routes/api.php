<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\ValidateStudentId;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\SubjectsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/students')->controller(StudentsController::class)->group(function(){

Route::middleware(ValidateStudentId::class)->group(function () {
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
});

Route::get('','getAll');
Route::post('','create');


//Rutas Schools
//Route::prefix('/schools')->controller(SchoolsController::class)->group(function(){
    Route::get('/schools','getAll');
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
    Route::post('','create');
//});

//Rutas Teachers
Route::prefix('/teachers')->controller(TeachersController::class)->group(function(){
    Route::get('','getAll');
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
    Route::post('','create');
});

//Rutas Subjects
Route::prefix('/subjects')->controller(SubjectsController::class)->group(function(){
    Route::get('','getAll');
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
    Route::post('','create');
});

});
