@extends('layouts.admin.admin_master')

@section('sidebar')
    @include('layouts.admin.navigation')
@endsection

<style>
    /* Styles for the custom card */
    .content-wrapper {
        padding: 3px; /* Add padding around the content */
        padding-right: 490px;
    }
    .custom-card {
        width: 400px; /* Adjust as needed */
        margin: auto; /* Centers the card horizontally */
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
        margin-top: 15px; /* Space between text and button */
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
            <p class="card-text">Updated_at: {{ $admin[0]->updated_at }}</p>
            <br>
            <!-- Button to trigger the modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
                Change Password
            </button>
        </div>
    </div>
</div>


<!-- Modal for editing profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Your password change form goes here -->
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
