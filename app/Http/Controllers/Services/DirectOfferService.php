<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class DirectOfferService extends Controller
{
    public $name =  "العروض المباشرة";
    public $title_creator = "إنشاء عرض جديد";
    public $title_updater = "تعديل بيانات العرض";
    public $modal_size = "modal-xl";
    public $creator_id = "creator-offer-button";
    public $updater_id = "updater-offer-button";
    public $model = Offer::class;
    public $class_title = "Offer";
    public $excel_file = "OffersExport";

    public function __construct()
    {
        $this->model = new Offer();
    }

    public function model($id)
    {
        return Offer::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $user = User::find(auth()->id());

        $branches_ids = $user->branches()->pluck('id')->toArray();
        $filters["branch_id"] = $branches_ids;

        return Offer::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->where('offer_type', 'direct')
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
        $searches["branch_id"] = branches(true);
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

        $directions = [
            __('north') => 'north',
            __('south') => 'south',
            __('east') => 'east',
            __('west') => 'west',
        ];

        $land_types = [
            __("stomach") => "stomach",
            __("corner") => "corner",
            __("two-faces") => "two-faces",
            __("head-block") => "head-block"
        ];

        $licensed = [
            __("residential") => 'residential',
            __("residential_investment") => 'residential_investment',
            __("investment_business") => 'investment_business',
            __("services") => 'services'
        ];

        $street_widths = [
            "6" => "6",
            "8" => "8",
            "12" => "12",
            "15" => "15",
            "16" => "16",
            "18" => "18",
            "20" => "20",
            "25" => "25",
            "30" => "30",
            "40" => "40",
            "60" => "60",
            "100" => "100"
        ];

        $owner_types = [
            '1' => '1', '2' => '2', '3' => '3'
        ];

        $building_types = [
            __("connected") => 'connected',
            __("separate") => 'separate',
            __("semi_detached") => 'semi_detached',
        ];

        $building_status = [
            __("existing") => 'existing',
            __("under_construction") => 'under_construction',
        ];

        $construction_deliveries = [
            __("bone") => 'bone',
            __("hand_over_50%") => 'hand_over_50%',
            __("turnkey") => 'turnkey',
        ];


        $inputs = [
            [
                select("select", "city_id", "city_id_select_id$prefix_id", "fab fa-searchengin", "", "select inputSelect$type", "", true, cities(true), "", false, "اختار المدينة", "text-danger city_id-validation fw-bold ms-5 reset-validation"),
                select("select", "neighborhood_id", "neighborhood_id_select_id$prefix_id", "fas fa-warehouse", "", "select inputSelect$type", "", true, [], "", false, "الحي", "text-danger neighborhood_id-validation fw-bold ms-5 reset-validation"),
                input("text", "statement", "statement_input_id$prefix_id", "fas fa-pen-clip", "ltr", "50", "form-control inputText$type", "Example: exmap-22", true, "بيان العقار", "text-danger statement-validation fw-bold ms-5 reset-validation"),
                input("text", "land_number", "land_number_input_id$prefix_id", "fas fa-list-ol", "ltr", "25", "form-control inputText$type", "Example: exmap-22", true, "رقم الأرض", "text-danger land_number-validation fw-bold ms-5 reset-validation"),
                input("text", "block_number", "block_number_input_id$prefix_id", "fas fa-list-ol", "ltr", "25", "form-control inputText$type", "Example: exmap-22", true, "رقم البلوك", "text-danger block_number-validation fw-bold ms-5 reset-validation"),
            ],
            [
                select("select", "property_type",  "property_type_select_id$prefix_id", "far fa-building", "", "select inputSelect$type", "نوع العقار", false, $property_type, "", false, "نوع العقار", "text-danger property_type-validation fw-bold ms-5 reset-validation"),
                input("text", "space", "space_input_id$prefix_id", "fas fa-chart-area", "rtl", "255", "form-control inputText$type", "المساحة", true, "المساحة", "text-danger space-validation fw-bold ms-5 reset-validation"),
                input("text", "price_meter", "price_meter_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "السعر بالمتر", true, "السعر بالمتر", "text-danger price_meter-validation fw-bold ms-5 reset-validation"),
                input("text", "total", "total_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "السعر بالكامل", true, "السعر بالكامل", "text-danger total-validation fw-bold ms-5 reset-validation"),
                select("select", "directions",  "directions_select_id$prefix_id", "fas fa-street-view", "", "select inputSelect$type", "الاتجاه", false, $directions, "multiple", false, "الاتجاه", "text-danger directions-validation fw-bold ms-5 reset-validation"),
                select("select", "land_type",  "land_type_select_id$prefix_id", "fas fa-earth-oceania", "", "select inputSelect$type", "نوع الارض", false, $land_types, "", false, "نوع الارض", "text-danger land_type-validation fw-bold ms-5 reset-validation"),
                select("select", "licensed",  "licensed_select_id$prefix_id", "fas fa-id-badge", "", "select inputSelect$type", "الترخيص", false, $licensed, "", false, "الترخيص", "text-danger licensed-validation fw-bold ms-5 reset-validation"),
                select("select", "street_width",  "street_width_select_id$prefix_id", "fas fa-road", "", "select inputSelect$type", "عروض الشوارع", false, $street_widths, "multiple", false, "عروض الشوارع", "text-danger street_width-validation fw-bold ms-5 reset-validation"),
                input("text", "character", "character_input_id$prefix_id", "fas fa-c", "rtl", "255", "form-control inputText$type", "الحرف او المجاور", false, "الحرف او المجاور", "text-danger character-validation fw-bold ms-5 reset-validation"),
                input("number", "interface_length", "interface_length_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 30", false, "طول الواجهة", "text-danger interface_length-validation fw-bold ms-5 reset-validation"),
                select("select", "branch_id", "branch_id_select_id$prefix_id", "fas fa-code-branch", "", "select inputSelect$type", "الفرع", true, branches(true), "", false, "الفرع", "text-danger branch_id-validation fw-bold ms-5 reset-validation"),

                input("number", "bathrooms", "bathrooms_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 3", true, "عدد دورة المياه", "text-danger bathrooms-validation fw-bold ms-5 reset-validation"),
                input("number", "flat_rooms", "flat_rooms_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 3", true, "عدد غرف الشقة", "text-danger flat_rooms-validation fw-bold ms-5 reset-validation"),
                input("number", "age", "age_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 10", true, "عمر العقار", "text-danger age-validation fw-bold ms-5 reset-validation"),
                input("number", "floor", "floor_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 2", true, "رقم الطابق", "text-danger floor-validation fw-bold ms-5 reset-validation"),
                input("number", "floors", "floors_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 2", true, "عدد الطوابق", "text-danger floors-validation fw-bold ms-5 reset-validation"),
                input("number", "flats", "flats_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 2", true, "عدد الشقق", "text-danger flats-validation fw-bold ms-5 reset-validation"),
                input("number", "rooms", "rooms_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 2", true, "عدد الغرف", "text-danger rooms-validation fw-bold ms-5 reset-validation"),
                input("number", "stores", "stores_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 2", true, "عدد المحلات", "text-danger stores-validation fw-bold ms-5 reset-validation"),
                input("number", "annual_income", "annual_income_input_id$prefix_id", "far fa-building", "ltr", "255", "form-control inputText$type", "Example: 2", true, "الدخل السنوي", "text-danger annual_income-validation fw-bold ms-5 reset-validation"),

                select("select", "owner_ship_type",  "owner_ship_type_select_id$prefix_id", "far fa-building", "", "select inputSelect$type", "نوع الملكية", false, $owner_types, "", false, "نوع الملكية", "text-danger owner_ship_type-validation fw-bold ms-5 reset-validation"),
                select("select", "building_type",  "building_type_select_id$prefix_id", "far fa-building", "", "select inputSelect$type", "نوع البناء", false, $building_types, "", false, "نوع البناء", "text-danger building_type-validation fw-bold ms-5 reset-validation"),
                select("select", "building_status",  "building_status_select_id$prefix_id", "far fa-building", "", "select inputSelect$type", "حالة البناء", false, $building_status, "", false, "حالة البناء", "text-danger building_status-validation fw-bold ms-5 reset-validation"),
                select("select", "construction_delivery",  "construction_delivery_select_id$prefix_id", "far fa-building", "", "select inputSelect$type", "تسليم البناء", false, $construction_deliveries, "", false, "تسليم البناء", "text-danger construction_delivery-validation fw-bold ms-5 reset-validation"),
            ],
            [
                input("textarea", "notes", "notes_input_id$prefix_id", "fas fa-briefcase", "rtl", "255", "form-control inputText$type", "الملاحظات", true, "الملاحظات", "text-danger notes-validation fw-bold ms-5 reset-validation"),
            ]
        ];

        $contents = config("views.modals.contents.offers-service");

        $x = 0;

        foreach ($contents as $content) {
            $content["inputs"] = $inputs[$x];
            $contents[$x] = $content;
            $x++;
        }

        return $contents;
    }

    public function rules($id = "", $property_type = "land")
    {
        $property_type ?? $property_type = "land";

        $main = config("data.rules.offers.main");

        $type = config("data.rules.offers.$property_type");

        $rules = array_merge($main, $type);

        return $rules;
    }

    public function messages()
    {
        return [
            //First Tab
            "land_number.required" => "رقم الأرض مطلوب",
            "land_number.max" => "رقم الأرض يجب ألا يتجاوز 255 حرف",
            "statement.required" => "بيان العقار مطلوب",
            "statement.max" => "بيان العقار يجب ألا يتجاوز 255 حرف",
            "block_number.required" => "رقم البلوك مطلوب",
            "block_number.max" => "رقم البلوك يجب ألا يتجاوز 255 حرف",
            "city_id.required" => "المدينة مطلوبة",
            "city_id.exists" => "المدينة غير موجودة",
            "neighborhood_id.required" => "الحي مطلوب",
            "neighborhood_id.exists" => "الحي غير موجود",

            //Second Tab
            "property_type.required" => "نوع العقار مطلوب",
            "property_type.in" => "نوع العقار غير موجود",
            "space.required" => "المساحة مطلوبة",
            "space.numeric" => "المساحة يجب أن تكون أرقام فقط",
            "price_meter.required" => "السعر بالمتر مطلوب",
            "price_meter.numeric" => "السعر بالمتر يجب أن تكون أرقام فقط",
            "total.required" => "السعر بالكامل مطلوب",
            "total.numeric" => "السعر بالكامل يجب أن تكون أرقام فقط",
            "directions.required" => "الاتجاه مطلوب",
            "directions.array" => "الاتجاه غير موجود",
            "land_type.required" => "نوع الأرض مطلوب",
            "land_type.in" => "نوع الأرض غير موجود",
            "licensed.required" => "الترخيص مطلوب",
            "licensed.in" => "الترخيص غير موجود",
            "street_width.required" => "عرض الشارع مطلوب",
            "street_width.array" => "عرض الشارع غير موجود",
            "character.required" => "الطابع مطلوب",
            "character.max" => "الطابع يجب ألا يتجاوز 255 حرف",
            "interface_length.required" => "طول الواجهة مطلوب",
            "interface_length.numeric" => "طول الواجهة يجب أن تكون أرقام فقط",
            "branch_id.required" => "الفرع مطلوب",
            "branch_id.exists" => "الفرع غير موجود",

            "bathrooms.required" => "عدد الحمامات مطلوب",
            "bathrooms.numeric" => "عدد الحمامات يجب أن تكون أرقام فقط",
            "flat_rooms.required" => "عدد غرف الشقة مطلوب",
            "flat_rooms.numeric" => "عدد غرف الشقة يجب أن تكون أرقام فقط",
            "age.required" => "العمر مطلوب",
            "age.numeric" => "العمر يجب أن تكون أرقام فقط",
            "floor.required" => "الطابق مطلوب",
            "floor.numeric" => "الطابق يجب أن تكون أرقام فقط",
            "floors.required" => "عدد الطوابق مطلوب",
            "floors.numeric" => "عدد الطوابق يجب أن تكون أرقام فقط",
            "flats.required" => "عدد الشقق مطلوب",
            "flats.numeric" => "عدد الشقق يجب أن تكون أرقام فقط",
            "rooms.required" => "عدد الغرف مطلوب",
            "rooms.numeric" => "عدد الغرف يجب أن تكون أرقام فقط",
            "stores.required" => "عدد المحلات مطلوب",
            "stores.numeric" => "عدد المحلات يجب أن تكون أرقام فقط",
            "annual_income.required" => "الدخل السنوي مطلوب",
            "annual_income.numeric" => "الدخل السنوي يجب أن تكون أرقام فقط",
            "owner_ship_type.required" => "نوع الملكية مطلوب",
            "building_type.required" => "نوع البناء مطلوب",
            "building_status.required" => "حالة البناء مطلوبة",
            "construction_delivery.required" => "تسليم البناء مطلوب",
        ];
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
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });
        $data['offer_type'] = "direct";
        return Offer::store($data);
    }

    public function update($data, $id)
    {
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });
        return Offer::updateModel($data, $id);
    }

    public function show($id)
    {
        return redirect()->route('panel.offers.profile', $id);
    }

    public function fillable()
    {
        return [

            //Offer
            "order_id",
            "real_estate_id",
            "user_id",
            "offer_code",
            "offer_type",
            "status",
            "creator",
            "updater",

            //Real Estate
            // "user_id",
            "floor",
            "floors",
            "flats",
            "flat_rooms",
            "rooms",
            "stores",
            "bathrooms",
            "interface_length",
            "age",
            "space",
            "annual_income",
            "space",
            "total",
            "price",
            "price_meter",
            "notes",
            "land_number",
            "statement",
            "character",
            "block_number",
            "directions",
            "real_estate_type",

            //Real Estate Location
            // "user_id",
            // "real_estate_id",
            "city_id",
            "neighborhood_id",
            "branch_id",
            "land_type",
            // "interface_length",
            "owner_ship_type",
            "building_type",
            "building_status",
            "construction_delivery",
            "property_type",
            "directions",
            "licensed",
            "street_width",
            "property_status",
        ];
    }
}
