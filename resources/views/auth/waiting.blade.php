<!-- resources/views/auth/waiting.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Account Pending Approval</h1>
    <p>Your account is currently pending approval. Please wait for an administrator to approve your registration.</p>
    
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
</div>
@endsection
