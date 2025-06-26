<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\PaymentController;


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

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/tutor/dashboard', function () {
        return view('tutor.dashboard');
    })->middleware('role:tutor')->name('tutor.dashboard');


    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
        ->middleware('role:student')
        ->name('student.dashboard');

    Route::get('/student/enrolment', [EnrolmentController::class, 'index'])
        ->middleware('role:student')
        ->name('enrolment.page');

    /* Route::get('/student/enrolment/', [EnrolmentController::class, 'create'])
    ->middleware('role:student')
    ->name('enrolment.page'); */

    Route::get('/student/dashboard', [StudentDashboardController::class, 'dashboard'])->name('student.dashboard');


    Route::get('/student/timetable', [StudentDashboardController::class, 'timetable'])
        ->middleware('role:student')
        ->name('student.timetable');


    Route::post('/student/enrolment', [EnrolmentController::class, 'store'])->name('enrolment.store');


    Route::get('/test-view', function () {
        return view('admin.dashboard');
    });

    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
});

Route::get('/student/payment', [PaymentController::class, 'index'])
    ->middleware('role:student')
    ->name('student.payment');

Route::post('/student/payment/process', [PaymentController::class, 'process'])
    ->middleware('role:student')
    ->name('student.payment.process');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/students', [App\Http\Controllers\AdminController::class, 'listStudents'])->name('admin.index');
    Route::get('/students/{id}', [App\Http\Controllers\AdminController::class, 'viewStudent'])->name('admin.view');
});




require __DIR__ . '/auth.php';
