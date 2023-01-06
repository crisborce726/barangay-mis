@extends('layouts.app')
@section('title','Ap-apaya Dashboard | V.M.I.S.')

@section('content')

    <section class="content-header">
        <h1 class="page-title">Sectors</h1>
    </section>
    
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
            <li class="breadcrumb-item"><a href={!! route('barangays.index') !!}> Barangay</a></li>
            <li class="breadcrumb-item active">{{$bgryName}} Dashboard</li>
        </ul>
    </div>
    
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
                <!-- Per Brgy Card -->
                @include('barangays.dashboard')
                <!-- Close per barangay card -->            
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.Dashboard -->
    </section>
    <!-- ./section -->

@endsection