@extends('app.master.master')
@section('title','Welcome to mom dashboard')

<style>
  #loginDiv{
   border: 3px solid #3bb001;
   padding:11px;
   margin-top: 30px;
   background: #3bb00112;
}
</style>
<style>
  table{
    min-width: 400px;
    overflow-x: scroll;
  }
.table td {
    white-space: unset !important;
}

  </style>
@section('body')
<nav class="navbar navbar-expand-lg navbar-dark justify-content-between" style="background: #3bb001 !important;position:fixed;z-index:999;
width:100%">
    <a class="navbar-brand" href="#">
    <img src="{{ asset('assets/images/meetingLogoOrig.png')}}" width="60" height="30" class="d-inline-block align-top" alt="">
       <span class="text-white">&nbsp;&nbsp; Minutes of Meeting</span>
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
     
   
        <ul class="navbar-nav">
           
            {{-- <li class="nav-item active">
              <a class="nav-link" href="#">
                  <b>Home</b> <span class="sr-only">(current)</span></a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="#statics">
                  <b>Statistics</b></a>
            </li>
            <li class="nav-item">
            <a id="loginBtn" class="nav-link">
              <b>Login</b>
            </a>
            </li>
           
          </ul>
      <div>
       &nbsp;&nbsp;&nbsp; 
        <a target="_blank" href="#" class="mygov-logo hidden-xs">
            <img src="https://dashboard.nic.in/img/NEW2.png" alt="Digital India" title="Digital India"></a>
      </div>
    </div>
  </nav>
{{--  
<section>
  <div class="container-fluid" style="padding:0px;">
    <div class="row">
    <div class="col-md-12 boxShadow">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
          <img src="{{ asset('assets/images/Banner2.jpg')}}" class="d-block w-100" alt="...">
           
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/images/Banner3.jpg')}}" class="d-block w-100" alt="...">
          
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/images/Banner4.jpg')}}" class="d-block w-100" alt="...">
         
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  </div>
</section> --}}

<section id="statics" style="margin-top:5px;">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 offset-md-1 mt-5 text-center">
            @include('app.shared.alert-msg')
          </div>  

            <div class="col-md-10 offset-md-1 mt-5 mb-5"
            style="">
               <div class="row"  style="background: linear-gradient(to right, #8e9eab, #eef2f3);border-radius:5px;">
                <div class="col-md-12" style="margin-top: 24px;">
                    <div class="row">
                      <div class="col-md-4 mt-1 d-flex justify-content-center">
                        <div class="card boxShadow" style="background-color: #fff;font-weight: bold;border-radius:10px;max-width:260px;">
                            <div class="card-body d-flex" style="height:200px;">
                              <div class="row">
                                <div class="col-md-12" style="background: white;margin: auto;text-align:center;">
                                <img src="{{ asset('assets/images/meeting.png')}}" height="40px;">
                                </div>
                                <div class="col-md-12">
                                    <div class="meetingDesc">
                                        Total Meeting Recorded
                                    </div>
                                    <div class="meetingCount">
                                     <span class="countSpan"> {{ $meeting['A'] + $meeting['C'] }}</span>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1 d-flex justify-content-center">
                      <div class="card boxShadow" style="background-color: #fff;font-weight: bold;border-radius:10px;max-width:260px;">
                          <div class="card-body d-flex" style="height:200px;">
                            <div class="row">
                              <div class="col-md-12" style="background: white;margin: auto;text-align:center;">
                              <img src="{{ asset('assets/images/interface.png')}}" height="40px;">
                              </div>
                              <div class="col-md-12">
                                  <div class="meetingDesc">
                                    Meeting scheduled in next 10 days
                                  </div>
                                  <div class="meetingCount">
                                    <span class="countSpan">  {{ count($uMeeting) }}
                                    </span>
                                  </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mt-1 d-flex justify-content-center">
                    <div class="card boxShadow" style="background-color: #fff;font-weight: bold;border-radius:10px;max-width:260px;">
                        <div class="card-body d-flex" style="height:200px;">
                          <div class="row">
                            <div class="col-md-12" style="background: white;margin: auto;text-align:center;">
                            <img src="{{ asset('assets/images/day.png')}}" height="40px;">
                            </div>
                            <div class="col-md-12">
                                <div class="meetingDesc">
                                  Meeting completed in last 10 days
                                </div>
                                <div class="meetingCount">
                                  <span class="countSpan"> {{ count($cMeeting) }}
                                  </span>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                    {{-- <div class="col-md-3 mt-1">
                        <div class="card bgtotalMeet boxShadow" style="background-color: #00c0ef;font-weight: bold;border-radius:10px;">
                            <div class="card-body d-flex" style="height:84px;">
                                <div class="col-md-3" style="background: white;margin: auto;">
                                <img src="{{ asset('assets/images/meeting.png')}}" height="40px;">
                                </div>
                                <div class="col-md-9">
                                    <div class="meetingDesc">
                                        Total Meeting
                                    </div>
                                    <div class="meetingCount">
                                      {{ $meeting['A'] + $meeting['C'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-1">
                        <div class="card bgCompletedMeeting boxShadow" style="background-color: #00c0ef;font-weight: bold;border-radius:10px;">
                            <div class="card-body d-flex" style="height:84px;">
                                <div class="col-md-3" style="background: white;margin: auto;">
                                <img src="{{ asset('assets/images/day.png')}}" height="40px;">
                                </div>
                                <div class="col-md-9">
                                    <div class="meetingDesc">
                                        Completed Meeting
                                    </div>
                                    <div class="meetingCount">
                                      {{ $meeting['C'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-1">
                        <div class="card bgProgressMeeting boxShadow" style="background-color: #00c0ef;font-weight: bold;border-radius:10px;">
                            <div class="card-body d-flex" style="height:84px;">
                                <div class="col-md-3" style="background: white;margin: auto;">
                                <img src="{{ asset('assets/images/chart.png')}}" height="40px;">
                                </div>
                                <div class="col-md-9">
                                    <div class="meetingDesc">
                                        Progress Meeting
                                    </div>
                                    <div class="meetingCount">
                                      {{ $meeting['A'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-1">
                      <div class="card boxShadow" style="background: linear-gradient(to right, #00d2ff, #928dab);font-weight: bold;border-radius:10px;">
                          <div class="card-body d-flex" style="height:84px;">
                              <div class="col-md-3" style="background: white;margin: auto;">
                              <img src="{{ asset('assets/images/men.png')}}" height="40px;">
                              </div>
                              <div class="col-md-9">
                                  <div class="meetingDesc">
                                    Total User created
                                  </div>
                                  <div class="meetingCount">
                                      {{ $uCount }}
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                    <div class="col-md-3 mt-1">
                        <div class="card bgTotalAgenda boxShadow" style="background-color: #00c0ef;font-weight: bold;border-radius:10px;">
                            <div class="card-body d-flex" style="height:84px;">
                                <div class="col-md-3" style="background: white;margin: auto;">
                                <img src="{{ asset('assets/images/business.png')}}" height="40px;">
                                </div>
                                <div class="col-md-9">
                                    <div class="meetingDesc">
                                        Total Agenda
                                    </div>
                                    <div class="meetingCount">
                                        {{ $ca + $oa + $pa}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-1">
                        <div class="card bgAgendaCompleted boxShadow" style="background-color: #00c0ef;font-weight: bold;border-radius:10px;">
                            <div class="card-body d-flex" style="height:84px;">
                                <div class="col-md-3" style="background: white;margin: auto;">
                                <img src="{{ asset('assets/images/interface.png')}}" height="40px;">
                                </div>
                                <div class="col-md-9">
                                    <div class="meetingDesc">
                                        Agenda Completed
                                    </div>
                                    <div class="meetingCount">
                                      {{ $ca}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mt-1">
                        <div class="card bgAgendaProgress boxShadow" style="background-color: #00c0ef;font-weight: bold;border-radius:10px;">
                            <div class="card-body d-flex" style="height:84px;">
                                <div class="col-md-3" style="background: white;margin: auto;">
                                <img src="{{ asset('assets/images/gear.png')}}" height="40px;">
                                </div>
                                <div class="col-md-9">
                                    <div class="meetingDesc">
                                        Agenda Progress
                                    </div>
                                    <div class="meetingCount">
                                      {{ $pa}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mt-1">
                      <div class="card boxShadow" style=" background: linear-gradient(to right, #f00000, #dc281e);font-weight: bold;border-radius:10px;">
                          <div class="card-body d-flex" style="height:84px;">
                              <div class="col-md-3" style="background: white;margin: auto;">
                              <img src="{{ asset('assets/images/pending.png')}}" height="40px;">
                              </div>
                              <div class="col-md-9">
                                  <div class="meetingDesc">
                                      Agenda overdue
                                  </div>
                                  <div class="meetingCount">
                                    {{ $oa }}
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div> --}}
                  
                    
                   
                   </div>
                </div>
          
                <div class="col-lg-6 grid-margin stretch-card"
                style="margin-top: 24px;">
                    <div class="card">
                        <div class="card-body boxShadow" style="height:350px;overflow:auto;">
                          <div class="card-body">
                            <h4 class="card-title tableMeetingheader">
                              Meeting scheduled in next 10 days 
                            </h4>
            
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                
                                      <tr>
                                        <th>Sl. No</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Starting Time</th>
                                        <th>Duration</th>
                                        <th>Location</th>
                                        <th>M. Chaired by</th>
                                        <th>M. Status</th>
                                      </tr>
                                </thead>
                                <tbody>
                                  @forelse ($uMeeting as $item)
                                  <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                      <td>{{ $item->mm_title}}</td>
                                      <td>{{ date('d-M-Y',strtotime($item->ms_meeting_date))
                                       }}
                                      </td>
                                      <td>{{
                                       $item->ms_meeting_time
                                       }}
                                      </td>
                                      <td>
                                      </td>
                                      <td>
                                      </td>
                                      <td>{{ $item->um_first_name.' '.$item->um_last_name }}</td>
                                      <td>
                                          
                          @if ($item->mm_status == 'A')
                          <label class="badge badge-info">Active</label>
                          {{-- @elseif($m->mm_status == 'D')
                          <label class="badge badge-warning">Delete</label> --}}
                          @elseif($item->mm_status == 'D')
                          <label class="badge badge-danger">Deleted</label>
                          @elseif($item->mm_status == 'C')
                          <label class="badge badge-success">Completed</label>
                          @endif
                                      </td>
                                    </tr>
                                    @empty
                                    <tr>
                                      <td colspan="5" class="text-center text-danger">
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
                <div class="col-lg-6 grid-margin stretch-card"
                style="margin-top: 24px;">
                    <div class="card ">
                        <div class="card-body boxShadow" style="height:350px;overflow:auto;">
                          <div class="card-body">
                            <h4 class="card-title tableMeetingheader">
                              Meeting completed in last 10 days 
                            </h4>
            
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Sl. No</th>
                                    <th>Title</th>
                                    <th>Date & Time</th>
                                    <th>Starting Time</th>
                                    <th>Duration</th>
                                    <th>Location</th>
                                    <th>M. Chaired by</th>
                                    <th>M. Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @forelse ($cMeeting as $item)
                                  <tr>
                                  <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->mm_title}}</td>
                                    <td>{{ date('d-M-Y',strtotime($item->ms_meeting_date))
                                    }}
                                    </td>
                                    <td>{{
                                     $item->ms_meeting_time
                                     }}
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>{{ $item->um_first_name.' '.$item->um_last_name }}</td>
                                    <td>
                                        
                        @if ($item->mm_status == 'A')
                        <label class="badge badge-info">Active</label>
                        {{-- @elseif($m->mm_status == 'D')
                        <label class="badge badge-warning">Delete</label> --}}
                        @elseif($item->mm_status == 'D')
                        <label class="badge badge-danger">Deleted</label>
                        @elseif($item->mm_status == 'C')
                        <label class="badge badge-success">Completed</label>
                        @endif
                                    </td>
                                  </tr>
                                  @empty
                                  <tr>
                                    <td colspan="5" class="text-center text-danger">
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
               
            </div>
            {{-- <div class="col-md-12">
                
            </div> --}}
        </div>
    </div>
</section>  
{{-- <section>
    <div class="container-fluid" style="background: linear-gradient(to top, #6A82FB, #FC5C7D);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5 mb-4 text-white text-center">
                    <h1 style="text-decoration: underline;">About Mom Software</h1>
                </div>  
                <div class="col-md-8 mb-5 text-white" style="font-size: 20px;">
                    " Dashboard for Analytical Review of Projects Across Nation, transform complex government data into compelling visuals. It gives the technical administration a tool, which is needed to deliver real-time, dynamic project monitoring without coding or programming through web services. It enhance the analytical capabilities through data collection by consolidating multiple data sources into one centralized, easy-to-access platform. It immediately identifies trends and quickly drilldowns into data to gain enhanced perspectives of the district level projects. DARPAN displays information in an objective and quantifiable way that helps the technical administration to see and understand not only its success, but also its pain points and areas in need of improvement."
                </div>
                <div class="col-xl-4 col-lg-4 order-1 order-lg-2 hero-img aos-init aos-animate mb-5" data-aos="zoom-in" data-aos-delay="150">
                <img src="{{ asset('assets/images/aboutus-mom.png')}}" class="img-fluid animated" alt="">
                  </div>
                
            </div>
                          
        </div>
    </div>
</section> --}}
<section>
    <div class="container-fluid" style="background:linear-gradient(to right, #3bb001cc , #49b7398a);">
        <div class="row">
            <div class="col-md-8 offset-md-2 p-4 text-white text-center">
               <h5> MOM platform is designed, developed and hosted by National Informatics Centre, Ministry of Information & Broadcasting, Government of India.</h5>
            </div>
        </div>
    </div>   
</section>    



<div class="modal fade" id="loginModal" 
tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title d-flex justify-content-center w-100" id="exampleModalLabel">
          <b>Minutes Of Meeting</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="loginDiv">
          <h5 class="text-center ngo-login-form">Login</h5>
          {{-- alert msg --}}
          @include('app.shared.alert-msg')
          {{-- alert msg --}}
          <div class="row">
            <div class="col-md-12 alert alert-danger" id="errFlash" style="display: none">

            </div>
            <div class="col-md-12">
         
            </div>
          </div>

          <form action="{{ route('login.attemptLogin') }}" method="POST" data-parsley-validate="">
             {{ csrf_field() }}
            <div class="row">
              <label for="email" class="col-sm-4 col-form-label">
                <p>Email Id</p>
              </label>
              <div class="col-sm-8">
               <input type="email" class="form-control cutsomInput email @error('email') parsley-error @enderror"  maxlength="255" autocomplete="off" id='email' name='email' placeholder="Enter Email Id" data-parsley-required data-parsley-type="email" data-parsley-trigger="change" value="{{ old('email') }}">

              @error('email')
              <small class="validate-err">{{$message}}</small>
              @enderror
            </div>
            </div>
            <div class="row">
              <label for="password" class="col-sm-4 col-form-label">
                <p>Password</p>
              </label>
              <div class="col-sm-8">
                <input type="password" class="form-control X password @error('password') parsley-error @enderror" autocomplete="off" id='password' name='password' placeholder="Enter Password" data-parsley-required="" data-parsley-trigger="change" >
                @error('password')
                <small class="validate-err">{{$message}}</small>
                @enderror
              </div>
            </div>

            {{-- <div class="row">
              <label for="captcha" class="col-sm-4 col-form-label">
                <p>Captcha</p>
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control cutsomInput @error('captcha') parsley-error @enderror" id="captcha" autocomplete="off" name="captcha" placeholder="Type Captcha" maxlength="6" minlength="6" data-parsley-required data-parsley-trigger="change">
                @error('captcha')
                <small class="validate-err">{{$message}}</small>
                @enderror
              </div>
            </div> --}}


           {{-- <div class="row mb-3">
              <label for="inputPassword" class="col-sm-4 col-form-label"></label>
              <div class="col-sm-6" style="padding-right: 0px;">
               <img  src="{{$captcha}}" id="captchaImg" class="captchaImg" style="padding-left: 12px;width: 100%;height: 40px;"/>
              </div>
              <div class="col-sm-2">
                 <span class="btn btn-outline-danger btn-icon-text reset-captcha"
                title="Reset Captcha">
                  <i class="fa fa-refresh"></i>
                </span>
             

              </div>
            </div> --}}
          
            <div class="text-right">
              <a target="_blank" href="{{ route('user.forgotpassword') }}">Forgot Password</a>
            </div>
            <div class="row justify-content-lg-center align-items-center
            text-center">
               <input type="submit" class="btn btn-success btn-md" id="valideteUserLogin" value="Login">

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>