@extends('partials.panel.layout')
@section('title', $title)
@section('content')
    @livewire('offer-profile', ['offer_id' => $offer->id])
@endsection
