
  <!-- Modal -->
  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#ff0000;color:white">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#fff">&times;</span>
            </button>
          <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight:bolder; text-transform:uppercase; font-family: 'Times New Roman', Times, serif">Add new Resident</h5>
        </div>
        
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="modal-title" id="exampleModalLongTitle" style="font-weight:bolder; text-transform:uppercase; font-family: 'Times New Roman', Times, serif; color:red"> New Resident Portal</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('residents.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <input id="household_no" type="text" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="household_no" value="{{ old('household_no') }}" required placeholder="Household Number">

                                @if ($errors->has('household_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('household_no') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <input id="suffix" type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' name="suffix" value="{{ old('suffix') }}" placeholder="Suffix">

                                @if ($errors->has('suffix'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('suffix') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-md-4">
                                <input id="lastname" type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))' name="lastname" value="{{ old('lastname') }}" required placeholder="Lastname">

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="firstname" type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))' name="firstname" value="{{ old('firstname') }}" required placeholder="Firstname">

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="middlename" type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))' name="middlename" value="{{ old('middlename') }}" placeholder="Middlename">

                                @if ($errors->has('middlename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-4">
                                <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('date') }}" max="@php $today= date('Y-m-d');echo $today; @endphp" required placeholder="Birth Date">

                                @if ($errors->has('birth_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <select  id="gender" name="gender" class="form-control" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="phone_number" type="text" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="phone_number" value="{{ old('phone_number') }}" placeholder="(09xxxxxxxxx)">

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <input id="sitio" type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))' name="sitio" value="{{ old('sitio') }}" placeholder="Sitio">

                                @if ($errors->has('sitio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sitio') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if(Auth::user()->usertype == 'admin')
                                <div class="col-md-6">
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
                            @else
                                <div class="col-md-6">
                                    <input id="barangay" placeholder="{{Auth()->user()->barangay}}" value="{{Auth()->user()->barangay}}" type="text" class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))' name="barangay" value="{{ old('barangay') }}" readonly>

                                    @if ($errors->has('barangay'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('barangay') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Save Resident</button>
                    </div>
            </form>
    
      </div>
    </div>
  </div>