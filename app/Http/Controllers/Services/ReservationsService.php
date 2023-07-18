<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationsService extends Controller
{
    public $name = "الحجوزات";
    public $title_creator = "إنشاء حجز جديد";
    public $title_updater = "تعديل بيانات الحجز";
    public $modal_size = "";
    public $creator_id = "creator-reservation-button";
    public $updater_id = "updater-reservation-button";
    public $model = Reservation::class;
    public $class_title = "Reservation";
    public $excel_file = "ReservationsExport";

    public function __construct()
    {
        $this->model = new Reservation();
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Reservation::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function model($id)
    {
        return Reservation::find($id);
    }

    public function columns()
    {
        return config('views.tables.columns.reservations-service');
    }

    public function rows()
    {
        return config('views.tables.rows.reservations-service');
    }

    public function selects()
    {
        return config('views.tables.searches.reservations-service');
    }

    public function create()
    {
        return config('views.tables.buttons.create.reservations-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.reservations-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [[]];

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
        return Reservation::getRules($id);
    }

    public function messages()
    {
        return Reservation::getMessages();
    }

    public function delete($id)
    {
        return Reservation::deleteModel($id);
    }

    public function status($id)
    {
        return Reservation::status($id);
    }

    public function store($data)
    {
        return Reservation::store($data);
    }

    public function update($data, $id)
    {
        return Reservation::updateModel($data, $id);
    }

    public function fillable()
    {
        return $this->model->getFillable();
    }
}
