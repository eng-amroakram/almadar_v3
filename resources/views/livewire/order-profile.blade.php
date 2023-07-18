<div>
    <div class="row">

        <div class="col-lg-6" wire:ignore.self>
            <div class="card mb-3" style="border-radius: .5rem;" wire:ignore.self>

                <div class="row g-0" wire:ignore.self>
                    <div class="col-md-4 gradient-custom text-center text-white"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;" wire:ignore.self>
                        <img src="{{ asset('assets/images/order.png') }}" alt="Avatar" class="img-fluid my-5"
                            style="width: 80px;" />
                        <h5 class="text-dark">كود الطلب</h5>
                        <p class="text-dark">{{ $order->order_code }}</p>

                        @if ($order->offer)
                            <h5 class="text-dark">كود العرض</h5>
                            <p class="text-dark">{{ $order->offer->offer_code }}</p>
                        @endif

                        @if ($order->status == 'closed')
                            <button type="button" class="btn btn-outline-success" wire:click="activate"
                                data-mdb-ripple-color="dark">تنشيط
                                الطلب</button>
                        @endif

                        @if ($order->status == 'hanging')
                            <button type="button" class="btn btn-outline-danger" wire:click="closeOrder"
                                data-mdb-ripple-color="dark">اغلاق الطلب</button>
                        @endif

                        @if (in_array($order->status, ['follow_up_request', 'request_not_processed']))
                            <button type="button" class="btn btn-outline-success" data-mdb-toggle="modal"
                                data-mdb-target="#creator-order-link-offer-button" data-mdb-ripple-color="dark">ربط مع
                                العرض</button>
                        @endif

                    </div>

                    <div class="col-md-8">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <div class="me-auto p-2">
                                    <h6>معلومات العميل</h6>
                                </div>

                                @if (in_array($order->status, ['new', 'follow_up_request', 'request_not_processed']))
                                    <div class="p-2">
                                        <button class="btn btn-sm btn-outline-primary" data-mdb-toggle="modal"
                                            data-mdb-target="#creator-order-note-button" data-mdb-ripple-color="dark">
                                            <i class="far fa-pen-to-square"></i> إضافة ملاحظة
                                        </button>
                                    </div>
                                @endif

                            </div>
                            <hr class="mt-0 mb-4">

                            <div class="row pt-1">

                                <div class="col-6">
                                    <h6><i class="fas fa-circle-user"></i> الاسم: </h6>
                                    <p class="text-muted">{{ $order->client->name }}</p>
                                </div>
                                <div class="col-6">
                                    <h6><i class="fas fa-square-phone-flip"></i> رقم الجوال: </h6>
                                    <p class="text-muted"><span dir="ltr">+966 {{ $order->client->phone }}</span>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <h6><i class="fas fa-city"></i> هل مدعوم من الاسكان: </h6>
                                    <p class="text-muted">{{ $order->client->housing_support == 1 ? 'نعم' : 'لا' }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <h6><i class="fas fa-briefcase"></i> جهة العمل: </h6>
                                    <p class="text-muted">{{ $order->client->employer }}
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-toggle-on"></i> نوع القطاع: </h6>
                                    <p class="text-muted">{{ $order->client->employment_type_name }}
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-toggle-on"></i> حالة العميل للشراء: </h6>
                                    <p class="text-muted">{{ __($order->time_purchase) }}
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-toggle-on"></i> حالة الطلب: </h6>
                                    <p class="text-muted">{{ $order->order_status }}
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

            <div class="row" wire:ignore.self>
                <div class="col-md-12" wire:ignore.self>
                    <div class="card mb-4 mb-md-0" wire:ignore.self>

                        <div class="card-body" wire:ignore.self>
                            <h6>تتبع حالة الطلب</h6>
                            <hr class="mt-0 mb-4">

                            <ul class="timeline" wire:ignore.self="">

                                @foreach ($order_notes as $order_note)
                                    <li class="timeline-item">
                                        <span
                                            class="timeline-point timeline-point-success timeline-point-indicator "></span>
                                        <div class="timeline-event">
                                            <div
                                                class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                <h6>{{ $order_note->user_name }}</h6>
                                                <span
                                                    class="timeline-event-time ">{{ $order_note->created_at->format('Y-m-d') }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1"
                                                wire:ignore.self="">
                                                <h6>{{ $order_note->note }}</h6>
                                            </div>

                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6">

            <div class="card mb-4">
                <div class="card-body">

                    <div class="d-flex">
                        <div class="me-auto p-2">
                            <h6>معلومات العقار</h6>
                        </div>
                        <div class="p-2">
                            <p class="card-text font-small-2 me-25 mb-0">{{ $last_update_time }}</p>
                        </div>
                    </div>
                    <hr class="mt-0 mb-4">

                    <div class="row">
                        <div class="col-3">
                            <h6><i class="fas fa-building"></i> نوع العقار: </h6>
                            <p class="text-muted">{{ __($order->property_type) }}</p>
                        </div>

                        <div class="col-3">
                            <h6><i class="fas fa-chart-area"></i> المساحة: </h6>
                            <p class="text-muted">{{ number_format($order->space) }} متر</p>
                        </div>

                        <div class="col-3">
                            <h6><i class="fas fa-dollar-sign"></i> الميزانية: </h6>
                            <p class="text-muted">{{ $order->budget }}</p>
                        </div>

                        <div class="col-3">
                            <h6><i class="fas fa-city"></i> المدينة: </h6>
                            <p class="text-muted">{{ $order->city_name }}</p>
                        </div>

                        <div class="col-3">
                            <h6><i class="fas fa-dollar-sign"></i> المبلغ المتوفر: </h6>
                            <p class="text-muted">{{ number_format($order->amount) }}</p>
                        </div>


                        <div class="col-3">
                            <h6><i class="far fa-credit-card"></i> طريقة الشراء: </h6>
                            <p class="text-muted">{{ __($order->payment_method) }}</p>
                        </div>

                        <div class="col-12">
                            <h6><i class="fas fa-align-justify"></i> ملاحظات على الطلب: </h6>
                            <textarea cols="30" class="w-100" disabled>{{ $order->notes }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            @can('orderEditors', 'App\Models\User')
                <div class="row">

                    <div class="col-md-12">
                        <div class="card mb-4 mb-md-0">

                            <div class="card-body">
                                <h6>حالات التعديل والإضافة</h6>
                                <hr class="mt-0 mb-4">

                                <ul class="timeline" wire:ignore.self="">


                                    @foreach ($order_edits as $order_edit)
                                        <li class="timeline-item">
                                            <span
                                                class="timeline-point timeline-point-success timeline-point-indicator "></span>
                                            <div class="timeline-event">
                                                <div
                                                    class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                    <h6>{{ $order_edit->note }}</h6>
                                                    <span
                                                        class="timeline-event-time ">{{ $this->getLastUpateOrderEditTime($order_edit->id) }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            @endcan


        </div>

    </div>

    <div class="modal top fade" id="creator-order-note-button" tabindex="-1" data-mdb-backdrop="static"
        aria-labelledby="Creator" aria-hidden="true" wire:ignore>
        <div class="modal-dialog  cascading-modal" style="margin-top: 4%">

            <div class="modal-content">

                <div class="modal-c-tabs">

                    <x-creator.nav-tabs :tabs="$tabs"></x-creator.nav-tabs>

                    <div class="tab-content">
                        <x-table-extension.loading></x-table-extension.loading>

                        @foreach ($contents as $content)
                            <div class="tab-pane fade in {{ $content['status'] }} nav-tabs-custom-creator {{ $content['id'] . '-' . 'creator-tap' }}"
                                id="{{ $content['id'] }}" role="tabpanel">

                                <div class="modal-body">
                                    @foreach ($content['inputs'] as $input)
                                        <x-creator.inputs :input="$input" :size="$size" :classsize="'col-md-12 mb-3'"
                                            :creatorid="'creator-order-note-button'">
                                        </x-creator.inputs>
                                    @endforeach
                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn bg-brown-color" data-mdb-dismiss="modal">
                                        إغلاق
                                    </button>

                                    <button type="button"
                                        class="btn text-white brown-color submitCreator">حفظ</button>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal top fade" id="creator-order-link-offer-button" tabindex="-1" data-mdb-backdrop="static"
        aria-labelledby="Creator" aria-hidden="true" wire:ignore>
        <div class="modal-dialog  cascading-modal" style="margin-top: 4%">

            <div class="modal-content">

                <div class="modal-c-tabs">

                    <ul class="nav md-tabs tabs-2" role="tablist" style="background-color: rgb(139, 107, 75);">
                        <li class="nav-item">
                            <a class="nav-link active nav-link-custom-creator" data-toggle="tab"
                                href="#creator-order-link-offer" role="tab">
                                <i class="mr-1"></i>
                                اختيار كود العرض
                            </a>
                        </li>
                    </ul>


                    <div class="tab-content">
                        <x-table-extension.loading></x-table-extension.loading>

                        <div class="tab-pane fade in active show nav-tabs-custom-creator {{ 'creator-order-link-offer-' . 'creator-tap' }}"
                            id="creator-order-link-offer" role="tabpanel">

                            <div class="modal-body">

                                <div class="col-md-12 mb-3">

                                    <label class="form-label select-label">
                                        <strong>اختيار كود العرض</strong>
                                    </label>

                                    <div class="col-md-12 input-group">

                                        <span class="input-group-text">
                                            <i class="fas fa-code-commit"></i>
                                        </span>

                                        <select id="offer_code_select_id_creator" wire:model.defer="offer_code"
                                            class="select inputSelectCreator" name="offer_code"
                                            data-mdb-container="#creator-order-link-offer-button"
                                            data-mdb-filter="true">
                                            <option></option>
                                            @foreach (offer_codes(true) as $key => $option)
                                                <option value="{{ $key }}">{{ $key }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <small
                                        class="text-danger offer_code-validation fw-bold ms-5 reset-validation"></small>
                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn bg-brown-color" data-mdb-dismiss="modal">
                                    إغلاق
                                </button>

                                <button type="button" class="btn text-white brown-color"
                                    wire:click="linkOffer">حفظ</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    @push('creator')
        <script>
            $(document).ready(function() {
                //Buttons
                var $submitCreator = $(".submitCreator");

                //Inputs
                var $inputTextCreator = $(".inputTextCreator");
                var $inputSelectCreator = $(".inputSelectCreator");
                var $checkboxInputCreator = $(".checkboxInputCreator");

                //Data
                var $data = [];

                //Functions
                function setInput($name, $value) {
                    $data[$name] = $value;
                }

                function getContent() {
                    var $object = Object.assign({}, $data);
                    return JSON.stringify($object);
                }

                //Events
                $inputTextCreator.on("input", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
                    setInput($name, $value);
                });

                $inputSelectCreator.on("change", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
                    setInput($name, $value);
                });

                $submitCreator.on('click', function() {
                    $(".reset-validation").text(" ");
                    console.log(getContent());
                    Livewire.emit('storeNote', getContent());
                });

                Livewire.on("errors", function(errors) {
                    $(".reset").text("");
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $("." + key + "-validation").text(errors[key]);
                        }
                    }
                    console.log(errors);
                });

                Livewire.on("closeModal", function(errors) {
                    let $id = "#creator-order-note-button";
                    $($id).modal('hide');
                    $(".reset-validation").val("");
                    $data = [];
                });


                Livewire.on("closeModalOfferLink", function(errors) {
                    let $id = "#creator-order-link-offer-button";
                    $($id).modal('hide');
                    $(".reset-validation").val("");
                    $data = [];
                });

            });
        </script>
    @endpush
</div>
