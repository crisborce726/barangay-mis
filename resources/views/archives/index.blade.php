@extends('layouts.app')
@section('title','Archive List | V.M.I.S.')

@section('content')

    <section class="content-header">
        <h1 class="page-title">Archive</h1>
    </section>
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
            <li class="breadcrumb-item active">Archive</li>
        </ul>
    </div>

    <section class="content">
        
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-bordered table-responsive-sm datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                                @if(Auth::user()->username == 'admin')
                                    <th>Account</th>
                                @else
                                    <th>Username</th>
                                @endif
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($data as $item)
                        <tr>
                            <td scope="row">
                                <span class="badge">{{ $i }} </span>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>
                                <b>Username:</b> {{$item->username}}
                                <br/>
                                <b>Reset Password:</b> {{$item->username}}
                            </td>
                            <td>
                                
                                    @if($item->status == 1)
                                        <span class="label label-success">ACTIVE</span>
                                    @elseif($item->status == 0)
                                        <span class="label label-danger">BLOCK</span>
                                    @elseif($item->status == 2)
                                        <span class="label label-warning">ARCHIVED</span>
                                    @endif
                                
                            </td>
                            <td>
                                @if(Auth::user()->usertype == 'admin')
                                    @if($item->status == 1)
                                        <button title="Archive" class="btn btn-danger btn-xs archiveUser"  data-post_id={{$item->id}} data-toggle="modal" data-target="#archiveUser"><i class="fa fa-archive"></i></button>
                                    @elseif($item->status == 2)
                                        <button title="Restore" class="btn btn-success btn-xs restoreUser"  data-post_id={{$item->id}} data-toggle="modal" data-target="#restoreUser"><i class="fa fa-archive"></i></button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @php $i ++;  @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>

<!-- Restore Modal -->
<div class="modal fade" id="restoreUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-success">
            <h5 class="modal-title text-white" id="exampleModalLabel">Restore Account Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <form action="{{ route('user.restore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                <h1 class="text-danger text-center">
                    <i class="fa fa-exclamation-triangle"></i>
                </h1>
                    <p class="text-center">
                        Are you sure you want to restore this account?
                    </p>
                    <input type="text" name="post_id" id="post_id" hidden>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">No, Exit</button>
                <button type="submit" class="btn btn-success">Yes, Restore</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Restore Modal -->

@endsection