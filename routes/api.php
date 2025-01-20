<?php


use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\ValidateStudentId;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\LoginController;
use \App\Http\Middleware\IsUserAuthenticated;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas Students
Route::prefix('students')->controller(StudentsController::class)->group(function() {
    Route::middleware(ValidateStudentId::class)->group(function () {
        Route::get('{id}', 'getById');
        Route::delete('{id}', 'delete');
        Route::put('{id}', 'modifyById');
    });
    Route::get('', 'getAll');
    Route::post('', 'create');
});

// Rutas Schools
Route::prefix('schools')->controller(SchoolsController::class)->group(function() {
    Route::get('', 'getAll');
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
    Route::post('', 'create');
    // Escuela con profesor
    Route::get('/{id}/teachers','getSchoolAndTeacher');
});

// Rutas Teachers
Route::prefix('teachers')->controller(TeachersController::class)->group(function() {
    Route::get('', 'getAll');
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
    Route::post('', 'create');
    // Escuela desde profesor (inverso)
    Route::get('/{id}/schools', 'getSchoolByTeacher');
    // Profesor con asignaturas
    Route::get('/{id}/subjects','getTeacherAndsubjects');
});

// Rutas Subjects
Route::prefix('subjects')->controller(SubjectsController::class)->group(function() {
    Route::get('', 'getAll');
    Route::get('{id}', 'getById');
    Route::delete('{id}', 'delete');
    Route::put('{id}', 'modifyById');
    Route::post('', 'create');
    // Profesor desde asignatura (inverso)
    Route::get('/{id}/teachers', 'getTeacherBySubject');
});

//Rutas login
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('testLogin', [LoginController::class, 'testLogin']);
Route::middleware(IsUserAuthenticated::class)->get('loginCustom', [LoginController::class, 'displayDataUserLogged']);
