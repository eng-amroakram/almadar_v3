<div class="modal fade" id="{{ $updater_id }}" tabindex="-2" role="dialog" data-mdb-backdrop="static"
    aria-labelledby="updater-offers" aria-hidden="true" wire:ignore>
    <div class="modal-dialog {{ $size }} cascading-modal" style="margin-top: 4%">

        <div class="modal-content">

            <div class="modal-c-tabs">
                <x-updater.nav-tabs :tabs="$tabs" :title="$title"></x-updater.nav-tabs>

                <div class="tab-content">

                    <x-table-extension.loading></x-table-extension.loading>

                    @foreach ($contents as $content)
                        <x-updater.tab-content :content="$content" :size="$size" :updaterbuttong="'submitOffersUpdater'" :updaterid="$updater_id">
                        </x-updater.tab-content>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@push('updater-offers')
    <script>
        $(document).ready(function() {



            //Buttons
            var $submitOffersUpdater = $(".submitOffersUpdater");

            //Inputs
            var $inputTextOffersUpdater = $(".inputTextOffersUpdater");
            var $inputSelectOffersUpdater = $(".inputSelectOffersUpdater");
            var $checkboxInputOffersUpdater = $(".checkboxInputOffersUpdater");

            //Next
            var $nextUpdater = $(".nextUpdater");

            //Tabs
            var $nav_tabs_custom_updater = $(".nav-tabs-custom-updater");
            var $nav_link_custom_updater = $(".nav-link-custom-updater");

            var $data_offers_updater = @json($data);

            function setInputOffersUpdater($name, $value) {
                $data_offers_updater[$name] = $value;
            }

            function getContentOffersUpdater() {
                var $object = Object.assign({}, $data_offers_updater);
                return JSON.stringify($object);
            }

            function numbers($name, $value) {

                if ($value) {
                    console.log($value);

                    let string_number = $value.replace(/[^\d.]/g, "");

                    if (string_number.match(/\./g)) {
                        if (string_number.match(/\./g).length > 1) {
                            string_number = string_number.replace(/,/g, "").replace(/\.(?=.*\.)/g,
                                "");
                        }
                    }

                    let number = parseFloat(string_number.replace(/,/g, ""));
                    console.log(number.toLocaleString());
                    return number;
                }

            }

            $nextUpdater.on('click', function() {
                let $id = $(this).attr('tapupdaterid');

                if ($id) {
                    let $tab = '.' + $id + '-' + 'updater-tap';
                    let $nav = '.' + $id + '-' + 'updater-nav';

                    $nav_link_custom_updater.removeClass('active');
                    $nav_tabs_custom_updater.removeClass('active');
                    $nav_tabs_custom_updater.removeClass('show');

                    $($nav).addClass('active');
                    $($tab).addClass('active');
                    $($tab).addClass('show');
                }

            });

            $inputTextOffersUpdater.on("input", function() {
                $name = $(this).attr("name");
                $value = $(this).val();
                setInputOffersUpdater($name, $value);

                if ($name == "space") {
                    $check = $value.slice(-1);
                    if ($check == ".") {
                        $(this).val($value);
                    } else {
                        let result = numbers($name, $value);
                        if (result) {
                            $(this).val(result.toLocaleString());
                        } else {
                            $(this).val("0");
                        }

                        setInputOffersUpdater($name, result);
                    }
                }

            });

            $inputSelectOffersUpdater.on("change", function() {
                $name = $(this).attr("name");
                $value = $(this).val();
                setInputOffersUpdater($name, $value);
            });

            $checkboxInputOffersUpdater.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                let $checked = $(this).is(':checked');

                if ($checked) {
                    $(this).prop('checked', true);
                    setInputOffersUpdater($name, true);
                    if ($name == "attribution_check") {
                        $attributionDiv.show();
                    }
                } else {
                    $(this).prop('checked', false);
                    setInputOffersUpdater($name, false);
                    if ($name == "attribution_check") {
                        $attributionDiv.hide();
                    }
                }
            });

            $submitOffersUpdater.on('click', function() {
                $(".reset-validation").text(" ");

                for (let key in $data_offers_updater) {
                    if ($data_offers_updater.hasOwnProperty(key)) {
                        @this.set(key, $data_offers_updater[key]);
                    }
                }
                Livewire.emit('updateOffer', getContentOffersUpdater());
            });

            Livewire.on("errors-updater", function(errors) {
                $(".reset").text("");
                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        $("." + key + "-validation").text(errors[key]);
                    }
                }
                console.log(errors);
            });

            Livewire.on("closeModal", function(errors) {
                let $id = "#{{ $updater_id }}";
                $($id).modal('hide');
                $($id).removeClass('show');
                $($id).attr('aria-hidden', 'true');
                $($id).attr('aria-modal', 'false');
                $($id).css('display', 'none');
                $('body').removeClass('modal-open').css({
                    'overflow': '',
                    'padding-right': ''
                });
                // remove div of class modal-backdrop
                $('.modal-backdrop').remove();
                $(".reset-validation").val("");

                $data_offers_updater = [];
            });

            Livewire.on('select2', function(id, value) {
                let $te = value + '';
                console.log(id);
                console.log(value);
                const singleSelect = document.querySelector(id);
                const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                singleSelectInstance.setValue($te);
            });

            Livewire.on('setSelectInputUpdater', function(data, inputid, id) {
                var $input = $("#" + inputid);
                var singleSelect = document.querySelector("#" + inputid);
                var singleSelectInstance = mdb.Select.getInstance(singleSelect);
                $input.empty();

                $.each(data, function(index, value) {

                    if (value == id) {
                        $input.append('<option selected value="' + value +
                            '">' +
                            index +
                            '</option>');
                    } else {
                        $input.append('<option value="' + value +
                            '">' +
                            index +
                            '</option>');
                    }

                    $input.append('<option value="' + value + '">' + index + '</option>');
                });
            });

            Livewire.on("setMultiSelectInput", function(data, inputid, ids) {
                const multiSelect = document.querySelector("#" + inputid);
                const multiSelectInstance = mdb.Select.getInstance(multiSelect);
                multiSelectInstance.setValue(ids);
            });

            Livewire.on('setDataFields', function(data) {
                $(".reset-validation").text(" ");
            });


            Livewire.on('showAttributionFields', function(id, check) {
                $('#attribution_check_input_id_updater').prop('checked', check);
                if (check) {
                    $attributionDiv.show();
                } else {
                    $attributionDiv.hide();

                }
            });

            Livewire.on('setNumberInput', function(id, name, value) {
                $input = $("#" + id);
                $input.val(value.toLocaleString());
                setInputOffersUpdater(name, value);
            });

        });
    </script>
@endpush

</div>
