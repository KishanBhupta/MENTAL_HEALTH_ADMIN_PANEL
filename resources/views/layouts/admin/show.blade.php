@extends('layouts.admin.admin_master')

@section('main-sidebar')
    @include('layouts.admin.navigation')
@endsection

@section('content')
<div class="content-wrapper">
    <h1>Admin Profile</h1>
    <p>ID: {{ $admin[0]->id }}</p>
    <p>Name: {{ $admin[0]->adminName }}</p>
    <p>Email: {{ $admin[0]->adminEmail }}</p>
    <p>Created_at: {{ $admin[0]->created_at }}</p>
    
    <!-- Edit Button -->
    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
    
@endsection
<!-- 

<div class="container">
        <div class="profile-header">
            <h1>Admin Profile</h1>
        </div>
        <div class="profile-details">
            <p>ID: {{ $admin[0]->id }}</p>
        <p>Email: {{ $admin[0]->admionEmail }}</p>
    </div>
</div>  -->
