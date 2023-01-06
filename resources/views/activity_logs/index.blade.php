@extends('layouts.app')
@section('title','Users Log List | V.M.I.S.')

@section('content')
    <!-- Page Header -->
    <section class="content-header">
        <h1 class="page-title">Users Activity Log</h1>
    </section>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
        <li class="breadcrumb-item active">Users Log</li>
    </ul>
    <!-- /Page Header -->

    <!-- Section -->
    <section class="content">
        <!-- Row -->
        <!-- Widget -->
        @if(auth()->user()->usertype == 'admin')
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <!-- card -->
                <div class="card">
                    <!-- card-header -->
                    <div class="card-header">
                        <h2 class="card-title">User Widget</h2>
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
                        <div class="row">
                            
                                @foreach($data_user as $item)
                                    <!-- card-body User Widget -->
                                    <div class="col-md-3">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="card card-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            @if($item->usertype == 'admin')
                                                <div class="widget-user-header bg-danger">
                                            @else
                                                <div class="widget-user-header bg-warning">
                                            @endif
                                                <h4 class="widget-user-username">{{$item->name}}</h4>
                                                <h5 class="widget-user-desc">{{ucfirst($item->usertype)}}</h5>
                                            </div>
                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-2" src="{{ URL::to('/storage/images/'.$item->image)}}"  alt="User Avatar">
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="description-block">
                                                            <a  href="{{route ('view.logs', $item->id) }}" title="Show More" class="btn btn-sm">
                                                                <h5 class="description-header">
                                                                    @php
                                                                        $count = DB::table('activity_logs')
                                                                        ->where('user_id', '=', $item->id)
                                                                        ->count();
                                                                            echo $count;
                                                                    @endphp Log/s  <span class="description-text"><i class="fa fa-arrow-right"></i> </span>
                                                                </h5>
                                                            </a>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.widget-user -->
                                    </div>
                                    <!-- /.card-body User Widget -->
                                @endforeach
                            
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        @endif
        <!-- Widget -->
        <!-- /.Row -->

        <!-- Row -->
        <div class="row">
            <!-- col -->
            <div class="col-md-12">
                <!-- card -->
                <div class="card">
                    <!-- card-header -->
                    <div class="card-header">
                        <h2 class="card-title">Users Activily Log</h2>
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
                        <!-- Table -->
                        <table class="table table-hover table-bordered table-mini datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Module</th>
                                    <th>Action</th>
                                    <th>URL</th>
                                    <th>IP</th>
                                    <th>Agent</th>
                                    <th>Created  At</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->module}}</td>
                                    <td>{{$item->action}}</td>
                                    <td>{{$item->url}}</td>
                                    <td>{{$item->ip}}</td>
                                    <td>{{$item->agent}}</td>
                                    <td>{{$item->date}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.Table -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.Row -->
    </section>
    <!-- /.Section -->
    
@endsection