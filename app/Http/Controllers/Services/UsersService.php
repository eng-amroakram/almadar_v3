<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersService extends Controller
{
    public $name =  "المستخدمين";
    public $title_creator = "إنشاء مستخدم جديد";
    public $title_updater = "تعديل بيانات المستخدم";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-user-button";
    public $updater_id = "updater-user-button";
    public $model = User::class;
    public $class_title = "User";
    public $excel_file = "UsersExport";

    public function __construct()
    {
        $this->model = new User();
    }

    public function model($id)
    {
        return User::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return User::data()
            ->whereNot('user_type', 'superadmin')
            ->whereNot('id', auth()->id())
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.tables.columns.users-service');
    }

    public function rows()
    {
        return config('views.tables.rows.users-service');
    }

    public function selects()
    {
        $searches = config('views.tables.searches.users-service');
        $searches["branch_id"] = branches(true);
        return $searches;
    }

    public function create()
    {
        return config('views.tables.buttons.create.users-service');
    }

    public function edit($id)
    {
        return route('panel.users.edit', $id);
    }

    public function tabs()
    {
        return config('views.modals.tabs.users-service');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id", "far fa-user", "rtl", "50", "form-control inputText$type", "اسم المستخدم", true, "اسم المستخدم", "text-danger reset-validation name-validation"),
                input("email", "email", "email_input_id$prefix_id", "fas fa-at", "ltr", "50", "form-control inputText$type", "البريد الالكتروني", true, "البريد الالكتروني", "text-danger reset-validation email-validation"),
                input("text", "phone", "phone_input_id$prefix_id", "fas fa-phone", "ltr", "10", "form-control inputText$type", "رقم الجوال", true, "رقم الجوال", "text-danger reset-validation phone-validation"),
                input("password", "password", "password_input_id$prefix_id", "fas fa-key", "ltr", "50", "form-control inputText$type", "كلمة السر", true, "كلمة السر", "text-danger reset-validation password-validation"),

                select("select", "branches_ids", "branches_ids_select_id$prefix_id", "fas fa-code-branch", "", "select inputSelect$type", "الفروع", true, branches(true), "multiple", true, "الفروع", "text-danger reset-validation branches_ids-validation"),
                select("select", "user_status", "user_status_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", "حالة المستخدم", false, ["نشط" => "active", "غير نشط" => "inactive",], "", true, "حالة المستخدم", "text-danger reset-validation user_status-validation"),
                select("select", "user_type", "user_type_select_id$prefix_id", "fas fa-elevator", "", "select inputSelect$type", "نوع المستخدم", false, ["ادمن فرعي" => "admin", "مسوق" => "marketer", "مكتب" => "office",], "", true, "نوع المستخدم", "text-danger reset-validation user_type-validation"),
                input("text", "advertiser_number", "advertiser_number_input_id$prefix_id", "fas fa-bullhorn", "rtl", "50", "form-control inputText$type advertiser-number-input", "رقم المعلن", true, "رقم المعلن", "text-danger reset-validation advertiser_number-validation"),
                select("group-select", "permissions", "permissions_select_id$prefix_id", "fas fa-key", "", "select inputSelect$type", "صلاحيات المستخدم", true, config('permissions.select-permissions'), "multiple", true, "صلاحيات المستخدم", "text-danger reset-validation permissions-validation"),
            ],
            // checkboxes(config('permissions.permissions')),
        ];

        $contents = config("views.modals.contents.users-service");

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
        return User::getRules($id);
    }

    public function messages()
    {
        return User::getMessages();
    }

    public function delete($id)
    {
        return User::deleteModel($id);
    }

    public function status($id)
    {
        return User::status($id);
    }

    public function store($data)
    {
        return User::store($data);
    }

    public function update($data, $id)
    {
        return User::updateModel($data, $id);
    }

    public function show($id)
    {
        return redirect()->route('panel.users.profile', $id);
    }

    public function fillable()
    {
        return [
            "name",
            "email",
            "phone",
            "password",
            "user_status",
            "user_type",
            "advertiser_number",
            "branches_ids",
            'permissions'
        ];
    }
}
