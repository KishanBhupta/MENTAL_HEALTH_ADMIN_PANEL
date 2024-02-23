@extends('layouts.admin.admin_master')


@section('sidebar')
    @include('layouts.admin.navigation')
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $postCount }}</h3>

                                <p>Total Post</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $feedbackCount }}</h3>

                                <p>Total App Feedback</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $userCount }}</h3>

                                <p>Total Users </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $reportCount}}</h3>

                                <p>Total Report </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-6 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Posts
                                </h3>
                            </div>
                            <div class="card-body">
                                <div style="width: 80%; margin: auto;">
                                    <canvas id="postChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Left col over -->

                    <!-- Right col -->
                    <section class="col-lg-6 connectedSortable">
                      <!-- Custom tabs (Charts with tabs)-->
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">
                                  <i class="fas fa-chart-pie mr-1"></i>
                                  Users
                              </h3>
                          </div>
                          <div class="card-body">
                              <div style="width: 80%; margin: auto;">
                                  <canvas id="userChart"></canvas>
                              </div>
                          </div>
                      </div>
                  </section>
                  <!-- Right col over -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>


    </div>

@endsection


@section('additional-jScripts')

<script>
  var postChartCanvas = document.getElementById('postChart').getContext('2d');
  var myPostChart = new Chart(postChartCanvas, {
      type: 'line',
      data: {
          labels: @json($postData['labels']),
          datasets: [{
              label: 'Posts',
              data: @json($postData['posts']),
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });


  var userChartCanvas = document.getElementById('userChart').getContext('2d');
  var myUserChart = new Chart(userChartCanvas, {
      type: 'line',
      data: {
          labels: @json($userData['labels']),
          datasets: [{
              label: 'Users',
              data: @json($userData['users']),
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });


  
</script>

@endsection