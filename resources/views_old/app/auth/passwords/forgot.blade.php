@extends('app.master.master')
@section('title','Welcome to mom dashboard');
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
</style>
@section('body')
<section>
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin-top: 30px">
         <div class="panel panel-default loignBox p-4">
          <div class="panel-heading text-center">Minsistry Of Information & Broadcasting</div>
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

                <form action="{{ route('user.forgotpassword') }}" method="POST" data-parsley-validate="">
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
                    <label for="captcha" class="col-sm-4 col-form-label">
                      <p>Capcha</p>
                    </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control cutsomInput @error('captcha') parsley-error @enderror" id="captcha" autocomplete="off" name="captcha" placeholder="Type Capcha" maxlength="6" minlength="6" data-parsley-required data-parsley-trigger="change">
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
                        <i class="fa fa-refresh btn-icon-prepend"></i>
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
                  <div class="row justify-content-lg-center align-items-center
                  text-center">

                     <input type="submit" class="btn btn-success btn-md" id="forgetPasswordForm" value="Login">

                  </div>
                </form>

              </div>

            </div>
          </div>
        </div>
        </div>
      </div>

    </div>
    </div>
  </section>
@endsection
