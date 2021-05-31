<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Facades\Input;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::paginate(15), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'ref' => 'required|unique:products',
            'value_cost' => 'required',
            'value_sell' => 'required',
            'amount' => 'required|min:1',
            'category_id' => 'required',
        ]);
        $product = Product::create($request->all());

        return response()->json(['product' => $product, 'message' => 'Product created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $response = Product::find($product->id)->load('category');
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'ref' => 'required|unique:products',
            'value_cost' => 'required',
            'value_sell' => 'required',
            'amount' => 'required|min:1',
            'category_id' => 'required',
        ]);
        $product->update($request->all());
        $product->save();

        return response()->json(['message' => 'Product updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }

    public function search(Request $request) {
        $field = key($request->all());
        $value = current($request->all());
        $product = Product::where($field, 'like', "%{$value}%")->paginate(15);

        return response()->json($product);
    }
}
