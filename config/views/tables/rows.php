<?php


return [
    "brokers-service" => [
        "id" => 'property',
        "name" => 'property',
        "phone" => 'property',
        "type_name" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "cities-service" =>  [
        "id" => 'property',
        "name" => 'property',
        "code" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "neighborhoods-service" => [
        "id" => 'property',
        "name" => 'property',
        "city_name" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "users-service" => [
        "id" => 'property',
        "name" => 'property',
        "phone" => 'property',
        "type" => 'badge',
        "branches" => 'dropdown',
        "user_status" => 'status',
        "actions" => ["delete", "edit", "show"],
    ],

    "branches-service" => [
        "id" => 'property',
        "name" => 'property',
        "code" => 'property',
        "city_name" => 'property',
        "status" => 'status',
        "users_count" => 'property',
        "actions" => ["delete", "edit"],
    ],

    "clients-service" => [
        "id" => 'property',
        "name" => 'property',
        "phone" => 'property',
        "city_name" => 'property',
        "client_neighborhood_name" => 'property',
        "employment_type_name" => 'property',
        "is_buy_name" => 'property',
        "status" => 'status',
        "actions" => ["delete", "edit"],
    ],

    "orders-service" => [
        "order_code" => 'property',
        "created_at_formated" => 'property',
        "real_estate_type" => 'property',
        "user_name" => 'property',
        "city_name" => 'property',
        "client_name" => 'property',
        "budget" => 'property',
        "attribution_name" => 'property',
        "branch_name" => 'property',
        "order_status" => 'property',
        "actions" => ["delete", "edit", "show"],
    ],

    "offers-service" => [
        "offer_code" => 'property',
        "offer_type_name" => 'property',
        "user_name" => 'property',
        "statement" => 'property',
        "city_name" => 'property',
        "neighborhood_name" => 'property',
        "total_string" => 'property',
        "space_string" => 'property',
        "branch_name" => 'property',
        "real_estate_type_name" => 'property',
        "real_estate_status_name" => 'badge',
        // "status" => 'status',
        "actions" => ["delete", "edit", "show"],
    ],

    "reservations-service" => [
        "id" => 'property',
        "date" => 'property',
        "client_name" => 'property',
        "price_string" => 'property',
        "period" => 'property',
        "status" => 'status',
        "actions" => ["delete"],
    ],

    "sales-service" => [
        "sale_code" => 'property',
        "created_at_fromated" => 'property',
        "city_name" => 'property',
        "real_estate_type" => 'property',
        "land_number" => 'property',
        "space_string" => 'property',
        "real_estate_price_string" => 'property',
        "price_commission_vat" => 'property',
        "amount_paid_string" => 'property',
        "remaining_amount_string" => 'property',
        "client_employment_type" => 'property',
        "branch_name" => 'property',
        "status" => 'status',
        "actions" => ["show"],
    ],

    "sale-payment-service" => [
        "id" => 'property',
        "sale_code" => 'property',
        "buyer_name" => 'property',
        "seller_name" => 'property',
        "amount_string" => 'property',
        "created_at" => 'property',
        "actions" => ["download"],
    ]
];
