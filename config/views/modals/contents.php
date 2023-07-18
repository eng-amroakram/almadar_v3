<?php


return [
    "brokers-service" => [
        [
            "id" => "create-broker",
            "title" => "إضافة وسيط جديد",
            "prev" => "",
            "next" => "",
            "type" => "text",
            "status" => "show active",
            "inputs" => [],
            "checkboxes" => []
        ]
    ],

    "cities-service" => [
        [
            "id" => "create-city",
            "title" => "إنشاء مدينة جديدة",
            "prev" => "",
            "next" => "",
            "type" => "text",
            "status" => "show active",
            "inputs" => [],
            "checkboxes" => []
        ],
    ],

    "neighborhoods-service" => [
        [
            "id" => "create-neighborhood",
            "status" => "show active",
            "prev" => "",
            "next" => "",
            "inputs" => [],
            "checkboxes" => []
        ],
    ],

    "branches-service" => [
        [
            "id" => "create-branch",
            "status" => "active show",
            "prev" => "",
            "next" => "",
            "inputs" => [],
            "checkboxes" => []
        ],

    ],

    "users-service" => [
        [
            "id" => "user-info",
            "status" => "active show",
            "prev" => "",
            "next" => "",
            "inputs" => [],
            "checkboxes" => []
        ],
        // [
        //     "id" => "user-permissions",
        //     "status" => "",
        //     "prev" => "user-info",
        //     "next" => "",
        //     "inputs" => [],
        //     "checkboxes" => []
        // ],

    ],

    "clients-service" => [
        [
            "id" => "client-info",
            "status" => "active show",
            "prev" => "",
            "next" => "employer-information",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "employer-information",
            "status" => "",
            "prev" => "client-info",
            "next" => "national-address",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "national-address",
            "prev" => "employer-information",
            "next" => "",
            "status" => "",
            "inputs" => [],
            "checkboxes" => []
        ],
    ],

    "offers-service" => [
        [
            "id" => "basic-offer-info",
            "status" => "active show",
            "prev" => "",
            "next" => "real-estate-info",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "real-estate-info",
            "status" => "",
            "prev" => "basic-offer-info",
            "next" => "offer-notes",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "offer-notes",
            "prev" => "real-estate-info",
            "next" => "",
            "status" => "",
            "inputs" => [],
            "checkboxes" => []
        ],
    ],

    "orders-service" => [
        [
            "id" => "client-info",
            "status" => "active show",
            "prev" => "",
            "next" => "order-info",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "order-info",
            "status" => "",
            "prev" => "client-info",
            "next" => "order-notes",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "order-notes",
            "prev" => "order-info",
            "next" => "",
            "status" => "",
            "inputs" => [],
            "checkboxes" => []
        ],
    ],

    "orders-notes-service" => [
        [
            "id" => "add-order-note",
            "status" => "active show",
            "prev" => "",
            "next" => "",
            "inputs" => [],
            "checkboxes" => []
        ]
    ],

    "sales-service" => [
        [
            "id" => "offer-info",
            "status" => "active show",
            "prev" => "",
            "next" => "buyer-info",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "buyer-info",
            "status" => "",
            "prev" => "offer-info",
            "next" => "seller-info",
            "inputs" => [],
            "checkboxes" => []
        ],
        [
            "id" => "seller-info",
            "prev" => "buyer-info",
            "next" => "",
            "status" => "",
            "inputs" => [],
            "checkboxes" => []
        ],
    ],

    "sale-payment-service" => [
        [
            "id" => "new-sale-payment",
            "status" => "active show",
            "prev" => "",
            "next" => "",
            "inputs" => [],
            "checkboxes" => []
        ]
    ]

];
