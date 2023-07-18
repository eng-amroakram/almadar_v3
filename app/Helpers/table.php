<?php

if (!function_exists('badge')) {
    function badge($type)
    {
        if (in_array($type, ["ادمن فرعي", "تم البيع"])) {
            return "badge rounded-pill badge-danger";
        }

        if ($type == "مكتب") {
            return "badge rounded-pill badge-warning";
        }

        if ($type == "مسوق") {
            return "badge rounded-pill badge-info";
        }

        if (in_array($type, ["شاغر"])) {
            return "badge rounded-pill badge-success";
        }
    }
}

if (!function_exists('edit_table')) {
    function edit_table($service, $id)
    {
        $service = "App\Http\Controllers\Services\\" . $service;
        $service = new $service;
        return $service->edit($id);
    }
}

if (!function_exists('directions')) {
    function directions()
    {
        return [
            __('north') => 'north',
            __('south') => 'south',
            __('east') => 'east',
            __('west') => 'west',
        ];
    }
}

if (!function_exists('street_width')) {
    function street_width()
    {
        return [
            "6" => "6",
            "8" => "8",
            "12" => "12",
            "15" => "15",
            "16" => "16",
            "18" => "18",
            "20" => "20",
            "25" => "25",
            "30" => "30",
            "40" => "40",
            "60" => "60",
            "100" => "100"
        ];
    }
}

if (!function_exists('input')) {
    function input($type, $name, $id, $icon, $dir = "rtl", $maxlength = "50", $class, $placeholder = "", $defer = true, $lable = "", $validation = "", $disabled = false)
    {
        return [
            "type" => $type,
            "name" => $name,
            "icon" => $icon,
            "dir" => $dir,
            "maxlength" => $maxlength,
            "class" => $class,
            "id" => $id,
            "placeholder" => $placeholder,
            "defer" => $defer,
            "lable" => $lable,
            "validation" => $validation,
            "disabled" => $disabled
        ];
    }
}

if (!function_exists('select')) {
    function select($type = "select", $name, $id, $icon, $dir = "", $class, $placeholder = "", $search = false, $options, $multiple = "", $defer = true, $lable = "", $validation = "", $disabled = false)
    {
        return [
            "type" => $type,
            "name" => $name,
            "icon" => $icon,
            "dir" => $dir,
            "class" => $class,
            "placeholder" => $placeholder,
            "search" => $search,
            "id" => $id,
            "options" => $options,
            "multiple" => $multiple,
            "defer" => $defer,
            "lable" => $lable,
            "validation" => $validation,
            "disabled" => $disabled

        ];
    }
}

if (!function_exists('checkboxes')) {
    function checkboxes($checkboxes)
    {
        $boxes = [];

        foreach ($checkboxes as $title => $names) {
            $boxes[] = [
                "type" => "checkbox",
                "title" => $title,
                "checkboxes" => $names
            ];
        }

        return $boxes;
    }
}
