<?php

namespace App\Http\Controllers;

use App\Product;
use App\ReportObsoleteProduct;
use Illuminate\Http\Request;

class ReportsObsoleteProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $products = Product::whereHas('sales', function($q) use($request) {
            $q->whereBetween('created_at',[$request->since, $request->at])            
            ->havingRaw("sum(amount) > {$request->amount}");
        })->get();

        $newProducts = [];

        $products->map(function($p, $key) use(&$newProducts) {
            $newProducts[] = $p;
            $newProducts[$key]->amount_total = $p->sales->sum('amount');
        });

        return response()->json($newProducts);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReportObsoleteProduct  $report
     * @return \Illuminate\Http\Response
     */
    public function show(ReportObsoleteProduct $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportObsoleteProduct  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportObsoleteProduct $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportObsoleteProduct  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportObsoleteProduct $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportObsoleteProduct  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportObsoleteProduct $report)
    {
        //
    }
}
