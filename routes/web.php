<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\SuperController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;

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
    return view('auth.login');
})->name('login');

Auth::routes();
Route::group(['middleware' => ['auth','prevent-back-history']], function() {
Route::resource('roles','UserManagement\RoleController');
Route::resource('users','UserManagement\UserController');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*************************************Department Admin courses*************************************************************************/
Route::get('/dashboard',[AdminCourseController::class,'showcourse'])->name('course.index');
Route::post('/dashboard/addcourse',[AdminCourseController::class,'addcoursepost'])->name('course.save');
Route::get('/dashboard/courses/{id}/delete',[AdminCourseController::class,'deletecourse'])->name('course.delete');
Route::post('/dashboard/courses/{id}/update',[AdminCourseController::class,'updatecourse'])->name('course.update');
/************************************Department Admin Assign Tutor********************************************************************/
Route::get('/dashboard/users',[AdminCourseController::class,'getuseres'])->name('user.index');
Route::post('/dashboard/{id}/{dep}/newtutor',[AdminCourseController::class,'postAssigntutor'])->name('user.Assingtutor');
Route::get('/dashboard/tutor',[AdminCourseController::class,'getutor'])->name('user.tutor');
Route::get('/dashboard/tutor/{id}/delete',[AdminCourseController::class,'deletetutor'])->name('admin.deletetutor');

/*************************************Acadmic Year **************************************************************************************/
Route::get('/dashboard/acadmicyear',[SuperAdminController::class,'getADyear'])->name('AcadmicY.index');
Route::post('/dashboard/addadyear',[SuperAdminController::class,'AddADyear'])->name('AcadmicY.addADyear');
Route::get('/dashboard/adyear/{id}/delete',[SuperAdminController::class,'deleteADyear'])->name('AcadmicY.deleteADyear');
Route::post('/dashboard/adyear/{id}/update',[SuperAdminController::class,'updateADyear'])->name('AcadmicY.updateADyear');
/**************************************Department Avaliable course************************************************************************/
Route::get('/dashboard/avaliablecourse',[AdminCourseController::class,'showcourseA'])->name('Acourse.index');
Route::get('/dashboard/avaliablecourse/add',[AdminCourseController::class,'AddcourseA'])->name('Addcourse.index');
Route::post('/dashboard/avaliablecourse/add',[AdminCourseController::class,'Select_AV_Tutor_T']);
Route::get('/autocomplete-search',[AdminCourseController::class,'selectSearch'])->name('autocomplete');
Route::post('/dashboard/avaliablecourse/add/{id}/added',[AdminCourseController::class,'Addvaliablecourse'])->name('Addcourse.added');
Route::get('/dashboard/avaliablecourse/{id}/delete',[AdminCourseController::class,'deleteAvaliableCourse'])->name('AVcourse.delete');

/********************************************Student****************************************************************************************/
Route::get('/dashboard/booking',[StudentController::class,'booking_department'])->name('student.booking.Department');
Route::get('/autocomplete-select/{id}/tutor',[StudentController::class,'AutoselectingTutor'])->name('autoselect');
Route::get('/autocomplete-select/{id}/courses',[StudentController::class,'AutoselectingCourse'])->name('autoCourses');
Route::get('/dashboard/booking/{dep}/select',[StudentController::class,'booking_department_selecting'])->name('student.booking.selecting');
Route::post('/dashboard/booking/select/{id}/option',[StudentController::class,'ShowbookingTurorial'])->name('student.booking.option');
Route::post('/dashboard/booking/create/{avaliablecourse}/{tutorid}/request',[StudentController::class,'AddTutorialrequest'])->name('student.booking.create');
Route::get('/dashboard/booking/request/{requestid}/delete',[StudentController::class,'TutorialrequestDelete'])->name('student.request.delete');
Route::post('/studentpost',[StudentController::class,'studensent'])->name('autocomment');

Route::get('/dashboard/student/tutorials',[StudentController::class,'tutorialList'])->name('student.tutorial.list');
Route::get('/dashboard/student/tutorials/all',[StudentController::class,'AllstudentRequest'])->name('student.tutorial.alllist');
Route::get('/dashboard/student/tutorials/timetable',[StudentController::class,'studenttimetable'])->name('student.tutorial.timetable');


Route::get('/dashboard/tutor/tutorials',[TutorController::class,'tutor_tutuorials'])->name('Tutor.tutorial.list');
Route::get('/dashboard/tutor/tutorials/status/{id}/{status}/update',[TutorController::class,'Tutorialstatus'])->name('Tutor.tutorial.status');
Route::get('/dashboard/tutor/tutorials/all',[TutorController::class,'AlltutorialsRequest'])->name('Tutor.tutorial.allRequest');
Route::get('/dashboard/tutor/tutorials/timetable',[TutorController::class,'tutortimetable'])->name('Tutor.tutorial.timetable');
Route::get('/dashboard/tutor/tutorials/timetable/{id}/getlist',[TutorController::class,'courserequest'])->name('Tutor.tutorial.getlist');

Route::get('/tutor/dashboard',[TutorController::class,'tutordashboard'])->name('tutordashboard');
Route::get('/student/dashboard',[StudentController::class,'studentdashboard'])->name('studentdashboard');

Route::post('/commenttutor-send',[TutorController::class,'sendcomment'])->name('autosendtutor');
Route::post('/commentstudent-send',[StudentController::class,'studentsendcomment'])->name('autosendstudent');






Route::get('/dashboard/user/profile',[HomeController::class,'profile'])->name('user.profile');
Route::post('/dashboard/user/update/profile',[HomeController::class,'Editeprofile'])->name('update.profile');


Route::get('/{page}', 'SuperController@index')->name('superuserpage');

#-------------------------------------------------------------------------------------------------------------------------

Route::get('/dashboard/booking/department/{depid}/listAvCourse',[StudentController::class, 'booking_department_availablecourses'])->name('deplistAv');
Route::get('/dashboard/booking/department/{depid}/AvCourse/{course}/tutors',[StudentController::class, 'booking_department_availablecourses_tutor'])->name('AvlisTu');

Route::get('/dashboard/booking/department/{depid}/selectoption',[StudentController::class, 'selectoption'])->name('booking.option');


#----------------------------------------- Reports --------------------------------------------------------------------------------------------
Route::get('/dashboard/report',[ReportController::class,'reporting_department'])->name('Report.allDepartments');
Route::get('/dashboard/departmentReport',[AdminCourseController::class,'departmentReport'])->name('Report.Department');
Route::get('/dashboard/report/{depid}/Department',[ReportController::class,'eachDepartmentReport'])->name('Report.eachDepartmentReport');



});
