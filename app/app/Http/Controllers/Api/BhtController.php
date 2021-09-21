<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buhta;
use Illuminate\Http\Request;

class BhtController extends Controller
{
    /**
     * Показать все бухты.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Buhta::with('TypesMetals', 'counterparties', 'metalThicknesse')->get();
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
        $buhta = buhta::create([
            "receipt_date" => $request->receiptDate,
            "warehouse_id" => $request->warehouseId,
            "name" =>  $request->name ? $request->name : (buhta::max('id') +1).' / '.$request->warehouseId,
            "type_metal_id" => $request->typeMetalId,
            "width" => $request->width,
            "weight" => $request->weight,
            "metal_thickness_id" => $request->metalThicknessId,
            "length" => $request->length,
            "price" => $request->price,
            "available" => $request->available,
            "counterparty_id" => $request->counterpartyId
        ]);
        return $buhta;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Buhta::where('buhtas.warehouse_id', $id)->join('aprs','buhtas.id', 'aprs.buhta_id')->where('aprs.buhta_id', '!=', NULL)->first())
        {
           return Buhta::with('TypesMetals', 'counterparties', 'warehouses', 'metalThicknesse')->where('warehouse_id', $id)->where('available', '1')->get(); // вывод бухт
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Buhta::with('TypesMetals', 'counterparties', 'metalThicknesse')->where('warehouse_id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        buhta::find($request->id)->update(['available'=> 1,'receipt_date' =>date("d.m.Y")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buhta= buhta::find($id);
        $buhta->delete();
        return $buhta;
    }

    public function history(Request $request)
    {
        if($request[0]) {
        return Buhta::with('TypesMetals', 'counterparties', 'warehouses', 'metalThicknesse')->where('available', '0')->where('warehouse_id', $request[0])->get(); // вывод бухт во вкладке история по айди склада
        }
        else {
        return Buhta::with('TypesMetals', 'counterparties', 'warehouses', 'metalThicknesse')->where('available', '0')->get(); // вывод бухт во вкладке история
        }
    }
}
