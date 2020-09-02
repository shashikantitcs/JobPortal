@extends('app.dashboard.dashboard')


@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->

         <h4 class="mb-0 font-weight-bold">Change Password</h4>


          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">

                Change Password

          </div>
        </div>

      </div>

    </div>


    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}


        {{-- create user start --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    {{-- <div class="card-header card bg-success">
                      <h4 class="text-white text-bold">Create user</h4>
                    </div> --}}
                    <div class="card-body boxShadow">
                      <!-- <h4 class="text-success text-bold">Reset Password</h4> -->
                      {{-- <p class="card-description">
                          Create user
                      </p> --}}
                    <form action="{{ route('user.passwordresetStore') }}" method="POST" data-parsley-validate="">
                      {{ csrf_field() }}
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                   <label for="oldPassword">Old Password</label>
                                  <input type="password" class="form-control oldPassword @error('old_password') parsley-error @enderror" id="oldPassword" placeholder="Enter Old Password" name="old_password" required="" data-parsley-trigger="change">
                                  @error('old_password')
                                  <small class="validate-err">{{$message}}</small>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                 <label for="newPassword">New Password</label>
                                <input type="password" class="form-control newPassword @error('new_password') parsley-error @enderror" id="newPassword" placeholder="Enter New Password" name="new_password" required="" data-parsley-trigger="change">
                                @error('new_password')
                                <small class="validate-err">{{$message}}</small>
                                @enderror
                              </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                 <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control confirmPassword @error('confirm_password') parsley-error @enderror" id="confirmPassword" placeholder="Enter Confirm Password" name="confirm_password" required="" data-parsley-trigger="change">
                                @error('confirm_password')
                                <small class="validate-err">{{$message}}</small>
                                @enderror
                              </div>
                            </div>
                          </div>
                        <div class="col-md-12 justify-content-lg-end align-items-end
                        d-flex">
                        <button type="submit" id="passwordreset" class="btn btn-success mr-2">Change Password</button>

                        </div>

                      </form>
                    </div>
                  </div>
            </div>

        </div>



@endsection
