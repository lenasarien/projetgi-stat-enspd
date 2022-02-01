@extends('layout')


@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/vector-map/jqvmap.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css') }}">

<link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
@endsection


@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- sales  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Etudiants</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ $students }}</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end sales  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- new customer  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Départements</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ $departments }}</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end new customer  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- visitor  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Filières</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ $filieres }}</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end visitor  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- total orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Cycles</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ $cycles }}</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                    <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end total orders  -->
    <!-- ============================================================== -->
</div>

<div class="row">
    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Etudiants par départements</h5>
            <div class="card-body">
                <div id="c3chart_category2" style="height: 420px;"></div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end category revenue  -->
    <!-- ============================================================== -->

    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header"> Effectif par année</h5>
            <div class="card-body">
                <div id="morris_totalrevenue"></div>
            </div>
            <div class="card-footer">
                <p class="display-7 font-weight-bold"><span class="text-primary d-inline-block"></span><span class="text-success float-right"></span></p>
            </div>
        </div>
    </div>
</div>
{{--
<!-- ============================================================== -->
<!-- revenue locations  -->
<!-- ============================================================== -->
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">Revenue by Location</h5>
        <div class="card-body">
            <div id="locationmap" style="width:100%; height:200px"></div>
        </div>
        <div class="card-body border-top">
            <div class="row">
                <div class="col-xl-6">
                    <div class="sell-ratio">
                        <h5 class="mb-1 mt-0 font-weight-normal">New York</h5>
                        <div class="progress-w-percent">
                            <span class="progress-value">72k </span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="sell-ratio">
                        <h5 class="mb-1 mt-0 font-weight-normal">San Francisco</h5>
                        <div class="progress-w-percent">
                            <span class="progress-value">39k</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="sell-ratio">
                        <h5 class="mb-1 mt-0 font-weight-normal">Sydney</h5>
                        <div class="progress-w-percent">
                            <span class="progress-value">25k </span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="sell-ratio">
                        <h5 class="mb-1 mt-0 font-weight-normal">Singapore</h5>
                        <div class="progress-w-percent mb-0">
                            <span class="progress-value">61k </span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- ============================================================== -->
<!-- end revenue locations  -->
<!-- ============================================================== -->
@endsection


@section('js')
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstrap bundle js-->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js-->
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<!-- chartjs js-->
<script src="assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
<script src="assets/vendor/charts/charts-bundle/chartjs.js"></script>

<!-- main js-->
<script src="assets/libs/js/main-js.js"></script>

<!-- chart chartist js -->
<script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>

<!-- morris js -->
<script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
<script src="assets/vendor/charts/morris-bundle/morris.js"></script>
<!-- chart c3 js -->
<script src="assets/vendor/charts/c3charts/c3.min.js"></script>
<script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
<script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>

<!-- jvactormap js-->
<script src="assets/vendor/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/vendor/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- sparkline js-->
<script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
<script src="assets/vendor/charts/sparkline/spark-js.js"></script>

<!-- dashboard js-->
<script src="assets/libs/js/dashboard-sales.js"></script>
<script src="assets/libs/js/dashboard-ecommerce.js"></script>
<script>


// ==============================================================
// Revenue By Categories
// ==============================================================

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}


var chart = c3.generate({
    bindto: "#c3chart_category2",
    data: {
        columns: [
            ['TCO', 100],
            ['GCI', 80],
            ['TCI', 50],
            ['TTIC', 40],
            ['ROI', 20],
        ],
        type: 'donut',

        onclick: function(d, i) { console.log("onclick", d, i); },
        onmouseover: function(d, i) { console.log("onmouseover", d, i); },
        onmouseout: function(d, i) { console.log("onmouseout", d, i); },

        colors: {
            TCO: '#5969ff',
            GCI: '#ff407b',
            TCI: '#25d5f2',
            TTIC: '#ffc750',
            ROI: '#2ec551',
        }
    },
    donut: {
        label: {
            show: false
        }
    },



});


</script>
@endsection
