@extends('layouts.app')
@section('title','Barangays | V.M.I.S.')

@section('content')
    <!-- Page Header -->
    <section class="content-header">
        <h1 class="page-title">Barangays</h1>
    </section>
    
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
        <li class="breadcrumb-item active">Barangays</li>
    </ul>
    <!-- /Page Header -->
    
    <!-- Section -->
    <section class="content">
        <!-- Dashboard -->
        <div class="card card-primary card-outline card-outline-tabs">
            <!-- card-header -->
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    @include('barangays.nav_tab')
                </ul>
            </div>
            <!-- /.card-header -->

            <!-- card-body -->
            <div class="card-body">
                <div class="row">
                    <!-- Brgy Card -->
                    @foreach ($bgry as $item)
                        <div class="col-md-3">
                            <div class="small-box" style="background-color:rgb(255, 255, 255);
                            background-image:
                            linear-gradient(
                                rgb(253, 108, 108), #C69749
                            );">
                                <div class="inner">
                                    <h3>{{\DB::table('residents')->where('barangay_id', $item->id)->count()}}</h3>
                                    <p>{{$item->barangay}}</p>
                                    <h5>Population</h5>
                                </div>
                                    <span class="icon">
                                        <i class="la la-users"></i>
                                    </span>
                                    
                                <a href="/Residents/{{$item->barangay}}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <!-- Close Barangay Card -->
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.Dashboard -->
    </section>
    <!-- ./section -->


    
@endsection

