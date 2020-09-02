@extends('app.dashboard.dashboard')
@php
     $user_type = Session::get('user')['um_user_type'];
@endphp
<style type="text/css">#circle {
  width: 70px;
  height:70px;
  -webkit-border-radius: 35px;
  -moz-border-radius: 35px;
  border-radius: 35px;
  background: white;


}
.fc-popover{
  top: 25% !important;
  left: 40%  !important;
}
.fc-content{
  white-space: inherit !important;
}
img.center {
display: block;
margin: 0 auto;
}

.table td{
  white-space: unset !important;
  /* white-space: break-spaces !important; */
}</style>
@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Dashboard</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">User Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Dashboard</p>
            {{-- <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">User List</p> --}}
          </div>
        </div>

      </div>

    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}



    {{-- <div class="row grid-margin boxShadow">
      <div class="col-12">
        <div class="card">
          <div class="row">
            <div class="col-lg-4 grid-margin grid-margin-lg-0">
              <div class="card-body">
              <img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/pending.png') }}" class="img-lg rounded" alt="profile image">
             <span>13099  Minutes</span>


              </div>
            </div>
            <div class="col-lg-4 grid-margin grid-margin-lg-0">
              <div class="card-body">
                  <img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/meeting.png') }}" class="img-lg rounded" alt="profile image">
               567  Agenda


              </div>
            </div>
            <div class="col-lg-4">
              <div class="card-body">
                <img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/user.png') }}" class="img-lg rounded" alt="profile image">
               567  Participant
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

   @if ( $user_type== 'A' ||  $user_type == 'MA')

    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #00c0ef;font-weight: bold;">
                <div class="card-body">
                    <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                        <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="assets/images/meeting.png" class="img-lg rounded" alt="profile image">
                  </div>
                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                            <h6 class="mb-0" style="color:#fff;">Total Meeting</h6>

                        <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{  $meeting['A'] + $meeting['C'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
              <div class="card" style="background-color: #00bf86;font-weight: bold;">
                <div class="card-body">
                    <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                      <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/day.png') }}" class="img-lg rounded" alt="profile image">
                  </div>
                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                             <h6 class="mb-0" style="color:#fff; ">Completed</h6>
                           <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{ $meeting['C'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
              <div class="card" style="background-color: #ffa000;font-weight: bold;">
                <div class="card-body">
                    <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                      <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/chart.png') }}" class="img-lg rounded" alt="profile image">
                  </div>
                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                            <h6 class="mb-0" style="color:#fff; ">Progress</h6>
                            <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{ $meeting['A'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #0fb0c0;font-weight: bold;">
                <div class="card-body">
                    <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                     <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/men.png') }}" class="img-lg rounded" alt="profile image">
                  </div>
                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                            <h6 class="mb-0" style="color:#fff;">Total User created</h6>

                            <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{ $ucount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 @endif

    <div class="row">
      <div class="col-md-3 grid-margin stretch-card">
          <div class="card" style="background-color: #f10075;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                  <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/business.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                          <h6 class="mb-0" style="color:#fff;font-weight: bold;">Total Agenda</h6>

                          <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{ $ca + $oa + $pa}}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #800080;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                    <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/interface.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                           <h6 class="mb-0" style="color:#fff;">Agenda Completed</h6>
                      <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{$ca}}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #B3C100;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                     <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/gear.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                          <h6 class="mb-0" style="color:#fff;">Agenda Progress</h6>
                          <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{ $pa}}</p>
                      </div>
                  </div>
              </div>
          </div>

      </div>
<div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #FF0000;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                    <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/pending.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                          <h6 class="mb-0" style="color:#fff;">Overdue Agenda</h6>
                          <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">{{ $oa}}</p>
                      </div>
                  </div>
              </div>
          </div>

      </div>
  </div>




   {{-- all user table start --}}

   <div class="row">
    <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">

    </div>

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body boxShadow" style="height:350px;overflow:auto;">
              <div class="card-body">
                <h4 class="card-title">Today Meeting</h4>

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sr No</th>
                        <th>Meeting</th>
                        <th>Time</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($todayMeeting as $tm)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          <a href="{{ route('meetingschedule.edit',['meetingschedule'=>$tm->mm_id]) }}">
                            {{ $tm->mm_title }}
                          </a>

                        </td>
                        <td>{{ $tm->ms_meeting_time }}</td>
                        <td>
                          @if ($tm->mm_status == 'A')
                          <label class="badge badge-info">Active</label>
                          @elseif($tm->mm_status == 'D')
                          <label class="badge badge-danger">Deleted</label>
                          @elseif($tm->mm_status == 'C')
                          <label class="badge badge-success">Completed</label>
                          @endif
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="4" class="text-center text-danger">
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
      </div>

      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
        <div class="card boxShadow" style="height:350px;overflow:auto;">
          <div class="card-body">
            <h4 class="card-title">Agenda Overdue</h4>
              <div class="row">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="col-1">Sr No.</th>
                    <th class="col-5">Meeting Title</th>
                    <th class="col-4">Agenda OverDue</th>
                    <th class="col-2">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($agendaOverdueArry as $aoa)
                  <tr>
                    <td class="col-1">{{ $loop->iteration }}</td>
                    <td class="col-5" >
                      <a href="{{ route( 'meetingschedule.edit',['meetingschedule'=>$aoa['am_mm_id'] ]) }}">
                        
                        {{ $aoa['mm_title'] }} 
                      </a>

                    </td>
                    <td class="col-4">
                      <label class="badge badge-danger">{{ $aoa['count'] }} Overdue Agenda</label>
                    </td>
                    <td class="col-2">
                      @if ($aoa['mm_status'] == 'A')
                      <label class="badge badge-info">Active</label>
                      @elseif($aoa['mm_status'] == 'D')
                      <label class="badge badge-danger">Deleted</label>
                      @elseif($aoa['mm_status'] == 'C')
                      <label class="badge badge-success">Completed</label>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="text-center text-danger">
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
      </div>






      <div class="col-lg-12 grid-margin grid-margin-lg-0 stretch-card" style="margin-top:50px;margin-bottom: 150px;">
        <div class="card boxShadow" >
          <div class="card-body">
            <div class="row">
                <div class="col-md-3">

                    <div class="mt-4">
                        <p>Filter board</p>
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">

                                <input type="checkbox" class="form-check-input getCalendarRefresh" value="true" meeting="O" checked readonly onclick="return false;">



                                Open Meeting
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check form-check-warning">
                            <label class="form-check-label">

                                <input type="checkbox" class="form-check-input getCalendarRefresh" value="true"
                               meeting="P" checked readonly onclick="return false;">




                                Scheduled Meeting
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check form-check-success">
                            <label class="form-check-label">

                                <input type="checkbox" class="form-check-input getCalendarRefresh" value="true" meeting="C" checked readonly onclick="return false;">



                                Concluded Meeting
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check form-check-danger">
                            <label class="form-check-label">

                                <input type="checkbox" class="form-check-input getCalendarRefresh" meeting="CA" checked readonly onclick="return false;">



                                Cancel Meeting
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" style="height:auto;overflow:auto;">
                    <div class="card" >
                        <div class="card-body">
                            <h4 class="card-title">UpComing Meeting</h4>
                            <div id="calendar" class="full-calendar fc fc-unthemed fc-ltr">


                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">

                   </script>
                </div>


            </div>
          </div>
        </div>
      </div>

    </div>

   {{-- all user table end --}}



  </div>

@endsection

@section('calendar')
<script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/js/calendar.js') }}"></script>
@endsection
