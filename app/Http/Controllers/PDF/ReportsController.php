<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ReportObsoleteProduct;

class ReportsController extends Controller
{
    public function getInventoryDownProducts()
    {
        $data = ['products' => Product::with('category')->whereInventoryDown()->get()];
        $pdf = \PDF::loadView('pdf.inventory-down-products', $data);
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('baixo-estoque.pdf');
    }

    public function downloadInventoryDownProducts()
    {
        $data = ['products' => Product::with('category')->whereInventoryDown()->get()];
        $pdf = \PDF::loadView('pdf.inventory-down-products', $data);
        $pdf->setPaper('A4','landscape');
        return $pdf->download('baixo-estoque.pdf');
    }

    public function getObsoleteProducts($reportObsoleteProduct)
    {
        $data = ['report' => ReportObsoleteProduct::find($reportObsoleteProduct)];
        $pdf = \PDF::loadView('pdf.obsolete-products', $data);
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('produtos-obsoletos.pdf');
    }
    public function downloadObsoleteProducts($reportObsoleteProduct)
    {
        $data = ['report' => ReportObsoleteProduct::find($reportObsoleteProduct)];
        $pdf = \PDF::loadView('pdf.obsolete-products', $data);
        $pdf->setPaper('A4','landscape');
        return $pdf->download('produtos-obsoletos.pdf');
    }
}
