<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesService extends Controller
{
    public $name =  "المبيعات";
    public $title_creator = "إنشاء صفقة جديدة";
    public $title_updater = "تعديل بيانات الصفقة";
    public $modal_size = "modal-xl";
    public $creator_id = "creator-sale-button";
    public $updater_id = "updater-sale-button";
    public $model = Sale::class;
    public $class_title = "Sale";
    public $excel_file = "SalesExport";

    public function __construct()
    {
        $this->model = new Sale();
    }

    public function model($id)
    {
        return Sale::find($id);
    }

    public function object()
    {
        return new Sale();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Sale::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $property_type = [
            __('land') => 'land',
            __('duplex') => 'duplex',
            __('condominium') => 'condominium',
            __('flat') => 'flat',
            __('chalet') => 'chalet',
            __('warehouse_land') => 'warehouse_land',
            __('agircultural_land') => 'agircultural_land',
            __('industrial_land') => 'industrial_land',
            __('residential_land') => 'residential_land',
        ];

        $payment_methods = [
            __('cash_money') => 'cash_money',
            __('bank_check') => 'bank_check',
            __('bank_transfer') => 'bank_transfer',
        ];

        $nationalities = [
            __("SaudiArabia") => "1",
            __("Emirates") => "2",
            __("Qatar") => "3",
            __("Oman") => "4",
            __("Kuwait") => "5",
            __("Bahrain") => "6",
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
                input("text", "offer_code", "offer_code_input_id$prefix_id", "fas fa-code-commit", "rtl", "255", "form-control inputText$type", "كود العرض", true, "كود العرض", "text-danger offer_code-validation fw-bold ms-5 reset-validation", true),
                input("text", "neighborhood", "neighborhood_input_id$prefix_id", "far fa-building", "rtl", "255", "form-control inputText$type", "الحي/الخطط", true, "الحي/الخطط", "text-danger neighborhood-validation fw-bold ms-5 reset-validation", true),
                input("text", "land_number", "land_number_input_id$prefix_id", "fas fa-list-ol", "rtl", "255", "form-control inputText$type", "رقم الارض", true, "رقم الارض", "text-danger land_number-validation fw-bold ms-5 reset-validation", true),
                input("text", "space", "space_input_id$prefix_id", "fas fa-chart-area", "rtl", "255", "form-control inputText$type", "مساحة العقار", true, "مساحة العقار", "text-danger space-validation fw-bold ms-5 reset-validation", true),
                input("text", "real_estate_price", "real_estate_price_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "سعر العقار", true, "سعر العقار", "text-danger real_estate_price-validation fw-bold ms-5 reset-validation", true),
                input("text", "total_amount", "total_amount_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "السعر الكلي", true, "السعر الكلي", "text-danger total_amount-validation fw-bold ms-5 reset-validation", true),

                // vats
                select('select', 'is_first_home', "is_first_home_select_id$prefix_id", "fas fa-house-chimney-user", "", "select inputSelect$type", "هل مسكن اول؟", true, ["لا" => 2, "نعم" => 1], "", true, "هل مسكن اول؟", "text-danger is_first_home-validation fw-bold ms-5 reset-validation"),
                input("text", "deserved_amount", "deserved_amount_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "المبلغ المستحق", true, "المبلغ المستحق", "text-danger deserved_amount-validation fw-bold ms-5 reset-validation", false),
                input("text", "commission_vat", "commission_vat_input_id$prefix_id", "fas fa-square-root-variable", "rtl", "3", "form-control inputText$type", "ضريبة القيمة المضافة", true, "ضريبة القيمة المضافة", "text-danger commission_vat-validation fw-bold ms-5 reset-validation", false),

                select('select', 'commission_type', "commission_type_select_id$prefix_id", "fas fa-toggle-off", "", "select inputSelect$type", "نوع العمولة", true, ["نسبة" => "percentage", "سعر" => "price"], "", true, "نوع العمولة", "text-danger commission_type-validation fw-bold ms-5 reset-validation"),
                input("text", "commission_percentage", "commission_percentage_input_id$prefix_id", "fas fa-square-root-variable", "rtl", "3", "form-control inputText$type", "نسبة العمولة", true, "نسبة العمولة", "text-danger commission_percentage-validation fw-bold ms-5 reset-validation", false),
                input("text", "commission_price", "commission_price_input_id$prefix_id", "fas fa-square-root-variable", "rtl", "255", "form-control inputText$type", "سعر العمولة", true, "سعر العمولة", "text-danger commission_price-validation fw-bold ms-5 reset-validation", false),

                input("text", "amount_paid", "amount_paid_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "المبلغ المدفوع", true, "المبلغ المدفوع", "text-danger amount_paid-validation fw-bold ms-5 reset-validation", false),
                select("select", "payment_method", "payment_method_select_id$prefix_id", "far fa-credit-card", "", "select inputSelect$type", "طريقة الدفع", true, $payment_methods, "", true, "طريقة الدفع", "text-danger payment_method-validation fw-bold ms-5 reset-validation"),
                select("select", "bank", "bank_select_id$prefix_id", "far fa-credit-card", "", "select inputSelect$type", "البنك", true, $banks, "", false, "البنك", "text-danger bank-validation fw-bold ms-5 reset-validation"),
                input("text", "check_number", "check_number_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputText$type", "رقم الشيك", true, "رقم الشيك", "text-danger check_number-validation fw-bold ms-5 reset-validation"),
                input("text", "recipient_name", "recipient_name_input_id$prefix_id", "fas fa-calendar-day", "rtl", "500", "form-control inputText$type", "اسم المستلم", true, "اسم المستلم", "text-danger recipient_name-validation fw-bold ms-5 reset-validation"),

            ],
            [
                select('select', 'client_buyer_id', "client_buyer_id_select_id$prefix_id", "fas fa-users", "", "select inputSelect$type", "العميل", true, clients(true), "", false, "العميل", "text-danger client_buyer_id-validation fw-bold ms-5 reset-validation"),
                input("text", "client_buyer_name", "client_buyer_name_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "اسم العميل", true, "اسم العميل", "text-danger client_buyer_name-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_phone", "client_buyer_phone_input_id$prefix_id", "fas fa-user", "ltr", "10", "form-control inputText$type", "رقم العميل", true, "رقم العميل", "text-danger client_buyer_phone-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_id_number_type", "client_buyer_id_number_type_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "نوع الهوية", true, "نوع الهوية", "text-danger client_buyer_id_number_type-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_id_number", "client_buyer_id_number_input_id$prefix_id", "fas fa-user", "ltr", "10", "form-control inputText$type", "رقم الهوية", true, "رقم الهوية", "text-danger client_buyer_id_number-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_email", "client_buyer_email_input_id$prefix_id", "fas fa-user", "ltr", "255", "form-control inputText$type", "الايميل", true, "الايميل", "text-danger client_buyer_email-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_description", "client_buyer_description_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "وصف العميل", true, "وصف العميل", "text-danger client_buyer_description-validation fw-bold ms-5 reset-validation", false),

                select("select", "client_buyer_nationality_id", "client_buyer_nationality_id_select_id$prefix_id", "fas fa-city", "", "select inputSelect$type", "", true, $nationalities, "", false, "الجنسية", "text-danger client_buyer_nationality_id-validation fw-bold ms-5 reset-validation"),

                select("select", "client_buyer_city_id", "client_buyer_city_id_select_id$prefix_id", "fas fa-city", "", "select inputSelect$type", "", true, cities(true), "", false, "المدينة", "text-danger client_buyer_city_id-validation fw-bold ms-5 reset-validation"),
                input("text", "client_buyer_neighborhood_name", "client_buyer_neighborhood_name_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "الحي", true, "الحي", "text-danger client_buyer_neighborhood_name-validation fw-bold ms-5 reset-validation", false),
                select("select", "client_buyer_employment_type",  "client_buyer_employment_type_select_id$prefix_id", "fas fa-briefcase", "", "select inputSelect$type", "", false, ["عام" => "public", "خاص" => "private",], "", false, "نوع العمل", "text-danger client_buyer_employment_type-validation fw-bold ms-5 reset-validation"),
                select("select", "client_buyer_housing_support", "client_buyer_housing_support_select_id$prefix_id", "fas fa-house", "", "select inputSelect$type", "", false, ["نعم" => 1, "لا" => 2,], "", false, "هل يحصل على دعم سكني؟", "text-danger client_buyer_housing_support-validation fw-bold ms-5 reset-validation"),
                input("text", "client_buyer_building_number", "client_buyer_building_number_input_id$prefix_id", "fas fa-list-ol", "rtl", "255", "form-control inputText$type", "رقم المبنى", true, "رقم المبنى", "text-danger client_buyer_building_number-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_street_name", "client_buyer_street_name_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "اسم الشارع", true, "اسم الشارع", "text-danger client_buyer_street_name-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_zip_code", "client_buyer_zip_code_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "الرمز البريدي", true, "الرمز البريدي", "text-danger client_buyer_zip_code-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_extra_figure", "client_buyer_extra_figure_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "الرقم الإضافي", true, "الرقم الإضافي", "text-danger client_buyer_extra_figure-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_buyer_unit_number", "client_buyer_unit_number_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "رقم الوحدة", true, "رقم الوحدة", "text-danger client_buyer_unit_number-validation fw-bold ms-5 reset-validation", false),
            ],
            [
                select('select', 'client_seller_id', "client_seller_id_select_id$prefix_id", "fas fa-users", "", "select inputSelect$type", "العميل", true, clients(true), "", false, "العميل", "text-danger client_seller_id-validation fw-bold ms-5 reset-validation"),
                input("text", "client_seller_name", "client_seller_name_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "اسم العميل", true, "اسم العميل", "text-danger client_seller_name-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_phone", "client_seller_phone_input_id$prefix_id", "fas fa-user", "ltr", "10", "form-control inputText$type", "رقم العميل", true, "رقم العميل", "text-danger client_seller_phone-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_id_number_type", "client_seller_id_number_type_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "نوع الهوية", true, "نوع الهوية", "text-danger client_seller_id_number_type-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_id_number", "client_seller_id_number_input_id$prefix_id", "fas fa-user", "ltr", "10", "form-control inputText$type", "رقم الهوية", true, "رقم الهوية", "text-danger client_seller_id_number-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_email", "client_seller_email_input_id$prefix_id", "fas fa-user", "ltr", "255", "form-control inputText$type", "الأيميل", true, "الأيميل", "text-danger client_seller_email-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_description", "client_seller_description_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "وصف العميل", true, "وصف العميل", "text-danger client_seller_description-validation fw-bold ms-5 reset-validation", false),

                select("select", "client_seller_nationality_id", "client_seller_nationality_id_select_id$prefix_id", "fas fa-city", "", "select inputSelect$type", "", true, $nationalities, "", false, "الجنسية", "text-danger client_seller_nationality_id-validation fw-bold ms-5 reset-validation"),

                select("select", "client_seller_city_id", "client_seller_city_id_select_id$prefix_id", "fas fa-city", "", "select inputSelect$type", "", true, cities(true), "", false, "المدينة", "text-danger client_seller_city_id-validation fw-bold ms-5 reset-validation"),
                input("text", "client_seller_neighborhood_name", "client_seller_neighborhood_name_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "الحي", true, "الحي", "text-danger client_seller_neighborhood_name-validation fw-bold ms-5 reset-validation", false),
                // select("select", "client_seller_employment_type",  "client_seller_employment_type_select_id$prefix_id", "fas fa-briefcase", "", "select inputSelect$type", "", false, ["عام" => "public", "خاص" => "private",], "", false, "نوع العمل", "text-danger client_seller_employment_type-validation fw-bold ms-5 reset-validation"),
                // select("select", "client_seller_housing_support", "client_seller_housing_support_select_id$prefix_id", "fas fa-house", "", "select inputSelect$type", "", false, ["نعم" => 1, "لا" => 2,], "", false, "هل يحصل على دعم سكني؟", "text-danger client_seller_housing_support-validation fw-bold ms-5 reset-validation"),
                input("text", "client_seller_building_number", "client_seller_building_number_input_id$prefix_id", "fas fa-list-ol", "rtl", "255", "form-control inputText$type", "رقم المبنى", true, "رقم المبنى", "text-danger client_seller_building_number-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_street_name", "client_seller_street_name_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "اسم الشارع", true, "اسم الشارع", "text-danger client_seller_street_name-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_zip_code", "client_seller_zip_code_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "الرمز البريدي", true, "الرمز البريدي", "text-danger client_seller_zip_code-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_extra_figure", "client_seller_extra_figure_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "الرقم الإضافي", true, "الرقم الإضافي", "text-danger client_seller_extra_figure-validation fw-bold ms-5 reset-validation", false),
                input("text", "client_seller_unit_number", "client_seller_unit_number_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "رقم الوحدة", true, "رقم الوحدة", "text-danger client_seller_unit_number-validation fw-bold ms-5 reset-validation", false),
            ]
        ];

        $contents = config("views.modals.contents.sales-service");

        $x = 0;

        foreach ($contents as $content) {
            $content["inputs"] = $inputs[$x];
            $contents[$x] = $content;
            $x++;
        }

        return $contents;
    }

    public function selects()
    {
        $searches = config('views.tables.searches.sales-service');

        $searches["city_id"] = cities(true);

        $searches["property_type"] = [
            __('land') => 'land',
            __('duplex') => 'duplex',
            __('condominium') => 'condominium',
            __('flat') => 'flat',
            __('chalet') => 'chalet',
            __('warehouse_land') => 'warehouse_land',
            __('agircultural_land') => 'agircultural_land',
            __('industrial_land') => 'industrial_land',
            __('residential_land') => 'residential_land',
        ];

        return $searches;
    }

    public function columns()
    {
        return config('views.tables.columns.sales-service');
    }

    public function rows()
    {
        return config('views.tables.rows.sales-service');
    }

    public function create()
    {
        return config('views.tables.buttons.create.sales-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.sales-service');
    }

    public function rules($id = "", $ar = "", $client_buyer_id = "", $client_seller_id = "")
    {
        return Sale::getRules($id, $client_buyer_id, $client_seller_id);
    }

    public function messages()
    {
        return Sale::getMessages();
    }

    public function delete($id)
    {
        return Sale::deleteModel($id);
    }

    public function status($id)
    {
        return Sale::status($id);
    }

    public function store($data)
    {
        return Sale::store($data);
    }

    public function update($data, $id)
    {
        return Sale::updateModel($data, $id);
    }

    public function show($id)
    {
        return redirect()->route('panel.sales.profile', $id);
    }

    public function fillable()
    {
        return [
            "sale_code",
            "offer_id",
            "user_id",
            "client_id",
            "real_estate_id",
            "broker_id",

            "offer_code",
            "neighborhood",
            "land_number",
            "space",
            "real_estate_price",

            "is_first_home",
            "deserved_amount",
            "commission_vat",

            "commission_type",
            "commission_percentage",
            "commission_price",
            "total_amount",

            "payment_method",
            "check_number",
            "recipient_name",
            "bank",
            "amount_paid",

            "status",
            "note",
            "creator",
            "updater",

            //Client Seller
            "client_seller_user_id",
            "client_seller_creator",
            "client_seller_updater",
            "client_seller_updated_at",
            "client_seller_employer",
            "client_seller_is_buy",

            "client_seller_id",
            "client_seller_name",
            "client_seller_phone",
            "client_seller_id_number_type",
            "client_seller_id_number",
            "client_seller_email",
            "client_seller_description",
            "client_seller_nationality_id",
            "client_seller_city_id",
            "client_seller_employment_type",
            "client_seller_housing_support",
            "client_seller_building_number",
            "client_seller_street_name",
            "client_seller_neighborhood_name",
            "client_seller_zip_code",
            "client_seller_extra_figure",
            "client_seller_unit_number",

            //Client Buyer
            "client_buyer_user_id",
            "client_buyer_creator",
            "client_buyer_updater",
            "client_buyer_updated_at",
            "client_buyer_employer",
            "client_buyer_is_buy",

            "client_buyer_id",
            "client_buyer_name",
            "client_buyer_phone",
            "client_buyer_id_number_type",
            "client_buyer_id_number",
            "client_buyer_email",
            "client_buyer_description",
            "client_buyer_nationality_id",
            "client_buyer_city_id",
            "client_buyer_employment_type",
            "client_buyer_housing_support",
            "client_buyer_building_number",
            "client_buyer_street_name",
            "client_buyer_neighborhood_name",
            "client_buyer_zip_code",
            "client_buyer_extra_figure",
            "client_buyer_unit_number",


        ];
    }
}
