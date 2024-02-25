@extends('layouts.admin.admin_master')

@section('sidebar')
    @include('layouts.admin.navigation')
@endsection

<style>
    /* Style for the card */
    .content-wrapper {
        padding: 10px; /* Add padding around the content */
    }
    .card {
        width: 400px; /* Adjust as needed */
        margin: 300px; /*Center the card horizontally with some space at the top*/
        margin-top: 10px; /* Adds some space at the top */
        padding: 20px; /* Padding inside the card */
        border: 1px solid #ccc; /* Border color */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
        
    }

    .card-body {
        padding: 20px; /* Padding inside the card */
    }   

    .card-title {
        font-size: 2rem; /* Title font size */
        margin-bottom: 10px; /* Space below title */
    }

    

    .card-text {
        margin-bottom: 5px; /* Space between each text paragraph */
    }

    .btn {
        margin-top: 15px; /* Space between text and button */
    }



    /* Style for the form elements */
    .card label {
        display: block; /* Each label on its own line */
        margin-bottom: 5px; /* Space between labels */
    }

    .card input[type="text"],
    .card input[type="email"] {
        width: 100%; /* Full width */
        padding: 8px; /* Padding for input fields */
        margin-bottom: 10px; /* Space between input fields */
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



<!-- Add this modal at the end of your Blade template -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Admin Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Your edit profile form goes here -->
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->adminName }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->adminEmail }}" required>
                    </div>
                    <!-- Add other fields for editing profile -->
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>












@endsection