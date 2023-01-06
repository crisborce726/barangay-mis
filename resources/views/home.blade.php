@extends('layouts.app')
@section('title','Home | V.M.I.S.')

@section('content')
    
    <section class="content-header">
        <h3 class="page-title">Welcome {{ Session::get('user') }}!</h3>
    </section>
    
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"> Home </a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ul>
    <!-- /Page Header -->
    
    <!-- Section -->
    <section class="content">
            <!-- Row -->
            <!-- Dashboard -->
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <!-- card -->
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Dashboard</h3>
                            <!-- card-tools -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                                </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <!-- card-body -->
                        <div class="card-body">
                            <div id="refresh">
                                    @include('includes.dashboard')
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                <!-- /.col -->
            </div>
            <!-- /.Dashboard -->
            <!-- /.Row -->

            <!-- Row -->
            <!-- Dashboard -->
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <!-- card -->
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h2 class="card-title">Activity</h2>
                            <!-- card-tools -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                                </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <!-- card-body -->
                        <div class="card-body">
                                <div id="fresh">
                                    <section class="bk-focus">
                                        <span id="ct" class="h1">
                                            @php
                                                date_default_timezone_set('Asia/Manila');
                                                echo date("h:i:s a")
                                            @endphp
                                        </span> 
                                        <span>PHST</span>
                                        <p> <span id="ctdat"> @php echo date("F d, Y, l") @endphp</span> </p>
                                    </section>
                                    
                                    <!-- Timelime example  -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- The time line -->
                                            <div class="timeline">
                                    
                                                @foreach ($logs as $activity) 
                                                    <!-- timeline time label -->
                                                    <div class="time-label sm">
                                                        <span class="bg-red"> @php echo date_format($activity->created_at, "d M. Y") @endphp</span>
                                                    </div>
                                                    <!-- /.timeline-label -->
                                                    <!-- timeline item -->
                                                    <div>
                                                        <i class="fa fa-user bg-blue" data-toggle="tooltip" title="{{$activity->name}}"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</span>
                                                            <h3 class="timeline-header no-border"><a href="#">{{$activity->name}}: </a> {!! $activity->action !!}</h3>
                                                        </div>
                                                    </div>
                                                    <!-- END timeline item -->
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.timeline -->

                                    {{ $logs->links('vendor.pagination.bootstrap-5') }}

                                </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                <!-- /.col -->
            </div>
        <!-- /.Dashboard -->
        <!-- /.Row -->
    </section>
    <!-- /.Section -->

@endsection

@section('script')
<script>
    setInterval("my_dash();",1000);
    function my_dash(){
        $('#refresh').load(location.href + ' #refresh');
        $('#fresh').load(location.href + ' #fresh');
    }
</script>
@endsection