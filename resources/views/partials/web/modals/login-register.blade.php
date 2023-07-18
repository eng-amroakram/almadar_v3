<div class="modal fade" id="LoginRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!-- Content -->
        <div class="modal-content">

            <!-- Modal cascading tabs -->
            <div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav md-tabs tabs-2" role="tablist" style="background-color: rgb(139, 107, 75);">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#panel17" role="tab">
                            <i class="fas fa-user mr-1"></i>
                            Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panel18" role="tab"><i
                                class="fas fa-user-plus mr-1"></i>
                            Register</a>
                    </li>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content">

                    <div class="mask" style="background-color: rgba(191, 144, 68, 0.5); z-index:1;" wire:loading>
                        <div
                            class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h4>جاري التحميل يرجى الانتظار ...</h4>
                        </div>
                    </div>
                    <!-- Panel 17 -->
                    <div class="tab-pane fade in show active" id="panel17" role="tabpanel">

                        <!-- Body -->
                        <div class="modal-body mb-1" style="text-align: right;">

                            <div class="input-group">
                                <span class="input-group-text" id="email_or_phone">
                                    <i class="fas fa-user mr-1"></i>
                                </span>
                                <input type="text" dir="rtl" class="form-control email-phone-login"
                                    id="email_or_phone" placeholder="الايميل / رقم الجوال"
                                    aria-describedby="email_or_phone" />
                            </div>
                            <small class="text-danger login_phone_email_validation_message pr-5 fw-bold"
                                style="display: block;"></small>

                            <div class="input-group mt-3">
                                <span class="input-group-text" id="password">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" dir="rtl" class="form-control password-login"
                                    id="password_login" placeholder="كلمة المرور" aria-describedby="password" />
                            </div>
                            <small class="text-danger login_password_validation_message pr-5 fw-bold"
                                style="display: block;"></small>

                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" style="background-color: rgb(139, 107, 75); color:white;"
                                class="btn send-login">إرسال</button>
                        </div>

                    </div>
                    <!-- Panel 7 -->

                    <!-- Panel 18 -->
                    <div class="tab-pane fade" id="panel18" role="tabpanel">

                        <!-- Body -->
                        <div class="modal-body" style="text-align: right;">

                            <div class="input-group">
                                <span class="input-group-text" id="name">
                                    <i class="fas fa-address-card"></i>
                                </span>
                                <input type="text" dir="rtl" class="form-control name-register"
                                    id="name_register" placeholder="الاسم" aria-describedby="name" />
                            </div>
                            <small class="text-danger register_name_validation_message pr-5 fw-bold"
                                style="display: block;"></small>

                            <div class="input-group mt-3">
                                <span class="input-group-text" id="email">
                                    <i class="fas fa-at"></i>
                                </span>
                                <input type="text" dir="rtl" class="form-control email-register"
                                    id="email_register" placeholder="الايميل" aria-describedby="email" />
                            </div>
                            <small class="text-danger register_email_validation_message pr-5 fw-bold"
                                style="display: block;"></small>

                            <div class="input-group mt-3">
                                <span class="input-group-text" id="phone">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" dir="rtl" class="form-control phone-register"
                                    id="phone_register" placeholder="رقم الجوال" aria-describedby="phone" />
                            </div>
                            <small class="text-danger register_phone_validation_message pr-5 fw-bold"
                                style="display: block;"></small>


                            <div class="input-group mt-3">
                                <span class="input-group-text" id="password">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" dir="rtl" class="form-control password-register"
                                    id="password_register" placeholder="كلمة المرور" aria-describedby="password" />
                            </div>
                            <small class="text-danger register_password_validation_message pr-5 fw-bold"
                                style="display: block;"></small>

                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" style="background-color: rgb(139, 107, 75); color:white;"
                                class="btn send-register">إرسال</button>
                        </div>
                    </div>
                    <!-- Panel 8 -->
                </div>

            </div>
        </div>
        <!-- Content -->
    </div>
</div>
