<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\OrderNote;

class OrderProfileService extends Controller
{
    public $name =  "إضافة ملاحظة للطلب";
    public $title_creator = "إضافة ملاحظة للطلب";
    public $title_updater = "";
    public $modal_size = "";
    public $creator_id = "creator-order-note-button";
    public $updater_id = "";
    public $model = OrderNote::class;
    public $class_title = "OrderNote";
    public $excel_file = "OrderNotesExport";

    public function __construct()
    {
        $this->model = new OrderNote();
    }

    public function create()
    {
        return config('views.tables.buttons.create.orders-notes-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.orders-notes-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $order_notes_statues = [
            __("customer_contacted") => "customer_contacted",
            __("customer_not_contacted") => "customer_not_contacted",
            __("client_not_wish") => "client_not_wish",
            __("request_suspension") => "request_suspension",
        ];

        $inputs = [
            [
                select('select', 'status', "status_select_id$prefix_id", "fas fa-users", "", "select inputSelect$type", "الحالة", true, $order_notes_statues, "", false, "الحالة", "text-danger status-validation fw-bold ms-5 reset-validation"),
                input("textarea", "note", "note_input_id$prefix_id", "fas fa-phone", "rtl", "500", "form-control inputText$type", "الملاحظة", true, "الملاحظة", "text-danger note-validation fw-bold ms-5 reset-validation"),
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
        return OrderNote::getRules($id);
    }

    public function messages()
    {
        return OrderNote::getMessages();
    }

    public function delete($id)
    {
        return OrderNote::deleteModel($id);
    }

    public function status($id)
    {
        return OrderNote::status($id);
    }

    public function store($data)
    {
        return OrderNote::store($data);
    }

    public function update($data, $id)
    {
        dd($data);
        return OrderNote::updateModel($data, $id);
    }

    public function fillable()
    {
        $fillable = $this->model->getFillable();
        return $fillable;
    }
}
