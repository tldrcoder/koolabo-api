<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobVacancyController;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::get('/projects/search/{name}', [ProjectController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});






// Route::resource('projects', ProjectController::class)->except(['create', 'edit']);
// Route::resource('jobs', JobController::class)->except(['create', 'edit']);
// Route::resource('job-vacancies', JobVacancyController::class)->except(['create', 'edit']);
// Route::get('/job-vacancies/search/{q}', [JobVacancyController::class, 'search'])
// 				->name('job-vacancies.search');
// Route::get('/hello', function (Request $request) {return "Hello!";});
// Route::get('/postman/csrf', function (Request $request) {return csrf_token();});