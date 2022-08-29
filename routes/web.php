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
        Route::post('/due/clear/{id}', [App\Http\Controllers\Admin\AdminController::class, 'dueClear']);
        Route::get('/student/list', [App\Http\Controllers\HRController::class, 'studentList']);
        Route::get('/students/list', [App\Http\Controllers\Admin\AdminController::class, 'adminStudentList']);
        Route::get('/batch/create', [App\Http\Controllers\Admin\AdminController::class, 'batchCreateForm']);
        Route::post('/batch/store', [App\Http\Controllers\Admin\AdminController::class, 'batchStore']);
        Route::get('/batch/delete/{id}', [App\Http\Controllers\Admin\AdminController::class, 'batchDelete']);
        Route::get('/salary/list', [\App\Http\Controllers\Admin\AdminController::class, 'salary']);
        Route::post('/salary/submit', [\App\Http\Controllers\Admin\AdminController::class, 'salaryPay']);
        Route::post('/admission/update/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'adminAdmissionFormUpdate']);
        Route::get('/admission/form/edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'adminEditAdmissionForm']);
        Route::get('/admission/student/info/delete/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'studentDelete']);
        Route::get('/admission/student/due/{id}', [App\Http\Controllers\Admin\AdminController::class, 'adminShowAdmissionDueModal']);
        Route::post('/student/due/clear/{id}', [App\Http\Controllers\Admin\AdminController::class, 'adminDueClear']);

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
            Route::get('/task/filtering', [App\Http\Controllers\Admin\TaskController::class, 'taskFiltering'])->name('admin.filtering');
            Route::get('/task/view/{id}', [App\Http\Controllers\Admin\TaskController::class, 'allTaskView'])->name('admin.employee.task.view');
            //=============== Expanse list =================//
            Route::get('/expanse/list', [App\Http\Controllers\Admin\AdminController::class, 'expanse']);
            Route::get('/admission/filtering', [App\Http\Controllers\Admin\AdminController::class, 'admissionFiltering']);
            Route::get('/admission/filtering/report/download/{from}/{to}', [App\Http\Controllers\Admin\AdminController::class, 'admissionFilteringReportDownload']);
            Route::get('/due/report', [App\Http\Controllers\Admin\AdminController::class, 'dueCollectReport']);

            //================= Batch student list download ================//
            Route::get('/student/batch/wise/download/{batchStudent}', [App\Http\Controllers\Admin\AdminController::class, 'studentDownloadFromBatchNumber']);
        });
    });
});

Auth::routes();


//========== Employee Call report download ============//
Route::get('/employee/call-report/download/{month}/{user_id}', [App\Http\Controllers\Admin\TaskController::class, 'callReportDownload']);
Route::get('/admin/user/expanse/list/download/{from}/{to}', [App\Http\Controllers\Admin\TaskController::class, 'expanseReportDownload']);

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
Route::get('/chat', [\App\Http\Controllers\UserController::class, 'communityChat']);

//====================== PDF Download =======================//
Route::get('/money/receipt/download/{id}', [\App\Http\Controllers\UserController::class, 'admissionPdfDownload']);
Route::get('/admission/form/download/{id}', [\App\Http\Controllers\UserController::class, 'admissionFormPdfDownload']);
Route::get('/paid/money/receipt/download/{id}', [\App\Http\Controllers\UserController::class, 'paidMoneyReceiptDownload']);

//================== Expanse =========================//
Route::get('/expanse', [App\Http\Controllers\Admin\ExpanseController::class, 'expanse']);
Route::get('/add/expanse', [App\Http\Controllers\Admin\ExpanseController::class, 'addExpanse']);
Route::post('/add/new/expanse', [\App\Http\Controllers\Admin\ExpanseController::class, 'addNewExpanse']);
Route::get('/edit/expanse/{id}', [\App\Http\Controllers\Admin\ExpanseController::class, 'editExpanse']);
Route::post('/update/expanse/{id}', [\App\Http\Controllers\Admin\ExpanseController::class, 'updateExpanse']);
Route::get('/delete/expanse/{id}', [\App\Http\Controllers\Admin\ExpanseController::class, 'deleteExpanse']);
Route::get('/salary', [\App\Http\Controllers\Admin\ExpanseController::class, 'salary']);
Route::post('/salary/submit', [\App\Http\Controllers\Admin\ExpanseController::class, 'salaryPay']);
Route::get('/salary/advance', [\App\Http\Controllers\Admin\ExpanseController::class, 'salaryAdvance']);
Route::get('/admin/admission/student/info/edit/{id}', [\App\Http\Controllers\HRController::class, 'editAdmissionForm']);
Route::get('/admin/admission/student/info/delete/{id}', [\App\Http\Controllers\HRController::class, 'studentDelete']);
Route::get('/admin/hr/profile', [\App\Http\Controllers\HRController::class, 'hrProfileShow']);
Route::post('/hr/profile/update/{id}', [\App\Http\Controllers\HRController::class, 'hrProfileUpdate']);
Route::post('/hr/password/update/{id}', [\App\Http\Controllers\HRController::class, 'hrProfilePasswordUpdate']);
Route::post('/admission/update/{id}', [\App\Http\Controllers\HRController::class, 'admissionFormUpdate']);
Route::get('/admin/addmission/form', [App\Http\Controllers\HRController::class, 'admissionForm']);
Route::get('/admin/money-receipt', [App\Http\Controllers\HRController::class, 'allMoneyReceipt']);
Route::get('/admin/money/receipt/view/{id}', [App\Http\Controllers\HRController::class, 'viewMoneyReceipt']);
Route::post('/admin/admission/checked', [App\Http\Controllers\HRController::class, 'admissionCheck']);
Route::get('/admin/student/reject/{id}', [App\Http\Controllers\HRController::class, 'rejectStudent']);
Route::get('/admin/student/restore/{id}', [App\Http\Controllers\HRController::class, 'restoreStudent']);
Route::get('/admin/reject/student/list', [App\Http\Controllers\HRController::class, 'rejectStudentList']);
Route::get('/admin/student/paid/list', [App\Http\Controllers\HRController::class, 'paidStudentList']);
Route::get('/admin/student/due/list', [App\Http\Controllers\HRController::class, 'dueStudentList']);

Route::get('/employee/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

