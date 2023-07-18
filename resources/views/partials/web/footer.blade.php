<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold fs-3 mb-4">
                        <img src="{{ asset('assets/images/logo.png') }}" height="60" alt="Almadar Logo" loading="lazy" />
                        المدار الواعد
                    </h6>
                    <p>
                        منصة عقارية سعودية لبيع وحجز العقارات داخل المملكة السعودية
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        الخدمات المتوفرة
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">تسويق العقارات</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">حجز العقارات</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">بيع وشراء العقارات</a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        تعليمات الاستخدام
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">سياسية الخصوصية</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">الشروط والاستخدام</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div dir="ltr" class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">تواصل معنا</h6>
                    <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@example.com
                    </p>
                    <p ><i class="fas fa-phone me-3"></i> + 966 50 585 9599</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2023 المدار الواعد:
        <a class="text-reset fw-bold" href="{{ route('web.index') }}">جميع الحقوق محفوظة لمنصة</a>
    </div>
    <!-- Copyright -->
</footer>

@include('partials.web.scripts')
@livewire('auth')
@stack('login_register_script')
@livewireScripts
</body>
</html>
