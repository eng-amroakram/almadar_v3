<?php

namespace App\Http\Livewire\Actions;

use App\Http\Controllers\Services\UsersService;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateUser extends Component
{

    protected $listeners = [
        'update' => 'update',
    ];

    public $user = null;
    public $user_id;

    public $name;
    public $email;
    public $phone;
    public $password;
    public $user_status;
    public $user_type;
    public $advertiser_number;
    public $branches_ids = [];
    public $permissions = [];
    public $permissions_user = [];

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
        $this->user_id = $user_id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->user_status = $this->user->user_status;
        $this->user_type = $this->user->user_type;
        $this->advertiser_number = $this->user->advertiser_number;
        $this->permissions_user = $this->user->permissions;
        $this->branches_ids = array_map('strval', $this->user->branches()->pluck('id')->toArray());

        $perms = [];

        foreach (config('permissions.permissions-false') as $group => $permissions) {
            foreach ($this->user->permissions as $key => $value) {
                if (array_key_exists($key, $permissions)) {
                    $perms[$group][$key] = $value;
                }
            }
        }

        $this->permissions = $perms;
    }

    public function render()
    {
        return view('livewire.actions.update-user');
    }

    public function getRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->user_id],
            'phone' => ['required', 'string', 'unique:users,phone,' . $this->user_id],
            'password' => ['nullable', 'string', 'min:8'],
            'user_status' => ['required', 'string', 'in:active,inactive'],
            'user_type' => ['required', 'string', 'in:admin,office,marketer'],
            'advertiser_number' => ['nullable', 'string'],
            'branches_ids' => ['required', 'array'],
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

    public function update(UsersService $usersService, $data)
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

        $message = $usersService->update($this->user_id, $data, $permissions);
        if ($message) {
            return redirect()->route('panel.users.index')->with('success', $message);
        }

        $this->alertMessage("حدث خطأ ما", 'error');
    }
}
