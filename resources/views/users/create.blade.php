  <!-- Modal -->
  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:#ff0000;color:white">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#fff">&times;</span>
            </button>
          <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight:bolder; text-transform:uppercase; font-family: 'Times New Roman', Times, serif">Add new users</h5>
        </div>
        
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="modal-title" id="exampleModalLongTitle" style="font-weight:bolder; text-transform:uppercase; font-family: 'Times New Roman', Times, serif; color:red"> New user Portal</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                        @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 45))' name="name" value="{{ old('name') }}" required placeholder="Full Name">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required placeholder="Username">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <select  id="barangay" name="barangay" class="form-control">
                                        <option value="" disabled selected>-- Select Barangay --</option>
                                        <option value="">None</option>
                                            @foreach($barangay as $value)
                                                <option value="{{$value->barangay}}">{{$value->barangay}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select  id="usertype" name="usertype" class="form-control">
                                        <option value="" disabled selected>-- Select Usertype --</option>
                                        @foreach($user_roles as $value)
                                                <option value="{{$value->usertype}}">{{ucfirst($value->usertype)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" >
                                </div>
                                
                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}" placeholder="Pass_12345 (Default Password)" disabled>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                    
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="sumbit" class="btn btn-primary">Save User</button>
                    </div>
            </form>
    
      </div>
    </div>
  </div>