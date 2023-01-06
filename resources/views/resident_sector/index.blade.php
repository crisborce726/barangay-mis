@extends('layouts.app')
@section('title', $sector . ' List | V.M.I.S.')

@section('content')

    <section class="content-header">
        <h1 class="page-title">Sectors</h1>
    </section>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
        <li class="breadcrumb-item">Sector</li>
        <li class="breadcrumb-item active">{{$sector}}</li>
    </ul>
            
    <!-- Section -->
    <section class="content">
        <!-- Dashboard -->
        <div class="card card-primary card-outline card-outline-tabs">
            <!-- card-header -->
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    @include('resident_sector.nav_tab')
                </ul>
            </div>
            <!-- /.card-header -->
            <!-- card-body -->
            <div class="card-body">
                    <a class="btn btn-warning full-right btn-xs mb-3" href="{{ route('excel.export', $sector_id.$sector) }}"><i class='fa fa-download'></i> Export Excel</a>
                
                <div class="row">
                    <table class="table table-hover table-bordered table-mini datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>House No.</th>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Suffix</th>
                                <th>Sex</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <th>Sitio</th>
                                <th>Barangay</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($res as $item)
                            <tr>
                                <!-- ID Col -->
                                <td>
                                    <span class="badge">{{ $item->resSec_id }}</span>
                                </td>
                                <!-- ID Col -->
            
                                <!-- Household No Col -->
                                <td>
                                    {{ $item->household_no }}
                                </td>
                                <!-- Household No Col -->
            
                                <!-- Lastname Col -->
                                <td>
                                    {{ $item->lastname }}
                                </td>
                                <!-- Lastname Col -->
            
                                <!-- Firstname Col -->
                                <td>
                                    {{ $item->firstname }}
                                </td>
                                <!-- Firstname Col -->
            
                                <!-- Middlename Col -->
                                <td>
                                    {{ $item->middlename }}
                                </td>
                                <!-- Middlename Col -->
            
                                <!-- Suffix Col -->
                                <td>
                                    @if(!empty($item->suffix))
                                        {{$item->suffix}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <!-- Suffix Col -->
            
                                <!-- Gender Col -->
                                <td>
                                    {{ $item->gender }}
                                </td>
                                <!-- Gender Col -->
            
                                <!-- Birth Date Col -->
                                <td>
                                    {{\Carbon\Carbon::parse($item->birth_date)->format('m/j/Y')}}
                                </td>
                                <!-- Birth Date Col -->
            
                                <!-- Age Col -->
                                <td>
                                    {{ \Carbon\Carbon::parse($item->birth_date)->age }}
                                </td>
                                <!-- Age Col -->
            
                                <!-- Sitio Col -->
                                <td>
                                    @if(!empty($item->sitio))
                                        {{$item->sitio}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <!-- Sitio Col -->
            
                                <!-- Barangay Col -->
                                <td>
                                    {{ $item->brgy }}
                                </td>
                                <!-- Barangay Col -->
            
                                <!-- Action Col -->
                                <td>
                                    <a title="Delete" class="btn btn-danger btn-xs admindeleteSec"  data-res_id="{{$item->resID}}" data-res_sec_id="{{$item->resSec_id}}" data-sector_id="{{$item->sector_id}}" data-toggle="modal" data-target="#admindeleteSec">
                                        <i class='fa fa-trash'></i>
                                    </a>                               
                                </td>
                                <!-- End Action Col -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.Dashboard -->
    </section>
    <!-- ./section -->


    <!-- Delete Modal -->
    <div class="modal fade" id="admindeleteSec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Delete Resident Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('resident_sectors.destroy', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE') 
                    <h1 class="text-danger text-center">
                        <i class="fa fa-exclamation-triangle"></i>
                    </h1>
                        <p class="text-center">
                            Are you sure you want to delete record from this sector?
                        </p>
                        <input type="text" name="res_id" id="res_id" hidden>
                        <input type="text" name="res_sec_id" id="res_sec_id" hidden>
                        <input type="text" name="sector_id" id="sector_id" hidden>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End of Delete Modal -->
    
@endsection