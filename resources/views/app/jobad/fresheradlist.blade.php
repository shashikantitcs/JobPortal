@extends('app.dashboard.dashboard')
@php
$ses_um_full_name = Session::get('user')['um_full_name'];
$ses_um_id = Session::get('user')['um_id'];
$ses_um_user_type = Session::get('user')['um_user_type'];
@endphp
<style>
  table{
    min-width: 1180px;
    overflow-x: scroll;
  }
.table td {
    white-space: unset !important;
}

  </style>
@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Fresher Job Ads</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">Meeting Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">Fresher Job Ads</p>
          </div>
        </div>
        @if ($ses_um_user_type == 'E')
        <div class="justify-content-end align-items-center d-flex">
          <a  href="{{ route('jobad.create') }}" class="btn btn-info ml-2">Add Job Ad</a>
        </div>
        @endif
      </div>
      
    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}

   <div class="row mb-5">
    {{-- <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
       <a href="{{ route('meeting.index') }}" class="btn btn-primary">Meeting List</a> 
      <a  href="{{ route('meeting.create') }}" class="btn btn-info ml-2">Add Meeting</a>
    </div> --}}
    {{-- <div class="col-md-6 justify-content-end align-items-center d-flex">
         
    </div> --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body boxShadow">
            <h4 class="card-title text-success">Fresher Job Ad List</h4>
            {{-- <p class="card-description">
              Add class <code>.table-hover</code>
            </p> --}}
            <div class="table-responsive">
              {{-- meetingList --}}
              <table class="table table-striped table-bordered table-hover" id="meetingList">
                <thead class="">
                  <tr class="bg-primary text-white">
                    <th >N.</th>
                    <th>Post</th>
                    <th>No of Post</th>
                 
                    {{-- <th >Meeting Created by</th> --}}
                    <th>Classification</th>
                    {{-- <th>Email</th> --}}
                    <th>Particulars of pay</th>
                    <th>Qualification</th>
                    <th>Eligibilty</th>
                    <th>Max Age</th>
                    <th>Last Sub Date</th>
                  </tr>
                </thead>
                <tbody>
                     @forelse ($fjobad as $m)
                    <tr >
                    <td>
                      <b>{{$loop->iteration}}</b>
                      {{-- {{ $loop->iteration }} --}}
                    </td>
                    <td ><b>{{ ucfirst($m->ja_post) }}</b></td>
                    <td> 
                        {{ ucfirst($m->ja_no_of_post) }}
                      
                    </td>
                    
                    
                      <td class="text-danger">
                        <i class="fa fa-user"></i>
                         <b>
                            {{ ucfirst($m->ja_classification)  }}
                         </b>
                        </br>
                        {{-- <i class="mdi mdi-email-open"></i>
                        <b>{{ ucfirst($m->ja_particulars_of_pay) }}</b> --}}
                      </td>

                      <td class="text-danger">
                        {{ ucfirst($m->ja_particulars_of_pay)  }}
                        {{-- @if ($m->mm_status == 'A')
                        <label class="badge badge-info">Active</label>
                        @elseif($m->mm_status == 'D')
                        <label class="badge badge-warning">Delete</label> 
                        @elseif($m->mm_status == 'D')
                        <label class="badge badge-danger">Deleted</label>
                        @elseif($m->mm_status == 'C')
                        <label class="badge badge-success">Completed</label>
                        @endif --}}
                       
                      </td>
                      <td> 
                        {{ ucfirst($m->ja_qualification)  }}
                  
                      </td>
                      <td> 
                        {{ ucfirst($m->ja_eligibilty)  }}
                  
                      </td>
                      <td> 
                        {{ ucfirst($m->ja_max_age)  }}
                  
                      </td>
                      <td> 
                        {{ date('d-M-Y',strtotime($m->ja_last_date_submission)) }}
                  
                      </td>
                      {{-- <td class="d-flex">
                        
                         <a class="btn btn-inverse-success btn-sm btn-icon" href="{{ route('agenda.index', ['meetingId'=>$m->mm_id]) }}"  title="Show" data-toggle="popover" data-trigger="hover" data-content="Meeting All Agenda">
                            <i class="mdi mdi-eye btn-icon-prepend"></i>
                          </a> 
                          <a class="btn btn-inverse-info btn-sm btn-icon ml-1" id="editSection" href="{{ route('meetingschedule.edit', ['meetingschedule'=>$m->mm_id]) }}" title="Show" data-toggle="popover" data-trigger="hover" data-content="Meeting Full Detail">
                            <i class="mdi mdi-eye btn-icon-prepend"></i>
                          </a>
                        @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA')
                         
                        
                         
                          @if ($m->mm_status == 'A' )
                          <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" href="{{ route('meeting.edit', ['meeting'=>$m->mm_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Meeting">
                            <i class="mdi mdi-grease-pencil"></i>
                          </a>
                          @endif
                         
                         @if ($m->mm_status == 'A' )
                          <form id="deleteMeetingForm" action="{{ route('meeting.destroy', ['meeting'=>$m->mm_id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteMeeting" id="deleteMeeting" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Meeting">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </form> 
                          @endif
                        @endif 
                      </td> --}}
                    
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
                  {{ $department->links() }}
                
              </div>
              
            </div> --}}
          </div>
        </div>
      </div>
   

   {{-- all user table end --}}



  </div>
</div>

@endsection
