@extends('partials.panel.layout')
@section('title', $title)
@section('content')
    @livewire('table', ['service' => $service])
@endsection
