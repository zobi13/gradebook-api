<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

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

//gradebooks
Route::get('/', [GradebookController::class, 'index'])
    ->middleware('auth:api');
Route::get('/gradebooks/create', [GradebookController::class, 'create'])
    ->middleware('auth:api');
Route::post('/gradebooks/create', [GradebookController::class, 'store'])
    ->middleware('auth:api');
Route::get('/gradebooks/{gradebook}', [GradebookController::class, 'show'])
    ->middleware('auth:api');
Route::get('/gradebooks/{gradebook}/edit', [GradebookController::class, 'edit'])
    ->middleware('auth:api');
Route::put('/gradebooks/{gradebook}/edit', [GradebookController::class, 'update'])
    ->middleware('auth:api');
Route::delete('/gradebooks/{gradebook}', [GradebookController::class, 'destroy'])
    ->middleware('auth:api');

//teachers
Route::get('/teachers', [TeacherController::class, 'index'])
    ->middleware('auth:api');
Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])
    ->middleware('auth:api');

//comments
Route::post('/gradebooks/{gradebook}/comments', [CommentController::class, 'store'])
    ->middleware('auth:api');
Route::delete('/gradebooks/{gradebook}/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth:api');

//students
Route::post('/gradebooks/{gradebook}/students', [StudentController::class, 'store'])
    ->middleware('auth:api');
Route::delete('/gradebooks/{gradebook}/students/{student}', [StudentController::class, 'destroy'])
    ->middleware('auth:api');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/me', [AuthController::class, 'getActiveUser'])
    ->middleware('auth:api');
Route::post('/auth/logout', [AuthController::class, 'logout'])
    ->middleware('auth:api');

Route::post('/auth/refresh', [AuthController::class, 'refreshToken']);