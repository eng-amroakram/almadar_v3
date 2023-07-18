<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\Services;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderEditor;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class OrderProfile extends Component
{
    use LivewireAlert;

    protected $listeners = [
        "storeNote" => "storeNote",
        "refresh" => '$refresh',
    ];

    public $order;
    public $order_notes = [];
    public $order_edits = [];
    public $service;
    public $last_update_time = 'لم يتم التعديل على هذا الطلب بعد';
    public $last_update_note_time = 'لم يتم التعديل على هذا الطلب بعد';

    public $tabs = [];
    public $contents = [];
    public $fillable = [];
    public $rules = [];
    public $messages = [];

    public $status = '';
    public $note = '';
    public $size = '';

    public $offer_code = '';


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

    public function mount($order_id)
    {
        $this->order = Order::find($order_id);
        $this->service = "OrderProfileService";
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
        if ($this->order) {
            if ($this->order->updated_at) {
                $last_update = $this->order->updated_at->toDateTimeString();
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

    public function getLastUpateOrderEditTime($order_edit_id)
    {
        $order_edit_id = OrderEditor::find($order_edit_id);

        $last_update = $order_edit_id->created_at->toDateTimeString();

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

    public function storeNote($data)
    {
        $service = $this->setService();
        $data = $this->getFieldsValues($this->fillable);

        $validator = Validator::make($data, $this->rules, $this->messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->emit('errors', $errors);
            return false;
        }
        $data['order_id'] = $this->order->id;

        $service = $this->setService();
        $message = $service->store($data);

        OrderEditor::store($this->order->id, $this->status);

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

    public function activate()
    {
        $message = OrderEditor::store($this->order->id, "active");
        $this->emit('refresh');

        if ($message) {
            $this->alertMessage($message, 'success');
            return true;
        }
    }

    public function closeOrder()
    {
        $message = OrderEditor::store($this->order->id, "client_not_wish");
        $this->emit('refresh');

        if ($message) {
            $this->alertMessage($message, 'success');
            return true;
        }
    }

    public function linkOffer()
    {
        if ($this->offer_code) {
            $offer = Offer::where('offer_code', $this->offer_code)->first();

            if ($offer) {
                $this->order->offer_id = $offer->id;
                $this->order->save();

                $offer->update([
                    "order_id" => $this->order->id,
                ]);
                $message = OrderEditor::store($this->order->id, "linked_to_offer");

                if ($message) {
                    $this->alertMessage($message, 'success');
                    $this->emit('closeModalOfferLink');
                    $this->emit('refresh');
                    return true;
                }
            }
        }

        $this->alertMessage('حدث خطأ في النظام !!', 'error');
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

    public function render()
    {
        $service = $this->setService();
        $this->getContent($service);
        $this->getLastUpateTime();
        $this->order_notes = $this->order->orderNotes()->orderBy('created_at', 'desc')->get();
        $this->order_edits = $this->order->orderEdits()->orderBy('created_at', 'desc')->get();

        return view('livewire.order-profile');
    }
}
