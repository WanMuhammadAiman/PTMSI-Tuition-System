<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\EnrolmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TutorMaterialController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Str;
use App\Models\Subject;




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

    Route::get('/dashboard', function () {
        $user = auth()->user();
    
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'tutor') {
            return redirect()->route('tutor.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    })->middleware('auth')->name('dashboard');
    

Route::get('/student/enrolment', [EnrolmentController::class, 'index'])
    ->middleware('role:student')
    ->name('enrolment.page');

/* Route::get('/student/enrolment/', [EnrolmentController::class, 'create'])
    ->middleware('role:student')
    ->name('enrolment.page'); */



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
        Route::get('/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/students', [App\Http\Controllers\AdminController::class, 'listStudents'])->name('admin.index');
        Route::get('/students/{id}', [App\Http\Controllers\AdminController::class, 'viewStudent'])->name('admin.view');
    });
    

    Route::get('payment-success', function () {
        return view('student.success');
    })->name('payment.success');

    Route::post('/stripe/checkout', [StripePaymentController::class, 'createCheckoutSession'])->name('stripe.checkout');

    Route::get('/receipt/{id}', [PaymentController::class, 'viewReceipt'])->name('student.receipt');

    Route::get('/payment-success', [StripePaymentController::class, 'handleSuccess'])->name('stripe.success');

    Route::get('/student/payment-history', [PaymentController::class, 'viewHistory'])->name('student.payment.history');

    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');


    Route::get('/tutor/materials', function () {
        return view('tutor.material-upload');
    })->middleware(['auth', 'role:tutor'])->name('tutor.material-upload');
    


// Show subjects
Route::get('/tutor/materials/primary', [TutorMaterialController::class, 'showPrimarySubjects'])->middleware(['auth', 'role:tutor'])->name('tutor.materials.primary');
Route::get('/tutor/materials/secondary', [TutorMaterialController::class, 'showSecondarySubjects'])->middleware(['auth', 'role:tutor'])->name('tutor.materials.secondary');

// Unified primary upload
Route::get('/tutor/materials/primary/{slug}/upload', [TutorMaterialController::class, 'showPrimaryUpload'])
    ->middleware(['auth', 'role:tutor'])
    ->name('tutor.materials.primary.unified');

    Route::post('/tutor/materials/primary/unified', [TutorMaterialController::class, 'handlePrimaryUpload'])
    ->middleware(['auth', 'role:tutor'])
    ->name('tutor.materials.primary.unified.upload');

// Material view by subject (shared)
Route::get('/tutor/materials/{slug}', [TutorMaterialController::class, 'viewMaterials'])->middleware(['auth', 'role:tutor'])->name('tutor.material.view');

// Student views
Route::get('/student/materials', [TutorMaterialController::class, 'studentSubjects'])->middleware(['auth', 'role:student'])->name('student.materials.index');
Route::get('/student/materials/{subject_id}', [TutorMaterialController::class, 'studentMaterials'])->name('student.materials.subject');

// Debug (optional)
Route::middleware('auth')->get('/debug-materials/{id}', [TutorMaterialController::class, 'studentMaterials']);

// Delete
Route::delete('/tutor/material/{id}', [TutorMaterialController::class, 'destroy'])->name('tutor.material.delete');


    // For student to view secondary materials by subject
Route::get('/tutor/secondary-material/view-secmaterial/{slug}', [TutorMaterialController::class, 'viewSecondaryMaterials'])
->middleware(['auth', 'role:student'])
->name('student.secondary.materials.view');

Route::get('/tutor/secondary-materials/{slug}', [TutorMaterialController::class, 'viewSecondaryMaterials'])
    ->middleware(['auth', 'role:tutor'])
    ->name('tutor.secondary.materials.view');


    Route::get('/tutor/secondary/upload/{slug}', [TutorMaterialController::class, 'showUploadPageSecondary'])
    ->middleware(['auth', 'role:tutor'])
    ->name('tutor.secondary.upload');

    Route::post('/tutor/secondary/material/upload', [TutorMaterialController::class, 'uploadMaterial'])
    ->middleware(['web', 'auth', 'role:tutor']) 
    ->name('tutor.secondary.material.upload');

    Route::get('/test-flash', function () {
        session()->flash('message', 'Flash works!');
        return redirect('/flash-target');
    });
    Route::get('/flash-target', function () {
        dd(session()->all());
    });
    

    Route::middleware(['auth', 'role:student'])->group(function () {
        Route::get('/survey', [SurveyController::class, 'showSurvey'])->name('student.survey');
        Route::post('/survey', [SurveyController::class, 'submitSurvey'])->name('student.survey.submit');
    });
    

Route::get('/admin/subjects', [AdminController::class, 'listSubjects'])->name('admin.subjects.index');
Route::get('/admin/subjects/{slug}', [AdminController::class, 'viewSubject'])->name('admin.subjects.view');
Route::delete('/admin/subjects/{slug}/enrolments', [AdminController::class, 'deleteSubjectEnrolments'])->name('admin.subjects.deleteEnrolments');


Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');


Route::get('/tutor/dashboard', [App\Http\Controllers\TutorDashboardController::class, 'index'])
    ->middleware('auth', 'role:tutor')->name('tutor.dashboard');


require __DIR__.'/auth.php';
