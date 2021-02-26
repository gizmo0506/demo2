<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
    return view('home');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});

Route::resource('employees', EmployeeController::class);

Route::get('/convert-to-json', function () {
    return App\Models\Employee::paginate(10);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ajaxlists', [EmployeeController::class, 'getList']);
