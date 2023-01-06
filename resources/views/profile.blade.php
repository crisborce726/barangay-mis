@extends('layouts.app')
@section('title','Profile | V.M.I.S.')

@section('content')
    <section class="content-header" style="margin-bottom: 25px;">
        <h1 class="pull-left">
            Profile
        </h1>
    </section>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"> Home </a></li>
        <li class="breadcrumb-item active">My Profile</li>
    </ul>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
  
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                        <img 
                        src="/storage/images/{{$profile->image}}"
                        style="
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                        object-fit: cover;
                        object-position: center;
                        border-radius: 50%;
                        box-shadow: rgba(0,0,0,0.8) 0 0 10px;"
                        width="150" height="150" alt="{{$profile->name}}"/>
                  </div>
  
                  <h3 class="profile-username text-center">{{$profile->name}}</h3>
  
                  <p class="text-muted text-center">{{ucfirst($profile->usertype)}}</p>
  
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>User ID</b> <a class="float-right">{{$profile->id}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Username</b> <a class="float-right">{{$profile->username}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Status</b>
                            <a class="float-right">
                                @if($profile->status)
                                    Active
                                @endif
                            </a>
                    </li>
                  </ul>
  
                  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="pt-2 px-3"><h3 class="card-title">Profile</h3></li>
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-two-password-tab" data-toggle="pill" href="#custom-tabs-two-password" role="tab" aria-controls="custom-tabs-two-password" aria-selected="false">Change Password</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                            <form action="{{ route('users.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                        
                                            <img id="cover_image" src="/storage/images/{{$profile->image}}"
                                            style="
                                            display: block;
                                            margin-left: auto;
                                            margin-right: auto;
                                            object-fit: cover;
                                            object-position: center;
                                            border-radius: 50%;
                                            box-shadow: rgba(0,0,0,0.8) 0 0 10px;"
                                            width="150" height="150" alt=""/>

                                            <!-- User image -->
                                            <div class="form-group">
                                                <label>User Image:</label>
                            
                                                <div class="input-group">
                                                    <input class="text-center" type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                                                </div>
                                                <!-- /.User Image -->
                                            </div>
                                            <!-- /.form group -->

                                            <!-- Fullname -->
                                            <div class="form-group">
                                                <label>Full name:</label>
                            
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                        <input type="text"  class="form-control" id="name" name="name" value="{{$profile->name}}">
                                                </div>
                                                <!-- /.Fullname -->
                                            </div>
                                            <!-- /.form group -->
                                            <!-- Username -->
                                            <div class="form-group">
                                                <label>Username:</label>
                            
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                    </div>
                                                        <input type="text" class="form-control" id="username" name="username" value="{{$profile->username}}">
                                                </div>
                                                <!-- /.Username -->
                                            </div>
                                            <!-- /.form group -->
                                            
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-sm">Update</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-two-password" role="tabpanel" aria-labelledby="custom-tabs-two-password-tab">
                            <form action="{{ route('change.password', $profile->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-8">
                                        <!-- Old password -->
                                        <div class="form-group">
                                            <label>Old password:</label>
                        
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                    <input type="password" id="old_password" name="old_password" class="form-control" required>
                                            </div>
                                            <!-- /.Old password -->
                                        </div>
                                        <!-- /.form group -->
                                        <!-- new password -->
                                        <div class="form-group">
                                            <label>New password:</label>
                        
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                                            </div>
                                            <!-- /.new password -->
                                        </div>
                                        <!-- /.form group -->
                                        <!-- new password -->
                                        <div class="form-group">
                                            <label>Re-enter New password:</label>
                        
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                    <input type="password" id="re_new_password" name="re_new_password" class="form-control" required>
                                            </div>
                                            <!-- /.new password -->
                                        </div>
                                        <!-- /.form group -->

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-sm">Change Password</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
