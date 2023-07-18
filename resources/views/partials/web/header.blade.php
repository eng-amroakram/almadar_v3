<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 0.0rem 1rem;">
        <div class="container">

            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand mt-2 mt-lg-0" href="#">
                    <img src="{{ asset('assets/images/logo.png') }}" height="60" alt="Almadar Logo" loading="lazy" />
                </a>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item hover-shadow w3-hover-brown">
                        <a class="nav-link fw-bold" href="#">لوحة التحكم</a>
                    </li>
                    <li class="nav-item hover-shadow w3-hover-brown">
                        <a class="nav-link fw-bold" href="#">فريق المنصة</a>
                    </li>
                    <li class="nav-item hover-shadow w3-hover-brown">
                        <a class="nav-link fw-bold" href="#">حول المنصة</a>
                    </li>
                </ul>

            </div>

            @guest
                <div class="d-flex align-items-center">
                    <a type="button" class="btn text-white" data-toggle="modal" data-target="#LoginRegisterForm"
                        style="background-color: rgb(139 107 75); font-size: 14px;" href="#!" role="button">
                        <i class="far fa-circle-user me-2" style="font-size: 16px;"></i>
                        تسجيل الدخول
                    </a>
                </div>
            @endguest

            @auth
                <div class="d-flex align-items-center">
                    <div class="dropdown">

                        <a class="text-reset me-3 dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li class="logout">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-arrow-right-from-bracket text-danger"></i>
                                    <span class="ms-1">تسجيل الخروج</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

        </div>
    </nav>

    <div class="p-5 text-center bg-image"
        style=" background-image: url('{{ asset('assets/images/realestate_background.jpg') }}'); height: 650px;">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-3">المدار العقارية</h1>
                    <h4 class="mb-3">منصة المدار الواعد العقارية</h4>
                    <a class="btn btn-outline-light btn-lg" href="#!" role="button">إضافة عقار</a>
                    <a class="btn btn-outline-light btn-lg" href="#!" role="button">حجز عقار</a>
                    <a class="btn btn-outline-light btn-lg" href="#!" role="button">شراء عقار</a>
                </div>
            </div>
        </div>
    </div>

</header>
