@extends('layouts.app')
@section('title','Edit Resident Details | V.M.I.S.')

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
                        <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">Edit Profile</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="profile">

                            <form action="{{ route('residents.update', $resident->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                    <div class="row">
                                        <div class="col-md-12" style="text-align:right">
                                            <a href="{{route ('residents.show', $resident->id) }}" class="btn btn-warning btn-sm"><i class='bx bx-arrow-back'></i>Back</a>
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
                                                                <input type="date" id="birth_date" name="birth_date"  class="form-control" max="@php echo date('Y-m-d'); @endphp" value="{{\Carbon\Carbon::parse($resident->birtyh_date)->format('F j, Y')}}">
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
                                                                            <input type="text" id="phone_number" name="phone_number"  class="form-control" value="{{$resident->phone_number}}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <small>Sitio</small>
                                                                            <input type="text" id="sitio" name="sitio"  class="form-control" value="{{$resident->sitio}}">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <small>Address</small>
                                                                            <input type="text" id="barangay" name="barangay"  class="form-control" value="{{$resident->brgy}}" readonly>
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
                                                            @foreach($sectors as $data)
                                                                <label>
                                                                    <input type="checkbox" class="checkBoxClass" name="sectors[]" value="{{$data->id}}" {{in_array($data->id, $resident_sector) ? 'checked' : '' }}>
                                                                    {{ $data->sector }}
                                                                </label>
                                                                <br/>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" align="right">
                                            <button type="submit" class="btn btn-primary"><i class='bx bxs-save'></i> Update</button>
                                        </div>
                                    </div>

                            </form>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection