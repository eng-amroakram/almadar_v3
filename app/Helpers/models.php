<?php

use App\Http\Controllers\Services\Services;
use App\Models\Branch;
use App\Models\Broker;
use App\Models\City;
use App\Models\Client;
use App\Models\Neighborhood;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;

if (!function_exists('branches')) {
    function branches($search = null)
    {
        if ($search) {

            $user = User::find(auth()->id());

            if ($user->user_type == "superadmin") {
                return Branch::data()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                    return [$name => $id];
                })->toArray();
            }

            $branches_ids = $user->branches()->pluck('id')->toArray();

            return Branch::data()->whereIn('id', $branches_ids)->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Branch::data()->get();
    }
}


if (!function_exists('offer_codes')) {
    function offer_codes($search = null)
    {
        if ($search) {
            return Offer::data()->pluck('offer_code', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Branch::data()->get();
    }
}


if (!function_exists('offer_real_estate_type')) {
    function offer_real_estate_type($id)
    {
        $offer = Offer::find($id);
        if ($offer) {
            if ($offer->realEstate) {
                return $offer->realEstate->real_estate_type;
            }
        }

        return "land";
    }
}

if (!function_exists('user_orders_count')) {
    function user_orders_count($type)
    {
        if ($type == "all") {
            $orders = Order::where('user_id', auth()->id())->count();
            return $orders;
        }
        $orders = Order::where('status', $type)->where('user_id', auth()->id())->count();
        return $orders;
    }
}

if (!function_exists('users')) {
    function users($search = null)
    {
        if ($search) {
            return User::data()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return User::data()->get();
    }
}

if (!function_exists('users_marketer')) {
    function users_marketer($search = null)
    {
        if ($search) {
            return User::data()->where('user_type', 'marketer')->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return User::data()->get();
    }
}


if (!function_exists('brokers')) {
    function brokers($search = null)
    {
        if ($search) {
            return Broker::data()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Broker::data()->get();
    }
}


if (!function_exists('clients')) {
    function clients($search = null)
    {
        if ($search) {
            return Client::data()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Client::data()->get();
    }
}


if (!function_exists('cities')) {
    function cities($search = null)
    {
        if ($search) {
            return City::data()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Branch::data()->get();
    }
}

if (!function_exists('neighborhoods')) {
    function neighborhoods($search = null)
    {
        if ($search) {
            return Neighborhood::data()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Neighborhood::data()->get();
    }
}


if (!function_exists('neighborhoods_city')) {
    function neighborhoods_city($search = null, $city_id = 1)
    {
        if ($search) {
            return Neighborhood::data()->where('city_id', $city_id)->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Neighborhood::data()->get();
    }
}

if (!function_exists('models_count')) {
    function models_count($model)
    {
        $model =  Services::modelInstance($model);
        return $model::count();
    }
}
