<?php

namespace App\Http\Livewire\Actions;

use App\Http\Controllers\Services\UsersService;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateUser extends Component
{
    protected $listeners = [
        'store' => 'store',
    ];

    public $name = "";
    public $email = "";
    public $phone = "";
    public $password = "";
    public $branches_ids = [];
    public $user_status = "";
    public $user_type = "";
    public $advertiser_number = "";

    public function render()
    {
        return view('livewire.actions.create-user');
    }

    public function getRules()
    {
        return [
            "name" => ['required', 'string'],
            "email" => ['required', 'email', 'unique:users,email'],
            "phone" => ['required', 'unique:users,phone'],
            "password" => ['required', 'string', 'min:8'],
            "user_status" => ['required', 'string'],
            "user_type" => ['required', 'string'],
            "branches_ids" => ['required', 'array'],
        ];
    }

    public function getMessages()
    {
        return [
            "name.required" => "حقل الاسم مطلوب",
            "email.required" => "حقل البريد الإلكتروني مطلوب",
            "email.email" => "البريد الإلكتروني يجب أن يكون صحيح",
            "email.unique" => "البريد الإلكتروني مستخدم من قبل",
            "phone.required" => "رقم الجوال مطلوب",
            "phone.unique" => "رقم الجوال مستخدم من قبل",
            "password.required" => "حقل كلمة المرور مطلوب",
            "password.min" => "حقل كلمة المرور يجب أن لا يقل عن 8 أحرف",
            "user_status.required" => "حقل حالة المستخدم مطلوب",
            "user_type.required" => "حقل نوع المستخدم مطلوب",
            "branches_ids.required" => "حقل الفروع مطلوب",
            "branches_ids.array" => "حقل الفروع يجب أن يكون مصفوفة",
        ];
    }

    public function store(UsersService $usersService, $data)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $permissions = config('permissions.false');

        $data = json_decode($data, true);
        if (array_key_exists('permissions', $data)) {
            $permissions = array_replace(config('permissions.false'), json_decode($data['permissions'], true));
        }

        if (array_key_exists('user_type', $data)) {
            if ($data['user_type'] == 'office') {
                $rules['advertiser_number'] = ['required', 'string'];
                $messages['advertiser_number.required'] = "يرجى ادخال رقم المعلن";
            }
        }

        $validator = Validator::make($data, $rules, $messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->emit('errors', $errors);
            return false;
        }

        $message = $usersService->store($data, $permissions);
        if ($message) {
            return redirect()->route('panel.users.index')->with('success', $message);
        }

        $this->alertMessage("حدث خطأ ما", 'error');
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 6000,
            'text' => $message,
            'timerProgressBar' => true,
        ]);
    }
}
