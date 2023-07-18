<div class="container" wire:ignore>

    <h4 style="color: #a58346;">تحديث المستخدم ( {{ $user->name }} )</h4>

    <div class="row mt-3">

        <div class="card card-default">

            <div class="card-header">
                <h4 class="card-title">بيانات المستخدم</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="mask"
                        style="z-index: 10; border-radius: 50px; background-color: rgba(191, 144, 68, 0.5)" wire:loading>
                        <div
                            class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h4>جاري التحميل يرجى الانتظار ...</h4>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="far fa-user"></i>
                            </span>
                            <input type="text" maxlength="255" name="name" wire:model='name'
                                value="{{ old('name') }}" class="form-control inputTextCreator"
                                placeholder="اسم المستخدم" />
                        </div>
                        <small class="text-danger reset-validation name-validation"></small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-at"></i>
                            </span>
                            <input type="email" maxlength="255" dir="ltr" wire:model='email' name="email"
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
                            <input type="text" maxlength="10" dir="ltr" wire:model="phone" name="phone"
                                value="{{ old('phone') }}" class="form-control inputTextCreator"
                                placeholder="رقم الجوال" />
                            <span class="input-group-text">+966</span>
                        </div>
                        <small class="text-danger reset-validation phone-validation"></small>
                    </div>

                    {{-- <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="password" maxlength="255" wire:model="password" name="password"
                                value="{{ old('password') }}" class="form-control inputTextCreator"
                                placeholder="كلمة السر" />
                        </div>
                        <small class="text-danger reset-validation password-validation"></small>
                    </div> --}}

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

                        <small class="text-danger branches_ids-validation"></small>

                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fab fa-searchengin"></i>
                            </span>
                            <select class="select inputSelectCreator" id="user_status" wire:model="user_status"
                                name="user_status">
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
                            <select class="select inputSelectCreator" wire:model="user_type" id="user_type"
                                name="user_type">
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
                                wire:model="advertiser_number" placeholder="رقم المعلن" />
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

                <div class="row mt-3">
                    <div class="mask"
                        style="z-index: 10;     border-radius: 50px;
                    background-color: rgba(191, 144, 68, 0.5)"
                        wire:loading>
                        <div
                            class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h4>جاري التحميل يرجى الانتظار ...</h4>
                        </div>
                    </div>
                    @foreach ($permissions as $title => $permissions)
                        <div class="list-group mt-3">

                            <div class="list-group-item">
                                <h5 class="mb-2">{{ __($title) }}</h5>
                                <div class="row">

                                    @foreach ($permissions as $key => $value)
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input checkboxInput"
                                                    name="{{ $key }}" type="checkbox"
                                                    @if ($value) checked @endif>
                                                <label class="form-check-label">{{ __($key) }}</label>
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
    </div>

    <div class="row mt-3">
        <div>
            <button style="background-color: #a58346;"
                class="btn btn-primary w-100 update-user-submit">{{ __('Update') }}</button>
        </div>
    </div>


    @push('update-user-scripts')
        <script>
            $(document).ready(function() {
                //Branches IDs
                const branchesIDs = document.querySelector('#branches_ids');
                const branchesIDsInstance = mdb.Select.getInstance(branchesIDs);
                // User Type
                const userType = document.querySelector('#user_type');
                const userTypeInstance = mdb.Select.getInstance(userType);
                // User Status
                const userStatus = document.querySelector('#user_status');
                const userStatusInstance = mdb.Select.getInstance(userStatus);

                var $updateUserSubmit = $(".update-user-submit");
                var $inputTextCreator = $(".inputTextCreator");
                var $checkboxInput = $(".checkboxInput");
                var $inputSelectCreator = $(".inputSelectCreator");

                var $branches_ids = {!! json_encode($branches_ids) !!};
                branchesIDsInstance.setValue($branches_ids);

                var $user_type = "{{ $user_type }}";
                userTypeInstance.setValue($user_type);

                var $user_status = "{{ $user_status }}";
                userStatusInstance.setValue($user_status);

                var $permissions_user = {!! json_encode($permissions_user) !!};
                var $permissions = $permissions_user;

                var $data = [];
                $data["branches_ids"] = $branches_ids;
                $data["user_type"] = $user_type;
                $data["user_status"] = $user_status;
                $data["advertiser_number"] = "{{ $advertiser_number }}";
                $data["name"] = "{{ $name }}";
                $data["email"] = "{{ $email }}";
                $data["phone"] = "{{ $phone }}";
                setInputPermssions(getContentPermissions($permissions));

                var $user_type = "{{ $user_type }}";
                var $advertiser_number = "{{ $advertiser_number }}";
                var $advertiser_number_div = $(".advertiser-number-div");
                var $advertiser_number_input = $(".advertiser-number-input");

                if ($user_type == "office") {
                    $advertiser_number_div.show();
                } else {
                    $advertiser_number_div.hide();
                    $advertiser_number_input.val("");
                    $advertiser_number = "";
                    $data["advertiser_number"] = "";
                }

                console.log($data);

                function setInput($name, $value) {
                    $data[$name] = $value;
                    console.log($data);
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

                $updateUserSubmit.on('click', function() {
                    $(".reset-validation").text("");
                    console.log(getContent());
                    Livewire.emit('update', getContent());
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
