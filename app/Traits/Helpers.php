<?php

namespace App\Traits;

use App\Models\Sale;
use ArPHP\I18N\Arabic;
use mikehaertl\pdftk\Pdf;

trait Helpers
{
    public function setFields($fillable)
    {
        foreach ($fillable as $field) {
            $this->{$field} = null;
        }
    }

    public function getFieldsValues($fillable)
    {
        $data = [];

        foreach ($fillable as $field) {
            $data[$field] = $this->{$field};
        }
        return $data;
    }

    public function setMadarPDF($sale_id, $file)
    {
        $sale = Sale::find($sale_id);
        $offer = $sale->offer;
        $obj = new Arabic('Numbers');

        $data = [
            "sale_created_at" => (string) $sale->created_at->format('Y-m-d'),
            "sale_code" => $sale->sale_code,
            "city_name" => $sale->realEstate->location->city->name,
            "customer_name" => auth()->user()->name,

            #Client Buyer
            "customer_buyer_adj" => $sale->buyer->description,
            "customer_buyer_name" => $sale->buyer->name,
            "customer_buyer_id_type" => $sale->buyer->id_number_type,
            "customer_buyer_id_number" => $sale->buyer->id_number,
            "customer_buyer_nationality" => $sale->buyer->nationality->name,
            "customer_buyer_phone" => $sale->buyer->phone,
            "customer_buyer_city_name" => $sale->buyer->city->name,
            "customer_buyer_building_number" => $sale->buyer->building_number,
            "customer_buyer_street_name" => $sale->buyer->street_name,
            "customer_buyer_additional_number" => $sale->buyer->extra_figure,
            "customer_buyer_zip_code" => $sale->buyer->zip_code,
            "customer_buyer_email" => $sale->buyer->email,

            #Client Seller
            "customer_seller_adj" => $sale->seller->description,
            "customer_seller_name" => $sale->seller->name,
            "customer_seller_id_type" => $sale->seller->id_number_type,
            "customer_seller_id_number" => $sale->seller->id_number,
            "customer_seller_nationality" => $sale->seller->nationality->name,
            "customer_seller_phone" => $sale->seller->phone,
            "customer_seller_city_name" => $sale->seller->city->name,
            "customer_seller_building_number" => $sale->seller->building_number,
            "customer_seller_street_name" => $sale->seller->street_name,
            "customer_seller_additional_number" => $sale->seller->extra_figure,
            "customer_seller_zip_code" => $sale->seller->zip_code,
            "customer_seller_email" => $sale->seller->email,

            #Real Estate Information
            "real_estate_statement" => $offer->statement,
            "real_estate_space" => $offer->space,
            "real_estate_location" => $offer->city_name . " بلوك رقم " . $offer->block_number,
            "real_estate_location_v2" => $offer->land_number,
            "total_price" => number_format($offer->total),
            "total_price_text" => $obj->int2str($offer->total) . "  ريال فقط لا غير",
            "paid_amount" => number_format($sale->amount_paid),
            "date_expire" => "01-02-2022",
            "amount_due" => number_format($sale->remaining_amount),
            "days" => "360",
            "customer_buyer_name" => $sale->buyer->name,
            "customer_seller_name" => $sale->seller->name,
        ];

        $file = public_path() . '/pdfs/madar.pdf';
        $saved_file = public_path() . '/pdf-viewer/web/madar.pdf';

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

        return asset('pdf-viewer/web/viewer.html?file=madar.pdf');
    }

    public function setDepositPDF($sale_id, $file)
    {
        $number_branch = 2053115582; #القطيف
        $name_branch = "القطيف";

        $sale = Sale::find($sale_id);
        // $offer = $sale->offer;
        // $obj = new Arabic('Numbers');
        $realEstate = $sale->realEstate;

        $add = __($realEstate->real_estate_type) . " " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;

        if (in_array($realEstate->real_estate_type, ['land', 'warehouse_land', 'agircultural_land', 'industrial_land', 'residential_land'])) {
            $add = "أرض " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;
        }

        if ($realEstate->real_estate_type == 'duplex') {
            $add = "دبلكس " . __($realEstate->location->building_status) . " " . number_format($sale->space) . "م " . "ب" . $realEstate->location->city->name . ' ' . $realEstate->character;
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

        $real_estate_data = "دفعة اتفاقية تخص " . $add . " والمتبقي " . $sale->remaining_amount_string . " ريال";

        if ($sale->payment_method == "cash_money") {
            $payment = "دفع كاش";
        }

        if ($sale->payment_method == "bank_check") {
            $payment = "شيك " . $sale->check_number . " " . $sale->bank;
        }

        if ($sale->payment_method == "bank_transfer") {
            $payment = "تحويل بنكي (" . $sale->bank . ")";
        }

        $real_estate_data_t = "دفعة رقم (1): " . "مجموع ماتم دفعه حتى تاريخه " . number_format($sale->amount_paid, 2) . " ريال";

        if ($realEstate->location->branch->code == "KHBR") {
            $number_branch = 2053112320;
            $name_branch = "الخبر";
        }

        $data = [
            'sale_date' => $sale->created_at->format('Y-m-d'),
            'sale_code' => $sale->sale_code,
            'customer_buyer_name' => $sale->buyer->name,
            'customer_seller_name' => $sale->seller->name,
            'paid_amount' => "مبلغ  " . number_format($sale->amount_paid, 2) . "   ريال فقط لا غير",
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

        return asset('pdf-viewer/web/viewer.html?file=deposit.pdf');
    }
}
