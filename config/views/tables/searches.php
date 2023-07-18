<?php


return [

    "brokers-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],

        "type" => [
            "فرد" => "person",
            "مكتب" => "office",
        ],
    ],

    "cities-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],
    ],

    "neighborhoods-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],
    ],

    "branches-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],
    ],

    "users-service" => [
        "user_status" => [
            "نشط" => "active",
            "غير نشط" => "inactive",
        ],

        "user_type" => [
            "أدمن فرعي" => "admin",
            "مكتب" => "office",
            "مسوق" => "marketer",
        ],
    ],

    "clients-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],

        "employment_type" => [
            "عام" => "public",
            "خاص" => "private",
        ],

        "is_buy" => [
            "قام بالشراء" => 1,
            "لم يشتري" => 2,
        ],
    ],

    "orders-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],
    ],

    "offers-service" => [
        "real_estate_status" => [
            "شاغر" => "vacant",
            "محجوز" => "booked-up",
            "تم البيع" => "sold"
        ],

        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],
    ],

    "reservations-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],
    ],

    "sales-service" => [
        "status" => [
            "نشط" => 1,
            "غير نشط" => 2,
        ],
    ],

    "sale-payment-service" => []

];
