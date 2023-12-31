<div class="modal fade" id="{{ $updater_id }}" tabindex="-1" role="dialog" data-mdb-backdrop="static"
    aria-labelledby="updater" aria-hidden="true" wire:ignore>
    <div class="modal-dialog {{ $size }} cascading-modal" style="margin-top: 4%">

        <div class="modal-content">

            <div class="modal-c-tabs">
                <x-updater.nav-tabs :tabs="$tabs" :title="$title"></x-updater.nav-tabs>

                <div class="tab-content">

                    <x-table-extension.loading></x-table-extension.loading>

                    @foreach ($contents as $content)
                        <x-updater.tab-content :content="$content" :size="$size" :updaterbuttong="'submitUpdater'" :updaterid="$updater_id">
                        </x-updater.tab-content>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

@push('updater')
    <script>
        $(document).ready(function() {

            var $property_type_select_id_updater_div = $(".property_type_select_id_updater_div");
            var $space_input_id_updater_div = $(".space_input_id_updater_div");
            var $price_meter_input_id_updater_div = $(".price_meter_input_id_updater_div");
            var $total_input_id_updater_div = $(".total_input_id_updater_div");
            var $directions_select_id_updater_div = $(".directions_select_id_updater_div");
            var $land_type_select_id_updater_div = $(".land_type_select_id_updater_div");
            var $licensed_select_id_updater_div = $(".licensed_select_id_updater_div");
            var $street_width_select_id_updater_div = $(".street_width_select_id_updater_div");
            var $character_input_id_updater_div = $(".character_input_id_updater_div");
            var $interface_length_input_id_updater_div = $(".interface_length_input_id_updater_div");
            var $branch_id_select_id_updater_div = $(".branch_id_select_id_updater_div");
            var $bathrooms_input_id_updater_div = $(".bathrooms_input_id_updater_div");
            var $flat_rooms_input_id_updater_div = $(".flat_rooms_input_id_updater_div");
            var $age_input_id_updater_div = $(".age_input_id_updater_div");
            var $floor_input_id_updater_div = $(".floor_input_id_updater_div");
            var $floors_input_id_updater_div = $(".floors_input_id_updater_div");
            var $flats_input_id_updater_div = $(".flats_input_id_updater_div");
            var $rooms_input_id_updater_div = $(".rooms_input_id_updater_div");
            var $stores_input_id_updater_div = $(".stores_input_id_updater_div");
            var $annual_income_input_id_updater_div = $(".annual_income_input_id_updater_div");
            var $owner_ship_type_select_id_updater_div = $(".owner_ship_type_select_id_updater_div");
            var $building_type_select_id_updater_div = $(".building_type_select_id_updater_div");
            var $building_status_select_id_updater_div = $(".building_status_select_id_updater_div");
            var $construction_delivery_select_id_updater_div = $(".construction_delivery_select_id_updater_div");
            var $city_id_select_id_updater_div = $(".city_id_select_id_updater_div");
            var $neighborhood_id_select_id_updater_div = $(".neighborhood_id_select_id_updater_div");
            var $statement_input_id_updater_div = $(".statement_input_id_updater_div");
            var $land_number_input_id_updater_div = $(".land_number_input_id_updater_div");
            var $block_number_input_id_updater_div = $(".block_number_input_id_updater_div");
            var $brokers_ids_select_id_updater_div = $(".brokers_ids_select_id_updater_div");

            //Sale Fields
            var $offer_code_input_id_updater_div = $(".offer_code_input_id_updater_div");
            var $neighborhood_input_id_updater_div = $(".neighborhood_input_id_updater_div");
            var $land_number_input_id_updater_div = $(".land_number_input_id_updater_div");
            var $is_first_home_select_id_updater_div = $(".is_first_home_select_id_updater_div");
            var $real_estate_price_input_id_updater_div = $(".real_estate_price_input_id_updater_div");
            var $deserved_amount_input_id_updater_div = $(".deserved_amount_input_id_updater_div");
            var $commission_vat_input_id_updater_div = $(".commission_vat_input_id_updater_div");
            var $commission_type_select_id_updater_div = $(".commission_type_select_id_updater_div");
            var $commission_percentage_input_id_updater_div = $(".commission_percentage_input_id_updater_div");
            var $commission_price_input_id_updater_div = $(".commission_price_input_id_updater_div");
            var $amount_paid_input_id_updater_div = $(".amount_paid_input_id_updater_div");
            var $payment_method_select_id_updater_div = $(".payment_method_select_id_updater_div");
            var $bank_select_id_updater_div = $(".bank_select_id_updater_div");
            var $check_number_input_id_updater_div = $(".check_number_input_id_updater_div");
            var $recipient_name_input_id_updater_div = $(".recipient_name_input_id_updater_div");

            var $client_buyer_id_select_id_updater_div = $(".client_buyer_id_select_id_updater_div");
            var $client_buyer_name_input_id_updater_div = $(".client_buyer_name_input_id_updater_div");
            var $client_buyer_phone_input_id_updater_div = $(".client_buyer_phone_input_id_updater_div");
            var $client_buyer_id_number_type_input_id_updater_div = $(
                ".client_buyer_id_number_type_input_id_updater_div");
            var $client_buyer_id_number_input_id_updater_div = $(".client_buyer_id_number_input_id_updater_div");
            var $client_buyer_email_input_id_updater_div = $(".client_buyer_email_input_id_updater_div");
            var $client_buyer_nationality_id_select_id_updater_div = $(
                ".client_buyer_nationality_id_select_id_updater_div");
            var $client_buyer_city_id_select_id_updater_div = $(".client_buyer_city_id_select_id_updater_div");
            var $client_buyer_employment_type_select_id_updater_div = $(
                ".client_buyer_employment_type_select_id_updater_div");
            var $client_buyer_housing_support_select_id_updater_div = $(
                ".client_buyer_housing_support_select_id_updater_div");
            var $client_buyer_building_number_input_id_updater_div = $(
                ".client_buyer_building_number_input_id_updater_div");
            var $client_buyer_street_name_input_id_updater_div = $(
                ".client_buyer_street_name_input_id_updater_div");
            var $client_buyer_neighborhood_name_input_id_updater_div = $(
                ".client_buyer_neighborhood_name_input_id_updater_div");
            var $client_buyer_zip_code_input_id_updater_div = $(".client_buyer_zip_code_input_id_updater_div");
            var $client_buyer_extra_figure_input_id_updater_div = $(
                ".client_buyer_extra_figure_input_id_updater_div");
            var $client_buyer_unit_number_input_id_updater_div = $(
                ".client_buyer_unit_number_input_id_updater_div");

            var $client_buyer_description_input_id_updater_div = $(
                ".client_buyer_description_input_id_updater_div");

            var $client_seller_id_select_id_updater_div = $(".client_seller_id_select_id_updater_div");
            var $client_seller_name_input_id_updater_div = $(".client_seller_name_input_id_updater_div");
            var $client_seller_phone_input_id_updater_div = $(".client_seller_phone_input_id_updater_div");
            var $client_seller_id_number_type_input_id_updater_div = $(
                ".client_seller_id_number_type_input_id_updater_div");
            var $client_seller_id_number_input_id_updater_div = $(".client_seller_id_number_input_id_updater_div");
            var $client_seller_email_input_id_updater_div = $(".client_seller_email_input_id_updater_div");
            var $client_seller_nationality_id_select_id_updater_div = $(
                ".client_seller_nationality_id_select_id_updater_div");
            var $client_seller_city_id_select_id_updater_div = $(".client_seller_city_id_select_id_updater_div");
            var $client_seller_employment_type_select_id_updater_div = $(
                ".client_seller_employment_type_select_id_updater_div");
            var $client_seller_housing_support_select_id_updater_div = $(
                ".client_seller_housing_support_select_id_updater_div");
            var $client_seller_building_number_input_id_updater_div = $(
                ".client_seller_building_number_input_id_updater_div");
            var $client_seller_street_name_input_id_updater_div = $(
                ".client_seller_street_name_input_id_updater_div");
            var $client_seller_neighborhood_name_input_id_updater_div = $(
                ".client_seller_neighborhood_name_input_id_updater_div");
            var $client_seller_zip_code_input_id_updater_div = $(".client_seller_zip_code_input_id_updater_div");
            var $client_seller_extra_figure_input_id_updater_div = $(
                ".client_seller_extra_figure_input_id_updater_div");
            var $client_seller_unit_number_input_id_updater_div = $(
                ".client_seller_unit_number_input_id_updater_div");
            var $client_seller_description_input_id_updater_div = $(
                ".client_seller_description_input_id_updater_div");
            var $total_amount_input_id_updater_div = $(".total_amount_input_id_updater_div");

            var $reset_updater_divs = $(".reset_updater_divs");

            Livewire.on("showModalsFields", function(type) {
                views(type);
                $("#property_type_select_id_updater").attr('disabled', 'disabled');
            });

            $reset_updater_divs.hide();
            $property_type_select_id_updater_div.show();
            $space_input_id_updater_div.show();
            $price_meter_input_id_updater_div.show();
            $total_input_id_updater_div.show();
            $total_amount_input_id_updater_div.show();
            $directions_select_id_updater_div.show();
            $land_type_select_id_updater_div.show();
            $licensed_select_id_updater_div.show();
            $street_width_select_id_updater_div.show();
            $character_input_id_updater_div.show();
            $interface_length_input_id_updater_div.show();
            $branch_id_select_id_updater_div.show();

            $city_id_select_id_updater_div.show();
            $neighborhood_id_select_id_updater_div.show();
            $statement_input_id_updater_div.show();
            $land_number_input_id_updater_div.show();
            $block_number_input_id_updater_div.show();
            $brokers_ids_select_id_updater_div.show();


            //Sales Fields
            $offer_code_input_id_updater_div.show();
            $neighborhood_input_id_updater_div.show();
            $land_number_input_id_updater_div.show();
            $is_first_home_select_id_updater_div.show();
            $real_estate_price_input_id_updater_div.show();
            $deserved_amount_input_id_updater_div.hide();
            $total_amount_input_id_updater_div.show();
            $commission_vat_input_id_updater_div.hide();
            $commission_type_select_id_updater_div.show();
            $commission_percentage_input_id_updater_div.hide();
            $commission_price_input_id_updater_div.hide();
            $amount_paid_input_id_updater_div.show();
            $payment_method_select_id_updater_div.show();
            $bank_select_id_updater_div.hide();
            $check_number_input_id_updater_div.hide();
            $recipient_name_input_id_updater_div.hide();

            // Buyer Fields
            $client_buyer_id_select_id_updater_div.show();
            $client_buyer_name_input_id_updater_div.show();
            $client_buyer_phone_input_id_updater_div.show();
            $client_buyer_id_number_type_input_id_updater_div.show();
            $client_buyer_id_number_input_id_updater_div.show();
            $client_buyer_email_input_id_updater_div.show();
            $client_buyer_nationality_id_select_id_updater_div.show();
            $client_buyer_city_id_select_id_updater_div.show();
            $client_buyer_employment_type_select_id_updater_div.show();
            $client_buyer_housing_support_select_id_updater_div.show();
            $client_buyer_building_number_input_id_updater_div.show();
            $client_buyer_street_name_input_id_updater_div.show();
            $client_buyer_neighborhood_name_input_id_updater_div.show();
            $client_buyer_zip_code_input_id_updater_div.show();
            $client_buyer_extra_figure_input_id_updater_div.show();
            $client_buyer_unit_number_input_id_updater_div.show();
            $client_buyer_description_input_id_updater_div.show();

            //Seller Fields
            $client_seller_id_select_id_updater_div.show();
            $client_seller_name_input_id_updater_div.show();
            $client_seller_phone_input_id_updater_div.show();
            $client_seller_id_number_type_input_id_updater_div.show();
            $client_seller_id_number_input_id_updater_div.show();
            $client_seller_email_input_id_updater_div.show();
            $client_seller_nationality_id_select_id_updater_div.show();
            $client_seller_city_id_select_id_updater_div.show();
            $client_seller_employment_type_select_id_updater_div.show();
            $client_seller_housing_support_select_id_updater_div.show();
            $client_seller_building_number_input_id_updater_div.show();
            $client_seller_street_name_input_id_updater_div.show();
            $client_seller_neighborhood_name_input_id_updater_div.show();
            $client_seller_zip_code_input_id_updater_div.show();
            $client_seller_extra_figure_input_id_updater_div.show();
            $client_seller_unit_number_input_id_updater_div.show();
            $client_seller_description_input_id_updater_div.show();

            // $("#total_amount_input_id_updater").attr("disabled", true);
            $("#total_input_id_updater").attr("disabled", true);


            function views($type) {

                $reset_updater_divs.hide();

                $property_type_select_id_updater_div.show();
                $city_id_select_id_updater_div.show();
                $neighborhood_id_select_id_updater_div.show();
                $statement_input_id_updater_div.show();
                $land_number_input_id_updater_div.show();
                $block_number_input_id_updater_div.show();
                $brokers_ids_select_id_updater_div.show();
                $("#total_input_id_updater").attr("disabled", false);


                if ($type == "land") {
                    $space_input_id_updater_div.show();
                    $price_meter_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $directions_select_id_updater_div.show();
                    $land_type_select_id_updater_div.show();
                    $licensed_select_id_updater_div.show();
                    $street_width_select_id_updater_div.show();
                    $character_input_id_updater_div.show();
                    $interface_length_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                    $("#total_input_id_updater").attr("disabled", "disabled");
                }

                if ($type == "duplex") {
                    $space_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $age_input_id_updater_div.show();
                    $directions_select_id_updater_div.show();
                    $land_type_select_id_updater_div.show();
                    $licensed_select_id_updater_div.show();
                    $street_width_select_id_updater_div.show();
                    $character_input_id_updater_div.show();
                    $interface_length_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                    $building_type_select_id_updater_div.show();
                    $building_status_select_id_updater_div.show();
                    $construction_delivery_select_id_updater_div.show();
                }

                if ($type == "condominium") {
                    $space_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $age_input_id_updater_div.show();
                    $floors_input_id_updater_div.show();
                    $flats_input_id_updater_div.show();
                    $stores_input_id_updater_div.show();
                    $annual_income_input_id_updater_div.show();
                    $flat_rooms_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                }

                if ($type == "flat") {
                    $space_input_id_updater_div.show();
                    $bathrooms_input_id_updater_div.show();
                    $flat_rooms_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $age_input_id_updater_div.show();
                    $floor_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                }


                if ($type == "chalet") {
                    $space_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $age_input_id_updater_div.show();
                    $directions_select_id_updater_div.show();
                    $street_width_select_id_updater_div.show();
                    $owner_ship_type_select_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                }

                if ($type == "warehouse_land") {
                    $space_input_id_updater_div.show();
                    $price_meter_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $licensed_select_id_updater_div.show();
                    $street_width_select_id_updater_div.show();
                    $character_input_id_updater_div.show();
                    $interface_length_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                    $("#total_input_id_updater").attr("disabled", "disabled");
                }

                if ($type == "agircultural_land") {
                    $space_input_id_updater_div.show();
                    $price_meter_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $licensed_select_id_updater_div.show();
                    $street_width_select_id_updater_div.show();
                    $character_input_id_updater_div.show();
                    $interface_length_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                    $("#total_input_id_updater").attr("disabled", "disabled");

                }

                if ($type == "industrial_land") {
                    $space_input_id_updater_div.show();
                    $price_meter_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $licensed_select_id_updater_div.show();
                    $street_width_select_id_updater_div.show();
                    $character_input_id_updater_div.show();
                    $interface_length_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                    $("#total_input_id_updater").attr("disabled", "disabled");

                }


                if ($type == "residential_land") {
                    $space_input_id_updater_div.show();
                    $price_meter_input_id_updater_div.show();
                    $total_input_id_updater_div.show();
                    $licensed_select_id_updater_div.show();
                    $street_width_select_id_updater_div.show();
                    $character_input_id_updater_div.show();
                    $interface_length_input_id_updater_div.show();
                    $branch_id_select_id_updater_div.show();
                    $("#total_input_id_updater").attr("disabled", "disabled");

                }

            }

            //Custom
            var $advertiser_number_div = $(".advertiser-number-div");
            var $advertiser_number = $(".advertiser-number");
            var $advertiser_number_input = $(".advertiser-number-input");
            var $password_field = $(".password-input-updater-div");
            $password_field.hide();
            $advertiser_number_div.hide();

            // Custom Order
            var $attributionInput = $(".attributionInput");
            var $attributionDiv = $(".attributionDiv");
            $attributionDiv.hide();

            //Buttons
            var $submitUpdater = $(".submitUpdater");

            //Inputs
            var $inputTextUpdater = $(".inputTextUpdater");
            var $inputSelectUpdater = $(".inputSelectUpdater");
            var $checkboxInputUpdater = $(".checkboxInputUpdater");

            //Next
            var $nextUpdater = $(".nextUpdater");

            //Tabs
            var $nav_tabs_custom_updater = $(".nav-tabs-custom-updater");
            var $nav_link_custom_updater = $(".nav-link-custom-updater");

            var $data_updater = @json($data);

            function setInputUpdater($name, $value) {
                $data_updater[$name] = $value;
            }

            function getContentUpdater() {
                var $object = Object.assign({}, $data_updater);
                return JSON.stringify($object);
            }

            function numbers($name, $value) {

                if ($value) {

                    if (typeof $value == 'string') {
                        let string_number = $value.replace(/[^\d.]/g, "");

                        if (string_number.match(/\./g)) {
                            if (string_number.match(/\./g).length > 1) {
                                string_number = string_number.replace(/,/g, "").replace(/\.(?=.*\.)/g,
                                    "");
                            }
                        }

                        let number = parseFloat(string_number.replace(/,/g, ""));
                        return number;
                    }
                    return $value;
                }

            }

            function setUpdaterTotal() {
                let $total_input = $("#total_amount_input_id_updater");
                let $total_cal = 0;
                var $real_estate_price = numbers("real_estate_price", $("#real_estate_price_input_id_updater")
                    .val());
                var $commission_price = 0;
                var $commission_vat_price = 0;
                var $deserved_amount_percentage = 0;
                var $commission_percentage_price = 0;
                var $paid_amount_price = numbers("paid_amount", $("#amount_paid_input_id_updater").val());

                var $is_first_home_select_id_updater = $("#is_first_home_select_id_updater");
                var $commission_type_select_id_updater = $("#commission_type_select_id_updater");

                if ($is_first_home_select_id_updater.val() == "2") {
                    // Commission Vat
                    let $commission_vat = $("#commission_vat_input_id_updater").val();
                    $commission_vat = numbers("commission_vat", $commission_vat);
                    if ($real_estate_price && $commission_vat) {
                        $commission_vat_price = $real_estate_price * ($commission_vat / 100);
                        let $text = "ضريبة القيمة المضافة " + $commission_vat_price.toLocaleString() + " ريال";
                        $(".commission_vat-validation").text($text);
                        $(".commission_vat-validation").removeClass("text-danger");
                        $(".commission_vat-validation").addClass("text-success");
                    } else {
                        $(".commission_vat-validation").text("");
                        $(".commission_vat-validation").removeClass("text-success");
                        $(".commission_vat-validation").addClass("text-danger");
                    }
                }

                if ($is_first_home_select_id_updater.val() == "1") {
                    if ($real_estate_price > 1000000) {
                        let $deserved_amount_input_id_updater = $("#deserved_amount_input_id_updater");
                        let $deserved_amount_price = $real_estate_price - 1000000;
                        $deserved_amount_input_id_updater.val($deserved_amount_price.toLocaleString());

                        $deserved_amount_percentage = $deserved_amount_price * 0.05;
                        let $text = "نسبة المبلغ المستحق " + $deserved_amount_percentage.toLocaleString() + " ريال";
                        $(".deserved_amount-validation").text($text);
                        $(".deserved_amount-validation").removeClass("text-danger");
                        $(".deserved_amount-validation").addClass("text-success");
                        setInputUpdater("deserved_amount", $deserved_amount_price);
                        @this.set('deserved_amount', $deserved_amount_price.toLocaleString());
                    } else {
                        setInputUpdater("deserved_amount", 0);
                        $("#deserved_amount_input_id_updater").val(0);
                        $(".deserved_amount-validation").text("لا يوجد مبلغ مستحق");
                        $(".deserved_amount-validation").removeClass("text-success");
                        $(".deserved_amount-validation").addClass("text-danger");
                    }
                }

                if ($commission_type_select_id_updater.val() == "percentage") {
                    let $commission_percentage = $("#commission_percentage_input_id_updater").val();
                    $commission_percentage = numbers("commission_percentage", $commission_percentage);

                    if ($real_estate_price && $commission_percentage) {
                        $commission_percentage_price = $real_estate_price * ($commission_percentage / 100);
                        let $text = "نسبة العمولة " + $commission_percentage_price.toLocaleString() + " ريال";
                        $(".commission_percentage-validation").text($text);
                        $(".commission_percentage-validation").removeClass("text-danger");
                        $(".commission_percentage-validation").addClass("text-success");
                    } else {
                        $(".commission_percentage-validation").text("");
                        $(".commission_percentage-validation").removeClass("text-success");
                        $(".commission_percentage-validation").addClass("text-danger");
                    }
                }

                if ($commission_type_select_id_updater.val() == "price") {

                    $commission_price = numbers("commission_price", $("#commission_price_input_id_updater").val());

                    if ($commission_price) {
                        let $text = "قيمة العمولة " + $commission_price.toLocaleString() + " ريال";
                        $(".commission_price-validation").text($text);
                        $(".commission_price-validation").removeClass("text-danger");
                        $(".commission_price-validation").addClass("text-success");
                    } else {
                        $(".commission_price-validation").text("");
                        $(".commission_price-validation").removeClass("text-success");
                        $(".commission_price-validation").addClass("text-danger");
                    }
                }

                $total_cal = $real_estate_price + $commission_price + $deserved_amount_percentage +
                    $commission_percentage_price + $commission_vat_price;

                $total_cal = $total_cal - $paid_amount_price;

                $total_input.val($total_cal.toLocaleString());
                setInputUpdater("total_amount", $total_cal);
                @this.set('total_amount', $total_cal.toLocaleString());
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

            $inputTextUpdater.on("input", function() {
                $name = $(this).attr("name");
                $value = $(this).val();
                setInputUpdater($name, $value);

                let array = ["space", "start_price", "end_price", "amount", "price_meter", "total",
                    "amount_paid", "deserved_amount", "commission_price", "commission_vat",
                    "commission_percentage", "total_amount"
                ];


                if (array.includes($name)) {
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

                        setInputUpdater($name, result);
                    }
                }

                if ($name == "start_price" || $name == "end_price") {
                    let $start_price = $("#start_price_input_id_updater").val();
                    $start_price = numbers($name, $start_price);
                    let $end_price = $("#end_price_input_id_updater").val();
                    $end_price = numbers($name, $end_price);

                    if ($start_price && $end_price) {
                        if ($start_price > $end_price) {
                            $(".start_price-validation").text(
                                "يجب أن يكون سعر البداية أقل من السعر النهائي");
                            $(".end_price-validation").text(
                                "يجب أن يكون السعر النهائي أكبر من سعر البداية");
                        } else {
                            $(".start_price-validation").text("");
                            $(".end_price-validation").text("");
                        }
                    }
                }

                if ($name == "price_meter" || $name == "space") {

                    let price_meter = $data_updater["price_meter"];
                    let space = $data_updater["space"];
                    let cal = $data_updater["total"];

                    if ($name == "space") {
                        let price_meter = numbers($name, $value);
                        let space = $data_updater["space"];
                    }

                    if ($name == "price_meter") {
                        let price_meter = $data_updater["price_meter"];
                        let space = numbers($name, $value);
                    }

                    if (price_meter && space) {
                        let cal = price_meter * space;
                        let $total = $("#total_amount_input_id_updater");
                        $total.val(cal.toLocaleString());
                        setInputUpdater("total", cal);
                        console.log(cal);
                    }

                }

                if ($name == "commission_vat") {
                    setUpdaterTotal();
                }

                if ($name == "commission_percentage") {
                    setUpdaterTotal();
                }

                if ($name == "commission_price") {
                    setUpdaterTotal();
                }

                if ($name == "deserved_amount") {
                    setUpdaterTotal();
                }

                if ($name == "amount_paid") {
                    let $total_price = numbers("total_amount", $("#total_amount_input_id_updater").val());
                    let $amount_paid = numbers("amount_paid", $("#amount_paid_input_id_updater").val());
                    if ($total_price && $amount_paid) {
                        if ($amount_paid > $total_price) {
                            $(".amount_paid-validation").text("");
                            $(".amount_paid-validation").text(
                                "يجب أن يكون المبلغ المدفوع أقل من أو يساوي المبلغ الإجمالي"
                            );
                        } else {
                            $(".amount_paid-validation").text("");
                        }
                    }
                    setUpdaterTotal();
                }


            });

            $inputSelectUpdater.on("change", function() {
                $name = $(this).attr("name");
                $value = $(this).val();
                setInputUpdater($name, $value);
                if ($name == "user_type") {
                    if ($value == "office") {
                        $advertiser_number_div.show();
                    } else {
                        $advertiser_number_div.hide();
                        $advertiser_number_input.val("");
                        $data_updater["advertiser_number"] = "";
                    }
                }

                if ($name == "is_first_home") {

                    if ($value == "1") {
                        $deserved_amount_input_id_updater_div.show();
                        $commission_vat_input_id_updater_div.hide();
                        setUpdaterTotal();
                    }

                    if ($value == "2") {
                        $deserved_amount_input_id_updater_div.hide();
                        $commission_vat_input_id_updater_div.show();
                        setUpdaterTotal();
                    }
                }

                if ($name == "commission_type") {

                    if ($value == "percentage") {
                        $commission_percentage_input_id_updater_div.show();
                        $commission_price_input_id_updater_div.hide();
                        setUpdaterTotal();

                    }

                    if ($value == "price") {
                        $commission_percentage_input_id_updater_div.hide();
                        $commission_price_input_id_updater_div.show();
                        setUpdaterTotal();
                    }
                }

                if ($name == "payment_method") {

                    if ($value == "cash_money") {
                        $bank_select_id_updater_div.hide();
                        $check_number_input_id_updater_div.hide();
                        $recipient_name_input_id_updater_div.show();
                        return true;
                    }

                    if ($value == "bank_check") {
                        $bank_select_id_updater_div.show();
                        $check_number_input_id_updater_div.show();
                        $recipient_name_input_id_updater_div.show();
                        return true;

                    }

                    if ($value == "bank_transfer") {
                        $bank_select_id_updater_div.show();
                        $check_number_input_id_updater_div.hide();
                        $recipient_name_input_id_updater_div.show();
                        return true;
                    }

                    $bank_select_id_updater_div.hide();
                    $check_number_input_id_updater_div.hide();
                    $recipient_name_input_id_updater_div.hide();
                }
            });

            $checkboxInputUpdater.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                let $checked = $(this).is(':checked');

                if ($checked) {
                    $(this).prop('checked', true);
                    setInputUpdater($name, true);
                    if ($name == "attribution_check") {
                        $attributionDiv.show();
                    }
                } else {
                    $(this).prop('checked', false);
                    setInputUpdater($name, false);
                    if ($name == "attribution_check") {
                        $attributionDiv.hide();
                    }
                }
            });

            $submitUpdater.on('click', function() {
                $(".reset-validation").text(" ");

                let $start_price = $("#start_price_input_id_updater").val();
                $start_price = numbers('start_price', $start_price);
                let $end_price = $("#end_price_input_id_updater").val();
                $end_price = numbers('end_price', $end_price);
                if ($start_price && $end_price) {
                    if ($start_price > $end_price) {
                        $(".start_price-validation").text(
                            "يجب أن يكون سعر البداية أقل من السعر النهائي");
                        $(".end_price-validation").text(
                            "يجب أن يكون السعر النهائي أكبر من سعر البداية");
                        return false;
                    } else {
                        $(".start_price-validation").text("");
                        $(".end_price-validation").text("");
                    }
                }

                for (let key in $data_updater) {

                    if ($data_updater.hasOwnProperty(key)) {

                        if (key == "total" || key == "total_amount" || key == "space" || key ==
                            "price_meter") {
                            let result = numbers(key, $data_updater[key]);
                            @this.set(key, result);
                            setInputUpdater(key, result);
                        } else {
                            @this.set(key, $data_updater[key]);
                        }
                    }
                }

                Livewire.emit('update', getContentUpdater());

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

            Livewire.on("closeModal", function(check) {
                window.location.reload();
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
                $advertiser_number_div.hide();
                $data_updater = [];

                if (check) {
                    let directions = document.querySelector("#directions_select_id_updater");
                    let directionsInstance = mdb.Select.getInstance(directions);
                    directionsInstance.setValue([]);

                    let street = document.querySelector("#street_width_select_id_updater");
                    let streetInstance = mdb.Select.getInstance(street);
                    streetInstance.setValue([]);
                }
            });

            Livewire.on('select2', function(id, value) {
                let $te = value + '';
                if ($te != 'null' && $te) {
                    const singleSelect = document.querySelector(id);
                    const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                    singleSelectInstance.setValue($te);
                }

                console.log(id, value);
            });

            Livewire.on('setSelectInputUpdater', function(data, inputid, id) {
                var $input = $("#" + inputid);
                var singleSelect = document.querySelector("#" + inputid);
                var singleSelectInstance = mdb.Select.getInstance(singleSelect);



                $.each(data, function(index, value) {

                    if (value == id) {
                        console.log(value, id);

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

                    // $input.append('<option value="' + value + '">' + index + '</option>');
                });

            });

            Livewire.on("setMultiSelectInput", function(data, inputid, ids) {
                const multiSelect = document.querySelector("#" + inputid);
                const multiSelectInstance = mdb.Select.getInstance(multiSelect);
                multiSelectInstance.setValue(ids);
            });

            Livewire.on('advertiser_number', function(type, advertiser_number) {

                if (type == "office") {
                    $advertiser_number_div.show();
                    $advertiser_number.text(advertiser_number);
                } else {
                    $advertiser_number_div.hide();
                    $advertiser_number_input.val("");
                }
            });

            Livewire.on('setDataFields', function(data) {
                // $(".reset-validation").text(" ");
                $data_updater = JSON.parse(data);
                console.log($data_updater);
            });

            Livewire.on("updateFrontDataUpdater", function(data) {
                $data_updater['client_id'] = data.id;
                $data_updater['client_name'] = data.name;
                $data_updater['client_phone'] = data.phone;
                $data_updater['client_employer'] = data.employer;
                $data_updater['client_is_buy'] = data.is_buy;
                $data_updater['client_employment_type'] = data.employment_type;
            });

            Livewire.on('showAttributionFields', function(id, check) {
                $('#attribution_check_input_id_updater').prop('checked', check);
                $data_updater['attribution_check'] = check;
                if (check) {
                    $attributionDiv.show();
                } else {
                    $attributionDiv.hide();
                }
            });

            Livewire.on('setNumberInput', function(id, name, value) {
                $input = $("#" + id);
                $input.val(value.toLocaleString());
                setInputUpdater(name, value);
            });

            Livewire.on("updateClientBuyerUpdater", function(client) {
                for (let key in client) {
                    if (client.hasOwnProperty(key)) {
                        if (client[key]) {
                            $data_updater[key] = client[key];
                        }
                    }
                }

                console.log($data_updater);
                console.log(client);
            });

            Livewire.on("updateClientsellerUpdater", function(client) {
                for (let key in client) {
                    if (client.hasOwnProperty(key)) {
                        if (client[key]) {
                            $data_updater[key] = client[key];
                        }
                    }
                }
            });

            Livewire.on("setSaleTypes", function(is_first_home, commission_type, payment_method) {

                if (is_first_home == "1") {
                    $deserved_amount_input_id_updater_div.show();
                    $commission_vat_input_id_updater_div.hide();
                    setUpdaterTotal();
                }

                if (is_first_home == "2") {
                    $deserved_amount_input_id_updater_div.hide();
                    $commission_vat_input_id_updater_div.show();
                    setUpdaterTotal();
                }


                if (commission_type == "percentage") {
                    $commission_percentage_input_id_updater_div.show();
                    $commission_price_input_id_updater_div.hide();
                    setUpdaterTotal();

                }

                if (commission_type == "price") {
                    $commission_percentage_input_id_updater_div.hide();
                    $commission_price_input_id_updater_div.show();
                    setUpdaterTotal();
                }


                if (payment_method == "cash_money") {
                    $bank_select_id_updater_div.hide();
                    $check_number_input_id_updater_div.hide();
                    $recipient_name_input_id_updater_div.show();
                }

                if (payment_method == "bank_check") {
                    $bank_select_id_updater_div.show();
                    $check_number_input_id_updater_div.show();
                    $recipient_name_input_id_updater_div.show();
                }

                if (payment_method == "bank_transfer") {
                    $bank_select_id_updater_div.show();
                    $check_number_input_id_updater_div.hide();
                    $recipient_name_input_id_updater_div.show();
                }

                // $bank_select_id_updater_div.hide();
                // $check_number_input_id_updater_div.hide();
                // $recipient_name_input_id_updater_div.hide();
            });

            Livewire.on('disableFieldsUpdater', function() {
                let $inputText = $(".inputTextUpdater");
                let $inputSelect = $(".inputSelectUpdater");

                $inputText.prop("disabled", true);
                $inputSelect.prop("disabled", true);

            });


        });
    </script>
@endpush

</div>
