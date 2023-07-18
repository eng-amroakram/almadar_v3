<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        return view('panel.table', ['service' => 'SalesService', 'title' => 'المبيعات']);
    }

    public function profile(Sale $sale)
    {
        return view('panel.sales.profile', ['sale' => $sale, 'title' => "صفقة {$sale->sale_code}"]);
    }

    public function clientPayments()
    {
        return view('panel.table', ['service' => 'SalePaymentService', 'title' => 'دفعات العملاء']);
    }
}
