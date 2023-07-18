<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\SalePayment;
use Illuminate\Http\Request;

class SalePaymentService extends Controller
{
    public $name = "دفعات العملاء";
    public $title_creator = "دفعات العملاء";
    public $title_updater = "تعديل بيانات الدفعة";
    public $modal_size = "";
    public $creator_id = "creator-new-sale-payment-button";
    public $updater_id = "updater-sale-payment-button";
    public $model = SalePayment::class;
    public $class_title = "SalePayment";
    public $excel_file = "SalePaymentsExport";

    public function __construct()
    {
        $this->model = new SalePayment();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return SalePayment::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function model($id)
    {
        return SalePayment::find($id);
    }

    public function columns()
    {
        return config('views.tables.columns.sale-payment-service');
    }

    public function rows()
    {
        return config('views.tables.rows.sale-payment-service');
    }

    public function selects()
    {
        $clients = config('views.tables.searches.sale-payment-service');
        $clients["buyer_id"] = clients(true);
        return $clients;
    }

    public function create()
    {
        return config('views.tables.buttons.create.sale-payment-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.sale-payment-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $payment_methods = [
            __('cash_money') => 'cash_money',
            __('bank_check') => 'bank_check',
            __('bank_transfer') => 'bank_transfer',
        ];

        $banks = [
            __("AAAL") => "AAAL",
            __("ALBI") => "ALBI",
            __("ARNB") => "ARNB",
            __("BJAZ") => "BJAZ",
            __("BSFR") => "BSFR",
            __("NCBK") => "NCBK",
            __("RIBL") => "RIBL",
            __("RJHI") => "RJHI",
            __("SABB") => "SABB",
            __("SIBC") => "SIBC",
        ];

        $inputs = [
            [
                select('select', 'buyer_id', "buyer_id_select_id$prefix_id", "fas fa-toggle-off", "", "select inputSelect$type", "العميل المشتري", true, clients(true), "", true, "العميل المشتري", "text-danger buyer_id-validation fw-bold ms-5 reset-validation"),
                input("text", "remaining_amount", "remaining_amount_input_id$prefix_id", "fas fa-square-root-variable", "rtl", "255", "form-control inputText$type", "المبلغ المتبقي", true, "المبلغ المتبقي", "text-danger remaining_amount-validation fw-bold ms-5 reset-validation", true),
                input("text", "amount", "amount_input_id$prefix_id", "fas fa-square-root-variable", "rtl", "255", "form-control inputText$type", "مبلغ الدفعة", true, "مبلغ الدفعة", "text-danger amount-validation fw-bold ms-5 reset-validation", false),
                select("select", "payment_method", "payment_method_select_id$prefix_id", "far fa-credit-card", "", "select inputSelect$type", "طريقة الدفع", true, $payment_methods, "", true, "طريقة الدفع", "text-danger payment_method-validation fw-bold ms-5 reset-validation"),
                select("select", "bank", "bank_select_id$prefix_id", "far fa-credit-card", "", "select inputSelect$type", "البنك", true, $banks, "", false, "البنك", "text-danger bank-validation fw-bold ms-5 reset-validation"),
                input("text", "check_number", "check_number_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputText$type", "رقم الشيك", true, "رقم الشيك", "text-danger check_number-validation fw-bold ms-5 reset-validation"),
                input("text", "recipient_name", "recipient_name_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputText$type", "اسم المستلم", true, "اسم المستلم", "text-danger recipient_name-validation fw-bold ms-5 reset-validation"),
            ]
        ];

        $contents = config('views.modals.contents.sale-payment-service',);

        $x = 0;

        foreach ($contents as $content) {
            $content["inputs"] = $inputs[$x];
            $contents[$x] = $content;
            $x++;
        }

        return $contents;
    }

    public function rules($id = "")
    {
        return SalePayment::getRules($id);
    }

    public function messages()
    {
        return SalePayment::getMessages();
    }

    public function delete($id)
    {
        return SalePayment::deleteModel($id);
    }

    public function status($id)
    {
        return SalePayment::status($id);
    }

    public function store($data)
    {
        return SalePayment::store($data);
    }

    public function update($data, $id)
    {
        return SalePayment::updateModel($data, $id);
    }

    public function fillable()
    {
        return $this->model->getFillable();
    }
}
