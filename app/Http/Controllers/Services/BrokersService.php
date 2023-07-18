<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Broker;

class BrokersService extends Controller
{
    public $name = "الوسطاء";
    public $title_creator = "إنشاء وسيط جديد";
    public $title_updater = "تعديل بيانات الوسيط";
    public $modal_size = "";
    public $creator_id = "creator-broker-button";
    public $updater_id = "updater-broker-button";
    public $model = Broker::class;
    public $class_title = "Broker";
    public $excel_file = "BrokersExport";

    public function __construct()
    {
        $this->model = new Broker();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Broker::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function model($id)
    {
        return Broker::find($id);
    }

    public function columns()
    {
        return config('views.tables.columns.brokers-service');
    }

    public function rows()
    {
        return config('views.tables.rows.brokers-service');
    }

    public function selects()
    {
        return config('views.tables.searches.brokers-service');
    }

    public function create()
    {
        return config('views.tables.buttons.create.brokers-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.brokers-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id", "fas fa-city", "rtl", "255", "form-control inputText$type", "اسم الوسيط", true, "", "text-danger name-validation fw-bold ms-5 reset-validation"),
                input("text", "phone", "phone_input_id$prefix_id", "fas fa-centercode", "ltr", "10", "form-control inputText$type", "رقم الجوال", true, "", "text-danger phone-validation fw-bold ms-5 reset-validation"),
                select("select", "type", "type_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "نوع الوسيط", false, ["مكتب" => "office", "فرد" => "person",], "", true, "", "text-danger type-validation fw-bold ms-5 reset-validation",),
                select("select", "status", "status_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "حالة الوسيط", false, ["نشط" => 1, "غير نشط" => 2,], "", true, "", "text-danger status-validation fw-bold ms-5 reset-validation",),
            ]
        ];

        $contents = config("views.modals.contents.brokers-service");

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
        return Broker::getRules($id);
    }

    public function messages()
    {
        return Broker::getMessages();
    }

    public function delete($id)
    {
        return Broker::deleteModel($id);
    }

    public function status($id)
    {
        return Broker::status($id);
    }

    public function store($data)
    {
        return Broker::store($data);
    }

    public function update($data, $id)
    {
        return Broker::updateModel($data, $id);
    }

    public function fillable()
    {
        return $this->model->getFillable();
    }
}
