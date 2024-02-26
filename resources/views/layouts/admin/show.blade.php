@extends('layouts.admin.admin_master')

@section('sidebar')
    @include('layouts.admin.navigation')
@endsection

<style>
    /* Styles for the admin profile section */
    .content-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 20px 20px;
    }
    .card {
        width: 1380px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        overflow: hidden; /* Hide overflowing content */
    }
    .profile-section {
        display: flex;
        align-items: center;
        padding: 20px;
    }
    .profile-photo {
        width: 140px; /* Adjust size as needed */
        height: 140px; /* Adjust size as needed */
        border-radius: 50%; /* Make it round */
        background-image: url('path/to/profile-photo.jpg'); /* Specify profile photo image */
        background-size: cover;
        background-position: left;
        margin-right: 20px;
    }
    .profile-details .card-title {
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    } 
    .card-text {
        font-size: 16px;
        margin-bottom: 10px;
        margin-right: 370px;
        color: #555;
    }
    .btn {
        padding: 0px 0px 10px 20px; /* Adjust top padding to move the button up */
        border: none;
        margin-top: 10px;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>

@section('content')
<div class="content-wrapper">
    {{-- Profile table --}}
    <div class="card">
        <div class="profile-section">
            <div class="profile-photo" style="background-image: url('{{ asset('images/profile/profile-photo.jpg') }}')"></div>
            <div class="profile-details">
                <h2 class="card-title">Admin Profile</h2>
                <p class="card-text">Name:   {{ $admin[0]->adminName }}</p>
                <p class="card-text">Email:   {{ $admin[0]->adminEmail }}</p>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Change Password</button>
        </div>
    </div>
    {{-- End of Profile table --}}
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
