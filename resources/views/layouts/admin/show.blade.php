@extends('layouts.admin.admin_master')

@section('sidebar')
    @include('layouts.admin.navigation')
@endsection


<style>
    /* Style for the custom card */
    .content-wrapper {
        padding: 20px; /* Add padding around the content */
    }
    .custom-card {
        align: left;
        width: 400px; /* Adjust as needed */
        margin: 279px auto; /* Centers the card horizontally */
        margin-top: 30px; /* Adds some space at the top */
        border: 1px solid #ccc; /* Border color */
        border-radius: 18px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
    }

    .custom-card .card-body {
        padding: 25px; /* Padding inside the card */
    }

    .custom-card .card-title {
        font-size: 2.6rem; /* Title font size */
        margin-bottom: 10px; /* Space below title */
    }

    .custom-card .card-text {
        margin-bottom: 5px; /* Space between each text paragraph */
    }

    .custom-card .btn {
        margin-top: 15px;
         /* Space between text and button */
    }
</style>



@section('content')
<div class="content-wrapper">
    <div class="custom-card">
        <div class="card-body">
            <h5 class="card-title">Admin Profile</h5>
            <p class="card-text">ID: {{ $admin[0]->id }}</p>
            <p class="card-text">Name: {{ $admin[0]->adminName }}</p>
            <p class="card-text">Email: {{ $admin[0]->adminEmail }}</p>
            <p class="card-text">Created_at: {{ $admin[0]->created_at }}</p>
            <br>
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
