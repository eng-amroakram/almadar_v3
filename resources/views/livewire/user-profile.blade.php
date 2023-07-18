<div class="row d-flex align-items-center h-100">
    <div class="col col-lg-12 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">

                <div class="col-md-2 gradient-custom text-center"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="Avatar"
                        class="img-fluid my-5" style="width: 80px;" />
                    <h5>المستخدم</h5>
                    <p>{{ $user->name }}</p>
                    {{-- <i class="far fa-edit mb-5"></i> --}}
                </div>

                <div class="col-md-10">

                    <div class="card-body p-4">

                        <h6>معلومات العميل</h6>
                        <hr class="mt-0 mb-4">

                        <div class="row pt-0">

                            <div class="col-4 mb-3">
                                <h6><i class="fas fa-at"></i> الايميل</h6>
                                <p class="text-muted"><span dir="ltr">{{ $user->email }}</span></p>
                            </div>

                            <div class="col-4 mb-3">
                                <h6><i class="fas fa-phone"></i> رقم الهاتف</h6>
                                <p class="text-muted"> <span dir="ltr"> +966 {{ $user->phone }}</span></p>
                            </div>

                            <div class="col-4 mb-3">
                                <h6><i class="fas fa-elevator"></i> نوع المستخدم</h6>
                                <p class="text-muted">{{ $user->type }}</p>
                            </div>

                        </div>

                        <h6>الطلبات</h6>
                        <hr class="mt-0 mb-4">

                        <div class="row pt-1">
                            <div class="col-3 mb-3">
                                <h6><i class="fas fa-store"></i> العدد الكلي للطلبات</h6>
                                <p class="text-muted">{{ user_orders_count('all') }}</p>
                            </div>
                            <div class="col-3 mb-3">
                                <h6><i class="fas fa-bag-shopping"></i> الطلبات المفتوحة</h6>
                                <p class="text-muted">{{ user_orders_count('new') }}</p>
                            </div>
                            <div class="col-3 mb-3">
                                <h6><i class="fas fa-basket-shopping"></i> الطلبات المكتملة</h6>
                                <p class="text-muted">{{ user_orders_count('linked_to_offer') }}</p>
                            </div>
                            <div class="col-3 mb-3">
                                <h6><i class="fas fa-store-slash"></i> الطلبات المغلقة</h6>
                                <p class="text-muted">{{ user_orders_count('closed') }}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                            <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                            <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
