<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class OrdersService extends Controller
{
    public $name =  "الطلبات";
    public $title_creator = "إنشاء طلب جديد";
    public $title_updater = "تعديل بيانات الطلب";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-order-button";
    public $updater_id = "updater-order-button";
    public $model = Order::class;
    public $class_title = "Order";
    public $excel_file = "OrdersExport";

    public function __construct()
    {
        $this->model = new Order();
    }

    public function model($id)
    {
        return Order::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $user = auth()->user();

        if ($user->user_type == "superadmin" || $user->user_type == "admin") {
            return Order::data()
                ->filters($filters)
                ->reorder($sort_field, $sort_direction)
                ->paginate($paginate);
        }

        $type = ($user->user_type == "marketer" && Route::currentRouteName() == 'panel.orders.assigned') ? "attribution" : "creator";

        return Order::data()
            ->filters($filters)
            ->where($type, auth()->id())
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.tables.columns.orders-service');
    }

    public function rows()
    {
        return config('views.tables.rows.orders-service');
    }

    public function selects()
    {
        // $searches = config('views.tables.searches.orders-service');

        $searches["city_id"] = cities(true);
        $searches["neighborhood_id"] = neighborhoods(true);

        $searches["status"] = [
            __('new') => "new",
            __('linked_to_offer') => "linked_to_offer",
            __('closed') => "closed",
            __('follow_up_request') => "follow_up_request",
            __('request_not_processed') => "request_not_processed",
            __('hanging') => "hanging",
        ];

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

    public function create()
    {
        return config('views.tables.buttons.create.orders-service');
    }

    public function tabs()
    {
        return config('views.modals.tabs.orders-service');
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

        $time_purchase = [
            __('ready_to_buy') => "ready_to_buy",
            __('6_months_later') => "6_months_later",
            __('after_one_year') => "after_one_year",
            __('after_two_years') => "after_two_years"
        ];

        $user = auth()->user();
        $custom = [];

        if (in_array($user->user_type, ['admin', 'superadmin'])) {
            $custom = [
                input("textarea", "notes", "notes_input_id$prefix_id", "fas fa-briefcase", "rtl", "255", "form-control inputText$type", "الملاحظات", true, "الملاحظات", "text-danger notes-validation fw-bold ms-5 reset-validation"),
                input("checkbox", "attribution_check", "attribution_check_input_id$prefix_id", "fas fa-briefcase", "rtl", "255", "form-check-input checkboxInput$type", "هل تريد توجيه الطلب الى مسوق ؟؟", true, "هل تريد توجيه الطلب الى مسوق ؟؟", "text-danger attribution_check-validation fw-bold ms-5 reset-validation"),
                select("select", "attribution", "attribution_select_id$prefix_id", "fas fa-user-tag", "", "select inputSelect$type attributionInput", "المسوق", true, users_marketer(true), "", false, "المسوق", "text-danger attribution-validation fw-bold ms-5 reset-validation"),
            ];
        } else {
            $custom = [
                input("textarea", "notes", "notes_input_id$prefix_id", "fas fa-briefcase", "rtl", "255", "form-control inputText$type", "الملاحظات", true, "الملاحظات", "text-danger notes-validation fw-bold ms-5 reset-validation"),
            ];
        }

        $inputs = [
            [
                select('select', 'client_id', "client_id_select_id$prefix_id", "fas fa-users", "", "select inputSelect$type", "العميل", true, clients(true), "", false, "العميل", "text-danger client_id-validation fw-bold ms-5 reset-validation"),
                input("text", "client_name", "client_name_input_id$prefix_id", "fas fa-user", "rtl", "255", "form-control inputText$type", "اسم العميل", true, "اسم العميل", "text-danger client_name-validation fw-bold ms-5 reset-validation"),
                input("text", "client_phone", "client_phone_input_id$prefix_id", "fas fa-phone", "ltr", "10", "form-control inputText$type", "رقم الهاتف", true, "رقم الهاتف", "text-danger client_phone-validation fw-bold ms-5 reset-validation"),
                input("text", "client_employer", "client_employer_input_id$prefix_id", "fas fa-briefcase", "rtl", "255", "form-control inputText$type", "جهة العمل", true, "جهة العمل", "text-danger client_employer-validation fw-bold ms-5 reset-validation"),
                select("select", "client_is_buy", "client_is_buy_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", "حالة الشراء", false, ["نعم" => 1, "لا" => 2,], "", true, "هل اشترى العميل؟", "text-danger client_is_buy-validation fw-bold ms-5 reset-validation"),
                select("select", "client_employment_type",  "client_employment_type_select_id$prefix_id", "fas fa-briefcase", "", "select inputSelect$type", "", false, ["عام" => "public", "خاص" => "private",], "", true, "نوع العمل", "text-danger client_employment_type-validation fw-bold ms-5 reset-validation"),
            ],
            [
                select("select", "property_type",  "property_type_select_id$prefix_id", "far fa-building", "", "select inputSelect$type", "نوع العقار", false, $property_type, "", true, "نوع العقار", "text-danger property_type-validation fw-bold ms-5 reset-validation"),
                select("select", "city_id", "city_id_select_id$prefix_id", "fas fa-city", "", "select inputSelect$type", "", true, cities(true), "", false, "المدينة", "text-danger city_id-validation fw-bold ms-5 reset-validation"),
                select("select", "branch_id", "branch_id_select_id$prefix_id", "fas fa-code-branch", "", "select inputSelect$type", "الفرع", true, branches(true), "", false, "الفرع", "text-danger branch_id-validation fw-bold ms-5 reset-validation"),
                input("text", "space", "space_input_id$prefix_id", "fas fa-chart-area", "rtl", "255", "form-control inputText$type", "المساحة", true, "المساحة", "text-danger space-validation fw-bold ms-5 reset-validation"),
                input("text", "start_price", "start_price_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "السعر من ", true, "السعر من", "text-danger start_price-validation fw-bold ms-5 reset-validation"),
                input("text", "end_price", "end_price_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "255", "form-control inputText$type", "السعر الى", true, "السعر الى", "text-danger end_price-validation fw-bold ms-5 reset-validation"),
                select("select", "time_purchase", "time_purchase_select_id$prefix_id", "fas fa-hourglass-half", "", "select inputSelect$type", "وقت الشراء", true, $time_purchase, "", false, "وقت الشراء", "text-danger time_purchase-validation fw-bold ms-5 reset-validation"),
                select("select", "payment_method", "payment_method_select_id$prefix_id", "far fa-credit-card", "", "select inputSelect$type", "طريقة الدفع", true, $payment_methods, "", false, "طريقة الدفع", "text-danger payment_method-validation fw-bold ms-5 reset-validation"),
                input("text", "amount", "amount_input_id$prefix_id", "fas fa-wallet", "rtl", "255", "form-control inputText$type", "المبلغ المتوفر", true, "المبلغ المتوفر", "text-danger amount-validation fw-bold ms-5 reset-validation"),
            ],
            $custom

        ];

        $contents = config("views.modals.contents.orders-service");

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
        return Order::getRules($id);
    }

    public function messages()
    {
        return Order::getMessages();
    }

    public function delete($id)
    {
        return Order::deleteModel($id);
    }

    public function status($id)
    {
        return Order::status($id);
    }

    public function store($data)
    {
        if ($data['client_id']) {
            $clinet = [
                "name" => $data['client_name'],
                "phone" => $data['client_phone'],
                "employer" => $data['client_employer'],
                "is_buy" => $data['client_is_buy'],
                "employment_type" => $data['client_employment_type'],
            ];
            Client::updateModel($clinet, $data['client_id']);
        } else {
            $data["user_id"] = auth()->id();
            $data["creator"] = auth()->id();
            $clinet = Client::create($data);
            $data['client_id'] = $clinet->id;
        }

        return Order::store($data);
    }

    public function update($data, $id)
    {
        if ($data['client_id']) {
            $clinet = [
                "name" => $data['client_name'],
                "phone" => $data['client_phone'],
                "employer" => $data['client_employer'],
                "is_buy" => $data['client_is_buy'],
                "employment_type" => $data['client_employment_type'],
            ];
            Client::updateModel($clinet, $data['client_id']);
        } else {
            $data["user_id"] = auth()->id();
            $data["creator"] = auth()->id();
            $clinet = Client::create($data);
            $data['client_id'] = $clinet->id;
        }

        return Order::updateModel($data, $id);
    }

    public function show($id)
    {
        return redirect()->route('panel.orders.profile', $id);
    }

    public function fillable()
    {
        $fillable = $this->model->getFillable();
        $fillable[] = "client_name";
        $fillable[] = "client_phone";
        $fillable[] = "client_employer";
        $fillable[] = "client_is_buy";
        $fillable[] = "client_employment_type";
        $fillable[] = "attribution_check";

        return $fillable;
    }
}
