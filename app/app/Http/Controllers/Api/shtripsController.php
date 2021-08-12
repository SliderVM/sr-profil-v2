<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\strips;
use App\Models\Buhta;

class shtripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return strips::with('counterparties','brigade', 'TypesMetals', 'metalThicknesse')->get();
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
        $widthAPR = 0; // общая длина штрипса
        $i = 0;
        while ($i < count($request->aprs)) {
            $widthAPR = $widthAPR + $request->aprs[$i]['width'];
            $i = $i + 1;
        }

        $i = 0;
        while ($i < count($request->aprs)) {
            strips::create([
                'buhta_id' => $request->buhtas[0]['id'], // айди бухты
                'brigade_id' => $request->brigadeId, // айди бригады
                'width_in_millimeters' => $request->aprs[$i]['width'], // ширина штрипса в миллимтрах
                'warehouse_id' => $request->buhtas[0]['warehouse_id'], // айди склада
                'counterpartie_id' => $request->buhtas[0]['counterparty_id'], // айди контрагента
                'weight_in_tons' => $request->buhtas[0]['weight'] / $widthAPR * $request->aprs[$i]['width'], // вес штрипса в тоннах
                'metal_thicknesse_id' => $request->buhtas[0]['metal_thickness_id'], // толщина меттала
                'types_metal_id' => $request->buhtas[0]['type_metal_id'], // тип металла
                'length_in_meters' => $request->buhtas[0]['length'], // длина штрипса в метрах
                'cost' => $request->buhtas[0]['price'] * ($request->buhtas[0]['weight'] / $widthAPR * $request->aprs[$i]['width']), // стоимость
                'available' => '1', // доступность
                'date_manufacture' => $request->dateManufacture, // дата производства
            ]);
            $i = $i + 1;
        }
        Buhta::find($request->buhtas[0]['id'])->update(['available'=> 0]); // после резки штрипса делать бухту недоступной
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (strips::where('strips.warehouse_id', $id)->first()) {
            return strips::with('counterparties','brigade', 'TypesMetals', 'metalThicknesse')->where('warehouse_id', $id)->get(); // вывод штрипса по айди склада
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
