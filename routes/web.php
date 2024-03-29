<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\teacher\TeacherClassController;
use \App\Http\Controllers\student\ManageClassController;
use \App\Http\Controllers\student\StudentEnrollController;
use \App\Http\Controllers\student\SurahTrackerController;
use \App\Http\Controllers\teacher\TasmiController;
use \App\Http\Controllers\teacher\ChartController;
use \App\Http\Controllers\admin\ManageClassesController;
use \App\Http\Controllers\admin\ManageUsersController;
use \App\Http\Controllers\admin\ManageSurahsController;


// use \App\Http\Controllers\PDFController;



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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $user_created_at = auth()->user()->created_at;
        $Trialday = clone $user_created_at;
        $Trialday->addDays(7);
        $today = now();
        // Check if the user's role ID is 3
       

        if ($user && $user->role_id == 1) {
             if ($Trialday->equalTo($today) || $today > $Trialday && auth()->user()->status == 0){
                return view('dashboard');
            } 
            return view('admin.dashboard');

          
        }
        if ($user && $user->role_id == 2) {
          if ($Trialday->equalTo($today) || $today > $Trialday && auth()->user()->status == 0){
            return view('dashboard');
        }  
                 return view('student.dashboard');
           
        }
        if ($user && $user->role_id == 3) {
            if ($Trialday->equalTo($today) || $today > $Trialday && auth()->user()->status == 0){
                return view('dashboard');
                } 
                 return view('teacher.dashboard');
          
        }
 
        // Default view for other roles or unauthenticated users
        return view('dashboard');
    })->name('dashboard');
});

// if (auth()->user()->isAdmin()) {
//     return view('admin.dashboard');
// } else {
//     return view('dashboard');
// }


Route::group(['middleware'=>'role:Admin','prefix'=>'admin', 'as' =>'admin.'],function(){
    Route::resource('classes', ManageClassesController::class);
    Route::resource('surahs', ManageSurahsController::class);
    Route::resource('users', ManageUsersController::class);

    Route::get('/classes/{ClassId}/{ClassMakerId}', [ManageClassesController::class, 'show'])->name('classes.show');


    Route::get('/record/{ClassId}', [ManageClassesController::class, 'record'])->name('classes.pdf');


    Route::delete('/classes/del/{ClassId}/{ClassMakerId}', [ManageClassesController::class, 'deleteClass'])
    ->name('classes.deleteClass');

    
    Route::delete('/classes/destroyStudent/{ClassId}/{StudentId}', [ManageClassesController::class, 'destroy'])
    ->name('classes.destroy');

    Route::get('/users/record/{ClassId}/{id}', [ManageUsersController::class, 'showRecord'])->name('users.showRecord');

    Route::delete('/classes/removeClass/{ClassId}/{id}', [ManageUsersController::class, 'removeEnroll'])
    ->name('users.removeEnroll');

});

Route::group(['middleware'=>'auth'], function(){



    Route::group(['middleware'=>'role:Student','prefix'=>'student', 'as' =>'student.'],function(){
        Route::resource('classes', ManageClassController::class);
        Route::resource('tracker', SurahTrackerController::class);
        
        Route::resource('enroll', StudentEnrollController::class);
        Route::get('/classes/view/{id}', [ManageClassController::class, 'view'])->name('classes.view');
        Route::post('/enroll/classDel/{ClassId}/{id}', [StudentEnrollController::class, 'destroy'])->name('enroll.destroy');
        
        Route::get('/classes/record/{ClassId}/{id}', [ManageClassController::class, 'viewRecord'])->name('classes.viewRecord');




        // Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);



    });

    Route::group(['middleware'=>'role:Teacher','prefix'=>'teacher', 'as' =>'teacher.'],function(){    
        Route::resource('classes', TeacherClassController::class);
        Route::resource('tasmi', TasmiController::class);


        Route::get('/classes/search/', [TeacherClassController::class, 'search'])->name('classes.search');
        Route::get('/classes/pdf/{id}', [TeacherClassController::class, 'pdf'])->name('classes.pdf');
        // Route::get('/classes/record/{id}', [TeacherClassController::class, 'show'])->name('classes.record');
        Route::get('/tasmi/show/{ClassId}/{id}', [TasmiController::class, 'show'])->name('tasmi.show');
        Route::delete('/tasmi/deleteRec/{ClassId}/{id}', [TasmiController::class, 'destroy'])->name('tasmi.destroy');
        Route::get('/tasmi/record/{ClassId}/{id}', [TasmiController::class, 'showRecord'])->name('tasmi.showRecord');








    });

    

});
