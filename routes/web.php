<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ObjectiveController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InterventionController;
use App\Http\Controllers\Admin\SummaryController;
use App\Http\Controllers\Student\IndexController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'auth.login');

Auth::routes([
    'register' => false
]);

Route::prefix('admin')->as('admin.')->middleware('auth')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('students/fetch', [StudentController::class, 'fetchStudents'])->name('students.fetch');
    Route::resource('students', StudentController::class);

    Route::post('class/students', [AttendanceController::class, 'fetchClassStudents'])->name('class.students');
    Route::get('/attendances/status/edit', [AttendanceController::class, 'editAttendancesStatus'])->name('attendances.status.edit');
    Route::get('/attendances/status/update', [AttendanceController::class, 'updateAttendancesStatus'])->name('attendances.status.update');
    Route::resource('attendances', AttendanceController::class)->only('index', 'store', 'edit', 'update', 'create', 'destroy');
    Route::resource('classes', ClassController::class);


    Route::prefix('reports')->as('reports.')->group(function() {
        Route::get('admissions', [ReportController::class, 'openAdmissionReports'])->name('admissions');
    });

    Route::prefix('objectives')->as('objectives.')->controller(ObjectiveController::class)->group(function() {
        Route::get('/', 'openObjectivePage')->name('index');
        Route::get('grades/create', 'createGradeObjective')->name('grades.create');
        Route::post('grades', 'storeGradeObjective')->name('grades.store');
    });

    Route::prefix('analysis')->as('analysis.')->controller(SummaryController::class)->group(function() {
        Route::prefix('summaries')->as('summaries.')->group(function() {
            Route::get('/', 'index')->name('index');
        });
    });

    Route::controller(ObjectiveController::class)->group(function() {
        Route::get('get-sub-objectives', 'getSubObjectives')->name('get.sub-objectives');
        Route::get('get-objectives/{id}', 'getClassObjectives')->name('get.objectives');
        Route::get('get-class-students', 'getClassStudents')->name('get.class.students');
        Route::get('get-classes', 'getAllClasses')->name('get.classes');
    });


});


Route::get('fresh-db', function() {
    Artisan::call('migrate:fresh --seed');
    return 'success';
});

