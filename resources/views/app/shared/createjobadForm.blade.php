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
             
              @if (isset($editjobad))
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
                  <h4 class="text-success text-bold">Add Job Ad</h4>
                
                <form id="postjobad" action="{{ route('jobad.store') }}" method="POST" data-parsley-validate="">
                  {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                
                              <label for="ja_type">Select Job Type</label>
                                <select class="form-control ja_type @error('ja_type') parsley-error @enderror" id="ja_type" name="ja_type"  data-parsley-required="true">
                                  <option value="">Select Job Type</option>
                              
                                <option value="F" {{ old('ja_type') == 'F' ? 'selected' : '' }}>Fresher job post</option>
                                <option value="D" {{ old('ja_type') == 'D' ? 'selected' : '' }}>Deputation job post</option>

                                </select>
                              @error('ja_type')  
                              
                              <small class="validate-err">{{$message}}</small>
                             
                             @enderror
                             {{-- <input type="hidden" name="ms_status" value="R"> --}}
                            </div> 
                          </div>
                        </div>
                        <div class="row" id="jobadfrom" style="display:none;">  
                          <div class="col-md-3">
                              <div class="form-group">
                                  
                                  <label for="ja_post">Post</label>
                                  <input type="text" class="form-control ja_post commmanField @error('ja_post') parsley-error @enderror" id="ja_post" placeholder="Enter Post" name="ja_post"  data-parsley-required="true" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('ja_post') }}">
    
                                  @error('ja_post')  
                                    <small class="validate-err">{{$message}}</small>
                                  @enderror
                            
                                </div> 
                          </div>
    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ja_no_of_post">No. of Post</label>
                                <input type="text" class="form-control ja_no_of_post commmanField @error('ja_no_of_post') parsley-error @enderror" id="ja_no_of_post" placeholder="Enter Post" name="ja_no_of_post"  data-parsley-required="true" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('ja_no_of_post') }}">
                                @error('ja_no_of_post')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                              </div> 
                          </div>

                          <div class="col-md-3 fresherJobAd">
                            <div class="form-group">
                                <label for="ja_classification">Classification</label>
                              <textarea  class="form-control ja_classification fresherJobAdField @error('ja_classification') parsley-error @enderror" id="ja_classification" placeholder="Enter Meeting Description" name="ja_classification"  data-parsley-required="false" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('ja_classification') }}</textarea> 
                                @error('ja_classification')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                              </div> 
                          </div>

                          <div class="col-md-3 fresherJobAd">
                            <div class="form-group">
                                <label for="ja_particulars_of_pay">Particulars of pay</label>
                              <textarea  class="form-control ja_particulars_of_pay fresherJobAdField @error('ja_particulars_of_pay') parsley-error @enderror" id="ja_particulars_of_pay" placeholder="Enter Meeting Description" name="ja_particulars_of_pay" data-parsley-required="false" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('ja_particulars_of_pay') }}</textarea> 
                                @error('ja_particulars_of_pay')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                              </div> 
                          </div>
    
                          <div class="col-md-3 fresherJobAd">
                            <div class="form-group">
                                <label for="ja_qualification">Qualification</label>
                                <textarea  class="form-control ja_qualification fresherJobAdField @error('ja_qualification') parsley-error @enderror" id="ja_qualification" placeholder="Enter Qualification" name="ja_qualification" 
                                data-parsley-required="false" data-parsley-maxlength="255"data-parsley-trigger="change" rows="4">{{ old('ja_qualification') }}</textarea>
                                @error('ja_qualification')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                              </div> 
                          </div>

                          <div class="col-md-3 fresherJobAd">
                            <div class="form-group">
                                <label for="ja_eligibilty">Eligibilty </label>
                                <textarea  class="form-control ja_eligibilty fresherJobAdField @error('ja_eligibilty') parsley-error @enderror" id="ja_eligibilty" placeholder="Enter Eligibilty" name="ja_eligibilty" data-parsley-required="false" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('ja_eligibilty') }}</textarea>
                                @error('ja_eligibilty')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                              </div> 
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="ja_eligibilty">Max Age </label>
                                <input type="text" class="form-control ja_max_age commmanField @error('ja_max_age') parsley-error @enderror" id="ja_max_age" placeholder="Enter Post" name="ja_max_age" data-parsley-required="false" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('ja_max_age') }}">
                                @error('ja_max_age')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                               
                              </div> 
                          </div>

                          <div class="col-md-3 deputationJobAd">
                            <div class="form-group">
                                <label for="ja_eligibilty">Pay Scale</label>
                                <input type="text" class="form-control ja_pay_scale deputationJobAdField @error('ja_pay_scale') parsley-error @enderror" id="ja_pay_scale" placeholder="Enter Post" name="ja_pay_scale" data-parsley-type="number" data-parsley-required="false" data-parsley-trigger="change" value="{{ old('ja_pay_scale') }}">
                                @error('ja_pay_scale')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                               
                              </div> 
                          </div>
    
                          <div class="col-md-3">
                            <div class="form-group">
                              {{-- <div id=datepicker-popup"" class="input-group date datepicker meetingDate @error('ms_meeting_date') parsley-error @enderror"> --}}
                                <label for="ja_last_date_submission">Last date of Application Submission</label>
                                
                                <input type="text" id="ja_last_date_submission" class="form-control datepicker commmanField @error('ja_last_date_submission') parsley-error @enderror" name="ja_last_date_submission"  placeholder="Enter Meeting Date YYYY-MM-DD" data-parsley-required="true" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{old('ja_last_date_submission')}}">
                                    {{-- <span class="input-group-addon input-group-append border-left">
                                      <span class="mdi mdi-calendar input-group-text"></span>
                                    </span> --}}
                                   
                                  
                                  @error('ja_last_date_submission')  
                                  <small class="validate-err">{{$message}}</small>
                                  @enderror
                                {{-- </div> --}}
                              </div> 
                          </div>
    
                          {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="meetingTime">Meeting Time</label>
                                <div class="input-group date @error('ms_meeting_time') parsley-error @enderror" id="timepicker-example" data-target-input="nearest">
                                    <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                      <input type="text" id="meetingTime" class="form-control datetimepicker-input" data-target="#timepicker-example" name="ms_meeting_time" placeholder="Enter Meeting time"  value="{{old('ms_meeting_time')}}" required="" data-parsley-trigger="change" readonly/>
                                      <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
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
                                  <option value="">Choose Meeting Chaired By</option>
                                  
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
                          </div>  --}}
                       
                         
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
     