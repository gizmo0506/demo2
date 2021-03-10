<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Models\Employee;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::get('employeesall', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Employee::all();
});
 
Route::get('employees', [ApiController::class, 'encrypt']);

Route::post('employees', function(Request $request) {
    return Employee::create($request->all);
});

Route::put('employees/{id}', function(Request $request, $id) {
    $employe = Employee::findOrFail($id);
    $employe->update($request->all());

    return $employe;
});

Route::delete('employees/{id}', function($id) {
    Employee::find($id)->delete();

    return 204;
});