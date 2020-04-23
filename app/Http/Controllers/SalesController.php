<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::with(['product'])->paginate(15);

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
        if( (Product::find($request->product_id)->amount - $request->amount) < 0) {
            throw ValidationException::withMessages(['amount' => 'Sem estoque suficiente']);
        }

        if( $request->amount < 0) {
            throw ValidationException::withMessages(['amount' => 'Quantidade inválida']);
        }

        // if((Product::find($request->product_id)->amount - $request->amount) < 100) {
        //     Notification::send(App\User::all(), new InventoryDown(Product::find($request->product_id)));
        // }
        
        $sale = Sales::create($request->all());
        $sale->product->amount -= $sale->amount;
        $sale->product->save();
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
        return response()->json($response);
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
        $sale->products()->detach();
        $sale->delete();

        return response()->json(["message" => "Sale deleted"]);
    }
}
