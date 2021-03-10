<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SimpleSearchController;
use App\Http\Controllers\CrudController;
Use App\Http\Controllers\ItemSearchController;
use App\Http\Controllers\JwtController;


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
Route::get('todo', [CrudController::class, 'index']);

Route::resource('employees', EmployeeController::class);
Route::resource('todo', CrudController::class);
Route::get('/convert-to-json', function () {
    return App\Models\Employee::paginate(10);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::get('/ajaxlists', [EmployeeController::class, 'getList']);
Route::get('/simplesearch', [SimpleSearchController::class, 'index']);
Route::get('/ajax-autocomplete-search', [SimpleSearchController::class, 'selectSearch']);

Route::get('items-lists', [ItemSearchController::class, 'index'])->name('items-lists');
Route::post('create-item', [ItemSearchController::class, 'create'])->name('create-item');
Route::post('autocomplete', [ItemSearchController::class, 'autocomplete'])->name('autocomplete');

Route::get('/jwt/encrypt', [JwtController::class, 'encrypt']);
Route::get('/jwt/decrypt', [JwtController::class, 'decrypt']);