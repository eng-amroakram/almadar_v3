<div class="modal top fade" id="{{ $creator_id }}" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="Creator"
    aria-hidden="true" wire:ignore>
    <div class="modal-dialog {{ $size }} cascading-modal" style="margin-top: 4%">

        <div class="modal-content">

            <div class="modal-c-tabs">

                <x-creator.nav-tabs :tabs="$tabs"></x-creator.nav-tabs>

                <div class="tab-content">
                    <x-table-extension.loading></x-table-extension.loading>

                    @foreach ($contents as $content)
                        <x-creator.tab-content :content="$content" :size="$size" :creatorbuttong="'submitCreator'" :creatorid="$creator_id">
                        </x-creator.tab-content>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    @push('creator')
        <script>
            $(document).ready(function() {

                var $property_type_select_id_creator_div = $(".property_type_select_id_creator_div");
                var $space_input_id_creator_div = $(".space_input_id_creator_div");
                var $price_meter_input_id_creator_div = $(".price_meter_input_id_creator_div");
                var $total_input_id_creator_div = $(".total_input_id_creator_div");
                var $directions_select_id_creator_div = $(".directions_select_id_creator_div");
                var $land_type_select_id_creator_div = $(".land_type_select_id_creator_div");
                var $licensed_select_id_creator_div = $(".licensed_select_id_creator_div");
                var $street_width_select_id_creator_div = $(".street_width_select_id_creator_div");
                var $character_input_id_creator_div = $(".character_input_id_creator_div");
                var $interface_length_input_id_creator_div = $(".interface_length_input_id_creator_div");
                var $branch_id_select_id_creator_div = $(".branch_id_select_id_creator_div");
                var $bathrooms_input_id_creator_div = $(".bathrooms_input_id_creator_div");
                var $flat_rooms_input_id_creator_div = $(".flat_rooms_input_id_creator_div");
                var $age_input_id_creator_div = $(".age_input_id_creator_div");
                var $floor_input_id_creator_div = $(".floor_input_id_creator_div");
                var $floors_input_id_creator_div = $(".floors_input_id_creator_div");
                var $flats_input_id_creator_div = $(".flats_input_id_creator_div");
                var $rooms_input_id_creator_div = $(".rooms_input_id_creator_div");
                var $stores_input_id_creator_div = $(".stores_input_id_creator_div");
                var $annual_income_input_id_creator_div = $(".annual_income_input_id_creator_div");
                var $owner_ship_type_select_id_creator_div = $(".owner_ship_type_select_id_creator_div");
                var $building_type_select_id_creator_div = $(".building_type_select_id_creator_div");
                var $building_status_select_id_creator_div = $(".building_status_select_id_creator_div");
                var $construction_delivery_select_id_creator_div = $(".construction_delivery_select_id_creator_div");
                var $city_id_select_id_creator_div = $(".city_id_select_id_creator_div");
                var $neighborhood_id_select_id_creator_div = $(".neighborhood_id_select_id_creator_div");
                var $statement_input_id_creator_div = $(".statement_input_id_creator_div");
                var $land_number_input_id_creator_div = $(".land_number_input_id_creator_div");
                var $block_number_input_id_creator_div = $(".block_number_input_id_creator_div");
                var $brokers_ids_select_id_creator_div = $(".brokers_ids_select_id_creator_div");

                //Sale Fields
                var $offer_code_input_id_creator_div = $(".offer_code_input_id_creator_div");
                var $neighborhood_input_id_creator_div = $(".neighborhood_input_id_creator_div");
                var $land_number_input_id_creator_div = $(".land_number_input_id_creator_div");
                var $is_first_home_select_id_creator_div = $(".is_first_home_select_id_creator_div");
                var $real_estate_price_input_id_creator_div = $(".real_estate_price_input_id_creator_div");
                var $deserved_amount_input_id_creator_div = $(".deserved_amount_input_id_creator_div");
                var $commission_vat_input_id_creator_div = $(".commission_vat_input_id_creator_div");
                var $commission_type_select_id_creator_div = $(".commission_type_select_id_creator_div");
                var $commission_percentage_input_id_creator_div = $(".commission_percentage_input_id_creator_div");
                var $commission_price_input_id_creator_div = $(".commission_price_input_id_creator_div");
                var $amount_paid_input_id_creator_div = $(".amount_paid_input_id_creator_div");
                var $payment_method_select_id_creator_div = $(".payment_method_select_id_creator_div");
                var $bank_select_id_creator_div = $(".bank_select_id_creator_div");
                var $check_number_input_id_creator_div = $(".check_number_input_id_creator_div");
                var $recipient_name_input_id_creator_div = $(".recipient_name_input_id_creator_div");

                var $client_buyer_id_select_id_creator_div = $(".client_buyer_id_select_id_creator_div");
                var $client_buyer_name_input_id_creator_div = $(".client_buyer_name_input_id_creator_div");
                var $client_buyer_phone_input_id_creator_div = $(".client_buyer_phone_input_id_creator_div");
                var $client_buyer_id_number_type_input_id_creator_div = $(
                    ".client_buyer_id_number_type_input_id_creator_div");
                var $client_buyer_id_number_input_id_creator_div = $(".client_buyer_id_number_input_id_creator_div");
                var $client_buyer_email_input_id_creator_div = $(".client_buyer_email_input_id_creator_div");
                var $client_buyer_nationality_id_select_id_creator_div = $(
                    ".client_buyer_nationality_id_select_id_creator_div");
                var $client_buyer_city_id_select_id_creator_div = $(".client_buyer_city_id_select_id_creator_div");
                var $client_buyer_employment_type_select_id_creator_div = $(
                    ".client_buyer_employment_type_select_id_creator_div");
                var $client_buyer_housing_support_select_id_creator_div = $(
                    ".client_buyer_housing_support_select_id_creator_div");
                var $client_buyer_building_number_input_id_creator_div = $(
                    ".client_buyer_building_number_input_id_creator_div");
                var $client_buyer_street_name_input_id_creator_div = $(
                    ".client_buyer_street_name_input_id_creator_div");
                var $client_buyer_neighborhood_name_input_id_creator_div = $(
                    ".client_buyer_neighborhood_name_input_id_creator_div");
                var $client_buyer_zip_code_input_id_creator_div = $(".client_buyer_zip_code_input_id_creator_div");
                var $client_buyer_extra_figure_input_id_creator_div = $(
                    ".client_buyer_extra_figure_input_id_creator_div");
                var $client_buyer_unit_number_input_id_creator_div = $(
                    ".client_buyer_unit_number_input_id_creator_div");

                var $client_buyer_description_input_id_creator_div = $(
                    ".client_buyer_description_input_id_creator_div");

                var $client_seller_id_select_id_creator_div = $(".client_seller_id_select_id_creator_div");
                var $client_seller_name_input_id_creator_div = $(".client_seller_name_input_id_creator_div");
                var $client_seller_phone_input_id_creator_div = $(".client_seller_phone_input_id_creator_div");
                var $client_seller_id_number_type_input_id_creator_div = $(
                    ".client_seller_id_number_type_input_id_creator_div");
                var $client_seller_id_number_input_id_creator_div = $(".client_seller_id_number_input_id_creator_div");
                var $client_seller_email_input_id_creator_div = $(".client_seller_email_input_id_creator_div");
                var $client_seller_nationality_id_select_id_creator_div = $(
                    ".client_seller_nationality_id_select_id_creator_div");
                var $client_seller_city_id_select_id_creator_div = $(".client_seller_city_id_select_id_creator_div");
                var $client_seller_employment_type_select_id_creator_div = $(
                    ".client_seller_employment_type_select_id_creator_div");
                var $client_seller_housing_support_select_id_creator_div = $(
                    ".client_seller_housing_support_select_id_creator_div");
                var $client_seller_building_number_input_id_creator_div = $(
                    ".client_seller_building_number_input_id_creator_div");
                var $client_seller_street_name_input_id_creator_div = $(
                    ".client_seller_street_name_input_id_creator_div");
                var $client_seller_neighborhood_name_input_id_creator_div = $(
                    ".client_seller_neighborhood_name_input_id_creator_div");
                var $client_seller_zip_code_input_id_creator_div = $(".client_seller_zip_code_input_id_creator_div");
                var $client_seller_extra_figure_input_id_creator_div = $(
                    ".client_seller_extra_figure_input_id_creator_div");
                var $client_seller_unit_number_input_id_creator_div = $(
                    ".client_seller_unit_number_input_id_creator_div");
                var $client_seller_description_input_id_creator_div = $(
                    ".client_seller_description_input_id_creator_div");
                var $total_amount_input_id_creator_div = $(".total_amount_input_id_creator_div");


                var $reset_divs = $(".reset_divs");

                $reset_divs.hide();
                $property_type_select_id_creator_div.show();
                $space_input_id_creator_div.show();
                $price_meter_input_id_creator_div.show();
                $total_input_id_creator_div.show();
                $total_amount_input_id_creator_div.show();
                $directions_select_id_creator_div.show();
                $land_type_select_id_creator_div.show();
                $licensed_select_id_creator_div.show();
                $street_width_select_id_creator_div.show();
                $character_input_id_creator_div.show();
                $interface_length_input_id_creator_div.show();
                $branch_id_select_id_creator_div.show();

                $city_id_select_id_creator_div.show();
                $neighborhood_id_select_id_creator_div.show();
                $statement_input_id_creator_div.show();
                $land_number_input_id_creator_div.show();
                $block_number_input_id_creator_div.show();
                $brokers_ids_select_id_creator_div.show();

                //Sales Fields

                $offer_code_input_id_creator_div.show();
                $neighborhood_input_id_creator_div.show();
                $land_number_input_id_creator_div.show();
                $is_first_home_select_id_creator_div.show();
                $real_estate_price_input_id_creator_div.show();
                $deserved_amount_input_id_creator_div.hide();
                $commission_vat_input_id_creator_div.hide();
                $commission_type_select_id_creator_div.show();
                $commission_percentage_input_id_creator_div.hide();
                $commission_price_input_id_creator_div.hide();
                $amount_paid_input_id_creator_div.show();
                $payment_method_select_id_creator_div.show();
                $bank_select_id_creator_div.hide();
                $check_number_input_id_creator_div.hide();
                $recipient_name_input_id_creator_div.hide();

                // Buyer Fields
                $client_buyer_id_select_id_creator_div.show();
                $client_buyer_name_input_id_creator_div.show();
                $client_buyer_phone_input_id_creator_div.show();
                $client_buyer_id_number_type_input_id_creator_div.show();
                $client_buyer_id_number_input_id_creator_div.show();
                $client_buyer_email_input_id_creator_div.show();
                $client_buyer_nationality_id_select_id_creator_div.show();
                $client_buyer_city_id_select_id_creator_div.show();
                $client_buyer_employment_type_select_id_creator_div.show();
                $client_buyer_housing_support_select_id_creator_div.show();
                $client_buyer_building_number_input_id_creator_div.show();
                $client_buyer_street_name_input_id_creator_div.show();
                $client_buyer_neighborhood_name_input_id_creator_div.show();
                $client_buyer_zip_code_input_id_creator_div.show();
                $client_buyer_extra_figure_input_id_creator_div.show();
                $client_buyer_unit_number_input_id_creator_div.show();
                $client_buyer_description_input_id_creator_div.show();

                //Seller Fields
                $client_seller_id_select_id_creator_div.show();
                $client_seller_name_input_id_creator_div.show();
                $client_seller_phone_input_id_creator_div.show();
                $client_seller_id_number_type_input_id_creator_div.show();
                $client_seller_id_number_input_id_creator_div.show();
                $client_seller_email_input_id_creator_div.show();
                $client_seller_nationality_id_select_id_creator_div.show();
                $client_seller_city_id_select_id_creator_div.show();
                $client_seller_employment_type_select_id_creator_div.show();
                $client_seller_housing_support_select_id_creator_div.show();
                $client_seller_building_number_input_id_creator_div.show();
                $client_seller_street_name_input_id_creator_div.show();
                $client_seller_neighborhood_name_input_id_creator_div.show();
                $client_seller_zip_code_input_id_creator_div.show();
                $client_seller_extra_figure_input_id_creator_div.show();
                $client_seller_unit_number_input_id_creator_div.show();
                $client_seller_description_input_id_creator_div.show();
                $("#total_input_id_creator").attr("disabled", true);


                function viewsCreator($type) {

                    $reset_divs.hide();
                    $property_type_select_id_creator_div.show();
                    $city_id_select_id_creator_div.show();
                    $neighborhood_id_select_id_creator_div.show();
                    $statement_input_id_creator_div.show();
                    $land_number_input_id_creator_div.show();
                    $block_number_input_id_creator_div.show();
                    $brokers_ids_select_id_creator_div.show();
                    $("#total_input_id_creator").attr("disabled", false);

                    if ($type == "land") {
                        $space_input_id_creator_div.show();
                        $price_meter_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $directions_select_id_creator_div.show();
                        $land_type_select_id_creator_div.show();
                        $licensed_select_id_creator_div.show();
                        $street_width_select_id_creator_div.show();
                        $character_input_id_creator_div.show();
                        $interface_length_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                        $("#total_input_id_creator").attr("disabled", "disabled");
                    }

                    if ($type == "duplex") {
                        $space_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $age_input_id_creator_div.show();
                        $directions_select_id_creator_div.show();
                        $land_type_select_id_creator_div.show();
                        $licensed_select_id_creator_div.show();
                        $street_width_select_id_creator_div.show();
                        $character_input_id_creator_div.show();
                        $interface_length_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                        $building_type_select_id_creator_div.show();
                        $building_status_select_id_creator_div.show();
                        $construction_delivery_select_id_creator_div.show();
                    }

                    if ($type == "condominium") {
                        $space_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $age_input_id_creator_div.show();
                        $floors_input_id_creator_div.show();
                        $flats_input_id_creator_div.show();
                        $stores_input_id_creator_div.show();
                        $annual_income_input_id_creator_div.show();
                        $flat_rooms_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                    }

                    if ($type == "flat") {
                        $space_input_id_creator_div.show();
                        $bathrooms_input_id_creator_div.show();
                        $flat_rooms_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $age_input_id_creator_div.show();
                        $floor_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                    }


                    if ($type == "chalet") {
                        $space_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $age_input_id_creator_div.show();
                        $directions_select_id_creator_div.show();
                        $street_width_select_id_creator_div.show();
                        $owner_ship_type_select_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                    }

                    if ($type == "warehouse_land") {
                        $space_input_id_creator_div.show();
                        $price_meter_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $licensed_select_id_creator_div.show();
                        $street_width_select_id_creator_div.show();
                        $character_input_id_creator_div.show();
                        $interface_length_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                        $("#total_input_id_creator").attr("disabled", "disabled");
                    }

                    if ($type == "agircultural_land") {
                        $space_input_id_creator_div.show();
                        $price_meter_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $licensed_select_id_creator_div.show();
                        $street_width_select_id_creator_div.show();
                        $character_input_id_creator_div.show();
                        $interface_length_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                        $("#total_input_id_creator").attr("disabled", "disabled");

                    }

                    if ($type == "industrial_land") {
                        $space_input_id_creator_div.show();
                        $price_meter_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $licensed_select_id_creator_div.show();
                        $street_width_select_id_creator_div.show();
                        $character_input_id_creator_div.show();
                        $interface_length_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                        $("#total_input_id_creator").attr("disabled", "disabled");

                    }


                    if ($type == "residential_land") {
                        $space_input_id_creator_div.show();
                        $price_meter_input_id_creator_div.show();
                        $total_input_id_creator_div.show();
                        $licensed_select_id_creator_div.show();
                        $street_width_select_id_creator_div.show();
                        $character_input_id_creator_div.show();
                        $interface_length_input_id_creator_div.show();
                        $branch_id_select_id_creator_div.show();
                        $("#total_input_id_creator").attr("disabled", "disabled");

                    }

                }

                //Custom User
                var $advertiser_number_div = $(".advertiser-number-div");
                var $advertiser_number = $(".advertiser-number");
                var $advertiser_number_input = $(".advertiser-number-input");
                $advertiser_number_div.hide();

                // Custom Order
                var $attributionInput = $(".attributionInput");
                var $attributionDiv = $(".attributionDiv");
                $attributionDiv.hide();

                //Buttons
                var $submitCreator = $(".submitCreator");

                //Inputs
                var $inputTextCreator = $(".inputTextCreator");
                var $inputSelectCreator = $(".inputSelectCreator");
                var $checkboxInputCreator = $(".checkboxInputCreator");
                //Next
                var $nextCreator = $(".nextCreator");

                //Tabs
                var $nav_tabs_custom_creator = $(".nav-tabs-custom-creator");
                var $nav_link_custom_creator = $(".nav-link-custom-creator");


                $nextCreator.on('click', function() {
                    let $id = $(this).attr('tapcreatorid');

                    if ($id) {
                        let $tab = '.' + $id + '-' + 'creator-tap';
                        let $nav = '.' + $id + '-' + 'creator-nav';

                        $nav_link_custom_creator.removeClass('active');
                        $nav_tabs_custom_creator.removeClass('active');
                        $nav_tabs_custom_creator.removeClass('show');

                        $($nav).addClass('active');
                        $($tab).addClass('active');
                        $($tab).addClass('show');
                    }

                });

                //Data
                var $data = [];

                //Functions
                function setInput($name, $value) {
                    $data[$name] = $value;
                }

                function getContent() {
                    var $object = Object.assign({}, $data);
                    return JSON.stringify($object);
                }

                function numbers($name, $value) {

                    if ($value) {

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

                    return 0;

                }

                function setTotal() {
                    let $total_input = $("#total_amount_input_id_creator");
                    let $total_cal = 0;
                    var $real_estate_price = numbers("real_estate_price", $("#real_estate_price_input_id_creator")
                        .val());
                    var $commission_price = 0;
                    var $commission_vat_price = 0;
                    var $deserved_amount_percentage = 0;
                    var $commission_percentage_price = 0;
                    var $paid_amount_price = numbers("paid_amount", $("#amount_paid_input_id_creator").val());

                    var $is_first_home_select_id_creator = $("#is_first_home_select_id_creator");
                    var $commission_type_select_id_creator = $("#commission_type_select_id_creator");

                    if ($is_first_home_select_id_creator.val() == "2") {
                        // Commission Vat
                        let $commission_vat = $("#commission_vat_input_id_creator").val();
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

                    if ($is_first_home_select_id_creator.val() == "1") {
                        if ($real_estate_price > 1000000) {
                            let $deserved_amount_input_id_creator = $("#deserved_amount_input_id_creator");
                            let $deserved_amount_price = $real_estate_price - 1000000;
                            $deserved_amount_input_id_creator.val($deserved_amount_price.toLocaleString());

                            $deserved_amount_percentage = $deserved_amount_price * 0.05;
                            let $text = "نسبة المبلغ المستحق " + $deserved_amount_percentage.toLocaleString() + " ريال";
                            $(".deserved_amount-validation").text($text);
                            $(".deserved_amount-validation").removeClass("text-danger");
                            $(".deserved_amount-validation").addClass("text-success");
                            setInput("deserved_amount", $deserved_amount_price);
                            @this.set('deserved_amount', $deserved_amount_price.toLocaleString());
                        } else {
                            setInput("deserved_amount", 0);
                            $("#deserved_amount_input_id_creator").val(0);
                            $(".deserved_amount-validation").text("لا يوجد مبلغ مستحق");
                            $(".deserved_amount-validation").removeClass("text-success");
                            $(".deserved_amount-validation").addClass("text-danger");
                        }
                    }

                    if ($commission_type_select_id_creator.val() == "percentage") {
                        let $commission_percentage = $("#commission_percentage_input_id_creator").val();
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

                    if ($commission_type_select_id_creator.val() == "price") {

                        $commission_price = numbers("commission_price", $("#commission_price_input_id_creator").val());

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
                    setInput("total_amount", $total_cal);
                    @this.set('total_amount', $total_cal.toLocaleString());
                }


                //Events
                $inputTextCreator.on("input", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
                    setInput($name, $value);

                    let array = ["space", "start_price", "end_price", "amount", "price_meter", "total",
                        "amount_paid", "deserved_amount", "commission_price", "commission_vat",
                        "commission_percentage"
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

                            setInput($name, result);
                        }
                    }

                    if ($name == "price_meter" || $name == "space") {

                        let price_meter = $data["price_meter"];
                        let space = $data["space"];
                        let cal = $data["total"];

                        if ($name == "space") {
                            let price_meter = numbers($name, $value);
                            let space = $data["space"];
                        }

                        if ($name == "price_meter") {
                            let price_meter = $data["price_meter"];
                            let space = numbers($name, $value);
                        }

                        if (price_meter && space) {
                            let cal = price_meter * space;
                            let $total = $("#total_input_id_creator");
                            $total.val(cal.toLocaleString());
                            setInput("total", cal);
                            @this.set("total", cal);
                            $total.val(cal.toLocaleString());
                        }

                    }

                    if ($name == "start_price" || $name == "end_price") {
                        let $start_price = $("#start_price_input_id_creator").val();
                        $start_price = numbers($name, $start_price);
                        let $end_price = $("#end_price_input_id_creator").val();
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

                    if ($name == "commission_vat") {
                        setTotal();
                    }

                    if ($name == "commission_percentage") {
                        setTotal();
                    }

                    if ($name == "commission_price") {
                        setTotal();
                    }

                    if ($name == "deserved_amount") {
                        setTotal();
                    }

                    if ($name == "amount_paid") {
                        let $total_price = numbers("total_amount", $("#total_amount_input_id_creator").val());
                        console.log($total_price);
                        let $amount_paid = numbers("amount_paid", $("#amount_paid_input_id_creator").val());
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

                        setTotal();
                    }

                    if ($name == "amount") {
                        let $remaining_amount = numbers("remaining_amount", $(
                            "#remaining_amount_input_id_creator").val());
                        let $amount = numbers("amount", $("#amount_input_id_creator").val());
                        if ($remaining_amount && $amount) {
                            if ($amount > $remaining_amount) {
                                $(".amount-validation").text("");
                                $(".amount-validation").text(
                                    "يجب أن يكون المبلغ المدفوع أقل من أو يساوي المبلغ المتبقي"
                                );
                            } else {
                                $(".amount-validation").text("");
                            }
                        }
                    }


                });

                $inputSelectCreator.on("change", function() {
                    let $name = $(this).attr("name");
                    let $value = $(this).val();
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

                    if ($name == "property_type") {
                        viewsCreator($value);
                    }

                    if ($name == "is_first_home") {

                        if ($value == "1") {
                            $deserved_amount_input_id_creator_div.show();
                            $commission_vat_input_id_creator_div.hide();
                            setTotal();
                        }

                        if ($value == "2") {
                            $deserved_amount_input_id_creator_div.hide();
                            $commission_vat_input_id_creator_div.show();
                            setTotal();
                        }
                    }

                    if ($name == "commission_type") {

                        if ($value == "percentage") {
                            $commission_percentage_input_id_creator_div.show();
                            $commission_price_input_id_creator_div.hide();
                            setTotal();

                        }

                        if ($value == "price") {
                            $commission_percentage_input_id_creator_div.hide();
                            $commission_price_input_id_creator_div.show();
                            setTotal();
                        }
                    }

                    if ($name == "payment_method") {

                        if ($value == "cash_money") {
                            $bank_select_id_creator_div.hide();
                            $check_number_input_id_creator_div.hide();
                            $recipient_name_input_id_creator_div.show();
                            return true;
                        }

                        if ($value == "bank_check") {
                            $bank_select_id_creator_div.show();
                            $check_number_input_id_creator_div.show();
                            $recipient_name_input_id_creator_div.show();
                            return true;

                        }

                        if ($value == "bank_transfer") {
                            $bank_select_id_creator_div.show();
                            $check_number_input_id_creator_div.hide();
                            $recipient_name_input_id_creator_div.show();
                            return true;
                        }

                        $bank_select_id_creator_div.hide();
                        $check_number_input_id_creator_div.hide();
                        $recipient_name_input_id_creator_div.hide();

                    }


                });

                $checkboxInputCreator.on('change', function() {
                    let $value = $(this).val();
                    let $name = $(this).attr('name');
                    let $checked = $(this).is(':checked');

                    if ($checked) {
                        $(this).prop('checked', true);
                        setInput($name, true);
                        if ($name == "attribution_check") {
                            $attributionDiv.show();
                        }
                    } else {
                        setInput($name, false);
                        $(this).prop('checked', false);
                        if ($name == "attribution_check") {
                            $attributionDiv.hide();
                        }
                    }
                });

                $submitCreator.on('click', function() {
                    $(".reset-validation").text(" ");
                    let $start_price = $("#start_price_input_id_creator").val();
                    $start_price = numbers('start_price', $start_price);
                    let $end_price = $("#end_price_input_id_creator").val();
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

                    for (let key in $data) {
                        if ($data.hasOwnProperty(key)) {
                            @this.set(key, $data[key]);
                            console.log(key + " -> " + $data[key]);
                        }
                    }

                    Livewire.emit('store', getContent());
                });

                Livewire.on("errors", function(errors) {
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
                    let $id = "#{{ $creator_id }}";
                    $($id).modal('hide');
                    $(".reset-validation").val("");
                    $data = [];

                    if (check) {
                        let directions = document.querySelector("#directions_select_id_creator");
                        let directionsInstance = mdb.Select.getInstance(directions);
                        directionsInstance.setValue([]);

                        let street = document.querySelector("#street_width_select_id_creator");
                        let streetInstance = mdb.Select.getInstance(street);
                        streetInstance.setValue([]);
                    }

                });

                Livewire.on('select2', function(id, value) {
                    let $te = value + '';
                    if ($te != 'null' && $te) {
                        console.log(id);
                        console.log($te);
                        const singleSelect = document.querySelector(id);
                        const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                        if (singleSelectInstance) {
                            singleSelectInstance.setValue($te);
                        }
                    }
                });

                Livewire.on('updateClientBuyerFieldwithDisableIt', function(id, value) {
                    let $te = value + '';
                    if ($te != 'null' && $te) {
                        const singleSelect = document.querySelector(id);
                        const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                        singleSelectInstance.setValue($te);

                    }

                    $(id).attr("disabled", "disabled");
                    $(".client_buyer_id-validation").text("قام العميل بحجز العقار ودفع مبلغ عربون");

                });

                Livewire.on('updateSalePaymentBuyerFieldwithDisableIt', function(id, value, remaining_amount) {
                    let $te = value + '';
                    if ($te != 'null' && $te) {
                        const singleSelect = document.querySelector(id);
                        const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                        singleSelectInstance.setValue($te);

                    }

                    $(id).attr("disabled", "disabled");
                    $(".client_buyer_id-validation").text("قام العميل بحجز العقار ودفع مبلغ عربون");
                    $("#remaining_amount_input_id_creator").val(remaining_amount);

                    if (remaining_amount == 0) {
                        $("#remaining_amount_input_id_creator").attr("disabled", "disabled");
                        $("#amount_input_id_creator").attr("disabled", "disabled");
                        $("#payment_method_select_id_creator").attr("disabled", "disabled");
                        $(".submitCreator").attr("disabled", "disabled");
                        $(".remaining_amount-validation").text("تم دفع المبلغ بالكامل");
                    }
                });

                Livewire.on('setSelectInputCreator', function(data, inputid) {
                    var $input = $("#" + inputid);
                    var singleSelect = document.querySelector("#" + inputid);
                    var singleSelectInstance = mdb.Select.getInstance(singleSelect);
                    $input.empty();

                    $.each(data, function(index, value) {
                        $input.append('<option value="' + value + '">' + index + '</option>');
                        singleSelectInstance.setValue(value);
                    });
                });

                Livewire.on("updateFrontDataCreator", function(data) {
                    $data['client_id'] = data.id;
                    $data['client_name'] = data.name;
                    $data['client_phone'] = data.phone;
                    $data['client_employer'] = data.employer;
                    $data['client_is_buy'] = data.is_buy;
                    $data['client_employment_type'] = data.employment_type;
                });

                Livewire.on("updateClientBuyerCreator", function(client) {
                    for (let key in client) {
                        if (client.hasOwnProperty(key)) {
                            if (client[key]) {
                                $data[key] = client[key];
                            }
                        }
                    }
                });

                Livewire.on("updateClientsellerCreator", function(client) {
                    for (let key in client) {
                        if (client.hasOwnProperty(key)) {
                            if (client[key]) {
                                $data[key] = client[key];
                            }
                        }
                    }
                });

            });
        </script>
    @endpush

</div>
