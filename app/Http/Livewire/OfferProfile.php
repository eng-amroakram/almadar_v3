<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\Services;
use App\Models\Broker;
use App\Models\Offer;
use App\Models\Reservation;
use App\Models\SalePayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class OfferProfile extends Component
{
    use LivewireAlert;

    protected $listeners = [
        "storeReservation" => "storeReservation",
        "refresh" => '$refresh',
    ];

    public $offer;
    public $offer_edits = [];
    public $service;
    public $last_update_time = 'لم يتم التعديل على هذا العرض بعد';
    public $last_update_note_time = 'لم يتم التعديل على هذا العرض بعد';

    public $tabs = [];
    public $contents = [];
    public $fillable = [];
    public $rules = [];
    public $messages = [];

    public $status = '';
    public $note = '';
    public $size = 'modal-lg';

    public $date_from = null;
    public $date_to = null;

    private function setService()
    {
        return Services::createInstance($this->service) ?? new Services();
    }

    public function getContent($service)
    {
        $this->tabs = $service->tabs();
        $this->contents = $service->contents("Creator");
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

    public function mount($offer_id)
    {
        $this->offer = Offer::find($offer_id);

        $this->service = "OfferProfileService";
        $service = $this->setService();
        $this->rules = $service->rules();
        $this->messages = $service->messages();
        $this->fillable = $service->fillable();
        $this->size = "";
        $this->setFields($this->fillable);
        $this->getLastUpateTime();
    }

    public function getLastUpateTime()
    {
        if ($this->offer) {
            if ($this->offer->updated_at) {
                $last_update = $this->offer->updated_at->toDateTimeString();
                $time_now = now();

                $datetime1 = strtotime($last_update);
                $datetime2 = strtotime($time_now);

                $secs = $datetime2 - $datetime1; // == <seconds between the two times>
                $min = $secs / 60;
                $hour = $secs / 3600;
                $days = $secs / 86400;


                if ($days > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($days, 0) . ' يوم';
                    return true;
                }

                if ($hour > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($hour, 0) . ' ساعة';
                    return true;
                }

                if ($min > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($min, 0)  . ' دقيقة';
                    return true;
                }

                $this->last_update_time = 'اخر تحديث منذ ' . $secs . ' ثواني';
                return true;
            }
        }
    }

    public function getLastUpateOfferEditTime($offer_edit_id)
    {
        // $offer_edit_id = OfferEditor::find($offer_edit_id);

        $last_update = $offer_edit_id->created_at->toDateTimeString();

        if ($last_update) {
            $time_now = now();

            $datetime1 = strtotime($last_update);
            $datetime2 = strtotime($time_now);

            $secs = $datetime2 - $datetime1;
            $min = $secs / 60;
            $hour = $secs / 3600;
            $days = $secs / 86400;


            if ($days > 0.99) {
                return 'منذ ' . round($days, 0) . ' يوم';
            }

            if ($hour > 0.99) {
                return 'منذ ' . round($hour, 0) . ' ساعة';
            }

            if ($min > 0.99) {
                return 'منذ ' . round($min, 0)  . ' دقيقة';
            }

            return 'منذ ' . $secs . ' ثواني';
        }
    }

    public function render()
    {
        $service = $this->setService();
        $this->getContent($service);
        $this->getLastUpateTime();
        $this->offer_edits = $this->offer->offerEdits()->get();

        return view('livewire.offer-profile');
    }

    public function setClientOfferReservation()
    {
        $offer = Offer::find($this->offer->id);
        if ($offer) {
            $reservation =  $offer->reservation;
            if ($reservation) {
                $buyer = $reservation->client;
                $this->emit("setBuyerReservation", $buyer->id);
            }
        }
    }

    public function storeReservation($data)
    {
        $service = $this->setService();
        $data = $this->getFieldsValues($this->fillable);

        $validator = Validator::make($data, $this->rules, $this->messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->emit('profile-errors', $errors);
            return false;
        }

        $data = array_filter($data, fn ($value) => $value !== null);

        $data["user_id"] = auth()->id();
        $data["offer_id"] = $this->offer->id;
        $data["status"] = 1;
        $data["note"] = $this->note;
        $data["date_from"] = Carbon::createFromFormat('Y-m-d', $this->date_from);
        $data["date_to"] = Carbon::createFromFormat('Y-m-d', $this->date_to);

        $reservation = Reservation::create($data);

        SalePayment::create([
            'user_id' => auth()->id(),
            'seller_id' => null,
            'buyer_id' => $reservation->client_id,
            'reservation_id' => $reservation->id,
            'offer_id' => $reservation->offer_id,
            'amount' => $reservation->price,
            'payment_method' => $reservation->payment_method,
            'check_number' => $reservation->check_number,
            'recipient_name' => $reservation->recipient_name,
            'bank' => $reservation->bank,
        ]);

        $this->offer->realEstate->update(['property_status' => "booked-up"]);

        if ($reservation) {
            // $this->alertMessage("تم إنشاء الحجز بنجاح", 'success');
            // $this->emit('updateTable');
            // $this->emit('closeProfileModal');
            // $this->emit('refresh');
            // $this->setFields($this->fillable);
            // return true;
            return redirect()->route('panel.offers.profile', $this->offer->id);
        }

        $this->alertMessage('حدث خطأ ما', 'error');
    }

    public function viewReservation()
    {
        $reservation = $this->offer->reservation;

        foreach ($this->fillable as $field) {
            $this->{$field} = $reservation->{$field};
        }

        foreach ($this->contents as $content) {

            foreach ($content['inputs'] as $input) {
                if ($input['type'] == 'select') {
                    $input_id  = "#" . $input['id'];
                    $value = (string) $reservation->{$input['name']};
                    $this->emit('profileSelect2', $input_id, $value, $input['name']);
                }
            }
        }

        $this->emit("disableForm");
    }

    public function cancelReservation()
    {
        $reservation = $this->offer->reservation;
        $reservation->delete();

        $this->offer->realEstate->update(['property_status' => "vacant"]);

        return redirect()->route('panel.offers.profile', $this->offer->id);

        $this->alertMessage("تم إلغاء الحجز بنجاح", 'success');

        $this->emit('updateTable');

        $this->emit('closeProfileModal');

        $this->emit('enableForm');

        $this->emit('refresh');
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'top-start',
            'timer' => 3000,
            'text' => $message,
        ]);
    }
}
