<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OffersService extends Controller
{
    protected $name =  "العروض";
    protected $title_creator = "إنشاء عرض جديد";
    protected $title_updater = "تعديل بيانات العرض";
    protected $modal_size = "";
    protected $creator_id = "creator-offer-button";
    protected $updater_id = "updater-offer-button";
    protected $model = Offer::class;
    protected $class_title = "Offer";
    protected $excel_file = "OffersExport";

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Offer::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.tables.columns.offers-service');
    }

    public function rows()
    {
        return config('views.tables.rows.offers-service');
    }

    public function selects()
    {
        $searches = config('views.tables.searches.offers-service');
        $searches["city_id"] = cities(true);
        $searches["neighborhood_id"] = neighborhoods(true);
        return $searches;
    }

    public function create()
    {
        return config('views.tables.buttons.create.offers-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.offers-service');
    }

    public function contents()
    {
        $inputs = [];

        $contents = config("views.modals.contents.offers-service");

        $x = 0;

        foreach ($contents as $content) {
            $content["inputs"] = $inputs[$x];
            $contents[$x] = $content;
            $x++;
        }

        return $contents;
    }

    public function delete($id)
    {
        $offer = Offer::find($id);
        if ($offer) {
            $offer->delete();
            return "تم حذف العرض بنجاح";
        }

        return false;
    }

    public function status($id)
    {
        $offer = Offer::find($id);
        if ($offer) {
            $offer->update([
                'status' => $offer->status == 1 ? 2 : 1
            ]);
            return "تم تغير حالة العرض بنجاح";
        }

        return true;
    }
}
