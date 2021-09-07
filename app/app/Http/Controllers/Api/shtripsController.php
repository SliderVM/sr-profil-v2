<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\strips;
use App\Models\Buhta;
use App\Models\apr;

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
        // dd($request->aprs['0']['amount']);
        $widthAPR = 0; // общая длина штрипса
        $i = 0;
        while ($i < count($request->aprs)) {
            $widthAPR = $widthAPR + $request->aprs[$i]['width'];
            $i = $i + 1;
        }
        $i = 0;
        while($i < count($request->aprs)) {
$j = 0;

        while ($j < $request->aprs[$i]['amount']) {
            // dd($request->aprs);
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
            $j++;
        }
        $i++;
        }
        // dd(count($request->aprs));

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
        if(strips::where('strips.buhta_id', $id)->first()){
            return strips::with('counterparties', 'brigade', 'TypesMetals', 'metalThicknesse')->where('buhta_id', $id)->get(); // вывод штрипса по айди бухты
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
        return strips::with('TypesMetals', 'metalThicknesse')->where('warehouse_id', $id)->get();
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
        $strips = strips::where('buhta_id', $id)->first();
        $strips->delete();
        $buhtaDelete = Buhta::find($id)->update(['available'=> 1]);
        return response()->json(['msg' => 'Удалено!']);
    }

    public function showOutfitStripping(Request $request)
    {
        $id = $request->buhtas[0]['id'];
        $type = $request->buhtas[0]['types_metals']['name'];
        $width = $request->buhtas[0]['width'];
        $length = $request->buhtas[0]['length'];
        $thicknesses = $request->buhtas[0]['metal_thicknesse']['thicknesses'];
        $date = $request->dateOutfit;

        $vm = apr::where('buhta_id', $id)->first();
        ;
        return view('FormPrint.OutfitStripping', ['vm' =>$vm, 'id' => $id, 'date' => $date, 'type' => $type, 'width' => $width, 'thicknesses' => $thicknesses, 'length' => $length]);
    }
    public function warehouseNum($id) // складской номер
    {
        $shtrips = strips::find($id);
        $name = $shtrips['buhta_id'] .'/'. $shtrips['width_in_millimeters'];
        return $name;
    }
    public function sumShtrips($id, Request $request)
    {
        $num = $request['0'];
        $strip = strips::find($id);
        $sumLength = $strip->length_in_meters * $num;
        $sumWeight = $strip->weight_in_tons * $num;
        return [$sumLength, $sumWeight];
    }
}
