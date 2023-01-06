@extends('layouts.app')
@section('title','Resident List | V.M.I.S.')

@section('content')

    <section class="content-header">
        <h1 class="page-title">Residents</h1>
    </section>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href={!! route('home') !!}> Home </a></li>
        <li class="breadcrumb-item active">Resident</li>
    </ul>

    <section class="content">        
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    @php
                        $count = DB::table('residents')->count();
                        if($count != 0)
                        {
                            $last = DB::table('residents')->get()->last();
                        }
                    @endphp

                    @if(Auth()->user()->usertype != 'admin')
                        @if($count != 0)
                            @if((date('m') - \Carbon\Carbon::parse($last->created_at)->format('m') >= '6'))
                                <form action="{{ route('residents.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input  type="file" name="file" accept=".xlsx, .xls" required>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-success btn-xs"><i class='fa fa-upload' ></i> Import Resident Data</button>
                                        </div>
                                    </div> 
                                </form>
                            @endif
                        @else
                            <form action="{{ route('residents.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <input  type="file" name="file" accept=".xlsx, .xls" required>
                                        <input type="text" name="fullname" id="fullname" value="{{Auth()->user()->name}}" hidden>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success btn-xs"><i class='fa fa-upload' ></i> Import Resident Data</button>
                                    </div>
                                </div> 
                            </form>
                        @endif
                    @else
                        <form action="{{ route('residents.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input  type="file" name="file" accept=".xlsx, .xls" required>
                                    <input type="text" name="fullname" id="fullname" value="{{Auth()->user()->name}}" hidden>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-xs"><i class='fa fa-upload' ></i> Import Resident Data</button>
                                </div>
                            </div> 
                        </form>
                    @endif
                </div>
                <div class="pull-right">
                    @if(Auth()->user()->usertype != 'admin')
                        @if($count != 0)
                            @if((date('m') - \Carbon\Carbon::parse($last->created_at)->format('m') >= '6'))
                                <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#create"><i class='fa fa-plus'></i> Add Resident </a>
                            @endif
                        @else
                            <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#create"><i class='fa fa-plus'></i> Add Resident </a>
                        @endif
                    @else
                        <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#create"><i class='fa fa-plus'></i> Add Resident </a>
                    @endif
                    <a class="btn btn-warning btn-xs" href="{{ route('residents.export') }}"><i class='fa fa-download' ></i> Export Excel Data</a>
                    <a class="btn btn-primary btn-xs" href="{{ route('template.download') }}"><i class='fa fa-download'></i> Download Excel Template</a>
                </div>
            </div>            
            <div class="card-body">
                    <div class="card collapsed-card">
                        <div class="card-header">
                          <h3 class="card-title">Filter</h3>
          
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                          </div>
                          <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('residents.index') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') 
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group-prepend">
                                                <input  type="text" name="findHousehold" id="findHousehold" class="form-control sm my-0 py-1" placeholder="Household Number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group-prepend">
                                                <input value="{{old('findMe')}}" type="text" name="findMe" id="findMe" class="form-control sm my-0 py-1" placeholder="Firstname, Middlename or Lastname" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))'>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <br/>
                        
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                                </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" id="findSctr" name="findSctr">
                                                <option value="" selected disabled>Select Sector</option>
                                                @foreach($sector as $item)
                                                <option value="{{$item->id}}">{{$item->sector}}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group-prepend">
                                                <input type="text" name="findSitio" id="findSitio" class="form-control sm my-0 py-1" placeholder="Sitio" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))'>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" id="findBrgy" name="findBrgy">
                                                <option value="" selected disabled>Select Barangay</option>
                                                @foreach($brgy as $item)
                                                <option value="{{$item->id}}">{{$item->barangay}}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>
                        
                                    <br/>
                        
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input  type="text" name="findFrm" id="findFrm" class="form-control sm" placeholder="Enter Age" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </div>
                                        to
                                        <div class="col-md-4">
                                            <input type="text" name="findTo" id="findTo" class="form-control sm" placeholder="Enter Age" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-xs mr-1"><i class="fa fa-search"></i>
                                            <b>{{ __('SEARCH') }}</b>
                                        </button>
                                        <button href="{{route('residents.index')}}" class="btn btn-primary btn-xs"><i class="fa fa-refresh"></i>
                                            <b>{{ __('RESET') }}</b>
                                        </button>
                                    </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                <table class="table table-hover table-bordered table-mini datatable" id="residents-datatable">
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
                            <!-- No Col -->
                            <td>
                                <span class="badge">{{ $item->resID }}</span>
                            </td>
                            <!-- No Col -->
        
                            <!-- Household No Col -->
                            <td>
                                {{ $item->household_no }}
                            </td>
                            <!-- Household No Col -->
        
                            <!-- Lastname Col -->
                            <td>
                                {{ ucfirst($item->lastname) }}
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
                                <a href="{{route ('residents.show', $item->resID) }}" class="btn btn-success btn-xs" title="View" ><i class='fa fa-eye' ></i></a>
                                <a href="{{route ('residents.edit', $item->resID) }}" class="btn btn-warning btn-xs" title="Edit" ><i class='fa fa-edit'></i></a>
                                <a title="Change Barangay" class="btn btn-primary btn-xs changeBrgy"  data-res_id="{{$item->resID}}" data-toggle="modal" data-target="#changeBrgy"><i class='la la-edit'></i></a>
                                <a title="Delete" class="btn btn-danger btn-xs admindeleteRes"  data-res_id="{{$item->resID}}" data-toggle="modal" data-target="#admindeleteRes"><i class='fa fa-trash'></i></a>                               
                            </td>
                            <!-- End Action Col -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('residents.create')
    </section>

    <!-- Transfer Brgy Class -->
    <div class="modal fade" id="changeBrgy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Change Barangay Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('change.address') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    <h1 class="text-danger text-center">
                        <i class="fa fa-exclamation-triangle"></i>
                    </h1>
                        <p class="text-center">
                            Are you sure you want to change?
                        </p>
                        <input type="text" name="res_id" id="res_id" hidden>
                        <select  id="barangay" name="barangay" class="form-control">
                            <option value="" disabled selected>Select Barangay</option>
                            @php
                                $get = DB::table('barangays')->get();
                                foreach($get as $value)
                                {
                                    echo "<option value=".$value->id.">$value->barangay</option>";
                                }
                            @endphp
                        </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Exit</button>
                    <button type="submit" class="btn btn-warning">Yes, Change</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End Transfer Brgy Class -->

    <!-- Delete Modal -->
    <div class="modal fade" id="admindeleteRes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Delete Resident Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('residents.destroy', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE') 
                    <h1 class="text-danger text-center">
                        <i class="fa fa-exclamation-triangle"></i>
                    </h1>
                        <p class="text-center">
                            Are you sure you want to delete?
                        </p>
                        <input type="text" name="res_id" id="res_id" hidden>

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

@section('scripts')
<script type="text/javascript">
  
    $("button#submit").prop("disabled", true);

    let isOk = true;

    $("input, select").change(function ()
    {
        $("input, select").each(()=>
        {
            console.log(this); 
            if($(this).val() === "") 
            {
                isOk = false;
            } 
        });
        
        if(isOk) $("button#submit").prop("disabled", false);
    });

    $("input#findTo").prop("readonly", true);

    let isOkay = true;

    $("input#findFrm").change(function ()
    {
        $("input#findFrm").each(()=>
        {
            console.log(this); 
            if($(this).val() === "") 
            {
                isOkay = false;
            } 
        });
        
        if(isOkay) $("input#findTo").prop("readonly", false);
    });

</script>
@endsection