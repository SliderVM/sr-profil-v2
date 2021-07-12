<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\brigade;
use Illuminate\Http\Request;

class BrigadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return brigade::with('warehouse')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $func = function($value) {
            return $value['id'];
        };

        $warehouse = brigade::create([
            'name'=> $request->imya,
        ]);

        $warehouse->Warehouse()->sync(array_map($func, $request->warehouse));

        return $warehouse;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $func = function($value) {
            return $value['id'];
        };

        brigade::find($request->id)->update([
            'name'=> $request->name,
        ]);

        $warehouse = brigade::find($request->id);

        $warehouse->Warehouse()->sync(array_map($func,$request->Warehouse));

        return $warehouse;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse= brigade::find($id);
        $warehouse->Warehouse()->detach();
        $warehouse->delete();
    }
}
