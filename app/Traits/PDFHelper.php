<?php

namespace App\Traits;

use App\Models\SalePayment;
use ArPHP\I18N\Arabic;
use Illuminate\Support\Facades\Response;
use mikehaertl\pdftk\Pdf;

trait PDFHelper
{
    public function exportPDFFile($sale_payment_id)
    {
        $file = asset('pdfs/deposit.pdf');
        $number_branch = 2053115582; #القطيف
        $name_branch = "القطيف";

        $sale_payment = SalePayment::find($sale_payment_id);
        $offer = $sale_payment->offer;
        $sale = $offer->sale;
        $buyer = $sale_payment->buyer;

        // $sale = $sale_payment->sale;
        // $offer = $sale->offer;
        // $obj = new Arabic('Numbers');

        $realEstate = $offer->realEstate;

        $total = $sale ? $sale->amount_paid : $sale_payment->amount;

        $add = __($realEstate->real_estate_type) . " " . number_format($realEstate->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;


        if (in_array($realEstate->real_estate_type, ['land', 'warehouse_land', 'agircultural_land', 'industrial_land', 'residential_land'])) {
            $add = "أرض " . number_format($realEstate->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;
        }

        if ($realEstate->real_estate_type == 'duplex') {
            $add = "دبلكس " . __($realEstate->location->building_status) . " " . number_format($realEstate->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;
        }

        if ($realEstate->real_estate_type == 'condominium') {
            $add = "عمارة " . number_format($realEstate->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->floors . 'طوابق';
        }

        if ($realEstate->real_estate_type == 'flat') {
            $add = "شقة " . number_format($realEstate->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->flat_rooms . ' غرف';
        }

        if ($realEstate->real_estate_type == 'chalet') {
            $add = "شاليه " . number_format($realEstate->space) . "م " . "ب" . $realEstate->location->city->name;
        }

        $real_estate_data = "دفعة اتفاقية تخص " . $add . " والمتبقي " . $realEstate->remaining_amount . " ريال";

        if ($sale_payment->payment_method == "cash_money") {
            $payment = "دفع كاش";
        }

        if ($sale_payment->payment_method == "bank_check") {
            $payment = "شيك " . $sale_payment->check_number . " " . $sale_payment->bank;
        }

        if ($sale_payment->payment_method == "bank_transfer") {
            $payment = "تحويل بنكي (" . $sale_payment->bank . ")";
        }

        $real_estate_data_t = "دفعة رقم (1): " . "مجموع ماتم دفعه حتى تاريخه " . number_format($total, 2) . " ريال";

        if ($realEstate->location->branch->code == "KHBR") {
            $number_branch = 2053112320;
            $name_branch = "الخبر";
        }

        $data = [
            'sale_date' => $sale_payment->created_at,
            'sale_code' => $sale ? $sale->sale_code : '',
            'customer_buyer_name' => $sale ? $sale->buyer->name : $buyer->name,
            'customer_seller_name' => $sale ? $sale->seller->name : '',
            'paid_amount' => "مبلغ  " . $sale_payment->amount_string . "   ريال فقط لا غير",
            'check_number' => $payment,
            'real_estate_data' => $real_estate_data,
            'real_estate_data_t' => $real_estate_data_t,
            'number_branch' => $number_branch,
            'name_branch' => $name_branch
        ];

        $file = public_path() . '/pdfs/deposit.pdf';
        $saved_file = public_path() . '/pdf-viewer/web/deposit.pdf';

        $pdf = new Pdf($file, [
            'locale' => 'ar_SA.utf8',
            'procEnv' => [
                'LANG' => 'ar_SA.utf-8',
            ],
            // 'command' => 'C:\Program Files (x86)\PDFtk\bin\pdftk.exe',
            // 'useExec' => true,
        ]);

        $result = $pdf->fillForm($data)->needAppearances()->saveAs($saved_file);

        if ($result === false) {
            dd($pdf->getError());
        }

        $path = public_path('pdf-viewer/web/deposit.pdf');
        return Response::download($path, "$sale->sale_code" . '.pdf', ['Content-Type: application/pdf']);
    }
}
