<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\apr;
use App\Models\Buhta;

class aprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return buhta::with('TypesMetals', 'counterparties', 'warehouses')->get();
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
        $i=0;
        while($i < count($request[1])){
         $apr = apr::create([
            "buhta_id" => $request[0],
            "width" => $request[1][$i]['form']['width1'],
            "amount" => $request[1][$i]['form']['amount'],
            "tonage" => $request[1][$i]['form']['tonage']
        ]);
        $i=$i+1;
        }
        return $apr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return apr::join('buhtas','buhtas.id', 'aprs.buhta_id')->where('buhtas.id',$id)->where('aprs.buhta_id', '!=', NULL)->get(['aprs.width','aprs.amount', 'aprs.tonage']);
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
