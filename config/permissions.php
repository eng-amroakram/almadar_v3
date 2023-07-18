<?php

return [
    "all" => [
        'cities' => true,
        'neighborhoods' => true,
        'reservations' => true,
        'clients' => true,
        'branches' => true,
        'direct_offers' => true,
        'indirect_offers' => true,
        "orders" => true,
        "sales" => true,
        'sms' => true,
        'send_individual_messages' => true,
        'send_collection_messages' => true,
        'mediators' => true,

        "users" => true,
        "can_show_user" => true,
        "can_add_user" => true,
        "can_edit_user" => true,
        "can_delete_user" => true,
        "can_change_user_status" => true,

        'orders' => true,
        "can_show_order" => true,
        "can_add_order" => true,
        "can_edit_order" => true,
        "can_delete_order" => true,
        "can_change_order_status" => true,

        'offers' => true,
        'can_show_offer' => true,
        'can_add_offer' => true,
        'can_edit_offer' => true,
        'can_delete_offer' => true,
        'can_change_offer_status' => true,

        'sales' => true,
        'can_show_sale' => true,
        'can_add_sale' => true,
        'can_edit_sale' => true,
        'can_delete_sale' => true,
        'can_change_sale_status' => true,
    ],

    "marketer" => [
        "users" => false,
        'cities' => false,
        'neighborhoods' => false,
        'reservations' => true,
        'clients' => false,
        'branches' => false,
        'direct_offers' => true,
        'indirect_offers' => true,
        "orders" => true,
        "sales" => false,
        'sms' => false,
        'send_individual_messages' => false,
        'send_collection_messages' => false,
        'mediators' => false,

        "can_show_user" => false,
        "can_add_user" => false,
        "can_edit_user" => false,
        "can_delete_user" => false,
        "can_change_user_status" => false,

        "can_show_order" => true,
        "can_add_order" => true,
        "can_edit_order" => true,
        "can_delete_order" => true,
        "can_change_order_status" => true,

        'can_show_offer' => true,
        'can_add_offer' => true,
        'can_edit_offer' => true,
        'can_delete_offer' => true,
        'can_change_offer_status' => true,

        'can_show_sale' => false,
        'can_add_sale' => false,
        'can_edit_sale' => false,
        'can_delete_sale' => false,
        'can_change_sale_status' => false,
    ],

    "office" => [
        "users" => false,
        'cities' => false,
        'neighborhoods' => false,
        'reservations' => false,
        'clients' => false,
        'branches' => false,
        'direct_offers' => false,
        'indirect_offers' => true,
        "orders" => false,
        "sales" => false,
        'sms' => false,
        'send_individual_messages' => false,
        'send_collection_messages' => false,
        'mediators' => false,

        "can_show_user" => false,
        "can_add_user" => false,
        "can_edit_user" => false,
        "can_delete_user" => false,
        "can_change_user_status" => false,

        "can_show_order" => false,
        "can_add_order" => false,
        "can_edit_order" => false,
        "can_delete_order" => false,
        "can_change_order_status" => false,

        'can_show_offer' => true,
        'can_add_offer' => true,
        'can_edit_offer' => true,
        'can_delete_offer' => true,
        'can_change_offer_status' => true,

        'can_show_sale' => false,
        'can_add_sale' => false,
        'can_edit_sale' => false,
        'can_delete_sale' => false,
        'can_change_sale_status' => false,
    ],

    "admin" => [
        "users" => false,
        'cities' => false,
        'neighborhoods' => false,
        'reservations' => true,
        'clients' => false,
        'branches' => false,
        'direct_offers' => true,
        'indirect_offers' => true,
        "orders" => true,
        "sales" => true,
        'sms' => false,
        'send_individual_messages' => false,
        'send_collection_messages' => false,
        'mediators' => true,

        "can_show_user" => false,
        "can_add_user" => false,
        "can_edit_user" => false,
        "can_delete_user" => false,
        "can_change_user_status" => false,

        "can_show_order" => true,
        "can_add_order" => true,
        "can_edit_order" => true,
        "can_delete_order" => true,
        "can_change_order_status" => true,

        'can_show_offer' => true,
        'can_add_offer' => true,
        'can_edit_offer' => true,
        'can_delete_offer' => true,
        'can_change_offer_status' => true,

        'can_show_sale' => true,
        'can_add_sale' => true,
        'can_edit_sale' => true,
        'can_delete_sale' => true,
        'can_change_sale_status' => true,
    ],





















    "false" => [
        'cities' => false,
        'neighborhoods' => false,
        'reservations' => false,
        'clients' => false,
        'branches' => false,
        'direct_offers' => false,
        'indirect_offers' => false,
        "orders" => false,
        "sales" => false,
        'sms' => false,
        'send_individual_messages' => false,
        'send_collection_messages' => false,
        'mediators' => false,
        "users" => false,
        "can_show_user" => false,
        "can_add_user" => false,
        "can_edit_user" => false,
        "can_delete_user" => false,
        "can_change_user_status" => false,
        'orders' => false,
        "can_add_order" => false,
        "can_edit_order" => false,
        "can_show_order" => false,
        "can_delete_order" => false,
        "can_change_order_status" => false,
        'offers' => false,
        'can_show_offer' => false,
        'can_add_offer' => false,
        'can_edit_offer' => false,
        'can_delete_offer' => false,
        'can_change_offer_status' => false,
        'sales' => false,
        'can_show_sale' => false,
        'can_add_sale' => false,
        'can_edit_sale' => false,
        'can_delete_sale' => false,
        'can_change_sale_status' => false,
    ],

    "permissions" => [
        "pages" => [
            'users',
            'cities',
            'neighborhoods',
            'reservations',
            'clients',
            'branches',
            'direct_offers',
            'indirect_offers',
            'orders',
            'sales',
            'sms',
            'mediators',
        ],

        "users" => [
            "can_show_user",
            "can_add_user",
            "can_edit_user",
            "can_delete_user",
            "can_change_user_status",
        ],

        "orders" => [
            "can_show_order",
            "can_add_order",
            "can_edit_order",
            "can_delete_order",
            "can_change_order_status",
        ],

        "offers" => [
            'can_show_offer',
            'can_add_offer',
            'can_edit_offer',
            'can_delete_offer',
            'can_change_offer_status',
        ],

        "sales" => [
            'can_show_sale',
            'can_add_sale',
            'can_edit_sale',
            'can_delete_sale',
            'can_change_sale_status',
        ],

        "sms" => [
            'send_individual_messages',
            'send_collection_messages',
        ],
    ],

    "select-permissions" => [
        "pages" => [
            "المدن" => 'cities',
            "المستخدمين" => 'users',
            "الاحياء" => 'neighborhoods',
            "الحجوزات" => 'reservations',
            "العملاء" => 'clients',
            "العروض المباشرة" => 'direct_offers',
            "العروض الغير مباشرة" => 'indirect_offers',
            "الطلبات" => 'orders',
            "المبيعات" => 'sales',
            "الفروع" => 'branches',
            "الرسائل" => 'sms',
            "الوسطاء" => 'mediators',
        ],

        "users" => [
            "رؤية" => "can_show_user",
            "إضافة" => "can_add_user",
            "تعديل" => "can_edit_user",
            "حذف" => "can_delete_user",
            "تغير الحالة" => "can_change_user_status",
        ],

        "orders" => [
            "رؤية" => "can_show_order",
            "إضافة" => "can_add_order",
            "تعديل" => "can_edit_order",
            "حذف" => "can_delete_order",
            "تغير الحالة" => "can_change_order_status",
        ],

        "offers" => [
            "رؤية" => 'can_show_offer',
            "إضافة" => 'can_add_offer',
            "تعديل" => 'can_edit_offer',
            "حذف" => 'can_delete_offer',
            "تغير الحالة" => 'can_change_offer_status',
        ],

        "sales" => [
            "رؤية" => 'can_show_sale',
            "إضافة" => 'can_add_sale',
            "تعديل" => 'can_edit_sale',
            "حذف" => 'can_delete_sale',
            "تغير الحالة" => 'can_change_sale_status',
        ],

        "sms" => [
            "الرسائل الفردية" => 'send_individual_messages',
            "الرسائل الجماعية" => 'send_collection_messages',
        ],
    ],

    "permissions-false" => [
        "pages" => [
            'cities' => false,
            'neighborhoods' => false,
            'users' => false,
            'reservations' => false,
            'clients' => false,
            'branches' => false,
            'direct_offers' => false,
            'indirect_offers' => false,
            'orders' => false,
            'sales' => false,
            'sms' => false,
            'mediators' => false,
        ],

        "users" => [
            "can_show_user" => false,
            "can_add_user" => false,
            "can_edit_user" => false,
            "can_delete_user" => false,
            "can_change_user_status" => false,
        ],

        "orders" => [
            "can_show_order" => false,
            "can_add_order" => false,
            "can_edit_order" => false,
            "can_delete_order" => false,
            "can_change_order_status" => false,
        ],

        "offers" => [
            'can_show_offer' => false,
            'can_add_offer' => false,
            'can_edit_offer' => false,
            'can_delete_offer' => false,
            'can_change_offer_status' => false,
        ],

        "sales" => [
            'can_show_sale' => false,
            'can_add_sale' => false,
            'can_edit_sale' => false,
            'can_delete_sale' => false,
            'can_change_sale_status' => false,
        ],

        "sms" => [
            'send_individual_messages' => false,
            'send_collection_messages' => false,
        ],
    ],
];
