<?php

use App\Http\Controllers\JourneyEntryController;
use App\Http\Controllers\LearningLogEntryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechStackItemController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes untuk manajemen CMS
    Route::resource('projects', ProjectController::class);
    Route::resource('tech-stack', TechStackItemController::class)
        ->names('tech-stack')
        ->parameters(['tech-stack' => 'techStackItem']);
    Route::resource('work-experience', WorkExperienceController::class)
        ->names('work-experience')
        ->parameters(['work-experience' => 'workExperience']);
    Route::resource('journey', JourneyEntryController::class)
        ->names('journey')
        ->parameters(['journey' => 'journeyEntry']);
    Route::resource('learning-log', LearningLogEntryController::class)
        ->names('learning-log')
        ->parameters(['learning-log' => 'learningLogEntry']);
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Local Development — Error Page Preview Routes
|--------------------------------------------------------------------------
| These routes exist ONLY to make it easy to preview custom error views
| without having to trigger real errors or change APP_DEBUG.
|
| HOW IT WORKS: visit /preview-error/404, /preview-error/500, etc.
|
| ⚠️  KEEP THIS LOCAL-ONLY: the app()->environment('local') guard prevents
|    these routes from being registered in staging/production. Never remove
|    the environment check. If deploying, you may also safely delete this
|    entire block since it serves no production purpose.
|
*/
if (app()->environment('local')) {
    Route::get('/preview-error/{code}', function ($code) {
        abort((int) $code);
    })->where('code', '404|403|419|429|500|503')
      ->name('preview.error');
}


