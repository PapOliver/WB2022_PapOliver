@extends('layouts.app')
@section('title', '| ' . auth()->user()->name . ' Profile Page')


@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <h1>{{ auth()->user()->name }}'s Profile</h1>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ auth()->user()->name }}'s Profile Information</h2>
                    <p class="card-text">Profile</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email: {{ auth()->user()->email }}</li>
                    <li class="list-group-item">Registered: {{ auth()->user()->created_at->format('F j, Y') }}</li>
                </ul>

            </div>
            <div class="col-12 col-md-6">
                <h3>Change Password</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div> 
                @endif
                <form action="/profile/change-password" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>

                </form>
            </div>
        </div>
        
    </div>
@endsection