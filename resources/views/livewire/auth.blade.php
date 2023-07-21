<div wire:ignore>
    @include('partials.web.modals.login-register')

    @push('login_register_script')
        <script>
            $(document).ready(function() {

                // Login
                var $email_phone_login = "";
                var $password_login = "";

                //Register
                var $email_register = "";
                var $password_register = "";
                var $phone_register = "";
                var $name_register = "";

                //Fields Login
                var $email_phone_login_field = $(".email-phone-login");
                var $password_login_field = $(".password-login");

                //Fields Register
                var $email_register_field = $(".email-register");
                var $password_register_field = $(".password-register");
                var $phone_register_field = $(".phone-register");
                var $name_register_field = $(".name-register");

                //Fields Validation Login
                var $login_phone_email_validation_message = $(".login_phone_email_validation_message");
                var $login_password_validation_message = $(".login_password_validation_message");

                //Fields Validation Register
                var $register_email_validation_message = $(".register_email_validation_message");
                var $register_phone_validation_message = $(".register_phone_validation_message");
                var $register_password_validation_message = $(".register_password_validation_message");
                var $register_name_validation_message = $(".register_name_validation_message");

                //Buttons
                var $send_login = $(".send-login");
                var $send_register = $(".send-register");
                var $logout = $(".logout");

                //Actions
                $email_phone_login_field.on('input', function() {
                    var $user_action = $(this);
                    $email_phone_login = $user_action.val();
                    if ($email_phone_login.startsWith("05")) {
                        $user_action.attr('maxlength', 10);
                    } else {
                        $user_action.attr('maxlength', 35);
                    }
                });

                $password_login_field.on('input', function() {
                    var $user_action = $(this);
                    $password_login = $user_action.val();
                });

                $email_register_field.on('input', function() {
                    var $user_action = $(this);
                    $email_register = $user_action.val();
                });

                $password_register_field.on('input', function() {
                    var $user_action = $(this);
                    $password_register = $user_action.val();
                });

                $phone_register_field.on('input', function() {
                    var $user_action = $(this);
                    $phone_register = $user_action.val();
                    if ($phone_register.startsWith("05")) {
                        $user_action.attr('maxlength', 10);
                    } else {
                        $user_action.attr('maxlength', 35);
                    }
                });

                $name_register_field.on('input', function() {
                    var $user_action = $(this);
                    $name_register = $user_action.val();
                });

                //Register Progress
                $send_register.on('click', function() {
                    $res = register_validation();
                    console.log("4567890");
                    if ($res) {
                        @this.set('email_register', $email_register);
                        @this.set('password_register', $password_register);
                        @this.set('phone_register', $phone_register);
                        @this.set('name_register', $name_register);
                        Livewire.emit('register');
                    }
                });

                //Login Progress
                $send_login.on('click', function() {
                    $res = login_validation();

                    if ($res) {
                        @this.set('email_phone_login', $email_phone_login);
                        @this.set('password_login', $password_login);
                        Livewire.emit('login');
                    }
                });

                //Logout Progress
                $logout.on('click', function() {
                    console.log("login_register_script");
                    Livewire.emit('logout');
                });

                // Update Validation
                Livewire.on('update_email_phone_login', function(message) {
                    $login_phone_email_validation_message.text("");
                    $login_phone_email_validation_message.text(message);
                });

                Livewire.on('update_password_login', function(message) {
                    $login_password_validation_message.text("");
                    $login_password_validation_message.text(message);
                });

                //Validation Functions
                function login_validation() {

                    $login_phone_email_validation_message.text("");
                    $login_password_validation_message.text("");

                    if (!$email_phone_login) {
                        $login_phone_email_validation_message.text("يرجى إدخال رقم هاتف او ايميل !");
                        return false;
                    }

                    if ($email_phone_login) {

                        // if (!$email_phone_login.startsWith("05") && !$email_phone_login.startsWith("5")) {
                        //     let position = $email_phone_login.search("@");
                        //     if (position == -1) {
                        //         $login_phone_email_validation_message.text("يرجى إدخال بريد الكتروني صحيح");
                        //     }
                        //     return false;
                        // }

                        if ($email_phone_login.startsWith("05")) {
                            if ($email_phone_login.length != 10) {
                                $login_phone_email_validation_message.text("رقم الهاتف يتكون من 10 ارقام فقط لا غير");
                                return false;
                            }
                        }
                    }

                    if (!$password_login) {
                        $login_password_validation_message.text("يرجى إدخال كلمة المرور");
                        return false;
                    }

                    $login_phone_email_validation_message.text("");
                    $login_password_validation_message.text("");
                    return true;
                }

                function register_validation() {

                    $register_email_validation_message.text("");
                    $register_phone_validation_message.text("");
                    $register_password_validation_message.text("");
                    $register_name_validation_message.text("");

                    if (!$name_register) {
                        $register_name_validation_message.text("يرجى إدخال الاسم");
                        return false;
                    }

                    if (!$email_register) {
                        $register_email_validation_message.text("يرجى إدخال البريد الالكتروني");
                        return false;
                    }

                    if ($email_register) {

                        if (!$email_register.startsWith("05")) {
                            let position = $email_register.search("@");
                            if (position == -1) {
                                $register_email_validation_message.text("يرجى إدخال بريد الكتروني صحيح");
                                return false;
                            }
                        }
                    }

                    if (!$phone_register) {
                        $register_phone_validation_message.text("يرجى إخال رقم الهاتف");
                        return false;
                    }

                    if ($phone_register) {
                        if ($phone_register.startsWith("05")) {
                            if ($phone_register.length != 10) {
                                $register_phone_validation_message.text("رقم الهاتف يتكون من 10 ارقام فقط لا غير");
                                return false;
                            }
                        } else {
                            $register_phone_validation_message.text("رقم الهاتف يجب ان يبدأ ب 05");
                            return false;
                        }
                    }

                    if (!$password_register) {
                        $register_password_validation_message.text("يرجى إدخال كلمة السر");
                        return false;
                    }

                    return true;
                }

            });
        </script>
    @endpush

</div>
