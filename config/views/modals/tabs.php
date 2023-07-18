<?php

return [

    "brokers-service" => [
        ["title" => "إضافة وسيط جديد", "id" => "create-broker", "status" => "active", "icon" => "fas fa-people-arrows"],
    ],

    "cities-service" =>  [
        ["title" => "إنشاء مدينة جديدة", "id" => "create-city", "status" => "active", "icon" => "fas fa-city"],
    ],

    "neighborhoods-service" => [
        ["title" => "إنشاء حي جديد", "id" => "create-neighborhood", "status" => "active", "icon" => "fas fa-warehouse"],
    ],

    "branches-service" => [
        ["title" => "إنشاء فرع جديد", "id" => "create-branch", "status" => "active", "icon" => "fas fa-code-branch"],
    ],

    "users-service" => [
        ["title" => "معلومات المستخدم", "id" => "user-info", "status" => "active", "icon" => "fas fa-circle-info"],
        // ["title" => "صلاحيات المستخدم", "id" => "user-permissions", "status" => "", "icon" => "fas fa-key"],
    ],

    "clients-service" => [
        ["title" => "معلومات العميل", "id" => "client-info", "status" => "active", "icon" => "far fa-circle-question"],
        ["title" => "معلومات جهة العمل", "id" => "employer-information", "status" => "", "icon" => "fas fa-circle-info"],
        ["title" => "العنوان الوطني", "id" => "national-address", "status" => "", "icon" => "far fa-address-card"],
    ],

    "orders-service" => [
        ["title" => "معلومات العميل", "id" => "client-info", "status" => "active", "icon" => "far fa-circle-question"],
        ["title" => "معلومات الطلب", "id" => "order-info", "status" => "", "icon" => "fas fa-circle-info"],
        ["title" => "الملاحظات", "id" => "order-notes",  "status" => "", "icon" => "far fa-clipboard"],
    ],

    "orders-notes-service" => [
        ["title" => "إضافة ملاحظة للطلب", "id" => "add-order-note", "status" => "active", "icon" => ""],
    ],

    "offers-service" => [
        ["title" => "المعلومات الاساسية للعرض", "id" => "basic-offer-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ["title" => "اختيار نوع العقار ومعلوماته", "id" => "real-estate-info", "status" => "", "icon" => "fas fa-circle-info"],
        ["title" => "الملاحظات", "id" => "offer-notes",  "status" => "", "icon" => "far fa-clipboard"],
    ],

    "offers-reservation-service" => [
        ["title" => "حجز العرض", "id" => "basic-offer-info", "status" => "active", "icon" => "fas fa-circle-info"],
    ],

    "reservations-service" => [
        ["title" => "حجز العرض", "id" => "basic-offer-info", "status" => "active", "icon" => "fas fa-circle-info"],
    ],

    "sales-service" => [
        ["title" => "تفاصيل العرض", "id" => "offer-info", "status" => "active", "icon" => "far fa-circle-question"],
        ["title" => "بيانات المشتري", "id" => "buyer-info", "status" => "", "icon" => "fas fa-circle-info"],
        ["title" => "بيانات البائع", "id" => "seller-info",  "status" => "", "icon" => "far fa-clipboard"],

    ],

    "sales-profile-service" => [
        ["title" => "تفاصيل العرض", "id" => "offer-info", "status" => "active", "icon" => "far fa-circle-question"],
        ["title" => "بيانات المشتري", "id" => "buyer-info", "status" => "", "icon" => "fas fa-circle-info"],
        ["title" => "بيانات البائع", "id" => "seller-info",  "status" => "", "icon" => "far fa-clipboard"],
    ],

    "sale-payment-service" => [
        ["title" => "إضافة دفعة جديدة", "id" => "new-sale-payment", "status" => "active", "icon" => "far fa-circle-question"],
    ]


];
