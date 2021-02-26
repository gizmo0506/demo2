<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Redirect;
use Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $employee = Employee::where([
            ['name', '!=', Null],
            [function($query) use ($request){
                if(($term = $request->term)){
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy("id", "desc")
            ->paginate(15);

        //$employee = Employee::paginate(15);
        return view('index', compact('employee'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getList(Request $request)
    {
        $results = Employee::orderBy('id')->paginate(15);
        $ajaxlists = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $ajaxlists.='<table class="table"><tr><td>'.$result->id.'</td><td>'.$result->name.'</td><td>'.$result->email.'</td><td>'.$result->phone.'</td><td>'.$result->dob.'</td></tr></table>';
            }
            return $ajaxlists;
        }
        return view('ajaxlist');
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'dob' => 'required|date',
        ]);
        $employee = Employee::create($storeData);

        return redirect('/employees')->with('completed', 'Employee has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::all();
        return view('index', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'dob' => 'required|date',
        ]);
        Employee::whereId($id)->update($updateData);
        return redirect('/employees')->with('completed', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $emoloyee->delete();

        return redirect('/employees')->with('completed', 'Employee has been deleted');
    }
}
