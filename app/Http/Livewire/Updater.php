<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\Services;
use App\Models\Client;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Updater extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'updater' => 'updater',
        'update' => 'update',
        "refreshComponent" => '$refresh',
    ];

    public $service = '';

    public $fillable = [];
    public $contents = [];
    public $tabs = [];
    public $rules = [];
    public $messages = [];

    public $title = '';
    public $updater_id;
    public $size = '';

    public $model_id = '';

    public $data = [];

    public $offer_id = '';

    private function setService()
    {
        return Services::createInstance($this->service) ?? new Services();
    }

    public function mount($service, $offer_id = null)
    {
        $this->service = $service;
        $service = $this->setService();
        $this->fillable = $service->fillable();
        $this->setFields($this->fillable);
    }

    public function setFields($fillable)
    {
        foreach ($fillable as $field) {
            $this->{$field} = null;
        }
    }

    public function getFieldsValues($fillable)
    {
        $data = [];
        foreach ($fillable as $field) {
            $data[$field] = $this->{$field};
        }
        return $data;
    }

    public function getContent($service)
    {
        $this->title = $service->title_updater;
        $this->updater_id = $service->updater_id;
        $this->size = $service->modal_size;
        $this->tabs = $service->tabs();
        $this->contents = $service->contents("Updater");
    }

    public function render()
    {
        $service = $this->setService();
        $this->getContent($service);

        return view('livewire.updater', [
            "title" => $this->title,
            "contents" => $this->contents,
            "data" => $this->data,
        ]);
    }

    public function setBuyerFields($id)
    {
        if ($this->{"client_seller_id"} == $id) {
            $errors = ["client_buyer_id" => "لا يمكنك اختيار نفس العميل للبائع والمشتري"];
            $this->emit('errors', $errors);
            return false;
        }

        $client_model = Client::find($id);
        if ($client_model) {

            $this->{"client_buyer_name"} = $client_model->name;
            $this->{"client_buyer_phone"} = $client_model->phone;
            $this->{"client_buyer_id_number_type"} = $client_model->id_number_type;
            $this->{"client_buyer_id_number"} = $client_model->id_number;
            $this->{"client_buyer_email"} = $client_model->email;
            $this->{"client_buyer_description"} = $client_model->description;
            $this->{"client_buyer_building_number"} = $client_model->building_number;
            $this->{"client_buyer_street_name"} = $client_model->street_name;
            $this->{"client_buyer_neighborhood_name"} = $client_model->neighborhood_name;
            $this->{"client_buyer_zip_code"} = $client_model->zip_code;
            $this->{"client_buyer_extra_figure"} = $client_model->extra_figure;
            $this->{"client_buyer_unit_number"} = $client_model->unit_number;
            $this->{"client_buyer_nationality_id"} = $client_model->nationality_id;
            $this->{"client_buyer_city_id"} = $client_model->city_id;
            $this->{"client_buyer_employment_type"} = $client_model->employment_type;
            $this->{"client_buyer_housing_support"} = $client_model->housing_support;

            $client_array = array_filter($client_model->toArray(), function ($value) {
                return $value !== null;
            });

            unset($client_array["id"]);
            unset($client_array["status"]);

            $client_array = array_combine(array_map(function ($key) {
                return "client_buyer_" . $key;
            }, array_keys($client_array)), array_values($client_array));

            $this->emit('updateClientBuyerUpdater', $client_array);
            $this->emit('select2', "#client_buyer_nationality_id_select_id_updater", $client_model->nationality_id);
            $this->emit('select2', "#client_buyer_city_id_select_id_updater", $client_model->city_id);
            $this->emit('select2', "#client_buyer_employment_type_select_id_updater", $client_model->employment_type);
            $this->emit('select2', "#client_buyer_housing_support_select_id_updater", $client_model->housing_support);
        }
    }

    public function setSellerFields($id)
    {
        if ($this->{"client_buyer_id"} == $id) {
            $errors = ["client_seller_id" => "لا يمكنك اختيار نفس العميل للبائع والمشتري"];
            $this->emit('errors', $errors);
            return false;
        }

        $client_model = Client::find($id);

        if ($client_model) {

            $this->{"client_seller_name"} = $client_model->name;
            $this->{"client_seller_phone"} = $client_model->phone;
            $this->{"client_seller_id_number_type"} = $client_model->id_number_type;
            $this->{"client_seller_id_number"} = $client_model->id_number;
            $this->{"client_seller_email"} = $client_model->email;
            $this->{"client_seller_description"} = $client_model->description;
            $this->{"client_seller_building_number"} = $client_model->building_number;
            $this->{"client_seller_street_name"} = $client_model->street_name;
            $this->{"client_seller_neighborhood_name"} = $client_model->neighborhood_name;
            $this->{"client_seller_zip_code"} = $client_model->zip_code;
            $this->{"client_seller_extra_figure"} = $client_model->extra_figure;
            $this->{"client_seller_unit_number"} = $client_model->unit_number;
            $this->{"client_seller_nationality_id"} = $client_model->nationality_id;
            $this->{"client_seller_city_id"} = $client_model->city_id;
            $this->{"client_seller_employment_type"} = $client_model->employment_type;
            $this->{"client_seller_housing_support"} = $client_model->housing_support;

            $client_array = array_filter($client_model->toArray(), function ($value) {
                return $value !== null;
            });

            unset($client_array["id"]);
            unset($client_array["status"]);

            $client_array = array_combine(array_map(function ($key) {
                return "client_seller_" . $key;
            }, array_keys($client_array)), array_values($client_array));

            $this->emit('updateClientsellerUpdater', $client_array);
            $this->emit('select2', "#client_seller_nationality_id_select_id_updater", $client_model->nationality_id);
            $this->emit('select2', "#client_seller_city_id_select_id_updater", $client_model->city_id);
            $this->emit('select2', "#client_seller_employment_type_select_id_updater", $client_model->employment_type);
            $this->emit('select2', "#client_seller_housing_support_select_id_updater", $client_model->housing_support);
        }
    }

    public function updated($field, $value)
    {
        if (in_array($this->service, ["ClientsService", "DirectOfferService", "InDirectOfferService"])) {
            if ($field == 'city_id') {
                $this->emit('setSelectInputUpdater', neighborhoods_city(true, $value), "neighborhood_id_select_id_updater");
            }
        }

        if ($this->service == "OrdersService") {
            if ($field == 'client_id') {
                $clinet = Client::find($value);
                if ($clinet) {
                    $this->{'clinet_name'} = $clinet->name;
                    $this->{'client_phone'} = $clinet->phone;
                    $this->{'client_employer'} = $clinet->employer;
                    $this->{'client_is_buy'} = $clinet->is_buy;
                    $this->{'client_employment_type'} = $clinet->employment_type;
                    $this->emit('select2', "#client_is_buy_select_id_updater", $clinet->is_buy);
                    $this->emit('select2', "#client_employment_type_select_id_updater", $clinet->employment_type);
                    $this->emit('updateFrontDataUpdater', $clinet);
                }
            }
        }

        if ($this->service == "SalesProfileService") {
            if ($field == "client_buyer_id") {
                $this->setBuyerFields($value);
            }

            if ($field == "client_seller_id") {
                $this->setSellerFields($value);
            }

            if ($field == "client_buyer_nationality_id") {
                $this->emit('select2', "#client_buyer_nationality_id_select_id_updater", $value);
            }
        }
    }

    public function updater($service, $id)
    {
        $this->service = $service;
        $this->model_id = $id;
        $service = $this->setService();

        $model = $service->model($id);


        if ($this->service == "SalesProfileService") {

            $offer = $model->offer;
            $this->{'offer_code'} = $offer->offer_code;
            $this->{'neighborhood'} = $offer->neighborhood_name;
            $this->{'land_number'} = $offer->land_number;
            $this->{'space'} = $offer->space;
            $this->{'real_estate_price'} = $offer->total;


            if ($offer) {
                if ($offer->realEstate) {
                    if ($offer->realEstate->property_status == "sold") {
                        $this->emit("disableFieldsUpdater");
                    }
                }
            }


            $sale = $offer->sale;
            $buyer = $sale->buyer;
            $seller = $sale->seller;

            foreach ($sale->toArray() as $field => $value) {
                $this->{$field} = $value;
                if (in_array($field, ["commission_type", "is_first_home", "payment_method", "bank"])) {
                    $input_id =  "#" . $field . "_select_id_updater";
                    $this->emit('select2', $input_id, $value);
                }
            }

            foreach ($buyer->toArray() as $field => $value) {
                $this->{'client_buyer_' . $field} = $value;
                if (in_array($field, ["nationality_id", "city_id", "employment_type", "housing_support", "id"])) {
                    $input_id = "#client_buyer_" . $field . "_select_id_updater";
                    $this->emit('select2', $input_id, $value);
                }
            }

            foreach ($seller->toArray() as $field => $value) {
                $this->{'client_seller_' . $field} = $value;
                if (in_array($field, ["nationality_id", "city_id", "employment_type", "housing_support", "id"])) {
                    $input_id = "#client_seller_" . $field . "_select_id_updater";
                    $this->emit('select2', $input_id, $value);
                }
            }

            $this->emit("setSaleTypes", $sale->is_first_home, $sale->commission_type, $sale->payment_method);

            $this->data = $this->getFieldsValues($this->fillable);

            $data = json_encode($this->data);
            $this->emit('setDataFields', $data);

            return true;
        }

        if (in_array($this->service, ['DirectOfferService', 'InDirectOfferService'])) {
            $this->emit("showModalsFields", offer_real_estate_type($model->id));
        }

        foreach ($this->fillable as $field) {
            $this->{$field} = $model->{$field};
        }

        foreach ($this->contents as $content) {

            foreach ($content['inputs'] as $input) {

                if ($input['type'] == 'select') {
                    $input_id  = "#" . $input['id'];
                    $value = (string) $model->{$input['name']};
                    $this->emit('select2', $input_id, $value);
                }

                if (in_array($this->service, ["ClientsService"])) {
                    if ($input['name'] == 'city_id') {
                        $id = $model->neighborhood ? $model->neighborhood->id : "";
                        $this->emit('setSelectInputUpdater', neighborhoods_city(true, $model->{$input['name']}), "neighborhood_id_select_id_updater", $id);
                    }
                }

                if (in_array($this->service, ["DirectOfferService", "InDirectOfferService"])) {
                    if ($input['name'] == 'city_id') {
                        $id = $model->neighborhood_id;
                        $this->emit('setSelectInputUpdater', neighborhoods_city(true, $model->city_id), "neighborhood_id_select_id_updater", $id);
                    }

                    if ($input['name'] == 'directions') {
                        $ids = json_decode($model->directions);
                        $this->{'directions'} = $ids;
                        $this->emit('setMultiSelectInput', directions(), "directions_select_id_updater", $ids);
                    }

                    if ($input['name'] == 'street_width') {
                        $ids = json_decode($model->street_width);
                        $this->{'street_width'} = $ids;
                        $this->emit('setMultiSelectInput', street_width(), "street_width_select_id_updater", $ids);
                    }

                    if ($input['name'] == 'brokers_ids') {
                        $ids = json_decode($model->brokers_ids);
                        $this->{'brokers_ids'} = $ids;
                        $this->emit('setMultiSelectInput', brokers(), "brokers_ids_select_id_updater", $ids);
                    }
                }

                if ($this->service == "UsersService") {
                    if ($input['name'] == 'branches_ids') {
                        $ids = $model->branches ? $model->branches()->pluck('id')->toArray() : "";
                        $ids = array_map('strval', $ids);
                        $this->{'branches_ids'} = $ids;
                        $this->emit('setMultiSelectInput', branches(true), "branches_ids_select_id_updater", $ids);
                    }

                    if ($input['name'] == 'permissions') {
                        $ids = $model->permissions;
                        $ids = array_filter($ids, function ($value) {
                            return $value === true;
                        });

                        $ids = array_keys($ids);
                        $this->{'permissions'} = $ids;

                        $this->emit('setMultiSelectInput', config('permissions.all'), "permissions_select_id_updater", $ids);
                    }

                    if ($input['name'] == 'advertiser_number') {
                        $this->emit('advertiser_number', $model->user_type, $model->advertiser_number);
                    }
                }

                if ($this->service == "OrdersService") {
                    if ($input['name'] == 'attribution') {
                        $check = $model->attribution ? true : false;
                        $this->{"attribution_check"} = true;
                        $this->emit('showAttributionFields', $input['id'], $check);
                    }

                    if (in_array($input['name'], ["start_price", "end_price", 'space', 'amount'])) {
                        $this->emit('setNumberInput', $input['id'], $input['name'], $model->{$input['name']});
                    }
                }
            }
        }

        $this->data = $this->getFieldsValues($this->fillable);

        $data = json_encode($this->data);
        $this->emit('setDataFields', $data);
    }

    public function update($data)
    {
        $service = $this->setService();
        $data = $this->getFieldsValues($this->fillable);
        $property_type = "";

        if (array_key_exists("property_type", $data)) {
            $property_type = $data["property_type"];
        }

        $this->rules = $service->rules($this->model_id, $property_type);
        $this->messages = $service->messages();

        if (array_key_exists('user_type', $data)) {
            if ($data['user_type'] == 'office') {
                $this->rules['advertiser_number'] = ['required', 'string'];
                $this->messages['advertiser_number.required'] = "يرجى ادخال رقم المعلن";
            }
        }

        if (array_key_exists('password', $data)) {
            unset($data['password']);
            unset($this->rules['password']);
        }

        if ($this->service == "SalesService") {

            if ($data['is_first_home'] == 1) {
                $this->rules['deserved_amount'] = ['required'];
                $this->rules['commission_vat'] = [];
            }

            if ($data['is_first_home'] == 2) {
                $this->rules['commission_vat'] = ['required'];
                $this->rules['deserved_amount'] = [];
            }

            if ($data['commission_type'] == "percentage") {
                $this->rules['commission_percentage'] = ['required'];
                $this->rules['commission_price'] = [];
            }

            if ($data['commission_type'] == "price") {
                $this->rules['commission_price'] = ['required'];
                $this->rules['commission_percentage'] = [];
            }

            if ($data['payment_method'] == "cash_money") {
                $this->rules['bank'] = [];
                $this->rules['check_number'] = [];
                $this->rules['recipient_name'] = ['required'];
            }

            if ($data['payment_method'] == "bank_check") {
                $this->rules['bank'] = ['required'];
                $this->rules['check_number'] = ['required'];
                $this->rules['recipient_name'] = ['required'];
            }

            if ($data['payment_method'] == "bank_transfer") {
                $this->rules['bank'] = ['required'];
                $this->rules['check_number'] = [];
                $this->rules['recipient_name'] = ['required'];
            }
        }

        $validator = Validator::make($data, $this->rules, $this->messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->emit('errors-updater', $errors);
            return false;
        }

        $message = $service->update($data, $this->model_id);

        $offer_check = false;

        if (in_array($this->service, ["DirectOfferService", "InDirectOfferService"])) {
            $offer_check = true;
        }

        if ($message) {
            sleep(2);
            $this->alertMessage($message, 'success');
            $this->emit('updateTable');
            $this->emit('closeModal', $offer_check);
            $this->emit('refresh');
            $this->setFields($this->fillable);

            if ($this->service == "SalesProfileService") {
                $this->emit('reloadPage');
            }

            return true;
        }

        $this->alertMessage('حدث خطأ ما', 'error');
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'top-start',
            'timer' => 3000,
            'text' => $message,
            'timerProgressBar' => true,
        ]);
    }
}
