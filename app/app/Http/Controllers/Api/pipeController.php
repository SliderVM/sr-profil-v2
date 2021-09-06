<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pipeType;
use App\Models\Strips;

class pipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return pipeType::with('TypesMetals', 'metalThicknesse')->get();
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
        $pipe = pipeType::create([
            'name' => $request -> sizePipe,
            'metal_thicknesse_id' => $request -> metalThicknesseId, 'width_strip_in_millimeters' => $request -> widthShtrips, 'types_metal_id' => $request -> TypeMetalId,
            'coefficient' => $request -> weightPipe,
            'thickness_in_millimeters' => $request -> thicknessMetal,
            'pipe_in_pack' => $request -> amountPipe,
        ]);

        return $pipe;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shtrips = strips::find($id);
        $pipe =  pipeType::where('width_strip_in_millimeters', $shtrips->width_in_millimeters)->where('metal_thicknesse_id', $shtrips->metal_thicknesse_id)->where('types_metal_id', $shtrips->types_metal_id)->first();
        $sum = $shtrips['cost'] * $shtrips['weight_in_tons'];
        return [$pipe, $sum];
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
