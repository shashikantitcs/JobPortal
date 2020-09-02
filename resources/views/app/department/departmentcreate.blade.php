@extends('app.dashboard.dashboard')


@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
         @if (isset($editdepartment))
         <h4 class="mb-0 font-weight-bold">Update Department</h4>
         @else
         <h4 class="mb-0 font-weight-bold">Add Department</h4>
         @endif
         
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">
            @if (isset($edituser))
            Department Update View
            @else
            Department Create View
            @endif</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">
              @if (isset($editdepartment))
              Update Department
            @else
              Add Department</p>
            @endif
          </div>
        </div>
   
      </div>
      
    </div>

   {{-- create user start --}}

   @include("app.shared.departmentform")
   
   {{--create user end --}}

@endsection
