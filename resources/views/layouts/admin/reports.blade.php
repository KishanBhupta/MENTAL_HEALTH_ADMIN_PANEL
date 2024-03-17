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
                            <table class="table table-striped table-responsive-md text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Report From</th>
                                        <th>Reported User</th>
                                        <th>Reason For Reporting</th>
                                        <th>Status</th>
                                        <th>Reported Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if ($userReports != [])
                                    <tbody>
                                        @foreach ($userReports as $userReport)
                                            <tr>
                                                <td>{{ $userReport->user->firstName }} {{ $userReport->user->lastName }}
                                                </td>
                                                <td>{{ $userReport->reportedUser->firstName }}
                                                    {{ $userReport->reportedUser->lastName }}</td>
                                                <td>{{ $userReport->reportReason }}</td>
                                                <td>{{ $userReport->reportStatus }}</td>
                                                <td>{{ $userReport->created_at }}</td>
                                                <td>
                                                    @if ($userReport->reportStatus != 'Approved' && $userReport->reportStatus != 'Rejected')
                                                        <a href="/approveUserReport/{{ $userReport->reportedUser->id }}"
                                                            class="btn btn-success" title="Reject"><i
                                                                class="fa fa-check-circle" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if ($userReport->reportStatus == 'Rejected')
                                                        <a href="/approveUserReport/{{ $userReport->reportedUser->id }}"
                                                            class="btn btn-success" title="Accept"><i
                                                                class="fa fa-check-circle" aria-hidden="true"></i> </a>
                                                    @endif
                                                    @if ($userReport->reportStatus == 'Approved')
                                                        <a href="/unblockUserReport/{{ $userReport->reportedUser->id }}"
                                                            class="btn btn-info" title="Block"><i class="fa fa-user-times"
                                                                aria-hidden="true"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        @else
                            </table>
                            <h5 class="text-center m-3">No Reported User Found</h5>
                            @endif
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
                                <table class="table table-striped table-responsive  ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th> Report From </th>
                                            <th>Reported Post</th>
                                            <th>Reason For Reporting</th>
                                            <th>Status</th>
                                            <th>Reported Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($postReports as $postReport)
                                            <tr>
                                                <td>{{ $postReport->user->firstName }} {{ $postReport->user->lastName }}
                                                </td>
                                                <td>{{ $postReport->reportedPostId }} </td>

                                                <td>{{ $postReport->reportReason }}</td>
                                                <td>{{ $postReport->reportStatus }}</td>
                                                <td>{{ $postReport->created_at }}</td>
                                                <td>
                                                    @if ($postReport->reportStatus != 'Approved')
                                                        <a href="/approvePostReport/{{ $postReport->reportedPostId }}"
                                                            class="btn btn-success w-100" title="Approved"><i
                                                                class="fa fa-check-circle" aria-hidden="true"></i>
                                                            {{-- Approve --}}
                                                        </a>
                                                    @endif
                                                    @if ($postReport->reportStatus != 'Rejected')
                                                        <a href="/deletePostReport/{{ $postReport->reportedPostId }}"
                                                            class="btn btn-danger w-100" title="Rejected"><i
                                                                class="fa fa-times" aria-hidden="true"></i>
                                                            {{-- Reject --}}
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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
                                            <th>Reported Comment</th>
                                            <th>Reason For Reporting</th>
                                            <th>Status</th>
                                            <th>Reported Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commentReports as $commentReport)
                                            <tr>
                                                <td>{{ $commentReport->user->firstName }}
                                                    {{ $commentReport->user->lastName }}</td>
                                                <td>{{ $commentReport->reportedComment->commentDescription }} </td>
                                                <td>{{ $commentReport->reportReason }}</td>
                                                <td>{{ $commentReport->reportStatus }}</td>
                                                <td>{{ $commentReport->created_at }}</td>
                                                <td>
                                                    @if ($commentReport->reportStatus != 'Approved')
                                                        <a href="/approveCommentReport/{{ $commentReport->reportedComment->id }}"
                                                            class="btn btn-success w-100" title="Approved"><i
                                                                class="fa fa-check-circle" aria-hidden="true"></i>
                                                            {{-- Approve --}}
                                                        </a>
                                                    @endif
                                                    @if ($commentReport->reportStatus != 'Rejected')
                                                        <a href="/deleteCommentReport/{{ $commentReport->reportedComment->id }}"
                                                            class="btn btn-danger w-100"><i class="fa fa-times"
                                                                aria-hidden="true" title="Rejected"></i>
                                                            {{-- Reject --}}
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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
