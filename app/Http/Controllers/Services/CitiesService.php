<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Database\Eloquent\Builder;

class CitiesService extends Controller
{
    public $name = "المدن";
    public $title_creator = "إنشاء مدينة جديدة";
    public $title_updater = "تعديل بيانات المدينة";
    public $modal_size = "";
    public $creator_id = "creator-city-button";
    public $updater_id = "updater-city-button";
    public $model = City::class;
    public $class_title = "City";
    public $excel_file = "CitiesExport";


    public function __construct()
    {
        $this->model = new City();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return City::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function model($id)
    {
        return City::find($id);
    }

    public function columns()
    {
        return config('views.tables.columns.cities-service');
    }

    public function rows()
    {
        return config('views.tables.rows.cities-service');
    }

    public function selects()
    {
        return config('views.tables.searches.cities-service');
    }

    public function create()
    {
        return config('views.tables.buttons.create.cities-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.cities-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id", "fas fa-city", "rtl", "255", "form-control inputText$type", "اسم المدينة", true, "", "text-danger name-validation fw-bold ms-5 reset-validation"),
                input("text", "code", "code_input_id$prefix_id", "fas fa-centercode", "ltr", "10", "form-control inputText$type", "كود المدينة", true, "", "text-danger code-validation fw-bold ms-5 reset-validation"),
                select("select", "status", "status_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "حالة المدينة", false, ["نشط" => 1, "غير نشط" => 2,], "", true, "", "text-danger status-validation fw-bold ms-5 reset-validation",),
            ]
        ];

        $contents = config('views.modals.contents.cities-service',);

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
        return City::getRules($id);
    }

    public function messages()
    {
        return City::getMessages();
    }

    public function delete($id)
    {
        return City::deleteModel($id);
    }

    public function status($id)
    {
        return City::status($id);
    }

    public function store($data)
    {
        return City::store($data);
    }

    public function update($data, $id)
    {
        return City::updateModel($data, $id);
    }

    public function fillable()
    {
        return $this->model->getFillable();
    }
}
