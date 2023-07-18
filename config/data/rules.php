<?php

return [
    "offers" => [

        "main" => [
            "land_number" => ["required", "max:255"],
            "statement" => ["required", "max:255"],
            "block_number" => ["required", "max:255"],
            "city_id" => ["required", "exists:cities,id"],
            "neighborhood_id" => ["required", "exists:neighborhoods,id"],
            "property_type" => ["required", "in:land,duplex,condominium,flat,chalet,warehouse_land,agircultural_land,industrial_land,residential_land"],
            "space" => ["required", "numeric"],
            "total" => ["required", "numeric"],
            "branch_id" => ["required", "exists:branches,id"],
        ],

        "land" => [
            "price_meter" => ["required", "numeric"],
            "directions" => ["required", "array"],
            "land_type" => ["required", "in:stomach,corner,two-faces,head-block"],
            "licensed" => ["required", "in:residential,residential_investment,investment_business,services"],
            "street_width" => ["required", "array"],
            "character" => ["required", "max:255"],
            "interface_length" => ["required", "numeric"],
        ],

        "duplex" => [
            "age" => ["required", "numeric"],
            "directions" => ["required", "array"],
            "land_type" => ["required", "in:stomach,corner,two-faces,head-block"],
            "licensed" => ["required", "in:residential,residential_investment,investment_business,services"],
            "street_width" => ["required", "array"],
            "character" => ["required", "max:255"],
            "interface_length" => ["required", "numeric"],
            "building_type" => ["required"],
            "building_status" => ["required"],
            "construction_delivery" => ["required"],
        ],

        "condominium" => [
            "age" => ["required", "numeric"],
            "floors" => ["required", "numeric"],
            "flats" => ["required", "numeric"],
            "stores" => ["required", "numeric"],
            "annual_income" => ["required", "numeric"],
            "flat_rooms" => ["required", "numeric"],
        ],

        "flat" => [
            "bathrooms" => ["required", "numeric"],
            "flat_rooms" => ["required", "numeric"],
            "age" => ["required", "numeric"],
            "floor" => ["required", "numeric"],
        ],

        "chalet" => [
            "age" => ["required", "numeric"],
            "directions" => ["required", "array"],
            "street_width" => ["required", "array"],
            "owner_ship_type" => ["required"],
        ],

        "warehouse_land" => [
            "price_meter" => ["required", "numeric"],
            "licensed" => ["required", "in:residential,residential_investment,investment_business,services"],
            "street_width" => ["required", "array"],
            "character" => ["required", "max:255"],
            "interface_length" => ["required", "numeric"],
        ],

        "agircultural_land" => [
            "price_meter" => ["required", "numeric"],
            "licensed" => ["required", "in:residential,residential_investment,investment_business,services"],
            "street_width" => ["required", "array"],
            "character" => ["required", "max:255"],
            "interface_length" => ["required", "numeric"],
        ],

        "industrial_land" => [
            "price_meter" => ["required", "numeric"],
            "licensed" => ["required", "in:residential,residential_investment,investment_business,services"],
            "street_width" => ["required", "array"],
            "character" => ["required", "max:255"],
            "interface_length" => ["required", "numeric"],
        ],

        "residential_land" => [
            "price_meter" => ["required", "numeric"],
            "licensed" => ["required", "in:residential,residential_investment,investment_business,services"],
            "street_width" => ["required", "array"],
            "character" => ["required", "max:255"],
            "interface_length" => ["required", "numeric"],
        ],
    ]
];
