@extends('partials.panel.layout')
@section('content')
    @livewire('order-profile', ['order_id' => $order->id])
@endsection
