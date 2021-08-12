<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\counterparties;
use App\Models\Buhta;
use Illuminate\Http\Request;

class CounterpartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return counterparties::all('name', 'id');
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
        $counterparties = counterparties::create([
            "name" => $request->imya
        ]);
        return $counterparties;
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
        if (Buhta::where('counterparty_id', $id)->first())
        {
            return 'Невозможно удалить контрагента, так как он привязан к бухте';
        }
        else
        {
            $Agent = counterparties::find($id);
            $Agent->delete();
        };
    }
}
