@extends('app.dashboard.dashboard')

@php
$ses_um_full_name = Session::get('user')['um_full_name'];
$ses_um_id = Session::get('user')['um_id'];
$ses_um_user_type = Session::get('user')['um_user_type'];
@endphp
@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Manage Agenda Task</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">User Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">Manage Agenda Task</p>
          </div>
        </div>
        @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA' )
        <div class="justify-content-end align-items-center d-flex">
          <a  href="{{ route('agendatask.create') }}" class="btn btn-info ml-2">Add Agenda Task</a>
        </div>
        @endif
      </div>
      
    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}

  <div class="row">
 
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body boxShadow">
            @include('app.dashboard.agendatasksubview')
          </div>
        </div>
      </div>
  </div>

   {{-- all user table end --}}

   



  </div>

@endsection
