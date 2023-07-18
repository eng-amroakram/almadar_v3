<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientsService extends Controller
{
    public $name = "العملاء";
    public $title_creator = "إنشاء عميل جديد";
    public $title_updater = "تعديل بيانات العميل";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-client-button";
    public $updater_id = "updater-client-button";
    public $model = Client::class;
    public $class_title = "Client";
    public $excel_file = "ClientsExport";

    public function __construct()
    {
        $this->model = new Client();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Client::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function model($id)
    {
        return Client::find($id);
    }

    public function columns()
    {
        return config('views.tables.columns.clients-service');
    }

    public function rows()
    {
        return config('views.tables.rows.clients-service');
    }

    public function selects()
    {
        $searches = config('views.tables.searches.clients-service');
        $searches["city_id"] = cities(true);
        return $searches;
    }

    public function create()
    {
        return config('views.tables.buttons.create.clients-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.clients-service');
    }

    public function contents($type)
    {

        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id$prefix_id", "fas fa-address-card", "rtl", "50", "form-control inputText$type", "Example: John Doe", true, "اسم العميل", "text-danger name-validation fw-bold ms-5 reset-validation"),
                input("text", "phone", "phone_input_id$prefix_id", "fas fa-mobile-screen-button", "ltr", "10", "form-control inputText$type", "Example: 0599999999", true, "رقم العميل", "text-danger phone-validation fw-bold ms-5 reset-validation"),
                input("email", "email", "email_input_id$prefix_id", "fas fa-at", "ltr", "50", "form-control inputText$type", "Example: example@gmail.com", true, "البريد الإلكتروني", "text-danger email-validation fw-bold ms-5 reset-validation"),
                input("text", "id_number", "id_number_input_id$prefix_id", "fas fa-id-card", "ltr", "10", "form-control inputText$type", "Example: 1234567890", true, "رقم الهوية", "text-danger id_number-validation fw-bold ms-5 reset-validation"),
                select("select", "status", "status_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", "حالة العميل", false, ["نشط" => 1, "غير نشط" => 2,], "", true, "حالة العميل", "text-danger status-validation fw-bold ms-5 reset-validation"),
                select("select", "is_buy", "is_buy_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", "حالة الشراء", false, ["نعم" => 1, "لا" => 2,], "", true, "هل اشترى العميل؟", "text-danger is_buy-validation fw-bold ms-5 reset-validation"),
            ],
            [
                input("text", "employer", "employer_input_id$prefix_id", "fas fa-id-card-clip", "rtl", "50", "form-control inputText$type", "Example: John Doe", true, "جهة العمل", "text-danger employer-validation fw-bold ms-5 reset-validation"),
                select("select", "employment_type",  "employment_type_select_id$prefix_id", "fas fa-briefcase", "", "select inputSelect$type", "", false, ["عام" => "public", "خاص" => "private",], "", true, "نوع العمل", "text-danger employment_type-validation fw-bold ms-5 reset-validation"),
                select("select", "housing_support", "housing_support_select_id$prefix_id", "fas fa-house", "", "select inputSelect$type", "", false, ["نعم" => 1, "لا" => 2,], "", true, "هل يحصل على دعم سكني؟", "text-danger housing_support-validation fw-bold ms-5 reset-validation"),
            ],
            [
                select("select", "city_id", "city_id_select_id$prefix_id", "fas fa-city", "", "select inputSelect$type", "", true, cities(true), "", false, "المدينة", "text-danger city_id-validation fw-bold ms-5 reset-validation"),
                select("select", "neighborhood_id", "neighborhood_id_select_id$prefix_id", "fas fa-warehouse", "", "select inputSelect$type", "", true, [], "", false, "الحي", "text-danger neighborhood_id-validation fw-bold ms-5 reset-validation"),
                input("text", "building_number", "building_number_input_id$prefix_id", "fas fa-building", "rtl", "10", "form-control inputText$type", "Example: 123", true, "رقم المبنى", "text-danger building_number-validation fw-bold ms-5 reset-validation"),
                input("text", "street_name", "street_name_input_id$prefix_id", "fas fa-road", "rtl", "50", "form-control inputText$type", "Example: John Doe", true, "اسم الشارع", "text-danger street_name-validation fw-bold ms-5 reset-validation"),
                input("number", "zip_code", "zip_code_input_id$prefix_id", "fas fa-barcode", "rtl", "10", "form-control inputText$type", "Example: 123", true, "الرمز البريدي", "text-danger zip_code-validation fw-bold ms-5 reset-validation"),
                input("number", "extra_figure", "extra_figure_input_id$prefix_id", "fas fa-list-ol", "rtl", "10", "form-control inputText$type", "Example: 123", true, "الرقم الاضافي", "text-danger extra_figure-validation fw-bold ms-5 reset-validation"),
                input("number", "unit_number", "unit_number_input_id$prefix_id", "fas fa-list-ol", "rtl", "10", "form-control inputText$type", "Example: 123", true, "رقم الوحدة", "text-danger unit_number-validation fw-bold ms-5 reset-validation"),
            ]
        ];

        $contents = config("views.modals.contents.clients-service");

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
        return Client::getRules($id);
    }

    public function messages()
    {
        return Client::getMessages();
    }

    public function delete($id)
    {
        return Client::deleteModel($id);
    }

    public function status($id)
    {
        return Client::status($id);
    }

    public function store($data)
    {
        return Client::store($data);
    }

    public function update($data, $id)
    {
        return Client::updateModel($data, $id);
    }

    public function show($id)
    {
        return redirect()->route('panel.clients.profile', $id);
    }

    public function fillable()
    {
        return $this->model->getFillable();
    }
}
