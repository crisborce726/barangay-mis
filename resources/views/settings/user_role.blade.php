@extends('layouts.app')
@section('title','User Role Setting | V.M.I.S.')

@section('content')

    <section class="content-header">
        <h1 class="page-title">Settings</h1>
    </section>
    
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
            <li class="breadcrumb-item active"> User Role</li>
        </ul>
    </div>
    
    <!-- Section -->
    <section class="content">
        <!-- Dashboard -->
        <div class="card card-primary card-outline card-outline-tabs">
            <!-- card-header -->
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    @include('settings.nav_tab')
                </ul>
            </div>
            <!-- /.card-header -->

            <!-- card-body -->
            <div class="card-body">
                <!-- Brgy -->
                <table class="table table-hover table-bordered table-mini brgy-datatable datatable" id="brgy-datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td scope="row">
                                <span class="badge">{{ $item->id }} </span>
                            </td>
                            <td>{{$item->usertype}}</td>
                            
                            <td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Close brgy -->            
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.Dashboard -->
    </section>
    <!-- ./section -->

@endsection