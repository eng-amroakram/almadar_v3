@extends('partials.panel.layout')
@section('title', $title)
@section('content')
    @livewire('sale-profile', ['sale_id' => $sale->id])
@endsection
