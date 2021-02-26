<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;


class ItemSearchController extends Controller

{


	/**

     * Get the index name for the model.

     *

     * @return string

    */

    public function index(Request $request)

    {

        if($request->has('titlesearch')){

            $items = Item::search($request->titlesearch)

                ->paginate(6);

        }else{

            $items = Item::paginate(6);

        }

        return view('item-search',compact('items'));

    }


    /**

     * Get the index name for the model.

     *

     * @return string

    */

    public function create(Request $request)

    {

        $this->validate($request,['title'=>'required']);

        $items = Item::create($request->all());

        return back();

    }
    public function autocomplete(Request $request)

    {

        $data = Item::select("title")

                ->where("title","LIKE","%{$request->query}%")

                ->get();

   

        return response()->json($data);

    }

}