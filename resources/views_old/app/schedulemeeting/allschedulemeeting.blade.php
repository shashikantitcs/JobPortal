@extends('app.dashboard.dashboard')
<style>
  table{
    /* min-width: 1300px; */
    overflow-x: scroll;
  }
.table td {
    white-space: unset !important;
}
.select2-selection__rendered .select2-selection__choice{
    font-size: 17px !important;
  }
  .select2-container {
    width: 100% !important;
  }
  </style>
@php
$ses_um_full_name = Session::get('user')['um_full_name'];
$ses_um_id = Session::get('user')['um_id'];
$ses_um_user_type = Session::get('user')['um_user_type'];
@endphp


@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        @isset($msl)
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">All Schedule Meeting List</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">Section Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">All Schedule Meeting List</p>
          </div>
        </div>
        @endisset

        @isset($umsl)
        <div class="d-flex align-items-center">
          <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
           <h4 class="mb-0 font-weight-bold">Meeting Detail</h4>
           {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">Section Master View</button> --}}
           <div class="d-none d-md-flex ml-3">
             <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
             <i class="mdi mdi-chevron-right text-muted"></i>
             <p class="text-muted mb-0 tx-13 cursor-pointer">Meeting Detail</p>
           </div>
         </div>
        @endisset
      </div>

    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}
@isset($msl)

   <div class="row">
    <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
      {{-- <a href="{{ route('meetingschedule.index') }}" class="btn btn-primary">Schedule Meeting List</a> --}}
      {{-- <a  href="{{ route('section.create') }}" class="btn btn-info ml-2">Add Section</a> --}}
    </div>
    {{-- <div class="col-md-6 justify-content-end align-items-center d-flex">

    </div> --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body boxShadow">
            <h4 class="card-title text-success">Schedule Meeting List</h4>
            {{-- <p class="card-description">
              Add class <code>.table-hover</code>
            </p> --}}
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Meeting Title</th>
                    <th>Meeting Date</th>
                    {{-- <th>Department</th> --}}
                    <th>Meeting Time</th>
                    <th>Chaired By</th>
                    <th>MS. Status</th>

                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                    @forelse ($msl as $m)
                    <tr>
                    <td>
                      <b>{{$loop->iteration }}</b>
                      {{-- {{ $loop->iteration }} --}}
                    </td>
                    <td><b>{{ ucfirst($m->mm_title) }}</b></td>
                    <td>
                        {{ date('d-M-Y',strtotime($m->ms_meeting_date)) }}
                        {{-- 28.76% <i class="mdi mdi-arrow-down"></i> --}}
                    </td>

                      <td > {{ $m->ms_meeting_time }}</td>
                      <td class="text-danger"><b>{{ ucfirst($m->um_first_name.' '.$m->um_last_name)  }}</b></td>
                      {{-- <td class="text-danger">
                        <i class="mdi mdi-email-open"></i>
                        <b>{{ ucfirst($s->um_email) }}</b>
                      </td> --}}
                      <td >
                        @if ($m->ms_status == 'O' )
                        <label class="badge badge-info">Open</label>
                        @elseif($m->ms_status == 'P')
                        <label class="badge badge-warning">Postpone</label>
                        @elseif($m->ms_status == 'C')
                        <label class="badge badge-success">Concluded</label>
                        @elseif($m->ms_status == 'CA')
                        <label class="badge badge-danger">Cancel</label>
                        @endif

                      </td>
                      <td class="d-flex">

                          <button class="btn btn-inverse-success btn-sm btn-icon" onclick="showSwal('warning-message-and-cancel')" title="Show" data-toggle="popover" data-trigger="hover" data-content="Show Meeting Schedule Detail">
                              <i class="mdi mdi-eye" ></i>
                          </button>

                          @if ($m->ms_status == 'O' || $m->ms_status == 'R'  )
                          <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="editSection" href="{{ route('meetingschedule.edit', ['meetingschedule'=>$m->mm_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Meeting Schedule Detail">
                              <i class="mdi mdi-grease-pencil"></i>
                          </a>
                          @endif



{{--
                        <form id="deleteSectionForm" action="{{ route('section.destroy', ['section'=>$s->sm_id]) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteSection" id="deleteSection" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Section">
                            <i class="mdi mdi-delete"></i>
                          </button>
                        </form> --}}


                      </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-danger">
                                <b>No Result Found<b>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
            {{-- <div class="row mt-4">
              <div class="col-md-12 justify-content-end d-flex">
                  {{ $section->links() }}

              </div>

          </div> --}}
          </div>
        </div>
      </div>
    </div>

    @endisset
   {{-- all user table end --}}



   {{-- all user table start --}}
@isset($umsl)

<div class="row">
 <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
   {{-- <a href="{{ route('meetingschedule.index') }}" class="btn btn-primary">Schedule Meeting List</a> --}}
   {{-- <a  href="{{ route('section.create') }}" class="btn btn-info ml-2">Add Section</a> --}}
 </div>

 <div class="col-lg-12 grid-margin stretch-card mb-5">
  <div class="card">
    <div class="card-body boxShadow">
      <h4 class="card-title text-success">Meeting Detail</h4>
      <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
          <thead>
            <tr class="">

              <th>Meeting Title</th>
              <th>Meeting Description</th>
              {{-- <th>Department</th> --}}
              <th>Meeting Created By</th>
              <th>Created At</th>
              <th>Meeting Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                {{$umsl[0]->mm_title}}
              </td>
              <td>
                {{$umsl[0]->mm_description}}
              </td>
              <td class="text-danger">
                @foreach ($user as $u)
                    @if ($u->um_id == $umsl[0]->ms_created_by)
                      <b>
                        {{ ucfirst($u->um_first_name.' '.$u->um_last_name)  }}
                      </b></br>
                      <i class="mdi mdi-email-open"></i>{{ ucfirst($u->um_email)  }}
                      @break
                    @endif
                @endforeach
              </td>
              <td>
                {{ date('d-M-Y',strtotime($umsl[0]->mm_created_at)) }}
              </td>
              <td>
                @if ($umsl[0]->mm_status == 'A')
                <label class="badge badge-info">Active</label>
                @elseif($umsl[0]->mm_status == 'D')
                <label class="badge badge-danger">Deleted</label>
                @elseif($umsl[0]->mm_status == 'C')
                <label class="badge badge-success">Completed</label>
                @endif
              </td>
              <td style="width: 120px !important;">
                @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA')
                @if ($umsl[0]->mm_status == 'A' )
                <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" href="{{ route('meeting.edit', ['meeting'=>$umsl[0]->mm_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Meeting">
                  <i class="mdi mdi-grease-pencil"></i>
                </a>
                @endif

               @if ($umsl[0]->mm_status == 'A' )
                <form id="deleteMeetingForm" class="float-left" action="{{ route('meeting.destroy', ['meeting'=>$umsl[0]->mm_id]) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteMeeting" id="deleteMeeting" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Meeting">
                    <i class="mdi mdi-delete"></i>
                  </button>
                </form>
                @endif
              @endif
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
 <div class="col-lg-12 grid-margin stretch-card mb-5">
     <div class="card">
       <div class="card-body boxShadow">
         <h4 class="card-title text-success">Meeting Schedule Detail</h4>
         {{-- <p class="card-description">
           Add class <code>.table-hover</code>
         </p> --}}
         <div class="table-responsive">
           <table class="table table-hover table-striped table-bordered">
             <thead>
               <tr>
                 <th>Sr No.</th>
                 <th>Meeting Notice</th>
                 <th>Meeting Date</th>
                 <th>Meeting Time</th>
                 <th>Chaired By</th>
                 <th>Created at</th>
                 <th>Status</th>
                 <th>Action</th>

               </tr>
             </thead>
             <tbody>
                 @forelse ($umsl as $m)
                 <tr>
                 <td>
                   <b>{{ $loop->iteration  }}</b>
                 </td>
                 <td><b>{{ ucfirst($m->ms_meeting_notice) }}</b></td>
                 <td>
                  <b>{{ date('d-M-Y',strtotime($m->ms_meeting_date)) }}</b>
                 </td>

                   <td > {{ $m->ms_meeting_time }}</td>
                   <td class="text-danger">
                     <b>
                      {{ ucfirst($m->um_first_name.' '.$m->um_last_name)  }}
                     </b>
                     <!-- <i class="mdi mdi-email-open"></i>{{ ucfirst($m->um_email)  }} -->
                  </td>
                  <td>
                   {{ date('d-M-Y',strtotime($m->ms_created_at)) }}
                  </td>
                   <td>
                     @if ($m->ms_status == 'O' )
                     <label class="badge badge-info">Open</label>
                     @elseif($m->ms_status == 'P')
                     <label class="badge badge-warning">Scheduled</label>
                     @elseif($m->ms_status == 'C')
                     <label class="badge badge-success">Concluded</label>
                     @elseif($m->ms_status == 'CA')
                     <label class="badge badge-danger">Cancel</label>
                     @endif
                   </td>
                   <td  style="width: 150px !important;">
                    @if ($loop->last)
                    {{-- <button class="btn btn-inverse-success btn-sm btn-icon" onclick="showSwal('warning-message-and-cancel')" title="Close" data-toggle="popover" data-trigger="hover" data-content="Close Meeting">
                      <i class="mdi mdi-eye" ></i>
                  </button> --}}
                  @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA' )
                  @if ($m->mm_status == 'A')

                  @if ($m->ms_status !='CA' && $m->ms_status !='C')
                  <form id="updateScheduleMeetingAction" class="float-left" action="{{ route('meetingschedule.update', ['meetingschedule'=>$m->ms_id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="ms_status" value="C">
                    {{-- <input type="hidden" name="ms_status" --}}
                    <button type="button" class="btn btn-success btn-sm btn-icon scheduledMeetingClosed  ml-1" id="scheduledMeetingClosed" title="Concluded" data-toggle="popover" data-trigger="hover" data-content="Concluded Scheduled Meeting">
                      <i class="mdi mdi-check"></i>
                    </button>
                  </form>
                  @endif
                  {{-- <button class="btn btn-outline-primary">View</button> --}}
                  {{-- <form id="updateScheduleMeetingAction" action="{{ route('meetingschedule.update', ['meetingschedule'=>$m->ms_id]) }}" method="post">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="ms_status" value="C"> --}}

                    <button type="button" class="btn btn-warning btn-sm btn-icon ml-1 reScheduleMeeting" id="reScheduleMeeting" title="Shedule" data-toggle="popover" data-trigger="hover" data-content="Shedule Meeting">
                      <i class="mdi mdi-refresh"></i>
                    </button>

                    @if ($m->ms_status !='CA' &&  $m->ms_status !='C')
                    <form id="updateScheduleMeetingActionCancel" class="float-left" action="{{ route('meetingschedule.update', ['meetingschedule'=>$m->ms_id]) }}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="ms_status" value="CA">
                      {{-- <input type="hidden" name="ms_status" --}}
                      <button type="button" class="btn btn-danger btn-sm btn-icon scheduledMeetingClosed  ml-1" id="scheduledMeetingClosed" title="Cancel" data-toggle="popover" data-trigger="hover" data-content="Cancel Scheduled Meeting">
                        <i class="mdi mdi-calendar-remove"></i>
                      </button>
                    </form>
                    @endif
                  {{-- </form> --}}
{{--
                  <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="editSection" href="{{ route('meetingschedule.edit', ['meetingschedule'=>$m->ms_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Meeting Schedule Detail">
                      <i class="mdi mdi-grease-pencil"></i>
                  </a>      --}}
                    @endif
                    @endif
                    @endif
{{--
                     <form id="deleteSectionForm" class="float-left" action="{{ route('section.destroy', ['section'=>$s->sm_id]) }}" method="post">
                       @csrf
                       @method('DELETE')
                       <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteSection" id="deleteSection" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Section">
                         <i class="mdi mdi-delete"></i>
                       </button>
                     </form> --}}


                   </td>
                 </tr>
                 @empty
                     <tr>
                         <td colspan="9" class="text-center text-danger">
                             <b>No Result Found<b>
                         </td>
                     </tr>
                 @endforelse
             </tbody>
           </table>
         </div>
         {{-- <div class="row mt-4">
           <div class="col-md-12 justify-content-end d-flex">
               {{ $section->links() }}

           </div>

       </div> --}}
       </div>
     </div>
   </div>

   <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
     {{-- <a href="{{ route('agenda.create',['meetingId'=>$umsl[0]->mm_id]) }}" class="btn btn-primary">Add Agenda</a> --}}
     @if ($umsl[0]->mm_um_id == $ses_um_id || $ses_um_user_type == 'A')
     @if ($umsl[0]->mm_status == 'A')
     <a href="{{ route('agenda.addagenda',['meetingId'=>$umsl[0]->mm_id]) }}" class="btn btn-primary">Add Agenda</a>
     @endif
     @endif
   </div>
   <div class="col-lg-12 grid-margin stretch-card mb-5">
    <div class="card">
      <div class="card-body boxShadow">
        <h4 class="card-title text-success">Agenda List</h4>

        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered" >
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>Title</th>
                {{-- <th>Owner agenda</th> --}}
                <th>Exp. Completing Date</th>
                <th>Act. Completing Date</th>
                <th>Created At</th>
             
                <th>Manage User</th>
              
                <th>Status</th>
                <th>Task View</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($agenda as $a)
              <tr>
              <td>
                <b>{{ $loop->index+1 }}</b>
              </td>
              {{-- <td><b>{{ ucfirst($a->mm_title) }}</b></td> --}}
              <td><b>{{ ucfirst($a->am_title) }}</b></td>
              {{-- <td class="text-danger">
                @foreach ($user as $ua)
                @if ($ua->um_id == $agenda[0]->am_um_id)
                  <b>
                    {{ ucfirst($ua->um_first_name.' '.$ua->um_last_name)  }}
                  </b></br>
                  <i class="mdi mdi-email-open"></i>{{ ucfirst($ua->um_email)  }}
                  @break
                @endif
                @endforeach
            </td> --}}
              <td>
                @if ($a->am_expected_completion_date)
                <b>{{ date('d-M-Y',strtotime($a->am_expected_completion_date)) }}</b>
                @else
                  {{ 'NA' }}
                @endif
              </td>
              <td>
                @if ($a->am_actual_completion_date)
                <b>{{ date('d-M-Y',strtotime($a->am_actual_completion_date)) }}</b>
                @else
                  {{ 'NA' }}
                @endif
              </td>
            <td class="text-danger">
              {{ date('d-M-Y',strtotime($a->am_created_at)) }}
            </td>
            <td>
              {{-- @if ($umsl[0]->mm_um_id == $ses_um_id || $ses_um_user_type == 'A') --}}
            <button type="button" class="btn btn-inverse-warning btn-sm btn-icon ml-1 manageAgendaUser" id="manageAgendaUser" title="Manage User" data-toggle="popover" data-trigger="hover" data-content="Manage Agenda User" agendaId="<?php echo $a->am_id; ?>" url="{{ route('agenda.getAgendaU') }}">
                <i class="mdi mdi-account-convert"></i>
              </button>
              {{-- @endif --}}
            </td>
            <td class="text-danger">
              @php
                 $today = strtotime(date('Y-m-d'))."<br>";
                //  echo $a->am_expected_completion_date;
                $excpected_date =strtotime(date('Y-m-d',strtotime($a->am_expected_completion_date)) );
                // dd();
              @endphp
              @if ($a->is_deleted == 1)
              <label class="badge badge-warning">Deleted</label>
              @else
                @if (!empty($a->am_actual_completion_date))
                <label class="badge badge-success">Completed</label>
                @elseif(empty($a->am_actual_completion_date) && ($today > $excpected_date))
                <label class="badge badge-danger">Overdue</label>
                @elseif(empty($a->am_actual_completion_date) && ($today <= $excpected_date))
                <label class="badge badge-info">In Progress</label>
                @endif
              @endif
            </td>
            <td>
              <a href ="#allAgendaTaskDetail" class="btn btn-inverse-success btn-sm btn-icon getAgendaTask" amId="{{$a->am_id}}"  title="Show" data-toggle="popover" data-trigger="hover" data-content="Show Agenda All Task" aturl="{{ route('agendatask.getAgendatask') }}" agBtnSHow="@if($ses_um_user_type == 'U') @if (in_array($ses_um_id,$agendaUsers[$a->am_id])){{'true'}} @else {{'false'}} @endif @else {{'true'}} @endif">
                <i class="mdi mdi-eye btn-icon-prepend"></i>
              </a>
            </td>
            <td class="d-flex" style="min-height: 59px;">

                    {{-- <a class="btn btn-inverse-success btn-sm btn-icon" href="{{ route('agendatask.index', ['amId'=>$a->am_id]) }}"  title="Show" data-toggle="popover" data-trigger="hover" data-content="Show Agenda All Task" >
                      <i class="mdi mdi-eye btn-icon-prepend"></i>
                    </a> --}}

                    @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA' )

                    @if ($umsl[0]->mm_status == 'A' && empty($a->am_actual_completion_date))
                    {{-- @if ($a->mm_status == 'A' ) --}}
                    <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="editAgenda" href="{{ route('agenda.edit', ['agenda'=>$a->am_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Agenda Title">
                      <i class="mdi mdi-grease-pencil"></i>
                    </a>


                  @if ($a->is_deleted == 0 )
                  <form id="deleteAgendaForm" action="{{ route('agenda.destroy', ['agenda'=>$a->am_id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteagneda" id="deleteagneda" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Agenda">
                      <i class="mdi mdi-delete"></i>
                    </button>

                  </form>
                  @endif

                  @endif

                  @endif
              </td>


              </tr>

              @empty
              <tr>
                <td colspan="9" class="text-center text-danger">
                    <b>No Result Found<b>
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-12 grid-margin stretch-card mb-5" id="allAgendaTaskDetail" style="display: none;">

    <div class="card" style="border:none;">
      <div class="col justify-content-end align-items-center d-flex mb-2">
       @if ($umsl[0]->mm_um_id == $ses_um_id || $ses_um_user_type == 'A')
          @if ($umsl[0]->mm_status == 'A')
          <a href="javascript:void(0)" url="{{ route('agendatask.create',['meetingId'=>$umsl[0]->mm_id]) }}" class="btn btn-primary" id="addAgendaTask" amId="">Add Agenda Task</a>
          @endif
      @else  
         @foreach ($agenda as $a)
            {{-- @if ($ses_um_id == $a->aum_um_id) --}}
            @if ($umsl[0]->mm_status == 'A')
            <a href="javascript:void(0)" url="{{ route('agendatask.create',['meetingId'=>$umsl[0]->mm_id]) }}" class="btn btn-primary" id="addAgendaTask" amId="">Add Agenda Task</a>
            {{-- @endif --}}
            @php
             break;   
            @endphp
            @endif
             
         @endforeach
      @endif 
      </div>
      <div class="card-body boxShadow" >

      </div>
    </div>
  </div>

 </div>

 @endisset
{{-- all user table end --}}
  </div>

@endsection



@isset($umsl)
<div class="modal fade bd-example-modal-lg" id="reScheduleMeetingForm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success text-bold" id="exampleModalLabel">Re-Schedule Meeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">

          <div class="card-body boxShadow">
            {{-- <h4 class="text-success text-bold">Add Meeting</h4> --}}

          <form action="{{ route('meetingschedule.update', ['meetingschedule'=>$umsl[count($umsl)-1]->ms_id ]) }}" method="POST" data-parsley-validate="">
            @csrf
            @method('PUT')
                <div class="row">


                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="meetingNotice">Meeting Notice</label>
                          <textarea  class="form-control meetingNotice @error('ms_meeting_notice') parsley-error @enderror" id="meetingNotice" placeholder="Enter Meeting Notice" name="ms_meeting_notice" data-parsley-maxlength="255"  data-parsley-trigger="change" rows="4">{{ old('ms_meeting_notice') }}</textarea>
                          @error('ms_meeting_notice')
                          <small class="validate-err">{{$message}}</small>
                         @enderror

                        </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">

                          <label for="meetingDate">Meeting Date</label>

                          <input type="text" id="meetingDate" class="form-control datepicker @error('ms_meeting_date') parsley-error @enderror" name="ms_meeting_date"  placeholder="Enter Meeting Date YYYY-MM-DD" required="" data-date-format="YYYY-MM-DD" data-parsley-trigger="change" readonly value="{{old('ms_meeting_date')}}">



                            @error('ms_meeting_date')
                            <small class="validate-err">{{$message}}</small>
                            @enderror

                        </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="meetingTime">Meeting Time</label>
                          <div class="input-group date @error('ms_meeting_time') parsley-error @enderror" id="timepicker-example" data-target-input="nearest">
                              <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                <input type="text" id="meetingTime" class="form-control datetimepicker-input" data-target="#timepicker-example" name="ms_meeting_time" placeholder="Enter Meeting time"  value="{{old('ms_meeting_time')}}" required="" data-parsley-trigger="change" readonly/>

                              </div>
                            </div>

                        </div>
                        @error('ms_meeting_time')
                        <small class="validate-err">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">

                        <label for="meetingChairedBy">Meeting Chaired By</label>
                          <select class="form-control meetingChairedBy @error('ms_chaired_by') parsley-error @enderror" id="meetingChairedBy" name="ms_chaired_by" required="">
                            <option value="">Select Meeting Chaired By</option>
                         @foreach ($user as $u)
                            @if ($u->um_user_type == 'U')

                          <option value="{{$u->um_id}}" {{ old('ms_chaired_by') == $u->um_id ? 'selected' : '' }}>{{ $u->um_first_name." ".$u->um_last_name." (".$u->um_designation.")" }}</option>

                            @endif
                          @endforeach
                          </select>
                        @error('ms_chaired_by')

                        <small class="validate-err">{{$message}}</small>

                       @enderror
                       <input type="hidden" name="ms_status" value="P">
                      </div>
                    </div>


              <div class="col-md-12 justify-content-lg-end align-items-end
              d-flex">
              <button type="submit" class="btn btn-success mr-2">Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
                </div>

          </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endisset
{{-- for manage user --}}
<div class="modal fade" id="manageAgendaUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" Url="{{route('agenda.getAgendaU')}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success text-bold" id="exampleModalLabel">Manage Agenda Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="card">

          <div class="card-body boxShadow">
            <div class="row">
            <div class="col-md-12">

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Department</th>
                  <th scope="col">Section</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="agendaUserList">

              </tbody>
            </table>
          </div>
        </div>
        <form method="POST" id="manageAgendaUserForm" agendaId=''>
            <div class="row mt-5">
              @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA' )
              <div class="col-md-6">
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

              <div class="col-md-6">
                <div class="form-group">

                    <label for="agendaSection">Select Section</label>
                    <select class="form-control agendaSection @error('aum_su_id') parsley-error @enderror w-100" id="agendaSection" name="aum_su_id[]" >
                      <option value="">Select Section For User</option>

                    </select>

                  </div>
                  @error('aum_su_id')
                  <div>
                  <small class="validate-err">{{$message}}</small>
                  </div>
                 @enderror
              </div>
              <div class="col-md-12">

                <div class="form-group">
                    <label for="agendaUsers">Add User with this Agenda</label>
                    <select class="form-control agendaUsers @error('aum_uu_id') parsley-error @enderror w-100" id="agendaUsers" name="aum_uu_id[]" required="" multiple="multiple">

              @foreach ($user as $ur)

                @if ($ur->um_user_type == 'U') --}}
                    <option value="{{$ur->um_id}}" {{$ur->um_user_type}}>{{ $ur->um_first_name." ".$ur->um_last_name." (".$ur->um_designation.")" }}</option>
                 @endif
               @endforeach
                    </select>

                  </div>
                  @error('aum_uu_id')
                  <div>
                  <small class="validate-err">{{$message}}</small>
                  </div>
                 @enderror
              </div>
              <div class="col-md-12 text-center">
                <button type="button" class="btn btn-success btn-block btn-icon-text">
                  <i class="mdi mdi-file-check btn-icon-prepend"></i>
                  Add User
                </button>
              </div>
              @endif
            </div>
          </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
{{-- for manage user --}}


<div class="modal fade" id="addagendaTaskForm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title text-success text-bold" id="exampleModalLabel"></h5> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      </div>

    </div>
  </div>
</div>
