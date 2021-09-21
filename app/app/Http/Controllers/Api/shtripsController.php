<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\strips;
use App\Models\Buhta;
use App\Models\apr;
use App\Models\stripsTransferHistory;

class shtripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // ?
    {
        return strips::with('counterparties','brigade', 'TypesMetals', 'metalThicknesse', 'pipeType')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // получить штрипс и сумму штрипса для модалки подтвердить штрипс, count - количество неподтвержденного штрипса,shtrips весь неподтвержденный штрипс
    {
        $shtrips = strips::with('TypesMetals', 'metalThicknesse', 'pipeType')->where('available', '-1')->get();
        $count = strips::with('TypesMetals', 'metalThicknesse', 'pipeType')->where('available', '-1')->count();
        return [$shtrips, $count];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // создать штрипс из апр в управлении производством
    {
        $widthAPR = 0; // общая длина штрипса
        $i = 0;
        while ($i < count($request->aprs)) {
            $widthAPR = $widthAPR + $request->aprs[$i]['width'];
            $i++;
        }
        $k = 0;
        while($k < count($request->aprs)) {
            $j = 0;
            while ($j < $request->aprs[$k]['amount']) {
                strips::create([
                    'buhta_id' => $request->buhtas[0]['id'], // айди бухты
                    'brigade_id' => $request->brigadeId, // айди бригады
                    'width_in_millimeters' => $request->aprs[$k]['width'], // ширина штрипса в миллимтрах
                    'warehouse_id' => $request->buhtas[0]['warehouse_id'], // айди склада
                    'counterpartie_id' => $request->buhtas[0]['counterparty_id'], // айди контрагента
                    'weight_in_tons' => $request->buhtas[0]['weight'] / $widthAPR * $request->aprs[$k]['width'], // вес штрипса в тоннах
                    'metal_thicknesse_id' => $request->buhtas[0]['metal_thickness_id'], // толщина меттала
                    'types_metal_id' => $request->buhtas[0]['type_metal_id'], // тип металла
                    'length_in_meters' => $request->buhtas[0]['length'], // длина штрипса в метрах
                    'cost' => $request->buhtas[0]['price'] * ($request->buhtas[0]['weight'] / $widthAPR * $request->aprs[$k]['width']), // стоимость
                    'available' => '1', // доступность
                    'date_manufacture' => $request->dateManufacture, // дата производства
                ]);
                $j++;
            }
        $k++;
        }

        Buhta::find($request->buhtas[0]['id'])->update(['available'=> '-1']); // после резки штрипса делать бухту недоступной
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // вывод штрипса по айди бухты
    {
        if(strips::where('strips.buhta_id', $id)->first()){
            return strips::with('counterparties', 'brigade', 'TypesMetals', 'metalThicknesse', 'pipeType')->where('buhta_id', $id)->get();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // вывод штрипса по складам
    {
        return strips::with('TypesMetals', 'metalThicknesse', 'pipeType')->where('warehouse_id', $id)->where('available', '1')->groupBy('weight_in_tons', 'length_in_meters', 'width_in_millimeters')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // удалить штрипс, сделать бухту доступной, откатить бухту в истории
    {
        $strips = strips::where('buhta_id', $id)->first();
        $strips->delete();
        Buhta::find($id)->update(['available'=> 1]);
        return response()->json(['msg' => 'Удалено!']);
    }

    public function showOutfitStripping(Request $request) // печать нарядов
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

    public function warehouseNum($id) // складской номер для складов штрипса
    {
        $shtrips = strips::find($id);
        $name = $shtrips['buhta_id'] .'/'. $shtrips['width_in_millimeters'];
        return $name;
    }

    public function sumShtrips($id, Request $request) // общая сумма длины и веса при перемещении
    {
        $num = $request['0']; // количество из инпута переместить
        $strip = strips::find($id);
        $sumLength = $strip->length_in_meters * $num;
        $sumWeight = $strip->weight_in_tons * $num;
        return [$sumLength, $sumWeight];
    }

    public function groupShtrips(Request $request) // сгруппировать штрипс по общим параметрам, посчитать количество сгруппированных
    {
        $shtripsGroup = strips::find($request[1])->first();
        $sum = strips::where('weight_in_tons', $shtripsGroup->weight_in_tons)->where('length_in_meters', $shtripsGroup->length_in_meters)->where('width_in_millimeters', $shtripsGroup->width_in_millimeters)->where('available', '1')->pluck('id');
        $amount = $sum->count();
        return [$amount, $sum];
    }

    public function stripsTransfer(Request $request) // переместить штрипс(отправка)
    {
        $i = 0;
        while ($i < $request->count) {
            stripsTransferHistory::create([
            'strips_id' => $request->array[$i],
            'outgoing_warehouse_id' => $request->warehouseOutgoing,
            'incoming_warehouse_id'=> $request->warehouseInComing,
            'user_sending_id' => $request->userSending,
            'date_sending' => $request->dateSending
            ]);
            strips::find($request->array[$i])->update(['available'=> '-1']);
            $i++;
        }
    }

    public function stripsReceipt(Request $request) // переместить штрипс(получение)
    {
        $war = stripsTransferHistory::where('strips_id', $request->id)->get();
        stripsTransferHistory::where('strips_id', $request->id)->update(['user_receipt_id'=> $request->userReceipt,
        'date_receipt'=> $request->receiptDate]);
        strips::find($request->id)->update(['available'=> 1, 'warehouse_id' => $war[0]['incoming_warehouse_id']]);
    }

    public function stripsCancel($id) // отменить перемещение штрипса между складами
    {
        stripsTransferHistory::where('strips_id', $id)->delete();
        strips::find($id)->update(['available'=> '1']);
    }

    public function shtripsHistory($id)
    {
        $t = strips::join('strips_transfer_histories', 'strips_id', 'strips.id')->where('warehouse_id', $id)->with('TypesMetals', 'metalThicknesse', 'pipeType')->get();
        $us = stripsTransferHistory::join('users', 'user_sending_id', 'users.id')->pluck('name');
        $rec =  stripsTransferHistory::join('users', 'user_receipt_id', 'users.id')->pluck('name');
        return [$t, $us[0], $rec[0]];
    }
}
