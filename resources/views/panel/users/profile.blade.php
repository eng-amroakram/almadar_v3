@extends('partials.panel.layout')
@section('content')
    @livewire('user-profile', ['user_id' => $user->id])
@endsection
