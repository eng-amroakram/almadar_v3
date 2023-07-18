@extends('partials.panel.layout')
@section('content')
    @livewire('creator', ['service' => $service])
@endsection
