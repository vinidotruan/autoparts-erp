<?php

namespace App\Http\Controllers;

use App\Product;
use App\ReportObsoleteProduct;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function obsoleteProducts(Request $request)
    {
        $products = Product::whereHas('sales', function($q) use($request) {
            $q->whereBetween('date',[$request->since, $request->at])            
            ->havingRaw("sum(amount) < {$request->minimun_amount}");
        })->get();

        $newProducts = [];

        $products->map(function($p, $key) use(&$newProducts) {
            $newProducts[] = [
                "id" => $p->id,
                "name" => $p->title,
                "value" => $p->sales->sum('price'),
                "amount_total" =>  $p->sales->sum('amount')
            ];
        });

        $data = [
            'user_id' => $request->user_id,
            'since' => $request->since,
            'at' => $request->at,
            'minimun_amount' => $request->minimun_amount,
            'products' => serialize($newProducts)
        ];

        $re = ReportObsoleteProduct::create($data);
        return response()->json($re);

    }

    public function inventoryDown()
    {
        $products = Product::with('category')->whereRaw('amount < limit_amount')->get();
        return response()->json($products);
    }
}
