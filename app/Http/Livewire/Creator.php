<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\Services;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Creator extends Component
{
    use LivewireAlert;

    protected $listeners = [
        "store" => "store",
        "refresh" => '$refresh',
        "setBuyerReservation" => "setBuyerReservation",
        "setSalePaymentBuyerCreator" => "setSalePaymentBuyerCreator",
    ];

    public $service = '';
    public $fillable = [];

    public $contents = [];
    public $tabs = [];
    public $rules = [];
    public $messages = [];

    public $title = '';

    public $creator_id;
    public $size = '';

    public $name = '';

    public $offer_id = '';

    private function setService()
    {
        return Services::createInstance($this->service) ?? new Services();
    }

    public function mount($service, $offer_id = null)
    {
        $this->service = $service;
        $service = $this->setService();
        $this->rules = $service->rules();
        $this->messages = $service->messages();
        $this->fillable = $service->fillable();
        $this->setFields($this->fillable);

        if ($this->service == "SalesService" && $offer_id) {
            $this->offer_id = $offer_id;
            $this->setSaleOffer($offer_id);
        }
    }

    public function setSaleOffer($offer_id)
    {
        $offer = Offer::find($offer_id);
        if ($offer) {
            $this->{'offer_code'} = $offer->offer_code;
            $this->{'neighborhood'} = $offer->neighborhood_name;
            $this->{'land_number'} = $offer->land_number;
            $this->{'space'} = $offer->space;
            $this->{'real_estate_price'} = $offer->total;
        }
    }

    public function setBuyerReservation($buyer_id)
    {
        $this->{"client_buyer_id"} = $buyer_id;
        $this->setBuyerFields($buyer_id);
        $this->emit('updateClientBuyerFieldwithDisableIt', "#client_buyer_id_select_id_creator", $buyer_id);
    }

    public function setSalePaymentBuyerCreator($sale_id)
    {
        $sale = Sale::find($sale_id);
        $remaining_amount = $sale->remaining_amount;
        $buyer_id = $sale->buyer_id;
        $this->{"buyer_id"} = $buyer_id;
        $this->{"sale_id"} = $sale_id;
        $this->{"seller_id"} = $sale->seller_id;
        $this->{"offer_id"} = $sale->offer_id;
        if ($sale->offer->reservation) {
            $this->{"reservation_id"} = $sale->offer->reservation->id;
        } else {
            $this->{"reservation_id"} = null;
        }
        $this->emit('updateSalePaymentBuyerFieldwithDisableIt', "#buyer_id_select_id_creator", $buyer_id, number_format($remaining_amount));
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
        $this->title = $service->title_creator;
        $this->creator_id = $service->creator_id;
        $this->size = $service->modal_size;
        $this->tabs = $service->tabs();
        $this->contents = $service->contents("Creator");
    }

    public function render()
    {
        $service = $this->setService();
        $this->getContent($service);

        return view('livewire.creator', [
            "title" => $this->title,
            "contents" => $this->contents,
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

            $this->emit('updateClientBuyerCreator', $client_array);
            $this->emit('select2', "#client_buyer_nationality_id_select_id_creator", $client_model->nationality_id);
            $this->emit('select2', "#client_buyer_city_id_select_id_creator", $client_model->city_id);
            $this->emit('select2', "#client_buyer_employment_type_select_id_creator", $client_model->employment_type);
            $this->emit('select2', "#client_buyer_housing_support_select_id_creator", $client_model->housing_support);
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

            $this->emit('updateClientsellerCreator', $client_array);
            $this->emit('select2', "#client_seller_nationality_id_select_id_creator", $client_model->nationality_id);
            $this->emit('select2', "#client_seller_city_id_select_id_creator", $client_model->city_id);
            $this->emit('select2', "#client_seller_employment_type_select_id_creator", $client_model->employment_type);
            $this->emit('select2', "#client_seller_housing_support_select_id_creator", $client_model->housing_support);
        }
    }

    public function updated($field, $value)
    {
        if (in_array($this->service, ['DirectOfferService', 'ClientsService', 'InDirectOfferService'])) {
            if ($field == 'city_id') {
                $this->emit('setSelectInputCreator', neighborhoods_city(true, $value), "neighborhood_id_select_id_creator");
            }
        }

        if ($this->service == "OrdersService") {
            if ($field == 'client_id') {
                $client = Client::find($value);
                if ($client) {
                    $this->{'client_name'} = $client->name;
                    $this->{'client_phone'} = $client->phone;
                    $this->{'client_employer'} = $client->employer;
                    $this->{'client_is_buy'} = $client->is_buy;
                    $this->{'client_employment_type'} = $client->employment_type;
                    $this->emit('select2', "#client_is_buy_select_id_creator", $client->is_buy);
                    $this->emit('select2', "#client_employment_type_select_id_creator", $client->employment_type);
                    $this->emit('updateFrontDataCreator', $client);
                }
            }
        }

        if ($this->service == "SalesService") {
            if ($field == "client_buyer_id") {
                $this->setBuyerFields($value);
            }

            if ($field == "client_seller_id") {
                $this->setSellerFields($value);
            }

            if ($field == "client_buyer_nationality_id") {
                $this->emit('select2', "#client_buyer_nationality_id_select_id_creator", $value);
            }
        }
    }

    public function store($data)
    {
        $service = $this->setService();
        $data = $this->getFieldsValues($this->fillable);

        $property_type = "";

        if (array_key_exists("property_type", $data)) {
            $property_type = $data["property_type"];
        }

        $this->rules = $service->rules("", $property_type);
        $this->messages = $service->messages();

        if ($this->service == "SalesService") {

            $this->rules = $service->rules("", $property_type, $data['client_buyer_id'], $data['client_seller_id']);


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
            $this->emit('errors', $errors);
            return false;
        }

        $service = $this->setService();
        $message = $service->store($data);

        if ($message) {
            $this->alertMessage($message, 'success');
            $this->emit('updateTable');
            $this->emit('closeModal');
            $this->emit('refresh');
            $this->setFields($this->fillable);
            return true;
        }

        $this->alertMessage('حدث خطأ ما', 'error');
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'center',
            'timer' => 3000,
            'text' => $message,
        ]);
    }
}
