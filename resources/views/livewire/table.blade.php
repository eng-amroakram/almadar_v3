<section class="mb-4" wire:ignore.self style="height:650px;">

    {{-- alert success, info, error, warning --}}

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{ session('info') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('warning') }}</strong>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card"
        style="--mdb-card-box-shadow: 0 2px 15px -3px rgb(0, 0, 0), 0 10px 20px -2px rgba(0, 0, 0, 0.04);">

        <div class="card-header py-0">
            <nav class="navbar-expand-lg navbar-light bg-light mt-3"
                style="--mdb-navbar-box-shadow: 0 4px 12px 0 rgb(189, 189, 189),0 2px 4px rgba(0,0,0,0.05);">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="text-dark fw-bold fs-6">الصفحة
                                    الرئيسية</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="#"
                                    class="text-dark  fs-6">{{ $table_name }}</a></li>
                        </ol>
                    </nav>
                </div>
            </nav>
        </div>

        <div class="card-body">

            <div id="customremoveinputgroup" class="input-group p-0 mb-3" wire:ignore>
                <!-- search input -->
                <div id="navbar-search-autocomplete" class="form-outline">
                    <input type="search" id="form1" wire:model="search" class="form-control" />
                    <label class="form-label" for="form1">البحث</label>
                </div>

                @foreach ($selects as $name => $options)
                    <x-table-extension.select :input="$name" :options="$options"></x-table-extension.select>
                @endforeach

                @if ($table == 'OrdersService')
                    <div id="customwidth">
                        <!--Section: Demo-->
                        <div class="form-outline datepicker dateFrom" data-mdb-format="yyyy-mm-dd">
                            <input type="text" class="form-control" name="date_from" wire:model="date_from"
                                id="date_from_input_id_creator" placeholder="yyyy-mm-dd">
                            <label for="date_from_input_id_creator" class="form-label">التاريخ من</label>
                        </div>
                    </div>

                    <div id="customwidth">
                        <!--Section: Demo-->
                        <div class="form-outline datepicker dateTo" data-mdb-format="yyyy-mm-dd">
                            <input type="text" class="form-control" name="date_to" wire:model="date_to"
                                id="date_to_input_id_creator" placeholder="yyyy-mm-dd">
                            <label for="date_to_input_id_creator" class="form-label">التاريخ الى</label>
                        </div>
                    </div>
                @endif


                <div id="customwidth">
                    <button class="btn dropdown-toggle text-white fs-6" style="background-color: #a58346;"
                        type="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        تصدير
                    </button>

                    <ul class="dropdown-menu text-center fs-6">
                        <li wire:click="exportExcel">
                            <a class="dropdown-item fw-bold" href="#">
                                <i class="fas fa-file-excel text-success fs-5"></i>
                                ملف اكسل
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- mb-2 -->

            </div>


            <div class="table-responsive">
                <x-table-extension.loading></x-table-extension.loading>
                <table class="table table-hover text-nowrap table-bordered text-center">
                    <thead>
                        <tr>
                            {{-- <th scope="col">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            </th> --}}
                            @foreach ($columns as $column)
                                <th scope="col">{{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $model)
                            <x-table-extension.rows :model="$model" :class="$class" :classmodel="$class_model"
                                :classtitle="$class_title" :page="$create['page']" :updaterid="$updater_id" :table="$table"
                                :rows="$rows">
                            </x-table-extension.rows>
                        @endforeach
                    </tbody>

                </table>
            </div>

            @if ($create['check'])

                @if ($create['page'])
                    <div class="d-flex justify-content-end mt-3">
                        <a type="button" class="btn btn-rounded create-button"
                            href="{{ route('panel.users.create') }}">
                            <i class="fas fa-plus"></i>
                            {{ $create['lable'] }}
                        </a>
                    </div>
                @endif

                @can("create$class_title", $class_model)
                    @if ($create['modal'])
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-rounded create-button" data-mdb-toggle="modal"
                                data-mdb-ripple-color="dark" data-mdb-target="#{{ $create['id'] }}">
                                <i class="fas fa-plus"></i>
                                {{ $create['lable'] }}
                            </button>
                        </div>
                    @endif
                @endcan

            @endif

        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">

                <div wire:ignore>
                    <select class="select" wire:model="rows_number">
                        <option value="5" selected>5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="form-label select-label">الصفوف</label>
                </div>

                <div>
                    <nav aria-label="...">
                        <ul class="pagination pagination-circle">
                            {{ $data->withQueryString()->onEachSide(0)->links() }}
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
    @livewire('creator', ['service' => $table])
    @livewire('updater', ['service' => $table])
</section>




@push('users')
    <script>
        $(document).ready(function() {

            //Buttons Decleration
            var $delete = $(".delete");
            var $submit = $(".submit");
            var $edit = $(".edit");

            //Fields Decleration
            var $checkboxInput = $(".checkboxInput");
            var $textInput = $(".textInput");
            var $selectInput = $(".selectInput");
            var $advertiser_number = $(".advertiser-number");
            var $advertiser_number_input = $(".advertiser_number");

            $advertiser_number.hide();
            //Collection Array
            var $data = [];

            var dateFrom = document.querySelector('.dateFrom');
            dateFrom.addEventListener('dateChange.mdb.datepicker', function(e) {
                let $date_from_input_id_creator = $("#date_from_input_id_creator");
                console.log($date_from_input_id_creator.val());
                @this.set('date_from', $date_from_input_id_creator.val());
            });

            var dateTo = document.querySelector('.dateTo');
            dateTo.addEventListener('dateChange.mdb.datepicker', function(e) {
                let $date_to_input_id_creator = $("#date_to_input_id_creator");
                console.log($date_to_input_id_creator.val());
                @this.set('date_to', $date_to_input_id_creator.val());
            });

            function setData(key, value) {
                $data[key] = value;
            }

            function getContent() {
                var $object = Object.assign({}, $data);
                return JSON.stringify($object);
            }

            //Buttons Actions
            $delete.on('click', function() {
                var $id = $(this).attr('modelid');
                Livewire.emit('delete', $id);
            });

            $submit.on('click', function() {
                Livewire.emit('submit', getContent());
            });

            $edit.on('click', function() {
                var $id = $(this).attr('modelid');
                Livewire.emit('edit', $id);
            });

            //Fields Actions
            $textInput.on("input", function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                setData($name, $value);
            });


            $checkboxInput.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                let $checked = $(this).is(':checked');

                if ($checked) {
                    $(this).prop('checked', true);
                    $data[$name] = true;
                    setData($name, true);
                } else {
                    $data[$name] = false;
                    setData($name, false);
                    $(this).prop('checked', false);
                }
            });

            $selectInput.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                if ($name == "user_type") {
                    if ($value == "office") {
                        $advertiser_number.show();
                        $advertiser_number_input.val("");
                    } else {
                        $advertiser_number.hide();
                        $advertiser_number_input.val("");
                        $data['advertiser_number'] = null;
                    }
                }

                setData($name, $value);
            });

            Livewire.on('set-edit-user-form', function(data) {
                let $permissions = data.permissions;
                let $selects = data.selects;

                for (let permission in $permissions) {
                    if ($permissions.hasOwnProperty(permission)) {
                        let $checked = $permissions[permission];
                        let $checkbox = $("." + permission);
                        if ($checked) {
                            $checkbox.prop('checked', true);
                            $data[permission] = true;
                            setData(permission, true);
                        } else {
                            $data[permission] = false;
                            setData(permission, false);
                            $checkbox.prop('checked', false);
                        }
                    }
                }

                delete data.permissions;

                for (let choice in $selects) {
                    if ($selects.hasOwnProperty(choice)) {
                        let $id = "#" + choice + " option[value='" + $selects[choice] + "']";
                        $($id).prop("selected", true);
                        if (choice == "user_type") {
                            console.log(choice, $selects[choice]);
                            if ($selects[choice] == "office") {
                                $advertiser_number.show();
                                $advertiser_number_input.val($selects["advertiser_number"]);
                            } else {
                                $advertiser_number.hide();
                                $advertiser_number_input.val("");
                            }
                        }
                    }
                }


                for (key in data) {
                    if (data.hasOwnProperty(key)) {
                        let $input = $("." + key);
                        $input.val(data[key]);

                    }
                }

            });



        });
    </script>
@endpush
