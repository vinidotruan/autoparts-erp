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
            ->havingRaw("sum(amount) > {$request->minimun_amount}");
        })->get();

        $newProducts = [];

        // $products->map(function($p, $key) use(&$newProducts) {
        //     $newProducts[$key]->id = $p->id;
        //     $newProducts[$key]->value_total = $p->sales->sum('amount');
        //     $newProducts[$key]->amount_total = $p->sales->sum('amount');
        // });

        $data = [
            'user_id' => $request->user_id,
            'since' => $request->since,
            'at' => $request->at,
            'minimun_amount' => $request->minimun_amount,
            'data' => serialize($newProducts)
        ];

        $re = ReportObsoleteProduct::create($data);


        // return response()->json($newProducts);
        return response()->json($re);
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
