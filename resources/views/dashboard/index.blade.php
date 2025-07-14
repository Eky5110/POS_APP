@extends('layouts.app')
@section('title', 'Dashboard')
@section('content_title', 'Dashboard')

@section('content')
<div class="card">
    <x-alert :errors='$errors' type='warning'/>
    <div class="card-body">
        Welcome to POS Aplication, <strong>{{ auth()->user()->name }}</strong>
    </div>
</div>
@endsection
