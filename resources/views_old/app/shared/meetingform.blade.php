<style>
.select2-selection__rendered .select2-selection__choice{
  font-size: 17px !important;
}
</style>

{{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

    {{-- create user start --}}
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
         
          @if (isset($editmeeting))
          <div class="card">
          
            <div class="card-body boxShadow">
              <h4 class="text-success text-bold">Update Meeting Detail</h4>
           
            {{-- <form action="{{ route('meeting.update',['meeting'=>$editmeeting->mm_id]) }}" method="POST" data-parsley-validate=""> --}}
              <form action="{{ route('meeting.update',['meeting'=>$editmeeting->mm_id]) }}" method="POST" data-parsley-validate="">
                @method('PUT')
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                
                                <label for="meetingName">Meeting Title</label>
                                <input type="text" class="form-control meetingTitle @error('mm_title') parsley-error @enderror" id="meetingTitle" placeholder="Enter Meeting Title" name="mm_title" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ $editmeeting->mm_title }}">
  
                                @error('sm_name')  
                                  <small class="validate-err">{{$message}}</small>
                                @enderror
                          
                              </div> 
                        </div>
  
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="meetingDescription">Meeting Description</label>
                              <textarea  class="form-control meetingDescription @error('mm_description') parsley-error @enderror" id="meetingDescription" placeholder="Enter Meeting Description" name="mm_description" required="" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ $editmeeting->mm_description }}</textarea>
                              @error('mm_description')  
                              <small class="validate-err">{{$message}}</small>
                             @enderror
                             
                            </div> 
                        </div>
  
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="meetingNotice">Meeting Notice</label>
                              <textarea  class="form-control meetingNotice @error('ms_meeting_notice') parsley-error @enderror" id="meetingNotice" placeholder="Enter Meeting Notice" name="ms_meeting_notice" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ $editmeeting->ms_meeting_notice }}</textarea>
                              @error('ms_meeting_notice')  
                              <small class="validate-err">{{$message}}</small>
                             @enderror
                             
                            </div> 
                        </div>
  
                        {{-- <div class="col-md-4">
                          <div class="form-group">
                          
                              <label for="meetingDate">Meeting Date</label>
                              
                              <input type="text" id="meetingDate" class="form-control datepicker @error('ms_meeting_date') parsley-error @enderror" name="ms_meeting_date"  placeholder="Enter Meeting Date YYYY-MM-DD" required="" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{ $editmeeting->ms_meeting_date }}">
                                
                                 
                                
                                @error('ms_meeting_date')  
                                <small class="validate-err">{{$message}}</small>
                                @enderror
                           
                            </div> 
                        </div> --}}
  
                        {{-- <div class="col-md-4">
                          <div class="form-group">
                              <label for="meetingTime">Meeting Time</label>
                              <div class="input-group date @error('ms_meeting_time') parsley-error @enderror" id="timepicker-example" data-target-input="nearest">
                                  <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                    <input type="text" id="meetingTime" class="form-control datetimepicker-input" data-target="#timepicker-example" name="ms_meeting_time"  value="{{ $editmeeting->ms_meeting_time  }}" required="" data-parsley-trigger="change" readonly/>
                                   
                                  </div>
                                </div>
                               
                            </div> 
                            @error('ms_meeting_time')  
                            <small class="validate-err">{{$message}}</small>
                            @enderror
                        </div> --}}
  
                        {{-- <div class="col-md-4">
                          <div class="form-group">
                              <div>
                              <label for="meetingChairedBy">Meeting Chaired By</label>
                              <select class="form-control js-example-basic-multiple-limit meetingChairedBy @error('ms_chaired_by') parsley-error @enderror w-100" id="meetingChairedBy" name="ms_chaired_by" required="" multiple="multiple">
                                
                        @foreach ($user as $u)
                              <option value="{{$u->um_id}}" {{ $editmeeting->ms_chaired_by == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
                         @endforeach
                              
                              
                              </select>
                          </div>
                            
                         
                            </div> 
                            @error('ms_chaired_by')  
                            <div>
                            <small class="validate-err">{{$message}}</small>
                            </div>
                           @enderror
                        </div>  --}}

                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="mmstatus">Status</label>
                              <select class="form-control mmstatus @error('mm_status') parsley-error @enderror" id="mmstatus" name="mm_status" required="" data-parsley-trigger="change">
                                <option value="">Select Status</option>
                                <option value="A" {{ $editmeeting->mm_status == 'A' ? 'selected' : '' }}>Active</option>
                              
                                <option value="C" {{ $editmeeting->mm_status == 'C' ? 'selected' : '' }}>Completed</option>
                                {{-- <option value="CA" {{ $editmeeting->mm_status == 'CA' ? 'selected' : '' }}>Cancel</option> --}}
                                
                              </select>
                              @error('mm_status')  
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
              <h4 class="text-success text-bold">Add Meeting</h4>
            
            <form action="{{ route('meeting.store') }}" method="POST" data-parsley-validate="">
              {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              
                              <label for="meetingName">Meeting Title</label>
                              <input type="text" class="form-control meetingTitle @error('mm_title') parsley-error @enderror" id="meetingTitle" placeholder="Enter Meeting Title" name="mm_title" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('mm_title') }}">

                              @error('sm_name')  
                                <small class="validate-err">{{$message}}</small>
                              @enderror
                        
                            </div> 
                      </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="meetingDescription">Meeting Description</label>
                            <textarea  class="form-control meetingDescription @error('mm_description') parsley-error @enderror" id="meetingDescription" placeholder="Enter Meeting Description" name="mm_description" required="" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('mm_description') }}</textarea>
                            @error('mm_description')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                           
                          </div> 
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="meetingNotice">Meeting Notice</label>
                            <textarea  class="form-control meetingNotice @error('ms_meeting_notice') parsley-error @enderror" id="meetingNotice" placeholder="Enter Meeting Notice" name="ms_meeting_notice" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('ms_meeting_notice') }}</textarea>
                            @error('ms_meeting_notice')  
                            <small class="validate-err">{{$message}}</small>
                           @enderror
                           
                          </div> 
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          {{-- <div id=datepicker-popup"" class="input-group date datepicker meetingDate @error('ms_meeting_date') parsley-error @enderror"> --}}
                            <label for="meetingDate">Meeting Date</label>
                            
                            <input type="text" id="meetingDate" class="form-control datepicker @error('ms_meeting_date') parsley-error @enderror" name="ms_meeting_date"  placeholder="Enter Meeting Date YYYY-MM-DD" required="" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{old('ms_meeting_date')}}">
                                {{-- <span class="input-group-addon input-group-append border-left">
                                  <span class="mdi mdi-calendar input-group-text"></span>
                                </span> --}}
                               
                              
                              @error('ms_meeting_date')  
                              <small class="validate-err">{{$message}}</small>
                              @enderror
                            {{-- </div> --}}
                          </div> 
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                            <label for="meetingTime">Meeting Time</label>
                            <div class="input-group date @error('ms_meeting_time') parsley-error @enderror" id="timepicker-example" data-target-input="nearest">
                                <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                  <input type="text" id="meetingTime" class="form-control datetimepicker-input" data-target="#timepicker-example" name="ms_meeting_time" placeholder="Enter Meeting time"  value="{{old('ms_meeting_time')}}" required="" data-parsley-trigger="change" readonly/>
                                  {{-- <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div> --}}
                                </div>
                              </div>
                             
                          </div> 
                          @error('ms_meeting_time')  
                          <small class="validate-err">{{$message}}</small>
                          @enderror
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <div>
                            <label for="meetingChairedBy">Meeting Chaired By</label>
                            <select class="form-control js-example-basic-multiple-limit meetingChairedBy @error('ms_chaired_by') parsley-error @enderror w-100" id="meetingChairedBy" name="ms_chaired_by" required="" multiple="multiple">
                              {{-- <option value="">Choose Meeting Chaired By</option> --}}
                              
                      @foreach ($user as $u)
                            <option value="{{$u->um_id}}" {{ old('ms_chaired_by') == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
                       @endforeach
                            
                            
                            </select>
                        </div>
                          
                       
                          </div> 
                          @error('ms_chaired_by')  
                          <div>
                          <small class="validate-err">{{$message}}</small>
                          </div>
                         @enderror
                      </div> 
                   
                     
                      {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="mmstatus">Choose Status</label>
                            <select class="form-control mmstatus @error('mm_status') parsley-error @enderror" id="mmstatus" name="mm_status" required="" data-parsley-trigger="change">
                              <option value="">Choose Status</option>
                              <option value="A" {{ old('mm_status') == 'A' ? 'selected' : '' }}>Active</option>
                            
                            </select>
                            @error('mm_status')  
                            <small class="validate-err">{{$message}}</small>
                            @enderror
                        </div>
                      </div> --}}

                    
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
 