<?php

use Illuminate\Support\Facades\Route;
use App\models\teacher ;
use App\models\classroom ;
use App\models\subject ;


header('Access-Control-Allow-Origin ', '*');

Route::get('/', function () {

    return view('welcome');

})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('classroom', 'ClassroomController')->except(["index", "show", "edit", "destroy"])->middleware("auth");
Route::get('classroom', 'ClassroomController@index');
Route::get('classroom/get-classroom/{code}', 'ClassroomController@getClassroom')->name('get-classroom');
Route::delete('classroom/drop/{id}', 'ClassroomController@drop')->name('drop-classroom');


Route::resource('teacher', 'TeacherController')->except(["index", "edit", "destroy"])->middleware("auth");
Route::get('teacher', "TeacherController@index");
Route::get('teacher/get-teacher/{register}', 'TeacherController@getTeacher')->name('get-teacher');
Route::delete('teacher/drop/{id}', 'TeacherController@drop')->name('drop-teacher');

Route::resource('room', 'RoomController')->except(["show", "edit", "destroy"]);
Route::get('room', 'RoomController@index');
Route::get('room/get-room/{code}', 'RoomController@getRoom')->name('get-room');
Route::delete('room/drop/{id}', 'RoomController@drop')->name('drop-room');/*  */

Route::resource('student', 'StudentController')->only(['create', 'store', 'show', 'update'])->middleware("auth");
Route::get('student/get-student/{register}', 'StudentController@getStudent')->name('get-student');
Route::get('student/show-students/{classroom_id}', 'StudentController@showStudents')->name('show-students');
Route::delete('student/drop/{id}', 'StudentController@drop')->name('drop-student');

Route::resource('category', 'CategoryController')->except(["index", "edit", "destroy"])->middleware("auth");
Route::get('category', 'CategoryController@index');
Route::get('category/get-category/{id}', 'CategoryController@getCategory')->name('get-category');
Route::delete('category/drop/{id}', 'CategoryController@drop')->name('drop-category');


Route::get('subject/get-subject/{code}', 'SubjectController@getSubject')->name('get-subject');


Route::resource('rating', 'RatingController')->only(["index", "store"])->middleware("auth");
Route::get('/rating/{teacher}/{classroom}/{subject}', function (Teacher $teacher, Classroom $classroom, Subject $subject) {
    return view('rating.create', compact('teacher', 'classroom', 'subject'));
})->name('rating.create')->middleware("auth");


Route::resource('course', "CourseController")->except(["show", "edit", "update"])->middleware("auth");
Route::get('course/get-course', "CourseController@getCourse");



