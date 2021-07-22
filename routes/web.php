<?php

use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstructionalResourceController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UploadTemporaryFilesController;
use App\Models\Syllabus;

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
    return view('welcome');
});

Route::get('/test', function () {
    return view('pages.dashboard')->with('syllabi', Syllabus::all());
})->name('dashboard');

Route::get('instructionalResource/showResourceModal', [InstructionalResourceController::class, 'showResourceModal'])->name('instructionalResource.showResourceModal');
Route::resource('instructionalResource', InstructionalResourceController::class);
Route::resource('syllabus', SyllabusController::class);
Route::resource('uploadTemporaryFiles', UploadTemporaryFilesController::class);
Route::resource('downloadFile', DownloadFileController::class);
Route::resource('file', FileController::class);
Route::post('file/download', [FileController::class, 'download'])->name('file.download');
