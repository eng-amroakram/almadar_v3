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
        $sale = $sale_payment->sale;
        $offer = $sale->offer;
        $realEstate = $sale->realEstate;


        $obj = new Arabic('Numbers');

        $add = __($realEstate->real_estate_type) . " " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;


        if (in_array($realEstate->real_estate_type, ['land', 'warehouse_land', 'agircultural_land', 'industrial_land', 'residential_land'])) {
            $add = "أرض " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;
        }

        if ($realEstate->real_estate_type == 'duplex') {
            $add = "دبلكس " . $realEstate->location->building_status . " " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;
        }

        if ($realEstate->real_estate_type == 'condominium') {
            $add = "عمارة " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->floors . 'طوابق';
        }

        if ($realEstate->real_estate_type == 'flat') {
            $add = "شقة " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->flat_rooms . ' غرف';
        }

        if ($realEstate->real_estate_type == 'chalet') {
            $add = "شاليه " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name;
        }

        $real_estate_data = "دفعة اتفاقية تخص " . $add . " والمتبقي " . $sale->remaining_amount . " ريال";

        if ($sale_payment->payment_method == "cash_money") {
            $payment = "دفع كاش";
        }

        if ($sale_payment->payment_method == "bank_check") {
            $payment = "شيك " . $sale_payment->check_number . " " . $sale_payment->bank;
        }

        if ($sale_payment->payment_method == "bank_transfer") {
            $payment = "تحويل بنكي (" . $sale_payment->bank . ")";
        }

        $real_estate_data_t = "دفعة رقم (1): " . "مجموع ماتم دفعه حتى تاريخه " . number_format($sale->amount_paid, 2) . " ريال";

        if ($realEstate->location->branch->code == "KHBR") {
            $number_branch = 2053112320;
            $name_branch = "الخبر";
        }

        $data = [
            'sale_date' => $sale_payment->created_at,
            'sale_code' => $sale->sale_code,
            'customer_buyer_name' => $sale->buyer->name,
            'customer_seller_name' => $sale->seller->name,
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
