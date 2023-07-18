<div class="row d-flex align-items-center h-100">
    <div class="col col-lg-12 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">


                <div class="col-md-2 gradient-custom text-center"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="Avatar"
                        class="img-fluid my-5" style="width: 80px;" />
                    <h5>العميل</h5>
                    <p>{{ $client->name }}</p>
                    {{-- <i class="far fa-edit mb-5"></i> --}}
                </div>


                <div class="col-md-10">

                    <div class="card-body p-4">

                        <h6>معلومات العميل</h6>
                        <hr class="mt-0 mb-4">

                        <div class="row pt-0">
                            <div class="col-3 mb-3">

                                <h6><i class="fas fa-at"></i> الايميل</h6>
                                <p class="text-muted"><span dir="ltr">{{ $client->email }}</span></p>
                            </div>
                            <div class="col-3 mb-3">
                                <h6><i class="fas fa-phone"></i> رقم الهاتف</h6>
                                <p class="text-muted"> <span dir="ltr"> +966 {{ $client->phone }}</span></p>
                            </div>
                            <div class="col-3 mb-3">
                                <h6><i class="fas fa-city"></i> المدينة</h6>
                                <p class="text-muted">{{ $client->city_name }}</p>
                            </div>
                            <div class="col-3 mb-3">
                                <h6><i class="fas fa-briefcase"></i> قطاع العمل</h6>
                                <p class="text-muted">{{ $client->employment_type_name }}</p>
                            </div>
                        </div>


                        {{-- <h6>Projects</h6>
                        <hr class="mt-0 mb-4">

                        <div class="row pt-1">
                            <div class="col-3 mb-3">
                                <h6>Recent</h6>
                                <p class="text-muted">Lorem ipsum</p>
                            </div>
                            <div class="col-3 mb-3">
                                <h6>Most Viewed</h6>
                                <p class="text-muted">Dolor sit amet</p>
                            </div>
                        </div> --}}

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
