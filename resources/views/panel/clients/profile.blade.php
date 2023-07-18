@extends('partials.panel.layout')
@section('content')
    @livewire('client-profile', ['client_id' => $client->id])
@endsection
