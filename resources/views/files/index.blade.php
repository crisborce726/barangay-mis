@extends('layouts.app')
@section('title','File List | V.M.I.S.')

@section('content')
    <!-- Page Header -->
    <section class="content-header">
        <h1 class="page-title">File Uploaded</h1>
    </section>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
        <li class="breadcrumb-item active">Files</li>
    </ul>
    <!-- /Page Header -->

    <!-- Section -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered table-mini datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>File</th>
                            <th>Uploaded By</th>
                            <th>Created At</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td scope="row">
                                <span class="badge">{{ $item->id }} </span>
                            </td>
                            <td>{{$item->file_name}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->date}}</td>
                            <td>
                                <a class="btn btn-success btn-xs mr-1" href="{{ route('excelfile.download',$item->id) }}" title="Download"><i class="fa fa-download"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- ./section -->

@endsection