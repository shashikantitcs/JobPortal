    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

    {{-- create user start --}}
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
         
          @if (isset($editdepartment))
          <div class="card">
          
            <div class="card-body boxShadow">
              <h4 class="text-warning text-bold">Update Department Detail</h4>
           
            <form action="{{ route('department.update',['department'=>$editdepartment->dm_id]) }}" method="POST" data-parsley-validate="">
                {{ csrf_field() }}
                @method('PUT')
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="departmentName">Department Name</label>
                          <input type="text" class="form-control departmentName @error('dm_name') parsley-error @enderror" id="departmentName" placeholder="Enter Department Name" name="dm_name" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ $editdepartment->dm_name }}">
                          @error('dm_name')  
                          <small class="validate-err">{{$message}}</small>
                          @enderror
                            </div> 
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="departmentshortName">Department Short Name</label>
                            <input type="text" class="form-control departmentshortName @error('dm_short_name') parsley-error @enderror" id="departmentshortName" placeholder="EnterDepartment Short Name" name="dm_short_name" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ $editdepartment->dm_short_name }}">
                            @error('dm_short_name')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                    </div>
{{--                     
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="departmentHead">Department Head</label>
                          <select class="form-control departmentHead @error('dm_head_id') parsley-error @enderror" id="departmentHead" name="dm_head_id" required="" data-parsley-trigger="change">
                            <option value="">Select Department Head</option>

                            @foreach ($user as $u)
                          <option value="{{$u->um_id}}" {{ $editdepartment->dm_head_id == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
                            @endforeach
                       
                          </select>
                          @error('dm_head_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>  --}}
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="departmentDescription">Department Description</label>
                            <textarea  class="form-control departmentDescription @error('dm_description') parsley-error @enderror" id="departmentDescription" placeholder="Enter Department Description" name="dm_description" required="" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ $editdepartment->dm_description }}</textarea>
                            @error('dm_description')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="dmstatus">Status</label>
                            <select class="form-control dmstatus @error('dm_status') parsley-error @enderror" id="dmstatus" name="dm_status" required="" data-parsley-trigger="change">
                              <option value="">Select Status</option>
                              <option value="A" {{ $editdepartment->dm_status == 'A' ? 'selected' : '' }}>Active</option>
                              <option value="I" {{ $editdepartment->dm_status == 'I' ? 'selected' : '' }}>Inactive</option>
                              {{-- <option value="D" {{ $editdepartment->dm_status == 'D' ? 'selected' : '' }}>Deleted</option> --}}
                            </select>
                            @error('dm_status')  
                             <small class="validate-err">{{$message}}</small>
                            @enderror
                        </div>
                      </div> 

                  </div>
               
             
                <div class="col-md-12 justify-content-lg-end align-items-end 
                d-flex">
                <button type="submit" class="btn btn-success mr-2">Update</button>
              
                </div>
               
              </form>
            </div>
          </div>
          @else
          <div class="card">
          
            <div class="card-body boxShadow">
              <h4 class="text-success text-bold">Add Department</h4>
            
            <form action="{{ route('department.store') }}" method="POST" data-parsley-validate="">
              {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="departmentName">Department Name</label>
                          <input type="text" class="form-control departmentName @error('dm_name') parsley-error @enderror" id="departmentName" placeholder="Enter Department Name" name="dm_name" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('dm_name') }}">
                          @error('dm_name')  
                          <small class="validate-err">{{$message}}</small>
                          @enderror
                            </div> 
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="departmentshortName">Department Short Name</label>
                            <input type="text" class="form-control departmentshortName @error('dm_short_name') parsley-error @enderror" id="departmentshortName" placeholder="Enter Department Short Name" name="dm_short_name" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ old('dm_short_name') }}">
                            @error('dm_short_name')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                    </div>
                    
                    {{-- <div class="col-md-4">
                      <div class="form-group">
                          <label for="departmentHead">Department Head</label>
                          <select class="form-control departmentHead @error('dm_head_id') parsley-error @enderror" id="departmentHead" name="dm_head_id" required="" data-parsley-trigger="change">
                            <option value="">Select Department Head</option>
                            
                    @foreach ($user as $u)
                          <option value="{{$u->um_id}}" {{ old('dm_head_id') == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
                     @endforeach
                          
                          
                          </select>
                          @error('dm_head_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>  --}}
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="departmentDescription">Department Description</label>
                            <textarea  class="form-control departmentDescription @error('dm_description') parsley-error @enderror" id="departmentDescription" placeholder="Enter Department Description" name="dm_description" required="" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('dm_description') }}</textarea>
                            @error('dm_description')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                      </div>
                     
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="dmstatus">Status</label>
                            <select class="form-control dmstatus @error('dm_status') parsley-error @enderror" id="dmstatus" name="dm_status" required="" data-parsley-trigger="change">
                              <option value="">Select Status</option>
                              <option value="A" {{ old('dm_status') == 'A' ? 'selected' : '' }}>Active</option>
                              {{-- <option value="I" {{ old('dm_status') == 'I' ? 'selected' : '' }}>Inactive</option> --}}
                              {{-- <option value="D" {{ old('dm_status') == 'D' ? 'selected' : '' }}>Deleted</option> --}}
                            </select>
                            @error('dm_status')  
                             <small class="validate-err">{{$message}}</small>
                            @enderror
                        </div>
                      </div>

                    
                  </div>
               
             
                <div class="col-md-12 justify-content-lg-end align-items-end 
                d-flex">
                <button type="submit" class="btn btn-success mr-2">Submit</button>
               
                </div>
               
              </form>
            </div>
          </div>
          @endif

            
        </div>
    </div>   
   {{-- create user end --}}
 