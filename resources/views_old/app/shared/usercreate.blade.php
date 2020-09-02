    {{-- include alert msg --}}
      @include('app.shared.alert-msg')
    {{-- include alert msg --}}

    {{-- create user start --}}
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
         
          @if (isset($edituser))
          <div class="card">
          
            <div class="card-body boxShadow">
              <h4 class="text-warning text-bold"><b>Update user detail</b></h4>
              {{-- <p class="card-description">
                  Create user
              </p> --}}
            <form action="{{ route('user.update',['user'=>$edituser->um_id]) }}" method="POST" data-parsley-validate="">
               {{ csrf_field() }}
              @method('PUT')
                  <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="userfirstname">User First Name</label>
                          <input type="text" class="form-control userfirstname @error('um_first_name') parsley-error @enderror" id="userfirstname" placeholder="Enter User First Name" name="um_first_name" required="" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ $edituser->um_first_name }}">
                          @error('um_first_name')  
                          <small class="validate-err">{{$message}}</small>
                          @enderror
                            </div> 
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="userlastname">User Last Name</label>
                            <input type="text" class="form-control userlastname @error('um_last_name') parsley-error @enderror" id="userlastname" placeholder="Enter User Last Name" name="um_last_name" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ $edituser->um_last_name }}">
                            @error('um_last_name')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="useremail">Email</label>
                          <input type="email" class="form-control useremail @error('um_email') parsley-error @enderror" id="useremail" placeholder="Enter Email" name="um_email" required="" data-parsley-type="email" data-parsley-maxlength="255"  data-parsley-trigger="change" value="{{ $edituser->um_email }}">
                          @error('um_email')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                        </div> 
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="mobilenumber">Mobile Number</label>
                          <input type="text" class="form-control mobilenumber @error('um_mobile') parsley-error @enderror" id="mobilenumber" name="um_mobile" placeholder="Enter Mobile Number" required=""  minlength="10" data-parsley-maxlength="10" data-parsley-type="number"  data-parsley-trigger="change" value="{{ $edituser->um_mobile }}">
                          @error('um_mobile')  
                          <small class="validate-err">{{$message}}</small>
                           @enderror
                        </div> 
                  </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="usergender">Gender</label>
                          <select class="form-control usergender @error('um_gender') parsley-error @enderror" id="usergender" name="um_gender" required="" data-parsley-trigger="change">
                            <option value="">Select Gender</option>
                            <option value="M" {{  $edituser->um_gender == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ $edituser->um_gender == 'F' ? 'selected' : '' }}>Female</option>
                            <option value="O" {{ $edituser->um_gender == 'O' ? 'selected' : '' }}>Others</option>
                          
                          </select>
                          @error('um_gender')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                        </div> 
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="usergender">User Type</label>
                          <select class="form-control usertype @error('um_user_type') parsley-error @enderror" id="usertype" name="um_user_type"  required="" data-parsley-trigger="change">
                            <option value="">Select User Type</option>
                            @foreach ($role as $r)
                            <option value="{{ $r->role }}" {{ $edituser->um_user_type == $r->role ? 'selected' : '' }}>{{ $r->role_full_name }}</option>
                              @endforeach
                       
                          
                          </select>
                          @error('um_user_type')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                        </div> 
                    </div>  
                    {{-- @php
                        echo $edituser->um_user_type;die();
                    @endphp --}}
                    <div class="col-md-3 selectUserForDS" id="selectUserFOrD">
                      <div class="form-group">
                          <label for="selectDepartment">Select Department</label>
                          <select class="form-control selectDepartment @error('um_dm_id') parsley-error @enderror" id="selectDepartment" name="um_dm_id" data-parsley-trigger="change">
                            <option value="">Select Department Name</option>
                            {{-- {{ ($edituser->um_dm_id == $d->dm_id && ($edituser->um_user_type == 'S' || $edituser->um_user_type == 'D') ) ? 'selected' : '' }} --}}
                            @foreach ($department as $d)
                          <option value="{{$d->dm_id}}"
                          @if ($edituser->um_user_type =='U')
                            @if ($edituser->um_dm_id)
                            {{ $edituser->um_dm_id == $d->dm_id ? 'selected' : ''}}
                            @endif 

                            @if ($edituser->um_sm_id)
                            {{ $section->sm_dm_id == $d->dm_id ? 'selected' : ''}}
                            @endif 
                             @endif >
                                {{ ucfirst($d->dm_name)." (".$d->dm_short_name.")" }}
                          </option>
                            @endforeach
                       
                          </select>
                          @error('um_dm_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>

                    <div class="col-md-3 selectUserForDS" id="selectUserFOrS">
                      <div class="form-group">
                          <label for="selectSection">Select Section</label>
                          <select class="form-control selectSection @error('um_sm_id') parsley-error @enderror" id="selectSection" name="um_sm_id" data-parsley-trigger="change">
                            <option value="">Select Section Name</option>
                            @if ($edituser->um_sm_id)
                            @foreach ($fullsection as $fs)
                           
                            <option value="{{ $fs->sm_id }}" 
                              @if ($edituser->um_sm_id)
                              {{ $edituser->um_sm_id == $fs->sm_id ? 'selected' : ''}}
                              @endif>
                              {{ ucfirst($fs->sm_name) }}
                            </option>
                            @endforeach
                            @endif
                          </select>
                          @error('um_sm_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>

                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="userdesignation">Designation</label>
                              <input type="text" class="form-control userdesignation @error('um_designation') parsley-error @enderror" id="userdesignation" placeholder="Enter Designation" name="um_designation"  required="" data-parsley-maxlength="255" data-parsley-trigger="change"
                              value="{{ $edituser->um_designation }}">
                              @error('um_designation')  
                              <small class="validate-err">{{$message}}</small>
                              @enderror
                            </div>
                      </div>
                       
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="usersection">Select Status</label>
                            <select class="form-control umstatus @error('um_status') parsley-error @enderror" id="umstatus" name="um_status" required="" data-parsley-trigger="change">
                              <option value="">Select Status</option>
                              <option value="A" {{ $edituser->um_status == 'A' ? 'selected' : '' }}>Active</option>
                              <option value="I" {{ $edituser->um_status == 'I' ? 'selected' : '' }}>Inactive</option>
                              {{-- <option value="D" {{ $edituser->um_status == 'D' ? 'selected' : '' }}>Deleted</option> --}}
                            </select>
                            @error('um_status')  
                             <small class="validate-err">{{$message}}</small>
                            @enderror
                        </div>
                      </div>
                  </div>
               
             
                <div class="col-md-12 justify-content-lg-end align-items-end 
                d-flex">
                <button type="submit" class="btn btn-success mr-2">Update</button>
                {{-- <button class="btn btn-light">Cancel</button> --}}
                </div>
               
              </form>
            </div>
          </div>
          @else
          <div class="card">
            {{-- <div class="card-header card bg-success">
              <h4 class="text-white text-bold">Create user</h4>
            </div> --}}
            <div class="card-body boxShadow">
              <h4 class="text-success text-bold">Add user detail</h4>
              {{-- <p class="card-description">
                  Create user
              </p> --}}
            <form action="{{ route('user.store') }}" method="POST" data-parsley-validate="">
              {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="userfirstname">User First Name</label>
                          <input type="text" class="form-control userfirstname @error('um_first_name') parsley-error @enderror" id="userfirstname" placeholder="Enter User First Name" name="um_first_name" required="" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ old('um_first_name') }}">
                          @error('um_first_name')  
                          <small class="validate-err">{{$message}}</small>
                          @enderror
                            </div> 
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="userlastname">User Last Name</label>
                            <input type="text" class="form-control userlastname @error('um_last_name') parsley-error @enderror" id="userlastname" placeholder="Enter User Last Name" name="um_last_name" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ old('um_last_name') }}">
                            @error('um_last_name')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="useremail">Email</label>
                          <input type="email" class="form-control useremail @error('um_email') parsley-error @enderror" id="useremail" placeholder="Enter Email" name="um_email" required="" data-parsley-type="email" data-parsley-maxlength="255"  data-parsley-trigger="change" value="{{ old('um_email') }}">
                          @error('um_email')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                        </div> 
                    </div>

                    
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="userpassword">Password</label>
                          <input type="password" class="form-control userpassword @error('um_password') parsley-error @enderror" id="userpassword" placeholder="Enter Password" name="um_password" required="" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ old('um_password')}}">
                          @error('um_password')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                        </div> 
                    </div> 
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="mobilenumber">Mobile Number</label>
                          <input type="text" class="form-control mobilenumber @error('um_mobile') parsley-error @enderror" id="mobilenumber" name="um_mobile" placeholder="Enter Mobile Number" required=""  minlength="10" data-parsley-maxlength="10" data-parsley-type="number"  data-parsley-trigger="change" value="{{ old('um_mobile')}}">
                          @error('um_mobile')  
                          <small class="validate-err">{{$message}}</small>
                           @enderror
                        </div> 
                  </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="usergender">Gender</label>
                          <select class="form-control usergender @error('um_gender') parsley-error @enderror" id="usergender" name="um_gender" required="" data-parsley-trigger="change">
                            <option value="">Select Gender</option>
                            <option value="M" {{ old('um_gender') == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ old('um_gender') == 'F' ? 'selected' : '' }}>Female</option>
                            <option value="O" {{ old('um_gender') == 'O' ? 'selected' : '' }}>Others</option>
                          
                          </select>
                          @error('um_gender')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                        </div> 
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                          <label for="usergender">User Type</label>
                          <select class="form-control usertype @error('um_user_type') parsley-error @enderror" id="usertype" name="um_user_type"  required="" data-parsley-trigger="change">
                            <option value="">Select User Type</option>
                            @foreach ($role as $r)
                            <option value="{{ $r->role }}" {{ old('um_user_type') == $r->role ? 'selected' : '' }}>{{ $r->role_full_name }}</option>
                              @endforeach
                       
                          
                          </select>
                          @error('um_user_type')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                        </div> 
                    </div>  
                    <div class="col-md-3 selectUserForDS" id="selectUserFOrD">
                      <div class="form-group">
                          <label for="selectDepartment">Select Department</label>
                          <select class="form-control selectDepartment @error('um_dm_id') parsley-error @enderror" id="selectDepartment" name="um_dm_id" data-parsley-trigger="change">
                            <option value="">Select Department Name</option>

                            @foreach ($department as $d)
                          <option value="{{$d->dm_id}}" {{ old('um_dm_id') == $d->dm_id ? 'selected' : '' }}>{{ ucfirst($d->dm_name)." (".$d->dm_short_name.")" }}</option>
                            @endforeach
                       
                          </select>
                          @error('um_dm_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>
                    <div class="col-md-3 selectUserForDS" id="selectUserFOrS">
                      <div class="form-group">
                          <label for="selectSection">Select Section</label>
                          <select class="form-control selectSection @error('um_sm_id') parsley-error @enderror" id="selectSection" name="um_sm_id" data-parsley-trigger="change">
                            
                            <option value="">Select Section Name</option>

                          </select>
                          @error('um_sm_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="userdesignation">Designation</label>
                              <input type="text" class="form-control userdesignation @error('um_designation') parsley-error @enderror" id="userdesignation" placeholder="Enter Designation" name="um_designation"  required="" data-parsley-maxlength="255" data-parsley-trigger="change"
                              value="{{ old('um_designation')}}">
                              @error('um_designation')  
                              <small class="validate-err">{{$message}}</small>
                              @enderror
                            </div>
                      </div>
                     
                      {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="usersection">Status</label>
                            <select class="form-control umstatus @error('um_status') parsley-error @enderror" id="umstatus" name="um_status" required="" data-parsley-trigger="change">
                              <option value="">Select Status</option>
                              <option value="A" {{ old('um_status') == 'A' ? 'selected' : '' }}>Active</option>
                            </select>
                            @error('um_status')  
                             <small class="validate-err">{{$message}}</small>
                            @enderror
                        </div>
                      </div> --}}
                  </div>
               
             
                <div class="col-md-12 justify-content-lg-end align-items-end 
                d-flex">
                <button type="submit" id="addUserForm" class="btn btn-success mr-2">Submit</button>
                {{-- <button class="btn btn-light">Cancel</button> --}}
                </div>
               
              </form>
            </div>
          </div>
          @endif

            
        </div>
    </div>   
   {{-- create user end --}}