@extends('app.dashboard.dashboard')


@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
         @if (isset($edituser))
         <h4 class="mb-0 font-weight-bold">Update User Detail</h4>
         @else
         <h4 class="mb-0 font-weight-bold">Add User</h4>
         @endif
         
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">
            @if (isset($edituser))
              User Update View
            @else
            User Create View
            @endif</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">
              @if (isset($edituser))
              Update User Detail
            @else
              Add User</p>
            @endif
          </div>
        </div>
   
      </div>
      
    </div>

   {{-- create user start --}}

   @include("app.shared.usercreate")
   
   {{--create user end --}}

@endsection
