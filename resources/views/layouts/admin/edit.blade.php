@extends('layouts.admin.admin_master')

@section('main-sidebar')
    @include('layouts.admin.navigation')
@endsection

<style>
    /* Style for the card */
    .content-wrapper {
        padding: 20px; /* Add padding around the content */
    }
    .card {
        width: 400px; /* Adjust as needed */
        margin: 220px; /* Center the card horizontally with some space at the top */
        padding: 20px; /* Padding inside the card */
        border: 1px solid #ccc; /* Border color */
        border-radius: 50px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
    }

    /* Style for the form elements */
    .card label {
        display: block; /* Each label on its own line */
        margin-bottom: 10px; /* Space between labels */
    }

    .card input[type="text"],
    .card input[type="email"] {
        width: 100%; /* Full width */
        padding: 8px; /* Padding for input fields */
        margin-bottom: 15px; /* Space between input fields */
        border: 1px solid #ccc; /* Border color */
        border-radius: 4px; /* Rounded corners */
    }

    .card .btn-secondary {
        display: inline-block; /* Make button inline */
        background-color: blue; /* Button background color */
        color: #fff; /* Button text color */
        padding: 8px 16px; /* Padding for button */
        border: none; /* No border */
        border-radius: 4px; /* Rounded corners */
        cursor: pointer; /* Cursor style */
        text-decoration: none; /* No underline */
    }

    .card .btn-secondary:hover {
        background-color: #495057; /* Button background color on hover */
    }
</style>


@section('content')
<div class="content-wrapper">
    <div class="card">
        <h1>Edit Admin Profile</h1>
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PUT')
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $admin->adminName }}" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $admin->adminEmail }}" required>
                <br>
                <br>
                <a href="{{ route('admin.profile.show') }}" class="btn btn-secondary">Update Profile</a>
            </form>
    </div>
</div>
@endsection
