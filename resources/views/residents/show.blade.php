@extends('layouts.app')
@section('title','Resident Details | V.M.I.S.')

@section('content')
    <section class="content-header">
        <h1 class="page-title">Personal Information</h1>
    </section>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
        <li class="breadcrumb-item"><a href={!! route('residents.index') !!}> Residents </a></li>
        <li class="breadcrumb-item active">Personal Information</li>
    </ul>
    
    <div class="content">
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">View Profile</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="profile">

                            <div class="row">
                                <div class="col-md-12" align="right">
                                    <a href="{{route ('residents.edit', $resident->id) }}" class="btn btn-warning btn-sm" title="Edit" ><i class='bx bx-edit' ></i> Edit</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <strong>Personal Information</strong>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <small>First name</small>
                                                        <input type="text" name="firstname" class="form-control" value="{{$resident->firstname}}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <small>Middle name</small>
                                                        <input type="text" name="middlename" class="form-control" value="{{$resident->middlename}}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <small>Last name</small>
                                                        <input type="text" name="lastname" class="form-control" value="{{$resident->lastname}}">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <small>Gender</small>
                                                        
                                                            @if($resident->gender == 'M')
                                                                @php $gender = 'Male'; @endphp
                                                                <select  id="gender" name="gender" class="form-control" required>
                                                                    <option value="" disabled>Select Gender</option>
                                                                    <option value="M" selected>{{$gender}}</option>
                                                                    <option value="F">Female</option>
                                                                </select>
                                                            @elseif($resident->gender == 'F')
                                                                @php $gender = 'Female'; @endphp
                                                                <select  id="gender" name="gender" class="form-control" required>
                                                                    <option value="" disabled>Select Gender</option>
                                                                    <option value="M">Male</option>
                                                                    <option value="F" selected>{{$gender}}</option>
                                                                </select>
                                                            @endif
                                                            
                                                    </div>
                                                    <div class="col-md-4">
                                                        <small>Age</small>
                                                        <input type="text" name="age" class="form-control" value="{{ \Carbon\Carbon::parse($resident->birth_date)->age }}" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <small>Birthdate</small>
                                                        <input type="date"  class="form-control" value="{{\Carbon\Carbon::parse($resident->birtyh_date)->format('F j, Y')}}">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>Other Information</strong>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-4">
                                                                    <small>Mobile Number</small>
                                                                    <input type="text"  class="form-control" value="{{$resident->phone_number}}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <small>Sitio</small>
                                                                    <input type="text"  class="form-control" value="{{$resident->brgy}}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <small>Address</small>
                                                                    <input type="text"  class="form-control" value="{{$resident->brgy}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <strong>Sectors:</strong>
                                                    <br/>
                                                    @if(!empty($resident_sector))
                                                        @foreach($resident_sector as $data)
                                                            <label class="label label-success">
                                                                {{ $data->sector }}
                                                            </label>
                                                            <br/>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection