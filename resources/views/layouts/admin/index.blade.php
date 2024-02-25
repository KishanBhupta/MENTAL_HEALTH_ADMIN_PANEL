@extends('layouts.admin.admin_master')

@section('main-sidebar')
    @include('layouts.admin.navigation')
@endsection

@section('content')
<div class="content-wrapper">
    <br>
    {{-- Feedback table --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Feedbacks</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Feedback Data</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td>{{ $feedback->id }}</td>
                                            <td>{{ $feedback->user->firstName ?? '$firstName' }}</td>
                                            <td>{{ $feedback->feedbackData }}</td>
                                            <td>{{ $feedback->feedbackRating }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    {{-- End of Feedback table --}}
</div>
<!-- /.content -->
@endsection
