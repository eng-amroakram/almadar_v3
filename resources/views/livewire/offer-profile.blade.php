<div>
    <div class="row">

        <div class="col-lg-6" wire:ignore.self>
            <div class="card mb-3" style="border-radius: .5rem;" wire:ignore.self>

                <div class="row g-0" wire:ignore.self>
                    <div class="col-md-4 gradient-custom text-center text-white"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;" wire:ignore.self>
                        <img src="{{ asset('assets/images/order.png') }}" alt="Avatar" class="img-fluid my-5"
                            style="width: 80px;" />
                        <h5 class="text-dark">كود العرض</h5>
                        <p class="text-dark">{{ $offer->offer_code }}</p>

                        @if (!$offer->reservation && !$offer->sale)
                            <button type="button" class="btn btn-outline-success " data-mdb-toggle="modal"
                                data-mdb-target="#creator-offer-reservation-button"
                                data-mdb-ripple-color="dark">حجز</button>
                        @endif

                        @if ($offer->reservation && !$offer->sale)
                            <button type="button" class="btn btn-outline-danger " data-mdb-toggle="modal"
                                data-mdb-target="#creator-offer-reservation-button" wire:click="viewReservation"
                                data-mdb-ripple-color="dark">رؤية
                                الحجز</button>
                        @endif

                        @if (!$offer->sale)
                            <button type="button" class="btn btn-outline-primary" data-mdb-toggle="modal"
                                data-mdb-target="#creator-sale-button" wire:click="setClientOfferReservation"
                                data-mdb-ripple-color="dark">بيع</button>
                        @endif

                        @if ($offer->sale)
                            <a type="button" class="btn btn-outline-primary"
                                href="{{ route('panel.sales.profile', $offer->sale->id) }}">تفاصيل الصفقة</a>
                        @endif

                    </div>

                    <div class="col-md-8">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <div class="me-auto p-2">
                                    <h6>معلومات العرض</h6>
                                </div>

                                @if ($offer->reservation && !$offer->sale)
                                    <div class="p-2">
                                        <button class="btn btn-sm btn-outline-danger" data-mdb-toggle="modal"
                                            data-mdb-target="#" wire:click="cancelReservation"
                                            data-mdb-ripple-color="dark">
                                            <i class="far fa-pen-to-square"></i> إلغاء الحجز
                                        </button>
                                    </div>
                                @endif

                            </div>
                            <hr class="mt-0 mb-4">

                            <div class="row pt-1">

                                <div class="col-6">
                                    <h6><i class="fas fa-list-ol"></i> رقم الارض: </h6>
                                    <p class="text-muted">{{ $offer->land_number }}</p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-list-ol"></i> رقم البلوك: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $offer->block_number }}</span>
                                    </p>
                                </div>


                                <div class="col-6">
                                    <h6><i class="fab fa-searchengin"></i> المدينة: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $offer->city_name }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-warehouse"></i> الحي: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $offer->neighborhood_name }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-pen-clip"></i> بيان العقار: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $offer->statement }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="far fa-building"></i> نوع العقار</h6>
                                    <p class="text-muted"><span dir="ltr">{{ __($offer->property_type) }}</span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            @if ($offer->brokers->count() > 0)

                <div class="row">

                    <div class="col-md-12">
                        <div class="card mb-4 mb-md-0">

                            <div class="card-body">
                                <h6>الوسطاء</h6>
                                <hr class="mt-0 mb-4">

                                <ul class="timeline" wire:ignore.self="">


                                    @foreach ($offer->brokers as $broker)
                                        <li class="timeline-item">
                                            <span
                                                class="timeline-point timeline-point-success timeline-point-indicator "></span>
                                            <div class="timeline-event">
                                                <div
                                                    class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                    <h6>{{ $broker->name }}</h6>
                                                    {{-- <span
                                                    class="timeline-event-time ">{{ $this->getLastUpateOfferEditTime($broker->id) }}</span> --}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            @endif

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

                        @if ($offer->property_type == 'flat')
                            <div class="col-3">
                                <h6><i class="fas fa-chart-area"></i> المساحة: </h6>
                                <p class="text-muted">{{ $offer->space }} متر</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالكامل: </h6>
                                <p class="text-muted">{{ $offer->total }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-code-branch"></i> الفرع</h6>
                                <p class="text-muted">{{ $offer->branch_name }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عدد غرف الشقة</h6>
                                <p class="text-muted">{{ $offer->flat_rooms }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عدد دورات المياه</h6>
                                <p class="text-muted">{{ $offer->bathrooms }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عمر العقار</h6>
                                <p class="text-muted">{{ $offer->age }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> رقم الطابق</h6>
                                <p class="text-muted">{{ $offer->floor }}</p>
                            </div>
                        @endif

                        @if ($offer->property_type == 'duplex')
                            <div class="col-3">
                                <h6><i class="fas fa-chart-area"></i> المساحة: </h6>
                                <p class="text-muted">{{ $offer->space }} متر</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالكامل: </h6>
                                <p class="text-muted">{{ $offer->total }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-code-branch"></i> الفرع</h6>
                                <p class="text-muted">{{ $offer->branch_name }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-earth-oceania"></i> نوع الأرض: </h6>
                                <p class="text-muted">{{ __($offer->land_type) }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-id-badge"></i> الترخيص </h6>
                                <p class="text-muted">{{ __($offer->licensed) }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> طول الواجهة</h6>
                                <p class="text-muted">{{ $offer->interface_length }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> حالة العقار</h6>
                                <p class="text-muted">{{ $offer->real_estate_status_name }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عمر العقار</h6>
                                <p class="text-muted">{{ $offer->age }} سنة</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> الحرف او المجاور</h6>
                                <p class="text-muted">{{ $offer->character }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> نوع البناء</h6>
                                <p class="text-muted">{{ __($offer->building_type) }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> حالة البناء</h6>
                                <p class="text-muted">{{ __($offer->building_status) }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> تسليم البناء</h6>
                                <p class="text-muted">{{ __($offer->construction_delivery) }}</p>
                            </div>
                        @endif

                        @if ($offer->property_type == 'chalet')
                            <div class="col-3">
                                <h6><i class="fas fa-chart-area"></i> المساحة: </h6>
                                <p class="text-muted">{{ $offer->space }} متر</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالكامل: </h6>
                                <p class="text-muted">{{ $offer->total }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-street-view"></i> الاتجاهات: </h6>
                                <p class="text-muted">
                                    <x-dropdowns :models="json_decode($offer->directions)" :title="'الاتجاهات'" />
                                </p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-road"></i> عروض الشوارع:</h6>
                                <p class="text-muted">
                                    <x-dropdowns :models="json_decode($offer->street_width)" :title="'عروض الشوارع'" />
                                </p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-code-branch"></i> الفرع</h6>
                                <p class="text-muted">{{ $offer->branch_name }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عمر العقار</h6>
                                <p class="text-muted">{{ $offer->age }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> نوع الملكية</h6>
                                <p class="text-muted">{{ '1' }}</p>
                            </div>
                        @endif

                        @if ($offer->property_type == 'condominium')
                            <div class="col-3">
                                <h6><i class="fas fa-chart-area"></i> المساحة: </h6>
                                <p class="text-muted">{{ $offer->space }} متر</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالكامل: </h6>
                                <p class="text-muted">{{ $offer->total }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-code-branch"></i> الفرع</h6>
                                <p class="text-muted">{{ $offer->branch_name }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عدد غرف الشقة</h6>
                                <p class="text-muted">{{ $offer->flat_rooms }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عمر العقار</h6>
                                <p class="text-muted">{{ $offer->age }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عدد الطوابق</h6>
                                <p class="text-muted">{{ $offer->floors }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عدد الشقق</h6>
                                <p class="text-muted">{{ $offer->flats }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> عدد المحلات</h6>
                                <p class="text-muted">{{ $offer->stores }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i>الدخل السنوي</h6>
                                <p class="text-muted">{{ $offer->annual_income }}</p>
                            </div>
                        @endif

                        @if (in_array($offer->property_type, ['land']))
                            <div class="col-3">
                                <h6><i class="fas fa-chart-area"></i> المساحة: </h6>
                                <p class="text-muted">{{ $offer->space }} متر</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالمتر: </h6>
                                <p class="text-muted">{{ $offer->price_meter }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالكامل: </h6>
                                <p class="text-muted">{{ $offer->total }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-street-view"></i> الاتجاهات: </h6>
                                <p class="text-muted">
                                    <x-dropdowns :models="json_decode($offer->directions)" :title="'الاتجاهات'" />
                                </p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-road"></i> عروض الشوارع:</h6>
                                <p class="text-muted">
                                    <x-dropdowns :models="json_decode($offer->street_width)" :title="'عروض الشوارع'" />
                                </p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> نوع الارض: </h6>
                                <p class="text-muted">{{ __($offer->land_type) }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> الترخيص</h6>
                                <p class="text-muted">{{ __($offer->licensed) }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> الحرف او المجاور</h6>
                                <p class="text-muted">{{ $offer->character }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> طول الواجهة</h6>
                                <p class="text-muted">{{ $offer->interface_length }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-code-branch"></i> الفرع</h6>
                                <p class="text-muted">{{ $offer->branch_name }}</p>
                            </div>
                        @endif

                        @if (in_array($offer->property_type, ['warehouse_land', 'agircultural_land', 'industrial_land', 'residential_land']))
                            <div class="col-3">
                                <h6><i class="fas fa-chart-area"></i> المساحة: </h6>
                                <p class="text-muted">{{ $offer->space }} متر</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالمتر: </h6>
                                <p class="text-muted">{{ $offer->price_meter }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-dollar-sign"></i> السعر بالكامل: </h6>
                                <p class="text-muted">{{ $offer->total }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-road"></i> عروض الشوارع:</h6>
                                <p class="text-muted">
                                    <x-dropdowns :models="json_decode($offer->street_width)" :title="'عروض الشوارع'" />
                                </p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-id-badge"></i> الترخيص</h6>
                                <p class="text-muted">{{ __($offer->licensed) }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-c"></i> الحرف او المجاور</h6>
                                <p class="text-muted">{{ $offer->character }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="far fa-building"></i> طول الواجهة</h6>
                                <p class="text-muted">{{ $offer->interface_length }}</p>
                            </div>

                            <div class="col-3">
                                <h6><i class="fas fa-code-branch"></i> الفرع</h6>
                                <p class="text-muted">{{ $offer->branch_name }}</p>
                            </div>
                        @endif

                        <div class="col-12">
                            <h6><i class="fas fa-align-justify"></i> ملاحظات على الطلب: </h6>
                            <textarea cols="30" class="w-100" disabled>{{ $offer->notes }}</textarea>
                        </div>

                    </div>
                </div>
            </div>


            @can('superadmin', 'App\\Models\User')
                <div class="row" wire:ignore.self>
                    <div class="col-md-12" wire:ignore.self>
                        <div class="card mb-4 mb-md-0" wire:ignore.self>

                            <div class="card-body" wire:ignore.self>
                                <h6>التعديلات على العرض</h6>
                                <hr class="mt-0 mb-4">

                                <ul class="timeline" wire:ignore.self="">

                                    @foreach ($offer_edits as $offer_edit)
                                        <li class="timeline-item">
                                            <span
                                                class="timeline-point timeline-point-success timeline-point-indicator "></span>
                                            <div class="timeline-event">
                                                <div
                                                    class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1 ">
                                                    <h6>{{ $offer_edit->user_name }}</h6>
                                                    <span
                                                        class="timeline-event-time ">{{ $offer_edit->created_at->format('Y-m-d') }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1"
                                                    wire:ignore.self="">
                                                    <h6>{{ $offer_edit->note }}</h6>
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

    <div class="modal top fade" id="creator-offer-reservation-button" tabindex="-1" data-mdb-backdrop="static"
        aria-labelledby="Creator" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg cascading-modal" style="margin-top: 4%">

            <div class="modal-content">

                <div class="modal-c-tabs">

                    <x-creator.nav-tabs :tabs="$tabs"></x-creator.nav-tabs>

                    <div class="tab-content">
                        <x-table-extension.loading></x-table-extension.loading>

                        @foreach ($contents as $content)
                            <div class="tab-pane fade in {{ $content['status'] }} nav-tabs-custom-creator {{ $content['id'] . '-' . 'creator-tap' }}"
                                id="{{ $content['id'] }}" role="tabpanel">

                                <div class="modal-body">
                                    <div class="row">
                                        @foreach ($content['inputs'] as $input)
                                            <x-creator.inputs :input="$input" :size="$size" :classsize="'col-md-6'"
                                                :creatorid="'creator-offer-reservation-button'">
                                            </x-creator.inputs>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn bg-brown-color" data-mdb-dismiss="modal">
                                        إغلاق
                                    </button>

                                    <button type="button"
                                        class="btn text-white brown-color submitProfileCreator">حفظ</button>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    @livewire('creator', ['service' => 'SalesService', 'offer_id' => $offer->id])

    @push('creator-reservation')
        <script>
            $(document).ready(function() {

                var $bank_select_id_profile_creator_div = $(".bank_profile_select_id_creator_div");
                var $check_number_input_id_profile_creator_div = $(".check_number_profile_input_id_creator_div");
                var $recipient_name_input_id_profile_creator_div = $(".recipient_name_profile_input_id_creator_div");

                $bank_select_id_profile_creator_div.hide();
                $check_number_input_id_profile_creator_div.hide();
                $recipient_name_input_id_profile_creator_div.hide();

                //Buttons
                var $submitProfileCreator = $(".submitProfileCreator");

                //Inputs
                var $inputTextProfileCreator = $(".inputProfileTextCreator");
                var $inputSelectProfileCreator = $(".inputProfileSelectCreator");
                var $checkboxInputProfileCreator = $(".checkboxProfileInputCreator");

                //Data
                var $profile_data = [];

                var dateFromInput = document.querySelector('.date_from_profile_input_id_creator_dateInput');
                dateFromInput.addEventListener('dateChange.mdb.datepicker', function(e) {
                    let input = e.target.childNodes[1];
                    let id = "#" + input.id;
                    let value = input.value;
                    let name = input.name;
                    @this.set(name, value);
                    setProfileInput(name, value);
                });

                var dateToInput = document.querySelector('.date_to_profile_input_id_creator_dateInput');
                dateToInput.addEventListener('dateChange.mdb.datepicker', function(e) {
                    let input = e.target.childNodes[1];
                    let id = "#" + input.id;
                    let value = input.value;
                    let name = input.name;
                    @this.set(name, value);
                    setProfileInput(name, value);
                });

                //Functions
                function setProfileInput($name, $value) {
                    $profile_data[$name] = $value;
                }

                function getProfileContent() {
                    var $object = Object.assign({}, $profile_data);
                    return JSON.stringify($object);
                }

                function numbers($name, $value) {

                    if ($value) {

                        let string_number = $value.replace(/[^\d.]/g, "");

                        if (string_number.match(/\./g)) {
                            if (string_number.match(/\./g).length > 1) {
                                string_number = string_number.replace(/,/g, "").replace(/\.(?=.*\.)/g,
                                    "");
                            }
                        }
                        let number = parseFloat(string_number.replace(/,/g, ""));
                        return number;
                    }
                }

                //Events
                $inputTextProfileCreator.on("input", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
                    setProfileInput($name, $value);

                    if ($name == "price") {
                        $check = $value.slice(-1);
                        if ($check == ".") {
                            $(this).val($value);
                        } else {
                            let result = numbers($name, $value);
                            if (result) {
                                $(this).val(result.toLocaleString());
                            } else {
                                $(this).val("0");
                            }

                            setProfileInput($name, result);
                        }
                    }
                });

                $inputSelectProfileCreator.on("change", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
                    setProfileInput($name, $value);

                    if ($name == "payment_method") {

                        $bank_select_id_profile_creator_div.hide();
                        $check_number_input_id_profile_creator_div.hide();
                        $recipient_name_input_id_profile_creator_div.hide();

                        if ($value == "cash_money") {
                            $recipient_name_input_id_profile_creator_div.show();
                        }

                        if ($value == "bank_check") {
                            $bank_select_id_profile_creator_div.show();
                            $check_number_input_id_profile_creator_div.show();
                            $recipient_name_input_id_profile_creator_div.show();
                        }

                        if ($value == "bank_transfer") {
                            $bank_select_id_profile_creator_div.show();
                            $recipient_name_input_id_profile_creator_div.show();
                        }
                    }

                });

                $submitProfileCreator.on('click', function() {
                    $(".reset-validation").text(" ");

                    for (let key in $profile_data) {
                        if ($profile_data.hasOwnProperty(key)) {
                            @this.set(key, $profile_data[key]);
                        }
                    }

                    Livewire.emit('storeReservation', getProfileContent());
                });

                Livewire.on("profile-errors", function(errors) {
                    $(".reset").text("");
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $("." + key + "-validation").text(errors[key]);
                        }
                    }
                    console.log(errors);
                });

                Livewire.on("closeProfileModal", function(errors) {
                    let $id = "#creator-offer-reservation-button";
                    $($id).modal('hide');
                    $(".reset-validation").val("");
                    $profile_data = [];
                });

                Livewire.on('profileSelect2', function(id, value, name) {
                    let $te = value + '';
                    const singleSelect = document.querySelector(id);
                    const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                    singleSelectInstance.setValue($te);

                    let $bank_select_id_creator_div = $(".bank_profile_select_id_creator_div");
                    let $check_number_input_id_creator_div = $(".check_number_profile_input_id_creator_div");
                    let $recipient_name_input_id_creator_div = $(
                        ".recipient_name_profile_input_id_creator_div");

                    if ($te == "cash_money") {
                        $recipient_name_input_id_creator_div.show();
                    }

                    if ($te == "bank_check") {
                        $bank_select_id_creator_div.show();
                        $check_number_input_id_creator_div.show();
                        $recipient_name_input_id_creator_div.show();
                    }

                    if ($te == "bank_transfer") {
                        $bank_select_id_creator_div.show();
                        $recipient_name_input_id_creator_div.show();
                    }

                });

                Livewire.on("disableForm", function() {
                    let $submitProfileCreator = $(".submitProfileCreator");

                    //Inputs
                    let $inputTextProfileCreator = $(".inputProfileTextCreator");
                    let $inputSelectProfileCreator = $(".inputProfileSelectCreator");
                    let $checkboxInputProfileCreator = $(".checkboxProfileInputCreator");

                    $inputTextProfileCreator.prop("disabled", true);
                    $inputSelectProfileCreator.prop("disabled", true);
                    $checkboxInputProfileCreator.prop("disabled", true);
                    $submitProfileCreator.prop("disabled", true);
                });

                Livewire.on("enableForm", function() {

                    let $submitProfileCreator = $(".submitProfileCreator");

                    //Inputs
                    let $inputTextProfileCreator = $(".inputProfileTextCreator");
                    let $inputSelectProfileCreator = $(".inputProfileSelectCreator");
                    let $checkboxInputProfileCreator = $(".checkboxProfileInputCreator");

                    $inputTextProfileCreator.prop("disabled", false);
                    $inputSelectProfileCreator.prop("disabled", false);
                    $checkboxInputProfileCreator.prop("disabled", false);
                    $inputTextProfileCreator.val("");
                    $inputSelectProfileCreator.val("");
                    $checkboxInputProfileCreator.prop("checked", false);
                    $submitProfileCreator.prop("disabled", false);
                });


            });
        </script>
    @endpush


</div>
