@if (isset($editagendatask))
<div class="card">

  <div class="card-body boxShadow">
    <h4 class="text-success text-bold">Update Agenda Task Detail For 
      @foreach ($editagendatask as $eagtsk)
        @if($atl->atl_am_id == $eagtsk->am_id)
            {{ ucfirst($eagtsk->am_title)}}
            @php
                break;
            @endphp
        @endif
      @endforeach</h4>

    <form action="{{ route('agendatask.update',['agendatask'=>$atl->atl_id]) }}" method="POST" id="agendaTaskForm" data-parsley-validate="">
      @method('PUT')
      {{ csrf_field() }}
      <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                
              <label for="SelectAgendaAgendaTask">Select Agenda For Task Assignment</label>
                <select class="form-control SelectAgendaAgendaTask @error('atl_am_id') parsley-error @enderror" id="SelectAgendaAgendaTask" name="atl_am_id" required="">
                    <option value="">Select Agenda</option>
                    @foreach ($editagendatask as $eagtsk)
                <option value="{{$eagtsk->am_id}}" {{ $atl->atl_am_id == $eagtsk->am_id ? 'selected' : ''}}>{{$eagtsk->am_title}}</option>
                    @endforeach
                </select>
              @error('atl_am_id')  
              <small class="validate-err">{{$message}}</small>
             @enderror
        
            </div> 
          </div>

          <div class="col-md-4">
            <div class="form-group">
                
                <label for="agendaTaskTitle">Agenda Task Title</label>
                <input type="text" class="form-control agendaTaskTitle @error('atl_title') parsley-error @enderror" id="agendaTaskTitle" placeholder="Agenda Task Title" name="atl_title" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ $atl->atl_title }}">

                @error('atl_title')  
                  <small class="validate-err">{{$message}}</small>
                @enderror
          
              </div> 
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="agendaTaskDescription">Agenda task Description</label>
                <textarea  class="form-control agendaTaskDescription @error('atl_description') parsley-error @enderror" id="agendaTaskDescription" placeholder="Agenda task Description" name="atl_description"  data-parsley-maxlength="255"  data-parsley-trigger="change" rows="5">{{ $atl->atl_description }}</textarea>
                @error('atl_description')  
                <small class="validate-err">{{$message}}</small>
               @enderror
               
              </div> 
          </div>

            <div class="col-md-3">
              <div class="form-group">
         
                  <label for="expectedCompletionDate">Task Expected Completion </label>
                  
                  <input type="text" id="expectedCompletionDate" class="form-control expectedCompletionDate @error('atl_expected_completion_date') parsley-error @enderror datepicker" name="atl_expected_completion_date"  placeholder="Task Expected Completion" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{ $atl->atl_expected_completion_date ? $atl->atl_expected_completion_date : '' }}">
                    @error('atl_expected_completion_date')  
                    <small class="validate-err">{{$message}}</small>
                    @enderror
                 
                </div> 
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="selectUser">Select User</label>
                    <select class="form-control selectUser @error('atl_um_id') parsley-error @enderror" id="selectUser" name="atl_um_id" required="" data-parsley-trigger="change">
                      <option value="">Select User</option>
                      
              @foreach ($user as $u)
                    <option value="{{$u->um_id}}" {{ $atl->atl_um_id == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
               @endforeach
                    
                    
                    </select>
                    @error('atl_um_id')  
                    <small class="validate-err">{{$message}}</small>
                   @enderror
               
                  </div> 
              </div>
              <div class="col-md-3 mb-3">
                <div class="form-group">
                  <label>Multiple File upload</label>
                
                  <div class="input-group col-xs-12 mt-1">
                  <input type="file" name="img[]" multiple>
                  </div> 
                  <small class="text text-danger text-bold">( Only .pdf file allowed, Max. Size 2.0 MB)</small>
                </div>
          
              </div>
              <div class="col-md-3 mb-3 boxShadow">
                <p class="text-danger text-bold">Browse File's Name</p>
                <div class="form-group chooseFileList">
                </div>
          
              </div>
       
     
        <div class="col-md-12 justify-content-lg-end align-items-end 
        d-flex">
        <input type="submit" class="btn btn-success mr-2" id="agendataskassign" value="Update">
       
        </div>
       
    </form>
  </div>
</div>
@else
<div class="card mb-5">

  <div class="card-body boxShadow">
    <h4 class="text-success text-bold">Add Agenda Task For {{ ucfirst($agenda[0]->am_title)}}</h4>
  
   <form action="{{ route('agendatask.store') }}" method="POST" data-parsley-validate="" id="agendaTaskForm"
   enctype="multipart/form-data"> 
    {{ csrf_field() }}
        <div class="row">

          {{-- <div class="col-md-6">
              <div class="form-group">
                  
                <label for="SelectMeeting">Select Meeting</label>
                  <select class="form-control SelectMeetingAgendaTask @error('am_mm_id') parsley-error @enderror" id="SelectMeetingAgendaTask" name="am_mm_id" required="">
                    <option value="">Select Meeting</option>
                 @foreach ($meeting as $m)
                  <option value="{{$m->mm_id }}" {{ old('am_mm_id') == $m->mm_id ? 'selected' : '' }}>{{ ucfirst($m->mm_title) }}</option>
                  @endforeach
                  </select>
                @error('am_mm_id')  
                <small class="validate-err">{{$message}}</small>
               @enderror
          
              </div> 
            </div> --}}

        </div>
        <div class="row mb-5" style="padding-top: 14px;border:3px solid#2e8a01">
            <div class="col-md-4">
                <div class="form-group">
                    
                  <label for="SelectAgendaAgendaTask">Agenda For Task Assignment</label>
                    <select class="form-control SelectAgendaAgendaTask @error('atl_am_id') parsley-error @enderror" id="SelectAgendaAgendaTask" name="atl_am_id" required="">
                       
                        @foreach ($agenda as $ag)
                    <option value="{{$ag->am_id}}">{{$ag->am_title}}</option>
                        @endforeach
                    </select>
                  @error('atl_am_id')  
                  <small class="validate-err">{{$message}}</small>
                 @enderror
            
                </div> 
              </div>
            <div class="col-md-4">
                <div class="form-group">
                    
                    <label for="agendaTaskTitle">Agenda Task Title</label>
                    <input type="text" class="form-control agendaTaskTitle @error('am_title') parsley-error @enderror" id="agendaTaskTitle" placeholder="Agenda Task Title" name="atl_title" required="" data-parsley-maxlength="255" data-parsley-trigger="change" value="{{ old('atl_title') }}">

                    @error('atl_title')  
                      <small class="validate-err">{{$message}}</small>
                    @enderror
              
                  </div> 
            </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="agendaTaskDescription">Agenda task Description</label>
                  <textarea  class="form-control agendaTaskDescription @error('atl_description') parsley-error @enderror" id="agendaTaskDescription" placeholder="Agenda task Description" name="atl_description"  data-parsley-maxlength="255"  data-parsley-trigger="change" rows="5">{{ old('atl_description') }}</textarea>
                  @error('atl_description')  
                  <small class="validate-err">{{$message}}</small>
                 @enderror
                 
                </div> 
            </div>

            <div class="col-md-3">
              <div class="form-group">
                  <label for="expectedCompletionDate">Task Expected Completion </label>
                  <input type="text" id="expectedCompletionDate" class="form-control expectedCompletionDate @error('atl_expected_completion_date') parsley-error @enderror datepicker" name="atl_expected_completion_date"  placeholder="Task Expected Completion" readonly >
                    @error('atl_expected_completion_date')  
                    <small class="validate-err">{{$message}}</small>
                    @enderror
                 
                </div> 
            </div>

            {{-- <div class="col-md-3">
              <div class="form-group">
         
                  <label for="actualCompletionDate">Task Actual Completion Date</label>
                  
                  <input type="text" id="actualCompletionDate" class="form-control actualCompletionDate datepicker @error('atl_actual_completion_date') parsley-error @enderror" name="atl_actual_completion_date"  placeholder="Task Actual Completion Date" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{old('atl_actual_completion_date')}}">
                    @error('atl_actual_completion_date')  
                    <small class="validate-err">{{$message}}</small>
                    @enderror
                 
                </div> 
            </div>  --}}
            <div class="col-md-3">
              <div class="form-group">
                  <label for="selectUser">Select User</label>
                  <select class="form-control selectUser @error(' 	atl_um_id') parsley-error @enderror" id="selectUser" name="atl_um_id" required="" data-parsley-trigger="change">
                    <option value="">Select User</option>
                    
            @foreach ($user as $u)
                  <option value="{{$u->um_id}}" {{ old('atl_um_id') == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>
             @endforeach
                  
                  
                  </select>
                  @error('atl_um_id')  
                  <small class="validate-err">{{$message}}</small>
                 @enderror
             
                </div> 
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label>Multiple File upload</label>
              
             <div class="input-group col-xs-12 mt-3">
                <input type="file" name="img[]" multiple>
                <small class="text text-danger text-bold">( Only .pdf file allowed, Max. Size 2.0 MB)</small>
              </div> 
              </div>
            </div>
            <div class="col-md-3 mb-3 boxShadow">
              <p class="text-danger text-bold">Browse File's Name</p>
              <div class="form-group chooseFileList">
              </div>
            </div>
      
        </div>
     
   
      <div class="col-md-12 justify-content-lg-end align-items-end 
      d-flex">
      <input type="submit" id="agendataskassign" class="btn btn-success mr-2" value="Submit">
     
      </div>
     
 </form>
  </div>
</div>
@endif