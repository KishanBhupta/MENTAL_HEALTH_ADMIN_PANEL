@extends('layouts.admin.admin_master')

@section('main-sidebar')
    @include('layouts.admin.navigation')
@endsection

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- User Reports Table --}}
                <section class="mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h6>Reported Users</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-responsive-md">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Report From</th>
                                        <th>Reported User</th>
                                        <th>Reason For Reporting</th>
                                        <th>Status</th>
                                        <th>Reported Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userReports as $userReport)
                                    <tr>
                                        <td>{{$userReport->user->firstName}} {{$userReport->user->lastName}}</td>
                                        <td>{{$userReport->reportedUser->firstName}} {{$userReport->reportedUser->lastName}}</td>
                                        <td>{{$userReport->reportReason}}</td>
                                        <td>{{$userReport->reportStatus}}</td>
                                        <td>{{$userReport->created_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <div class="row">

                    {{-- Post table starts --}}

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h6>Reported Posts</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Report From</th>
                                            <th>Reported User</th>
                                            <th>Reason For Reporting</th>
                                            <th>Status</th>
                                            <th>Reported Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Report From</td>
                                            <td>Reported User</td>
                                            <td>Reason For Reporting</td>
                                            <td>Status</td>
                                            <td>Reported Date</td>
                                        </tr>
                                        <tr>
                                            <td>Report From</td>
                                            <td>Reported User</td>
                                            <td>Reason For Reporting</td>
                                            <td>Status</td>
                                            <td>Reported Date</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Post table over --}}

                    {{-- Comment table starts --}}

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h6>Reported Comments</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Report From</th>
                                            <th>Reported User</th>
                                            <th>Reason For Reporting</th>
                                            <th>Status</th>
                                            <th>Reported Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Report From</td>
                                            <td>Reported User</td>
                                            <td>Reason For Reporting</td>
                                            <td>Status</td>
                                            <td>Reported Date</td>
                                        </tr>
                                        <tr>
                                            <td>Report From</td>
                                            <td>Reported User</td>
                                            <td>Reason For Reporting</td>
                                            <td>Status</td>
                                            <td>Reported Date</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Commetn table over --}}

                </div>
            </div>
        </section>

    </div>
@endsection
