    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

    {{-- create user start --}}
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
         
          @if (isset($editsection))
          <div class="card">
          
            <div class="card-body boxShadow">
              <h4 class="text-warning text-bold">Update Section Detail</h4>
           
            <form action="{{ route('section.update',['section'=>$editsection->sm_id]) }}" method="POST" data-parsley-validate="">
                {{ csrf_field() }}
                @method('PUT')
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="sectionHead">Select Department</label>
                          <select class="form-control sectionHead @error('sm_dm_id') parsley-error @enderror" id="sectionHead" name="sm_dm_id" required="" data-parsley-trigger="change">
                            <option value="">Select Department Name</option>

                            @foreach ($department as $d)
                          
                          <option value="{{$d->dm_id}}" {{ $editsection->sm_dm_id == $d->dm_id ? 'selected' : '' }}>{{ ucfirst($d->dm_name)." (".$d->dm_short_name.")" }}</option>
                            @endforeach
                       
                          </select>
                          @error('sm_head_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div> 
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="sectionName">Section Name</label>
                          <input type="text" class="form-control sectionName @error('sm_name') parsley-error @enderror" id="sectionName" placeholder="Enter Section Name" name="sm_name" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ $editsection->sm_name }}">
                          @error('sm_name')  
                          <small class="validate-err">{{$message}}</small>
                          @enderror
                            </div> 
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="sectionShortName">Section Short Name</label>
                            <input type="text" class="form-control sectionShortName @error('sm_short_name') parsley-error @enderror" id="sectionShortName" placeholder="Enter Section Short Name" name="sm_short_name" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ $editsection->sm_short_name }}">
                            @error('sm_short_name')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                    </div>
                    
                    {{-- <div class="col-md-4">
                      <div class="form-group">
                          <label for="sectionHead">Section Head</label>
                          <select class="form-control sectionHead @error('sm_head_id') parsley-error @enderror" id="sectionHead" name="sm_head_id" required="" data-parsley-trigger="change">
                            <option value="">Select Section Head</option>

                            @foreach ($user as $u)
                          <option value="{{$u->um_id}}" {{ $editsection->sm_head_id == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
                            @endforeach
                       
                          </select>
                          @error('sm_head_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>  --}}
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sectionDescription">Section Description</label>
                            <textarea  class="form-control sectionDescription @error('sm_description') parsley-error @enderror" id="departmentDescription" placeholder="Enter Section Description" name="sm_description" required="" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ $editsection->sm_description }}</textarea>
                            @error('sm_description')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          </div> 
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="smstatus">Status</label>
                            <select class="form-control smstatus @error('sm_status') parsley-error @enderror" id="smstatus" name="sm_status" required="" data-parsley-trigger="change">
                              <option value="">Select Status</option>
                              <option value="A" {{ $editsection->sm_status == 'A' ? 'selected' : '' }}>Active</option>
                              <option value="I" {{ $editsection->sm_status == 'I' ? 'selected' : '' }}>Inactive</option>
                              {{-- <option value="D" {{ $editsection->sm_status == 'D' ? 'selected' : '' }}>Deleted</option> --}}
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
              <h4 class="text-success text-bold">Add Section Detail</h4>
            
            <form action="{{ route('section.store') }}" method="POST" data-parsley-validate="">
              {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="selectDepartment">Select Department</label>
                          <select class="form-control selectDepartmentCreate @error('sm_dm_id') parsley-error @enderror" id="selectDepartmentCreate" name="sm_dm_id" required="" data-parsley-trigger="change">
                            <option value="">Select Department Name</option>

                            @foreach ($department as $d)
                          <option value="{{$d->dm_id}}" {{ old('sm_dm_id') == $d->dm_id ? 'selected' : '' }}>{{ ucfirst($d->dm_name)." (".$d->dm_short_name.")" }}</option>
                            @endforeach
                       
                          </select>
                          @error('sm_dm_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div> 
                      <div class="col-md-4">
                          <div class="form-group">
                              
                              <label for="sectionName">Section Name</label>
                              <input type="text" class="form-control sectionName @error('sm_name') parsley-error @enderror" id="sectionName" placeholder="Enter Section Name" name="sm_name" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('sm_name') }}">
                              @error('sm_name')  
                              <small class="validate-err">{{$message}}</small>
                              @enderror
                        
                            </div> 
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="sectionShortName">Section Short Name</label>
                            <input type="text" class="form-control sectionShortName @error('sm_short_name') parsley-error @enderror" id="sectionShortName" placeholder="Enter Section Short Name" name="sm_short_name" data-parsley-maxlength="100" data-parsley-trigger="change" value="{{ old('sm_short_name') }}">
                            @error('sm_short_name')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                          
                          </div> 
                    </div>
                    
                    {{-- <div class="col-md-4">
                      <div class="form-group">
                        
                          <label for="sectionHead">Section Head</label>
                          <select class="form-control sectionHead @error('sm_head_id') parsley-error @enderror" id="sectionHead" name="sm_head_id" required="" data-parsley-trigger="change">
                            <option value="">Select Section Head</option>
                            
                    @foreach ($user as $u)
                          <option value="{{$u->um_id}}" {{ old('sm_head_id') == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
                     @endforeach
                          
                          
                          </select>
                          @error('sm_head_id')  
                          <small class="validate-err">{{$message}}</small>
                         @enderror
                     
                        </div> 
                    </div>  --}}
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sectionDescription">Section Description</label>
                            <textarea  class="form-control sectionDescription @error('sm_description') parsley-error @enderror" id="departmentDescription" placeholder="Enter Section Description" name="sm_description" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('dm_description') }}</textarea>
                            @error('sm_description')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                         
                          </div> 
                      </div>
                     
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="smstatus">Status</label>
                            <select class="form-control smstatus @error('sm_status') parsley-error @enderror" id="smstatus" name="sm_status" required="" data-parsley-trigger="change">
                              <option value="">Select Status</option>
                              <option value="A" {{ old('sm_status') == 'A' ? 'selected' : '' }}>Active</option>
                              {{-- <option value="I" {{ old('sm_status') == 'I' ? 'selected' : '' }}>Inactive</option> --}}
                              {{-- <option value="D" {{ old('sm_status') == 'D' ? 'selected' : '' }}>Deleted</option> --}}
                            </select>
                            @error('sm_status')  
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
 