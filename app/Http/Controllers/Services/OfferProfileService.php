<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Http\Request;

class OfferProfileService extends Controller
{
    public $name =  "حجز العرض";
    public $title_creator = "حجز العرض";
    public $title_updater = "";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-offer-reservation-button";
    public $updater_id = "";
    public $model = Offer::class;
    public $class_title = "Offer";
    public $excel_file = "OffersExport";

    public function __construct()
    {
        $this->model = new Offer();
    }

    public function create()
    {
        return config('views.tables.buttons.create.orders-notes-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.offers-reservation-service');
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
                select('select', 'client_id', "client_id_profile_select_id$prefix_id", "fas fa-users", "", "select inputProfileSelect$type", "اسم العميل", true, clients(true), "", false, "اسم العميل", "text-danger client_id-validation fw-bold ms-5 reset-validation"),
                input("text", "price", "price_profile_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputProfileText$type", "سعر الحجز", true, "سعر الحجز", "text-danger price-validation fw-bold ms-5 reset-validation"),
                input("date", "date_from", "date_from_profile_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputProfileText$type", "التاريخ من", true, "التاريخ من", "text-danger date_from-validation fw-bold ms-5 reset-validation"),
                input("date", "date_to", "date_to_profile_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputProfileText$type", "التاريخ الى", true, "التاريخ الى", "text-danger date_to-validation fw-bold ms-5 reset-validation"),
                select("select", "payment_method", "payment_method_profile_select_id$prefix_id", "far fa-credit-card", "", "select inputProfileSelect$type", "طريقة الدفع", true, $payment_methods, "", false, "طريقة الدفع", "text-danger payment_method-validation fw-bold ms-5 reset-validation"),
                select("select", "bank", "bank_profile_select_id$prefix_id", "far fa-credit-card", "", "select inputProfileSelect$type", "البنك", true, $banks, "", false, "البنك", "text-danger bank-validation fw-bold ms-5 reset-validation"),
                input("text", "check_number", "check_number_profile_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputProfileText$type", "رقم الشيك", true, "رقم الشيك", "text-danger check_number-validation fw-bold ms-5 reset-validation"),
                input("text", "recipient_name", "recipient_name_profile_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputProfileText$type", "اسم المستلم", true, "اسم المستلم", "text-danger recipient_name-validation fw-bold ms-5 reset-validation"),

                input("textarea", "note", "note_profile_input_id$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputProfileText$type", "الملاحظة", true, "الملاحظة", "text-danger note-validation fw-bold ms-5 reset-validation"),
            ],
        ];

        $contents = config("views.modals.contents.orders-notes-service");

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
        return Reservation::getRules($id);
    }

    public function messages()
    {
        return Reservation::getMessages();
    }

    public function delete($id)
    {
        return Offer::deleteModel($id);
    }

    public function status($id)
    {
        return Offer::status($id);
    }

    public function store($data)
    {
        return Offer::store($data);
    }

    public function update($data, $id)
    {
        return Offer::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            "order_id",
            "real_estate_id",
            "user_id",
            "broker_id",
            "offer_code",
            "offer_type",
            "status",
            "creator",
            "updater",
            "client_id",
            "date_from",
            "price",
            "date_to",
            "payment_method",
            "note",
            "check_number",
            "recipient_name",
            "bank",
        ];
    }
}
