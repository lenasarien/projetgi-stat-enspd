@extends('layout')


@section('css')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/select.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection



@section('content')

<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $title }}</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Statistiques</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader -->
<!-- ============================================================== -->


<div class="row">
    <!-- ============================================================== -->
    <!-- data table rowgroup  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <h5 class="mb-0">{{ $title }} </h5>
                        <p>Ci-dessous les resultats de votre requête</p>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 text-right" style="vertical-align: center;">
                        <label class="form-control" style="border-width: 0">Année</label>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        <select id="year" class="form-control">
                            @for($i = 0; $i < 10; $i++)
                            <option value="{{ date('Y') - $i }}"> {{ date('Y') - $i }} </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Filières</th>
                                <th>Niveau</th>
                                @foreach ($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $department => $filieres)
                                @php $isTCO = $department == 'TCO'; @endphp
                                <tr class="group"><td colspan="{{ 2 + count($columns) }}">{{ $department }}</td></tr>
                                @foreach ($filieres as $filiere => $item)
                                    @for ($i = 3; $i <= 5; $i++)
                                        @if ($isTCO && $i == 5) @break @endif
                                        @php
                                            $j = $isTCO ? $i - 2 : $i;
                                        @endphp
                                        <tr>
                                            @if ($i == 3)
                                                <td rowspan="{{ $isTCO ? 2 : 3 }}">{{ $filiere }}</td>
                                            @endif
                                            <td> Niveau {{ $j }}</td>
                                            @foreach ($columns as $column)
                                                <th>{{ $item[ $j ][ $column ] }}</th>
                                            @endforeach
                                        </tr>
                                    @endfor
                                @endforeach
                            @endforeach
                            <tr class="group">
                                <td colspan="2">Totaux</td>
                                @foreach ($columns as $column)
                                    <td>{{ $totaux[ $column ] }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end data table rowgroup  -->
    <!-- ============================================================== -->
</div>
@endsection


@section('js')
<!-- Optional JavaScript -->
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js'"></script>
<script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script>
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        console.log('urlParams', urlParams);
        const y = urlParams.get('year');
        $('#year').val(y ? y : (new Date().getFullYear()));
        $('#year').change(function () {
            const year = $(this).val();
            console.log('year', year);
            window.location = location.protocol + '//' + location.host + location.pathname + '?year=' + year;
        })
    });
</script>
@endsection

