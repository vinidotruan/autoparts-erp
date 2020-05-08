<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ReportsController extends Controller
{
    public function getInventoryDownProducts()
    {
        $data = ['products' => Product::with('category')->whereInventoryDown()->get()];
        $pdf = \PDF::loadView('pdf.inventoryDownProducts', $data);
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('baixo-estoque.pdf');
    }

    public function downloadInventoryDownProducts()
    {
        $data = ['products' => Product::with('category')->whereInventoryDown()->get()];
        $pdf = \PDF::loadView('pdf.inventoryDownProducts', $data);
        $pdf->setPaper('A4','landscape');
        return $pdf->download('baixo-estoque.pdf');
    }
}
