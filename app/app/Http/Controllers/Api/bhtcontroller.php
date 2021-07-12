<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buhta;
use App\Models\apr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BhtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Buhta::with('TypesMetals', 'counterparties')->get();
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
        $validator = Validator::make(
            $request->all(),
            [
                "warehouseId" => ["required"],
                "receiptDate" => ["required"],
                "typeMetalId" => ["required"],
                "width" => ["required"],
                "weight" => ["required"],
                "metalThicknessId" => ["required"],
                "length" => ["required"],
                "price" => ["required"],
                "available" => ["required"],
                "counterpartyId" => ["required"]
            ]
        );
        if ($validator->fails()) {
            return [
                "status" => false,
                $errors = $validator->errors()
            ];
        };
        $buhta = buhta::create([
            "receipt_date" => $request->receiptDate,
            "warehouse_id" => $request->warehouseId,
            "name" => (buhta::max('id') +1).' / '.$request->warehouseId,
            "type_metal_id" => $request->typeMetalId,
            "width" => $request->width,
            "weight" => $request->weight,
            "metal_thickness_id" => $request->metalThicknessId,
            "length" => $request->length,
            "price" => $request->price,
            "available" => $request->available,
            "counterparty_id" => $request->counterpartyId
        ]);

        return [
            "status" => true,
            "buhta" => $buhta
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        buhta::find($request->id)->update(['available'=> 2,'receipt_date' =>date("d.m.Y")]);
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
}
