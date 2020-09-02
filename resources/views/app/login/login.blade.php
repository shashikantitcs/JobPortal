@extends('app.master.master')
@section('title','Welcome to mom dashboard')
<style>
    body{
      font-family: sans-serif;
}

.loignBox{
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
}
.container-fluid{
  width: 64%;
}
.container{
    height: 100vh;
    vertical-align: middle;
    display: table-cell;
}
h1{
  font-size: 22px !important;
}

h3{
   font-size: 19px;
}

h4 {
  font-size:17px;
}
h5{
 font-size:15px;
}
p{
  font-size: 13px;
}
#mibheading{
  line-height: 1.7;
      text-shadow: 2px 1px 8px #2f2b2bc9;
}
#schemeHeading{
    margin-top: 60px;
text-decoration: underline;
}

#CommunityRadioDiv{
   padding: 14px 0px 26px 0px;
}
#mibheadingDiv{

    margin-top: 40px;
}

.rightFloatContact{
  float:right;
}

#ashoklogoDiv{
      text-align: center;
 /*   margin-top: 40px;*/
}

#ngoGrantsDiv{
       /*margin-top: 67px;*/
}

#loginDiv{

}
#firstRowBlock{
  border: 4px solid #5aa7de;
  background: #5aa7de;
  box-shadow: 0 4px 40px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#schemeBlock{
  background: #5aa7de;
}
.lemonHeading{
      color: #deff4f;
      text-shadow: 2px 1px 8px #2f2b2bc9;
}
#loginDiv{
   border: 3px solid #3bb001;
   padding:11px;
   margin-top: 30px;
   background: #3bb00112;
}
#registerDiv{
  padding: 18px 39px 0px 39px;
    line-height: 1;
}
.cutsomInput{
  background: #deff8d96;
  width: 73%;
    height: 30px;
    margin-left: 11px;
    font-size: 11px;
}
.login-block{
  background: #fff;
}
.reset-captcha{
  padding-left: 10px;
  cursor: pointer;
  color: red;
}
.login-form{
  display: none;
}
input.parsley-error {
        border: 1px solid #bc1414e6;
}

.parsley-errors-list {
        color: #bc1414e6 !important;
}
.col-sm-8 {
    flex: 0 0 66.66667%;
    max-width: 65.66667% !important;
}
.learnMomBckgrund{
  background: #f12711;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #f5af19, #f12711);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #f5af19, #f12711); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
font-size:24px;

}
.faqBckgrund{
  background: linear-gradient(45deg, #5846f9 0%, #7b27d8 100%);
}
.faqHeading{
  font-size: 20px !important;
}
</style>
@section('body')
<section>
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin-top: 30px">
         <div class="panel panel-default loignBox p-4">
          <div class="panel-heading text-center">Ministry Of Information & Broadcasting</div>
          <div class="panel-body">
          <div class=" login-block">
            <div id="ashoklogoDiv" style="margin-top: 10px;margin-bottom:10px;">
              <img src="{{ asset('assets/img/emblem-dark.png') }}" height="66px" width="60px;">
            </div>
            <div id="ngoGrantsDiv">
              <h3 class="text-center">Minutes Of Meeting</h3>
              <div id="loginDiv">
                <h5 class="text-center ngo-login-form">Login</h5>
                {{-- alert msg --}}
                @include('app.shared.alert-msg')
                {{-- alert msg --}}
                <div class="row">
                  <div class="col-md-12 alert alert-danger" id="errFlash" style="display: none">

                  </div>
                  <div class="col-md-12">
                    {{-- @include('include.__error') --}}
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
                      <input type="password" class="form-control cutsomInput password @error('password') parsley-error @enderror" autocomplete="off" id='password' name='password' placeholder="Enter Password" data-parsley-required="" data-parsley-trigger="change" value="" >
                      @error('password')
                      <small class="validate-err">{{$message}}</small>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <label for="captcha" class="col-sm-4 col-form-label">
                      <p>Captcha</p>
                    </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control cutsomInput @error('captcha') parsley-error @enderror" id="captcha" autocomplete="off" name="captcha" placeholder="Type Captcha" maxlength="6" minlength="6" data-parsley-required data-parsley-trigger="change">
                      @error('captcha')
                      <small class="validate-err">{{$message}}</small>
                      @enderror
                    </div>
                  </div>


                 <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-6" style="padding-right: 0px;">
                     <img  src="{{$captcha}}" id="captchaImg" class="captchaImg" style="padding-left: 12px;width: 100%;height: 40px;"/>
                    </div>
                    <div class="col-sm-2">
                       <span class="btn btn-outline-danger btn-icon-text reset-captcha"
                      title="Reset Captcha">
                        <i class="fa fa-refresh"></i>
                      </span>
                     {{-- <i class="fa fa-refresh reset-captcha" aria-hidden="true" title="Reset Captcha"></i>  --}}

                    </div>
                  </div>
                  {{-- <div class="row mb-2">
                    <div class="col-4">
                    </div>
                    <div class="col-sm-5">
                      <button class="btn btn-outline-danger btn-icon-text reset-captcha"
                      title="Reset Captcha">
                        <i class="fa fa-refresh btn-icon-prepend"></i>
                      </button>
                      <i class="fa fa-refresh reset-captcha" aria-hidden="true" title="Reset Captcha"></i>

                    </div>
                  </div>  --}}
                  <div class="text-right">
                    <a href="{{ route('user.forgotpassword') }}">Forgot Password</a>
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
      </div>

    </div>

    <!-- faq -->
     <div class="row mt-5 faqBckgrund">
      <div class="col-md-12 text-center p-2 text-white bg-primary text-bold learnMomBckgrund" >
        Frequently Asked Questions
      </div>
      {{-- <div class="container-fuild"> --}}
        <div class="col-md-6 offset-md-3 mt-5">
          <div class="accordion" id="accordionExample">
            <div class="card loignBox text-center">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0 ">
                  <button class="btn btn-link btn-block faqHeading" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                   Learn How to add meeting ? 
                  </button>
                </h2>
              </div>
          
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <video width="100%" height="240" controls>
                  <source src="{{asset('videos/AddMeeting.mov')}}" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                  Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
            <div class="card loignBox text-center">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block collapsed faqHeading" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Learn How to add agenda ? 
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  <video width="100%" height="240" controls>
                    <source src="{{asset('videos/AddAgenda.mov')}}" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                  Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
            <div class="card loignBox text-center">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block collapsed faqHeading" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Learn How to add assign agenda task ? 
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <video width="100%" height="240" controls>
                    <source src="{{asset('videos/AgendaTaskAssign.mov')}}" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                  Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
            <div class="card loignBox text-center">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block collapsed faqHeading" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                    Learn How to do action on assigned agenda task ? 
                  </button>
                </h2>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  <video width="100%" height="240" controls>
                    <source src="{{asset('videos/UserActionTaken.mov')}}" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                  Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
          </div>
      {{-- </div> --}}
    </div>

    </div>
    <!-- faq -->


    </div>
  </section>
@endsection
