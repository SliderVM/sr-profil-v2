<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buhta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class bhtcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Buhta::all();
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
                "warehouse_id" => ["required"],
                "receipt_date" => ["required"],
                "type_metal_id" => ["required"],
                "width" => ["required"],
                "weight" => ["required"],
                "metal_thickness_id" => ["required"],
                "length" => ["required"],
                "price" => ["required"],
                "available" => ["required"],
                "counterparty_id" => ["required"]
            ]
        );
        if ($validator->fails()) {
            return [
                "status" => false,
                $errors = $validator->errors()
            ];
        };
        $buhta = buhta::create([
            "receipt_date" =>$request->receipt_date,
            "warehouse_id" => $request->warehouse_id,
            "name" => (buhta::max('id') +1).' / '.$request->warehouse_id,
            "type_metal_id" => $request->type_metal_id,
            "width" => $request->width,
            "weight" => $request->weight,
            "metal_thickness_id" => $request->metal_thickness_id,
            "length" => $request->length,
            "price" => $request->price,
            "available" => $request->available,
            "counterparty_id" => $request->counterparty_id
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
    public function show($id)
    {
        // $buhta = buhta::find($id);
        // if(!$buhta) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "Not found"
        //     ]);
        // };
        // return $buhta;
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
