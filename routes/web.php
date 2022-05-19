<?php

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

//Config cache clear
Route::get('clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('optimize');
    dd("All clear!");
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', [App\Http\Controllers\Admin\AdminController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    Route::group(['middleware' => 'admin'], function (){
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'deshboard'])->name('admin.deshboard');
        Route::get('/register', [App\Http\Controllers\Admin\AdminController::class, 'register'])->name('admin.user.list');
        Route::get('/add/user', [App\Http\Controllers\Admin\AdminController::class, 'createForm'])->name('admin.user.register.form.create');
        Route::get('/hr/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'hr_dashboard'])->name('admin.hr.dashboard');
        Route::get('/admission/student/info/{id}', [App\Http\Controllers\Admin\AdminController::class, 'showAdmissionDueModal']);
        Route::post('/due/clear', [App\Http\Controllers\Admin\AdminController::class, 'dueClear']);
        Route::get('/student/list', [App\Http\Controllers\Admin\AdminController::class, 'studentList']);
        Route::get('/expanse', [App\Http\Controllers\Admin\AdminController::class, 'expanse']);
        Route::get('/add/expanse', [App\Http\Controllers\Admin\AdminController::class, 'addExpanse']);

        Route::group(['prefix' => 'user'], function (){
            Route::post('/store', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.user.register');
            Route::get('/edit/{user}', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.user.edit');
            Route::post('/update/{user}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admin.user.update');
            Route::get('/active/{user}', [App\Http\Controllers\Admin\AdminController::class, 'active'])->name('admin.user.active');
            Route::get('/inactive/{user}', [App\Http\Controllers\Admin\AdminController::class, 'inactive'])->name('admin.user.inactive');
            Route::get('/delete/{user}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.user.destroy');
            Route::get('/delete/{user}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.user.destroy');
            Route::get('/logout', [App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.user.logout');
            Route::get('/online', [App\Http\Controllers\Admin\AdminController::class, 'onlineUser'])->name('admin.user.online');
            Route::get('/attendance-log', [App\Http\Controllers\Admin\AdminController::class, 'attendanceLog'])->name('admin.user.attendance.log');
            Route::get('/attendance-sheet-download', [App\Http\Controllers\Admin\AdminController::class, 'attendanceSheetDownload'])->name('admin.user.attendance.download');
            //================== Task Management ====================//
            Route::get('/add/task', [App\Http\Controllers\Admin\TaskController::class, 'addTask'])->name('admin.add.task');
            Route::post('/excel/import', [App\Http\Controllers\Admin\TaskController::class, 'excel_store'])->name('admin.excel.import');
            Route::get('/list/task', [App\Http\Controllers\Admin\TaskController::class, 'listTask'])->name('admin.list.task');
            Route::get('/all/task', [App\Http\Controllers\Admin\TaskController::class, 'allTask'])->name('admin.all.task');
//            Route::post('/task/store', [App\Http\Controllers\Admin\TaskController::class, 'taskStore'])->name('admin.store.task');
            Route::get('/task/edit/{id}', [App\Http\Controllers\Admin\TaskController::class, 'taskEdit'])->name('admin.edit.task');
            Route::post('/task/update/{id}', [App\Http\Controllers\Admin\TaskController::class, 'taskUpdate'])->name('admin.update.task');
            Route::get('/task/delete/{id}', [App\Http\Controllers\Admin\TaskController::class, 'taskDelete'])->name('admin.delete.task');
            Route::get('/pending/task', [App\Http\Controllers\Admin\TaskController::class, 'pendingTask'])->name('admin.pending.task');
            Route::get('/complete/admission', [App\Http\Controllers\Admin\TaskController::class, 'completeAddmission'])->name('admin.complete.admission');
            Route::get('/not/interested', [App\Http\Controllers\Admin\TaskController::class, 'notInterested'])->name('admin.not.interested');
            Route::get('/highly/interested', [App\Http\Controllers\Admin\TaskController::class, 'highlyInterested'])->name('admin.highly.interested');
            Route::get('/interested', [App\Http\Controllers\Admin\TaskController::class, 'interested'])->name('admin.interested');
            Route::get('/recall', [App\Http\Controllers\Admin\TaskController::class, 'recall'])->name('admin.recall');
            Route::get('/task/view/{id}', [App\Http\Controllers\Admin\TaskController::class, 'allTaskView'])->name('admin.employee.task.view');
        });
    });
});

Auth::routes();

Route::get('/', [\App\Http\Controllers\UserController::class, 'userLoginForm']);
Route::get('/today/task', [\App\Http\Controllers\UserController::class, 'todayTask']);
Route::get('/view/details/{id}', [\App\Http\Controllers\UserController::class, 'viewDetails']);
Route::get('/profile/setting', [\App\Http\Controllers\UserController::class, 'profileSetting']);
Route::get('/all/task', [\App\Http\Controllers\UserController::class, 'allTask']);
Route::post('/interest/store', [\App\Http\Controllers\UserController::class, 'interestStore']);
Route::get('/pending/task', [\App\Http\Controllers\UserController::class, 'pendingTask']);
Route::get('/confirm/addmission', [\App\Http\Controllers\UserController::class, 'confirmAddmission']);
Route::get('/not/interested', [\App\Http\Controllers\UserController::class, 'notInterested']);
Route::get('/highly/interested', [\App\Http\Controllers\UserController::class, 'highlyInterested']);
Route::get('/interested', [\App\Http\Controllers\UserController::class, 'interested']);
Route::get('/others', [\App\Http\Controllers\UserController::class, 'others']);
Route::get('/addmission/form', [\App\Http\Controllers\UserController::class, 'addmissionForm']);
Route::get('/addmission/list', [\App\Http\Controllers\UserController::class, 'addmissionList']);
Route::get('/money/receipt', [\App\Http\Controllers\UserController::class, 'moneyReceipt']);
Route::get('/money/receipt/view/{id}', [\App\Http\Controllers\UserController::class, 'moneyReceiptView']);
Route::get('/admission/form/view/{id}', [\App\Http\Controllers\UserController::class, 'admissionFormView']);
Route::get('/admission/form/pdf', [\App\Http\Controllers\UserController::class, 'admissionFormPdf']);
Route::get('/money/receipt/pdf', [\App\Http\Controllers\UserController::class, 'moneyReceiptPdf']);
Route::post('/admission/store', [\App\Http\Controllers\UserController::class, 'admissionStore']);
Route::get('/update/information/{id}', [\App\Http\Controllers\UserController::class, 'updateInformation']);
Route::post('/profile/update/{id}', [\App\Http\Controllers\UserController::class, 'profileUpdate']);
Route::post('/password/update/{id}', [\App\Http\Controllers\UserController::class, 'passwordUpdate']);

//====================== PDF Download =======================//
Route::get('/money/receipt/download/{id}', [\App\Http\Controllers\UserController::class, 'admissionPdfDownload']);
Route::get('/admission/form/download/{id}', [\App\Http\Controllers\UserController::class, 'admissionFormPdfDownload']);

Route::get('/employee/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

