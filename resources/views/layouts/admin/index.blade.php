@extends('layouts.admin.admin_master')

@section('sidebar')
    @extends('layouts.admin.navigation')
@endsection

@section('content')
<style>
    /* Styles for the content wrapper */
    .content-wrapper {
        padding: 20px; /* Add padding around the content */
    }

    /* Styles for the unique wrapper */
    .unique-wrapper-fluid {
        margin: 20px 0; /* Add margin at the top and bottom */
    }

    /* Styles for the unique row */
    .unique-row {
        display: flex; /* Use flexbox for layout */
        flex-wrap: wrap; /* Allow wrapping */
    }

    /* Styles for the unique columns */
    .unique-col-md-12 {
        width: 100%; /* Full width for smaller screens */
        padding: 0 15px; /* Add padding on the sides */
        box-sizing: border-box; /* Include padding in width calculation */
    }

    /* Styles for the distinct box */
    .distinct-box {
        border: 1px solid #ccc; /* Border color */
        border-radius: 8px; /* Rounded corners */
        overflow: hidden; /* Hide overflowing content */
    }

    /* Styles for the distinct box header */
    .distinct-box-header {
        background-color: #f8f9fa; /* Header background color */
        padding: 10px 15px; /* Padding inside the header */
        border-bottom: 1px solid #ccc; /* Border bottom for separation */
    }

    /* Styles for the distinct box title */
    .distinct-box-title {
        margin: 0; /* Remove margin */
    }

    /* Styles for the distinct box body */
    .distinct-box-body {
        padding: 15px; /* Padding inside the body */
    }

    /* Styles for the distinct table */
    .distinct-table {
        width: 100%; /* Full width */
        border-collapse: collapse; /* Collapse border spacing */
    }

    /* Styles for table headers */
    .distinct-table th {
        background-color: #f8f9fa; /* Header background color */
        padding: 10px; /* Padding inside headers */
        border-bottom: 1px solid #ccc; /* Border bottom for separation */
    }

    /* Styles for table cells */
    .distinct-table td {
        padding: 10px; /* Padding inside cells */
        border-bottom: 1px solid #ccc; /* Border bottom for separation */
    }

    /* Styles for odd rows */
    .distinct-table tbody tr:nth-child(odd) {
        background-color: #f8f9fa; /* Alternate row background color */
    }
</style>

<div class="content-wrapper">
    <div class="unique-wrapper-fluid">
        <div class="unique-row">
            <div class="unique-col-md-12">
                <div class="distinct-box">
                    <div class="distinct-box-header">
                        <h3 class="distinct-box-title">Feedbacks</h3>
                    </div>
                    <!-- /.distinct-box-header -->
                    <div class="distinct-box-body">
                        <table class="distinct-table distinct-table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Feedback Data</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_reverse($feedbacks->toArray()) as $feedback)
                                <tr>
                                    <td>{{ $feedback['id'] }}</td>
                                    <td>{{ isset($feedback['user']['firstName']) ? $feedback['user']['firstName'] : '$firstName' }}</td>
                                    <td>{{ $feedback['feedbackData'] }}</td>
                                    <td>{{ $feedback['feedbackRating'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.distinct-box-body -->
                </div>
                <!-- /.distinct-box -->
            </div>
            <!-- /.unique-col -->
        </div>
        <!-- /.unique-row -->
    </div><!-- /.unique-wrapper-fluid -->
</div>
<!-- /.content -->
@endsection
