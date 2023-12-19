@extends('layouts.admin.main')

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/logo-login.png') }}" alt="AdminLTELogo" height="60" width="60">
</div>

@section('content')
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
              {{-- <li class="breadcrumb-item active">Dashboard v1</li> --}}
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
                        {{-- <h3>80</h3> --}}
                        <h3>{{ $count_produk }}</h3>
                        <p>Jumlah Produk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        {{-- <h3>15</h3> --}}
                        <h3>{{ $total_category }}</h3>
                        <p>Jumlah Kategori Produk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('productCategories') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        {{-- <h3>100</h3> --}}
                        <h3>{{ $total_stok }}</h3>
                        <p>Jumlah Stok Semua Produk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                @if(auth()->check() && auth()->user()->role == 'superadmin')
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $jumlah_testimoni }}</h3>
                        {{-- <h3>Rp. {{ number_format($total_harga, 0, ',', '.') }}</h3> --}}
                        <p>Jumlah Testimoni</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('testimoni') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                @endif
                @if(auth()->check() && auth()->user()->role == 'admin')
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        {{-- <h3>{{ $jumlah_testimoni }}</h3> --}}
                        <h3>Rp{{ number_format($total_harga, 0, ',', '.') }}</h3>
                        <p>Total Harga Semua Produk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('testimoni') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                @endif
            </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Jumlah Product
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart"
                         style="position: relative; height: 300px;">
                        {{-- <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas> --}}
                        <div id="chartProduk" style="height: 300px;"></div>
                     </div>
                    {{-- <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                      <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div> --}}
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

              <!-- Map card -->
              <div class="card bg-gradient-light">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Chart Pie Stock
                  </h3>
                  <!-- card tools -->
                  {{-- <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                      <i class="far fa-calendar-alt"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div> --}}
                  <!-- /.card-tools -->
                </div>
                <div class="card-body">
                  <div id="chartPie" style="height: 300px; width: 100%;"></div>
                </div>
                <!-- /.card-body-->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
{{-- </div> --}}
  <!-- /.content-wrapper -->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        //chart jumlah produk
        var chartData = {!! $chartData !!};

        Highcharts.chart('chartProduk', {
        chart: {
            type: 'column',
            // height: 400
        },
        title: {
            text: 'Jumlah Produk Setiap Kategori',
            // align: 'left'
        },
        xAxis: {
            categories: chartData.map(item => item.name),
            crosshair: true,
            // accessibility: {
            //     description: 'Countries'
            // }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Produk'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Produk per Kategori',
                data:
                    chartData.map(item => item.y)

            }
        ]
        });

        //chart jumlah stok
        var chartStock = {!! $chartStock !!};
        Highcharts.chart('chartPie', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Stok Produk Setiap Kategori'
        },
        tooltip: {
            valueSuffix: ' Produk'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    // format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [
            {
                name: 'Stock',
                colorByPoint: true,
                data: chartStock.map(item => ({ name: item.name, y: item.y }))
            }
        ]
        });
    });
</script>
@endsection
