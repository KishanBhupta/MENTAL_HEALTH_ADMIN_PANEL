@extends('layouts.admin.admin_master')

@section('main-sidebar')
    @include('layouts.admin.navigation')
@endsection

@section('content')
<div class="content-wrapper">
    <h1>Edit Admin Profile</h1>
        <form method="POST" action="{{ route('admin.profile.update') }}">
        <!-- <form action="{{ url('/admin/'.$admin->id) }}" method="POST"> -->
            @csrf
            @method('PUT')
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $admin->adminName }}" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $admin->adminEmail }}" required>
            <!-- Add more fields as needed -->
            <br>
            <!-- <button type="submit">Update Profile</button> -->
            <a class="btn btn-secondary">Update Profile</a>
        </form>

        
</div>
@endsection
