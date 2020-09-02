<style>
    .select2-selection__rendered .select2-selection__choice{
      font-size: 17px !important;
    }
    .selectedUsers{
      padding: 2px;
      font-size: ;
      font-weight: bold;
      background: #d4d4d4;
    }
   
</style>
    
    {{-- include alert msg --}}
        @include('app.shared.alert-msg')
        {{-- include alert msg --}}
    
        {{-- create user start --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
             
              @if (isset($editagenda))
              <div class="card">
              
                <div class="card-body boxShadow">
                  <h4 class="text-success text-bold">Update Agenda Detail</h4>

                  <form action="{{ route('agenda.update',['agenda'=>$editagenda->am_id]) }}" method="POST" data-parsley-validate="">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                
                              <label for="SelectMeeting">Select Meeting</label>
                                <select class="form-control SelectMeeting @error('am_mm_id') parsley-error @enderror" id="SelectMeeting" name="am_mm_id" required="">
                                  <option value="">Select Meeting</option>
                               @foreach ($meeting as $m)
                                <option value="{{$m->mm_id }}" {{ $editagenda->am_mm_id == $m->mm_id ? 'selected' : '' }}>{{ ucfirst($m->mm_title) }}</option>
                                @endforeach
                                </select>
                              @error('am_mm_id')  
                              
                              <small class="validate-err">{{$message}}</small>
                             
                             @enderror
                             {{-- <input type="hidden" name="ms_status" value="R"> --}}
                            </div> 
                          </div>
              
                          <div class="col-md-4">
                              <div class="form-group">
                                  
                                  <label for="meetingName">Agenda Title</label>
                                  <input type="text" class="form-control meetingTitle @error('am_title') parsley-error @enderror" id="meetingTitle" placeholder="Enter Agneda Title" name="am_title" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ $editagenda->am_title }}">
              
                                  @error('am_title')  
                                    <small class="validate-err">{{$message}}</small>
                                  @enderror
                            
                                </div> 
                          </div>
              
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agendaDescription">Agenda Description</label>
                                <textarea  class="form-control agendaDescription @error('am_description') parsley-error @enderror" id="agendaDescription" placeholder="Enter Agenda Description" name="am_description"  data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ $editagenda->am_description  }}</textarea>
                                @error('am_description')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                              </div> 
                          </div>
              
                          <div class="col-md-6">
                            <div class="form-group">
                       
                                <label for="expectedCompletionDate">Expected Completion Date</label>
                                
                                <input type="text" id="expectedCompletionDate" class="form-control expectedCompletionDate datepicker @error('am_expected_completion_date') parsley-error @enderror" name="am_expected_completion_date"  placeholder="Enter Meeting Date YYYY-MM-DD" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{ $editagenda->am_expected_completion_date  }}">
                                  @error('am_expected_completion_date')  
                                  <small class="validate-err">{{$message}}</small>
                                  @enderror
                               
                              </div> 
                          </div>
              
                          {{-- <div class="col-md-6">
                            <div class="form-group">
                       
                                <label for="actualCompletionDate">Actual Completion Date</label>
                                
                                <input type="text" id="actualCompletionDate" class="form-control actualCompletionDate datepicker @error('am_actual_completion_date') parsley-error @enderror" name="am_actual_completion_date"  placeholder="Enter Actual Completion Date YYYY-MM-DD" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{ $editagenda->am_actual_completion_date  }}">
                                  @error('am_actual_completion_date')  
                                  <small class="validate-err">{{$message}}</small>
                                  @enderror
                               
                              </div> 
                          </div> --}}

                          <div class="col-md-6">
                            <div class="form-group">
                                
                              <label for="SelectMeeting">Select Status</label>
                                <select class="form-control selectAgendaStatus @error('am_status') parsley-error @enderror" id="selectAgendaStatus" name="am_status" >
                                  <option value="">Select Status</option>
                             
                            <option value="C" {{ !empty($editagenda->am_actual_completion_date) ? 'selected' : '' }}>Completed</option>
                               
                                </select>
                              @error('am_status')  
                              
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
              <div class="card mb-5">
              
                <div class="card-body boxShadow">
                  <h4 class="text-success text-bold">Add Agenda</h4>
                
                <form action="{{ route('agenda.store') }}" method="POST" data-parsley-validate="" id="agendaCreateForm">
                  {{ csrf_field() }}
                      <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                
                              <label for="SelectMeeting">Select Meeting</label>
                                <select class="form-control SelectMeeting @error('am_mm_id') parsley-error @enderror" id="SelectMeeting" name="am_mm_id" required="">
                                  {{-- <option value="" >Select Meeting</option> --}}
                                @foreach ($meeting as $m)
                                <option value="{{$m->mm_id}}" {{ old('am_mm_id') == $m->mm_id ? 'selected' : '' }}>{{ ucfirst($m->mm_title) }}</option>
                                @endforeach 
                              </select>
                                {{-- <option value="{{$meeting[0]->mm_id}}" 'selected'>{{ ucfirst($meeting[0]->mm_title) }}</option>
                                </select> --}}
                              @error('am_mm_id')  
                              
                              <small class="validate-err">{{$message}}</small>
                             
                             @enderror
                           
                            </div> 
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  
                                  <label for="meetingName">Agenda Title</label>
                                  <input type="text" class="form-control meetingTitle @error('am_title') parsley-error @enderror" id="meetingTitle" placeholder="Enter Agenda Title" name="am_title" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('am_title') }}">
    
                                  @error('am_title')  
                                    <small class="validate-err">{{$message}}</small>
                                  @enderror
                            
                                </div> 
                          </div>
    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agendaDescription">Agenda Description</label>
                                <textarea  class="form-control agendaDescription @error('am_description') parsley-error @enderror" id="agendaDescription" placeholder="Enter Agenda Description" name="am_description"  data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('am_description') }}</textarea>
                                @error('am_description')  
                                <small class="validate-err">{{$message}}</small>
                               @enderror
                               
                              </div> 
                          </div>
    
                          <div class="col-md-3">
                            <div class="form-group">
                       
                                <label for="expectedCompletionDate">Expected Completion Date</label>
                                
                                <input type="text" id="expectedCompletionDate" class="form-control expectedCompletionDate datepicker @error('am_expected_completion_date') parsley-error @enderror" name="am_expected_completion_date"  placeholder="Enter Meeting Date YYYY-MM-DD" required="" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{old('am_expected_completion_date')}}">
                                  @error('am_expected_completion_date')  
                                  <small class="validate-err">{{$message}}</small>
                                  @enderror
                               
                              </div> 
                          </div>

                          {{-- <div class="col-md-6">
                            <div class="form-group">
                       
                                <label for="actualCompletionDate">Actual Completion Date</label>
                                
                                <input type="text" id="actualCompletionDate" class="form-control actualCompletionDate datepicker @error('am_actual_completion_date') parsley-error @enderror" name="am_actual_completion_date"  placeholder="Enter Actual Completion Date YYYY-MM-DD" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{old('am_actual_completion_date')}}">
                                  @error('am_actual_completion_date')  
                                  <small class="validate-err">{{$message}}</small>
                                  @enderror
                               
                              </div> 
                          </div> --}}
                        </div>
                        {{-- <div class="row">
                         
                        </div> --}}
                          <div class="row mb-5" id="dynamic_form" style="padding-top: 14px;border:3px solid#2e8a01">
                            <div class="col-md-12 mb-5">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="col-sm-8">Name</th>
                                    <th  class="col-sm-4">Action</th>
                                   
                                  </tr>
                                </thead>
                                <tbody id="addedUsers">
                                  {{-- <tr>
                                    <td colspan="2"></td>
                                  </tr> --}}
                                  
                                </tbody>
                              </table>
                             
                            </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                <label for="selectDepartementAgenda">Select Department</label>
                                <select class="form-control agendaDepartment @error('aum_du_id') parsley-error @enderror w-100" id="selectDepartementAgenda" name="aum_du_id">
                                   <option value="">Select Department</option>
                                  {{-- {{ old('aum_du_id') == $d->dm_head_id ? 'selected' : '' }} --}}
                          @foreach ($department as $d)
                                <option value="{{$d->dm_id}}">{{ $d->dm_name." (".$d->dm_short_name.")" }}</option>
                           @endforeach
                                
                                
                                </select>
                            </div>
                              </div> 
                              @error('aum_du_id')  
                              <div>
                              <small class="validate-err">{{$message}}</small>
                              </div>
                             @enderror
                          </div> 

                          <div class="col-md-4">
                            <div class="form-group">
                                
                                <label for="agendaSection">Select Section</label>
                                <select class="form-control agendaSection @error('aum_su_id') parsley-error @enderror w-100" id="agendaSection" name="aum_su_id[]" >
                                  <option value="">Select Section For User</option>
                          {{-- @foreach ($section as $s)
                                <option value="{{$s->sm_head_id}}" {{ old('aum_su_id') == $s->sm_head_id ? 'selected' : '' }}>{{ $s->sm_name." (".$s->sm_short_name.")" }}</option>
                           @endforeach --}}
                                
                                
                                </select>
                            
                              </div> 
                              @error('aum_su_id')  
                              <div>
                              <small class="validate-err">{{$message}}</small>
                              </div>
                             @enderror
                          </div> 

                          <div class="col-md-4">
                            <div class="form-group addAgendaSelectUser">
                              
                                <label for="agendaUsers">Select User</label>
                                <select class="form-control agendaUsers @error('aum_uu_id') parsley-error @enderror w-100" id="agendaUsers" name="aum_uu_id[]" required="" multiple="multiple">
                                <option value="">Select User</option> 
                          
                          @foreach ($user as $u)
                                <option value="{{$u->um_id}}" {{ old('aum_uu_id') == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
                           @endforeach
                                
                                
                                </select>
                            
                              </div> 
                              @error('aum_uu_id')  
                              <div>
                              <small class="validate-err">{{$message}}</small>
                              </div>
                             @enderror
                          </div> 
                          <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm" id="addUserplus5" title="Add More Task Title" data-toggle="popover" data-trigger="hover" data-content="Add More Agenda Task" data-original-title="Add Agenda Task with selected meeting">
                                <i class="mdi mdi-calendar-plus"></i>
                                Add User
                              </a>
                            {{-- <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-icon ml-2" id="minus5" title="Remove Task" data-toggle="popover" data-trigger="hover" data-content="Add More Agenda Task" data-original-title="Remove this row task ">
                                <i class="mdi mdi-delete"></i>
                            </a>   --}}
                          </div>
                          <input type="hidden" name="userId" id="userId">
                        </div>
                      
                   
                 
                    <div class="col-md-12 justify-content-lg-end align-items-end 
                    d-flex">
                    <input type="submit" id="agendacreate" class="btn btn-success mr-2" value="Submit">
                   
                    </div>
                   
                </form>
                </div>
              </div>
              @endif
    
                
            </div>
        </div>   
       {{-- create user end --}}
     