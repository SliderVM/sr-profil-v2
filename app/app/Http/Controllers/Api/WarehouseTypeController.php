<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\warehouse;
use App\Models\Buhta;
use App\Models\WarehouseType;
use Illuminate\Http\Request;

class WarehouseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WarehouseType::all('name','id');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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

        $warehouse = warehouse::create([
            'name'=> $request->name,
        ]);

        $warehouse->WarehouseTypes()->sync(array_map($func, $request->TypeWarehouse));

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
     * @param  Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $func = function($value) {
            return $value['id'];
        };

        warehouse::find($request->id)->update([
            'name'=> $request->name,
        ]);

        $warehouse = warehouse::find($request->id);

        $warehouse->WarehouseTypes()->sync(array_map($func,$request->WarehouseTypes));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Buhta::where('warehouse_id', $id)->first())
        {
            return 'Невозможно удалить склад, так как он привязан к бухте';
        }
        else
        {
            $warehouse= warehouse::find($id);
            $warehouse->WarehouseTypes()->detach();
            $warehouse->delete();
        }
    }
}
