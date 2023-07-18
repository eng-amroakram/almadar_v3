<div>

    <div class="row">
        <div class="col-lg-12" wire:ignore.self>
            <div class="card mb-3" style="border-radius: .5rem;" wire:ignore.self>
                <div class="row g-0" wire:ignore.self>
                    <div class="col-md-4 gradient-custom text-center text-white"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;" wire:ignore.self>
                        <img src="{{ asset('assets/images/order.png') }}" alt="Avatar" class="img-fluid my-5"
                            style="width: 80px;" />
                        <h5 class="text-dark">كود الصفقة</h5>
                        <p class="text-dark">{{ $sale->sale_code }}</p>
                    </div>

                    <div class="col-md-8">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <div class="me-auto p-2">
                                    <h5 class="fw-bold">معلومات العقار الاساسية</h6>
                                </div>
                                <div class="p-2">
                                    <button type="button" class="btn btn-sm fw-bold btn-outline-danger"
                                        data-mdb-toggle="modal" data-mdb-target="#updater-sale-button"
                                        data-mdb-ripple-color="dark"
                                        wire:click="$emit('updater','SalesProfileService', {{ $sale_id }})">
                                        <i class="far fa-pen-to-square"></i> تعديل معلومات الصفقة</button>
                                </div>
                            </div>

                            <hr class="mt-0 mb-4">

                            <div class="row pt-1">

                                <div class="col-6">
                                    <h6><i class="fas fa-building"></i> نوع العقار: </h6>
                                    <p class="text-muted ">{{ $sale->offer->real_estate_type_name }}</p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-list-ol"></i> رقم البلوك: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->offer->block_number }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-list-ol"></i> رقم الارض: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->offer->land_number }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-city"></i> المدينة: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->buyer->city_name }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-chart-area"></i> مساحة العقار: </h6>
                                    <p class="text-muted"><span
                                            dir="ltr">{{ number_format($sale->offer->space) }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-dollar-sign"></i> سعر العقار</h6>
                                    <p class="text-muted"><span
                                            dir="ltr">{{ number_format($sale->offer->total) }}</span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-6" wire:ignore.self>
            <div class="card mb-3" style="border-radius: .5rem;" wire:ignore.self>
                <div class="row g-0" wire:ignore.self>
                    <div class="col-md-12">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <div class="me-auto p-2">
                                    <h5 class="fw-bold">معلومات العميل المشتري</h6>
                                </div>

                            </div>

                            <hr class="mt-0 mb-4">

                            <div class="row pt-1">

                                <div class="col-6">
                                    <h6><i class="fas fa-circle-user"></i> الاسم: </h6>
                                    <p class="text-muted">{{ $sale->buyer->name }}</p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-square-phone-flip"></i> رقم الهاتف: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->buyer->phone }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-list-ol"></i> رقم الهوية: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->buyer->id_number }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-city"></i> المدينة: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->buyer->city_name }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-briefcase"></i> التوظيف: </h6>
                                    <p class="text-muted"><span
                                            dir="ltr">{{ $sale->buyer->employment_type_name }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-briefcase"></i> جهة التوظيف: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->buyer->employer }}</span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6" wire:ignore.self>
            <div class="card mb-3" style="border-radius: .5rem;" wire:ignore.self>
                <div class="row g-0" wire:ignore.self>

                    <div class="col-md-12">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <div class="me-auto p-2">
                                    <h5 class="fw-bold">معلومات العميل البائع</h5>
                                </div>
                            </div>

                            <hr class="mt-0 mb-4">

                            <div class="row pt-1">

                                <div class="col-6">
                                    <h6><i class="fas fa-circle-user"></i> الاسم: </h6>
                                    <p class="text-muted">{{ $sale->seller->name }}</p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-square-phone-flip"></i> رقم الهاتف: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->seller->phone }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-list-ol"></i> رقم الهوية: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->seller->id_number }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-city"></i> المدينة: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->seller->city_name }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-briefcase"></i> التوظيف: </h6>
                                    <p class="text-muted"><span
                                            dir="ltr">{{ $sale->seller->employment_type_name }}</span>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <h6><i class="fas fa-briefcase"></i> جهة التوظيف: </h6>
                                    <p class="text-muted"><span dir="ltr">{{ $sale->seller->employer }}</span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-6" wire:ignore.self>
            <div class="card mb-3" style="border-radius: .5rem;" wire:ignore.self>
                <div class="row g-0" wire:ignore.self>
                    <div class="col-md-12">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <div class="me-auto p-2">
                                    <h5 class="fw-bold">عربون عملية الدفع الاخيرة</h5>
                                </div>
                                <div class="p-2">
                                    <button type="button" class="btn btn-sm fw-bold btn-outline-success"
                                        data-mdb-toggle="modal" data-mdb-target="#creator-add-commission-button"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-hand-holding-dollar"></i> مبلغ السعي</button>
                                </div>
                            </div>

                            <hr class="mt-0 mb-4">

                            <div class="row pt-1">
                                {{-- <x-table-extension.loading></x-table-extension.loading> --}}
                                <iframe id="#deposit" src="{{ $deposit }}" width="100%" height="570px">
                                </iframe>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6" wire:ignore.self>
            <div class="card mb-3" style="border-radius: .5rem;" wire:ignore.self>
                <div class="row g-0" wire:ignore.self>
                    <div class="col-md-12">
                        <div class="card-body p-4">

                            <div class="d-flex">
                                <div class="me-auto p-2">
                                    <h5 class="fw-bold">صفقة البيع</h4>
                                </div>
                                <div class="p-2">
                                    <button type="button" class="btn btn-sm fw-bold btn-outline-success"
                                        data-mdb-toggle="modal"
                                        wire:click="$emit('setSalePaymentBuyerCreator', {{ $sale->id }})"
                                        data-mdb-target="#creator-new-sale-payment-button"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-hand-holding-dollar"></i> دفعة جديدة</button>
                                </div>
                            </div>

                            <hr class="mt-0 mb-4">

                            <div class="row pt-1">
                                {{-- <x-table-extension.loading></x-table-extension.loading> --}}
                                <iframe id="#madar" src="{{ $madar }}" width="100%" height="570px">
                                </iframe>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('updater', ['service' => 'SalesProfileService', 'offer_id' => $sale->offer_id])
    @livewire('creator', ['service' => 'SalePaymentService'])


    @push('pdf-service')
        <script>
            $(document).ready(function() {

                Livewire.on('set-pdf-file', function(path, id) {
                    $(id).attr('src', path);
                    console.log(path);
                    console.log(path);
                    console.log(path);
                    console.log(path);
                    console.log(id);
                    console.log(id);
                    console.log(id);
                    console.log(id);
                    console.log(id);
                });

            });
        </script>
    @endpush
</div>
