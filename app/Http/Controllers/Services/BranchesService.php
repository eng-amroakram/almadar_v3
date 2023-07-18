<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchesService extends Controller
{
    public $name = "الفروع";
    public $title_creator = "إنشاء فرع جديد";
    public $title_updater = "تعديل بيانات الفرع";
    public $modal_size = "";
    public $creator_id = "creator-branch-button";
    public $updater_id = "updater-branch-button";
    public $model = Branch::class;
    public $class_title = "Branch";
    public $excel_file = "BranchesExport";

    public function __construct()
    {
        $this->model = new Branch();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Branch::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function model($id)
    {
        return Branch::find($id);
    }

    public function columns()
    {
        return config('views.tables.columns.branches-service');
    }

    public function rows()
    {
        return config('views.tables.rows.branches-service');
    }

    public function selects()
    {
        $searches = config('views.tables.searches.branches-service');
        $searches['city_id'] =  cities(true);
        return $searches;
    }

    public function create()
    {
        return config('views.tables.buttons.create.branches-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.branches-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id", "fas fa-city", "rtl", "255", "form-control inputText$type", "اسم الفرع", true, "اسم الفرع", "text-danger name-validation fw-bold ms-5 reset-validation"),
                input("text", "code", "code_input_id$prefix_id", "fas fa-centercode", "ltr", "10", "form-control inputText$type", "كود الفرع", true, "كود الفرع", "text-danger code-validation fw-bold ms-5 reset-validation"),
                select("select", "city_id", "city_id_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "اختار المدينة", true, cities(true), "", false, "اختار المدينة", "text-danger city_id-validation fw-bold ms-5 reset-validation"),
                // select("select", "type", "type_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "نوع الوسيط", false, ["مكتب" => "office", "فرد" => "person",], "", true, "", "text-danger type-validation fw-bold ms-5 reset-validation",),
                select("select", "status", "status_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "حالة الفرع", false, ["نشط" => 1, "غير نشط" => 2,], "", true, "حالة الفرع", "text-danger status-validation fw-bold ms-5 reset-validation",),
            ]
        ];

        $contents = config("views.modals.contents.branches-service");

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
        return Branch::getRules($id);
    }

    public function messages()
    {
        return Branch::getMessages();
    }

    public function delete($id)
    {
        return Branch::deleteModel($id);
    }

    public function status($id)
    {
        return Branch::status($id);
    }

    public function store($data)
    {
        return Branch::store($data);
    }

    public function update($data, $id)
    {
        return Branch::updateModel($data, $id);
    }

    public function fillable()
    {
        return $this->model->getFillable();
    }
}
