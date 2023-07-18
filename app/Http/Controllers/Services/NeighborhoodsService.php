<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class NeighborhoodsService extends Controller
{

    public $name =  "الأحياء";
    public $title_creator = "إنشاء حي جديد";
    public $title_updater = "تعديل بيانات الحي";
    public $modal_size = "";
    public $creator_id = "creator-neighborhood-button";
    public $updater_id = "updater-neighborhood-button";
    public $model = Neighborhood::class;
    public $class_title = "Neighborhood";
    public $excel_file = "NeighborhoodsExport";

    public function __construct()
    {
        $this->model = new Neighborhood();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Neighborhood::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function model($id)
    {
        return Neighborhood::find($id);
    }

    public function columns()
    {
        return config('views.tables.columns.neighborhoods-service');
    }

    public function rows()
    {
        return config('views.tables.rows.neighborhoods-service');
    }

    public function selects()
    {
        $searches = config('views.tables.searches.neighborhoods-service');
        $searches["city_id"] = cities(true);
        return $searches;
    }

    public function create()
    {
        return config('views.tables.buttons.create.neighborhoods-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.neighborhoods-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id", "fas fa-city", "rtl", "50", "form-control inputText$type", "اسم الحي", true, "اسم الحي", "text-danger name-validation fw-bold ms-5 reset-validation"),
                select("select", "city_id", "city_id_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "", true, cities(true), "", false, "اختار المدينة", "text-danger city_id-validation fw-bold ms-5 reset-validation"),
                select("select", "status", "status_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "", false, ["نشط" => 1, "غير نشط" => 2,], "", true, "حالة الحي", "text-danger status-validation fw-bold ms-5 reset-validation"),
            ]
        ];

        $contents = config("views.modals.contents.neighborhoods-service");

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
        return Neighborhood::getRules($id);
    }

    public function messages()
    {
        return Neighborhood::getMessages();
    }

    public function delete($id)
    {
        return Neighborhood::deleteModel($id);
    }

    public function status($id)
    {
        return Neighborhood::status($id);
    }

    public function store($data)
    {
        return Neighborhood::store($data);
    }

    public function update($data, $id)
    {
        return Neighborhood::updateModel($data, $id);
    }

    public function fillable()
    {
        return $this->model->getFillable();
    }
}
