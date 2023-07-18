<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function inDirectOffer()
    {
        return view('panel.table', ['service' => 'InDirectOfferService', 'title' => 'العروض غير المباشرة']);
    }

    public function directOffer()
    {
        return view('panel.table', ['service' => 'DirectOfferService', 'title' => 'العروض المباشرة']);
    }

    public function profile(Offer $offer)
    {
        return view('panel.offers.profile', ['offer' => $offer, 'title' => "عرض {$offer->offer_code}"]);
    }
}
