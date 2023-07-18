@extends('partials.panel.layout')
@section('content')
    @livewire('actions.update-user', ['user_id' => $user_id])
@endsection
