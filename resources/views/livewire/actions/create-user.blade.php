<div class="container" wire:ignore>
    <h3>إنشاء مستخدم جديد</h3>

    <div class="row mt-3">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">بيانات المستخدم</h3>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="far fa-user"></i>
                            </span>
                            <input type="text" maxlength="255" name="name" value="{{ old('name') }}"
                                class="form-control inputTextCreator" placeholder="اسم المستخدم" />
                        </div>
                        <small class="text-danger reset-validation name-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-at"></i>
                            </span>
                            <input type="email" maxlength="255" dir="ltr" name="email"
                                value="{{ old('email') }}" class="form-control inputTextCreator"
                                placeholder="البريد الالكتروني" />
                        </div>
                        <small class="text-danger reset-validation email-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="text" maxlength="10" dir="ltr" name="phone"
                                value="{{ old('phone') }}" class="form-control inputTextCreator"
                                placeholder="رقم الجوال" />
                            <span class="input-group-text">+966</span>
                        </div>
                        <small class="text-danger reset-validation phone-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="password" maxlength="255" name="password" value="{{ old('password') }}"
                                class="form-control inputTextCreator" placeholder="كلمة السر" />
                        </div>
                        <small class="text-danger reset-validation password-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fab fa-searchengin"></i>
                            </span>
                            <select class="select inputSelectCreator" id="branches_ids" multiple name="branches_ids"
                                data-mdb-filter="true">
                                @foreach (branches(true) as $key => $option)
                                    <option value="{{ $option }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="text-danger reset-validation branches_ids-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fab fa-searchengin"></i>
                            </span>
                            <select class="select inputSelectCreator" id="user_status" name="user_status">
                                <option value="active" selected>نشط</option>
                                <option value="inactive">غير نشط</option>
                            </select>
                        </div>
                        <small class="text-danger reset-validation user_status-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fab fa-searchengin"></i>
                            </span>
                            <select class="select inputSelectCreator" id="user_type" name="user_type">
                                <option value="admin" selected>ادمن فرعي</option>
                                <option value="office">مكتب</option>
                                <option value="marketer">مسوق</option>
                            </select>
                        </div>

                        <small class="text-danger reset-validation user_type-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3 advertiser-number-div">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-bullhorn"></i>
                            </span>

                            <input type="text" maxlength="255" name="advertiser_number"
                                value="{{ old('advertiser_number') }}"
                                class="form-control inputTextCreator advertiser-number-input"
                                placeholder="رقم المعلن" />
                        </div>
                        <small class="text-danger reset-validation advertiser_number-validation"></small>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="card card-default">

            <div class="card-header">
                <h3 class="card-title">صلاحيات المستخدم</h3>
            </div>

            <div class="card-body">
                @foreach (config('permissions.permissions') as $title => $permissions)
                    <div class="list-group mt-3">
                        <div class="list-group-item">
                            <h5 class="mb-2">{{ __($title) }}</h5>
                            <div class="row">

                                @foreach ($permissions as $permission)
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input checkboxInput" name="{{ $permission }}"
                                                type="checkbox">
                                            <label class="form-check-label">{{ __($permission) }}</label>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div class="row mt-3">
        <div>
            <button style="background-color: #a58346;"
                class="btn btn-primary w-100 create-user-submit">{{ __('Save') }}</button>
        </div>
    </div>


    @push('create-user-scripts')
        <script>
            $(document).ready(function() {
                var $advertiser_number_div = $(".advertiser-number-div");
                var $inputTextCreator = $(".inputTextCreator");
                var $createUserSubmit = $(".create-user-submit");
                var $inputSelectCreator = $(".inputSelectCreator");
                var $checkboxInput = $(".checkboxInput");
                $advertiser_number_div.hide();

                var $data = [];
                var $permissions = [];

                function setInput($name, $value) {
                    $data[$name] = $value;
                }

                function setInputPermssions($permissions) {
                    $data["permissions"] = $permissions;
                }

                function getContent() {
                    var $object = Object.assign({}, $data);
                    return JSON.stringify($object);
                }

                function getContentPermissions() {
                    var $object = Object.assign({}, $permissions);
                    return JSON.stringify($object);
                }

                $inputTextCreator.on("input", function() {
                    $name = $(this).attr("name");
                    $value = $(this).val();
                    setInput($name, $value);
                });

                $inputSelectCreator.on("change", function() {
                    $name = $(this).attr("name");
                    $value = $(this).val();
                    setInput($name, $value);
                    if ($name == "user_type") {
                        if ($value == "office") {
                            $advertiser_number_div.show();
                        } else {
                            $advertiser_number_div.hide();
                            $(".advertiser-number-input").val("");
                            $data["advertiser_number"] = "";
                        }
                    }
                });

                $checkboxInput.on('change', function() {
                    let $value = $(this).val();
                    let $name = $(this).attr('name');
                    let $checked = $(this).is(':checked');

                    if ($checked) {
                        $permissions[$name] = true;
                        setInputPermssions(getContentPermissions($permissions));
                        $(this).prop('checked', true);
                    } else {
                        $permissions[$name] = false;
                        setInputPermssions(getContentPermissions($permissions));
                        $(this).prop('checked', false);
                    }
                    console.log($data);
                });

                $createUserSubmit.on('click', function() {
                    $(".reset-validation").text("");
                    console.log($data);
                    console.log(getContent());
                    Livewire.emit('store', getContent());
                });

                Livewire.on("errors", function(errors) {
                    $(".reset-validation").text("");
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            let input = "." + key + "-validation";
                            $(input).text(errors[key]);

                            $('html, body').animate({
                                scrollTop: 0
                            }, 500);
                        }
                    }
                    console.log(errors);
                });

            });
        </script>
    @endpush

</div>
