<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class SimpleSearchController extends Controller
{
    //
    public function index()
    {
    	return view('home');
    }

    public function selectSearch(Request $request)
    {
    	$employees = [];

        if($request->has('q')){
            $search = $request->q;
            $employees = Employee::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($employees);
    }
}
