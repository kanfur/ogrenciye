<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

use Illuminate\Support\Facades\DB;

Route::get('/', function () {

    // Test database connection
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Could not connect to the database. Please check your configuration. error:" . $e );
    }

    return view('welcome');
});

Route::namespace('Web')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', 'UserController@index');
    Route::get('/students/verify', 'UserController@verifyStudents');
    //route('admin.verify_student', ['id' => 1]);
    Route::post('/users/student/verify/{id}', 'UserController@verifyUser')->name('verify_student');
});