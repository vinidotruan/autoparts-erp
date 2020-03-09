<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::paginate(15);

        return response()->json($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = Sales::create($request->all());

        return response()->json(['message' => 'Sale created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sales  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sale)
    {
        $response = Sales::find($sale->id);
        return response()->json(['sale' => $response]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sales  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sale)
    {
        $sale->update($request->all());
        return response()->json(['message' => "Sale updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sales  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sale)
    {
        $sale->delete();

        return response()->json(["message" => "Sale deleted"]);
    }
}
