@extends('layouts.app')
@section('title','Users Log List || V.M.I.S.')

@section('content')

    <section class="content-header">
        <h1 class="page-title">User Activity Logs</h1>
    </section>
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
            <li class="breadcrumb-item "><a href={!! route('activity_logs.index') !!}> User Log</a></li>
            <li class="breadcrumb-item active">{{$get_user}}</li>
        </ul>
    </div>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a href="{{route ('activity_logs.index') }}" class="btn btn-warning btn-sm"><i class='fa fa-arrow-left'></i> Back</a>
                </div>
            </div>
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
        </div>
    </section>
    
@endsection