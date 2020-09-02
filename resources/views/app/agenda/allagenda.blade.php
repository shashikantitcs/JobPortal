@extends('app.dashboard.dashboard')
<style>
  .select2-selection__rendered .select2-selection__choice{
    font-size: 17px !important;
  }
  .select2-container {
    width: 100% !important;
  }
  table{
    min-width: 1180px;
    overflow-x: scroll;
  }
.table td {
    white-space: unset !important;
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
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Manage Agenda</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">User Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">Manage Agenda</p>
          </div>
        </div>
        @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA' )
        <div class="justify-content-end align-items-center d-flex">
          <a  href="{{ route('agenda.create') }}" class="btn btn-info ml-2">Add Agenda</a>
        </div>
        @endif
      </div>
      
    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}

   <div class="row">

    @if (isset($magenda))

    @if (count($agenda) > 0)
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
                </tr>
              </thead>
              <tbody>
            
                <tr>
                  <td>
                    {{$agenda[0]->mm_title}} 
                  </td>
                  <td>
                    {{$agenda[0]->mm_description}} 
                  </td>
                  <td class="text-danger">
                    @foreach ($user as $uu)
                        @if ($uu->um_id == $agenda[0]->mm_um_id)
                          <b>
                            {{ ucfirst($uu->um_first_name.' '.$uu->um_last_name)  }}
                          </b></br>
                          <i class="mdi mdi-email-open"></i>{{ ucfirst($uu->um_email)  }}
                          @break
                        @endif
                    @endforeach
                  </td>
                  <td>
                    {{ date('d-M-Y',strtotime($agenda[0]->mm_created_at)) }}
                  </td>
                  <td>
                    @if ($agenda[0]->mm_status == 'A')
                    <label class="badge badge-info">Active</label>
                    @elseif($agenda[0]->mm_status == 'D')
                    <label class="badge badge-danger">Deleted</label>
                    @elseif($agenda[0]->mm_status == 'C')
                    <label class="badge badge-success">Completed</label>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endif

    <div class="col-lg-12 grid-margin stretch-card mb-5">
      <div class="card">
        <div class="card-body boxShadow">
          <h4 class="card-title text-success">All Agenda List</h4>

          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" >
              <thead>
                <tr>
                  <th>Sr No.</th>
                  <th>Agneda Title</th>
                  <th>Owner agenda</th>
                  <th>Agneda Expected Completeting Date</th>
            
                  <th>Agneda Actual Completeting Date</th>
                   <th>Created At</th> 
                
                  <th>Action</th>
                
                </tr>
              </thead>
              <tbody>
                @forelse ($agenda as $a)
                <tr>
                <td>
                  <b>{{($agenda->currentPage() - 1) * $agenda->perPage() + $loop->iteration}}</b>
                
                </td>
                {{-- <td><b>{{ ucfirst($a->mm_title) }}</b></td> --}}
                <td><b>{{ ucfirst($a->am_title) }}</b></td>
                <td class="text-danger">
                  @foreach ($user as $ua)
                  @if ($ua->um_id == $agenda[0]->am_um_id)
                    <b>
                      {{ ucfirst($ua->um_first_name.' '.$ua->um_last_name)  }}
                    </b></br>
                    <i class="mdi mdi-email-open"></i>{{ ucfirst($ua->um_email)  }}
                    @break
                  @endif
                  @endforeach
              </td>
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
                
                  <td class="d-flex">
                 
                      <a class="btn btn-inverse-success btn-sm btn-icon" href="{{ route('agendatask.index', ['amId'=>$a->am_id]) }}"  title="Show" data-toggle="popover" data-trigger="hover" data-content="Show Agenda All Task">
                        <i class="mdi mdi-eye btn-icon-prepend"></i>
                      </a>
                      <button type="button" class="btn btn-inverse-warning btn-sm btn-icon ml-1 manageAgendaUser" id="manageAgendaUser" title="Manage User" data-toggle="popover" data-trigger="hover" data-content="Manage Agenda User" agendaId="<?php echo $a->am_id; ?>">
                        <i class="mdi mdi-account-convert"></i>
                      </button>
                      @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA' )
                     
                      
                      @if ($a->mm_status == 'A' )
                      <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="editAgenda" href="{{ route('agenda.edit', ['agenda'=>$a->am_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Agenda Title">
                        <i class="mdi mdi-grease-pencil"></i>
                      </a>
                    
                 
                    <form id="deleteAgendaForm" action="{{ route('agenda.destroy', ['agenda'=>$a->am_id]) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteagneda" id="deleteagneda" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Agenda">
                        <i class="mdi mdi-delete"></i>
                      </button>
                   
                    </form>
                    @endif
                    
                    @endif
                  </td>
                </tr>
              
                @empty
                <tr>
                  <td colspan="6" class="text-center text-danger">
                      <b>No Result Found<b>
                  </td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
          <div class="row mt-4">
            <div class="col-md-12 justify-content-end d-flex">
                {{ $agenda->links() }}
              
            </div>
            
        </div>
        </div>
      </div>
    </div>

        
    @else    
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body boxShadow">
          <h4 class="card-title text-success">All Agenda List</h4>

          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Sr No.</th>
                  <th>Meeting Title</th>
                  <th>Agneda Title</th>
                  <th>Agneda Expected Completeting Date</th>
            
                  <th>Agneda Actual Completeting Date</th>
                  <th>Meeting Status</th>
                
                  <th>Action</th>
                
                </tr>
              </thead>
              <tbody>
                @forelse ($agenda as $a)
                <tr>
                <td>
                  <b>{{($agenda->currentPage() - 1) * $agenda->perPage() + $loop->iteration}}</b>
                
                </td>
                <td><b>{{ ucfirst($a->mm_title) }}</b></td>
                <td><b>{{ ucfirst($a->am_title) }}</b></td>
                <td> 
                    {{ date('d-M-Y',strtotime($a->am_expected_completion_date)) }}
              
                </td>
                <td> 
                  {{ date('d-M-Y',strtotime($a->am_actual_completion_date)) }}
            
              </td>
              <td class="text-danger">
                  @if ($a->mm_status == 'A' )
                  <label class="badge badge-info">Active</label>
                  @elseif($a->mm_status == 'D')
                  <label class="badge badge-warning">Delete</label>
                  @elseif($a->mm_status == 'C')
                  <label class="badge badge-success">Completed</label>
                  @elseif($a->mm_status == 'CA')
                  <label class="badge badge-danger">Cancel</label>
                  @endif
                 
              </td>
                
                  <td class="d-flex">
                 
                      <a class="btn btn-inverse-success btn-sm btn-icon" href="{{ route('agendatask.index', ['amId'=>$a->am_id]) }}"  title="Show" data-toggle="popover" data-trigger="hover" data-content="Show Agenda All Task">
                        <i class="mdi mdi-eye btn-icon-prepend"></i>
                      </a>
                      <button type="button" class="btn btn-inverse-warning btn-sm btn-icon ml-1 manageAgendaUser" id="manageAgendaUser" title="Manage User" data-toggle="popover" data-trigger="hover" data-content="Manage Agenda User" agendaId="<?php echo $a->am_id; ?>">
                        <i class="mdi mdi-account-convert"></i>
                      </button>
                      @if ($ses_um_user_type == 'A' || $ses_um_user_type == 'MA' )
                
                      
                      @if ($a->mm_status == 'A' )
                      <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="editAgenda" href="{{ route('agenda.edit', ['agenda'=>$a->am_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Agenda Title">
                        <i class="mdi mdi-grease-pencil"></i>
                      </a>
                    
                 
                    <form id="deleteAgendaForm" action="{{ route('agenda.destroy', ['agenda'=>$a->am_id]) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteagneda" id="deleteagneda" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Agenda">
                        <i class="mdi mdi-delete"></i>
                      </button>
                   
                    </form>
                    @endif
                    
                    @endif
                  </td>
                </tr>
              
                @empty
                <tr>
                  <td colspan="6" class="text-center text-danger">
                      <b>No Result Found<b>
                  </td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>
          <div class="row mt-4">
            <div class="col-md-12 justify-content-end d-flex">
                {{ $agenda->links() }}
              
            </div>
            
        </div>
        </div>
      </div>
    </div>
        
    @endif

  </div>

   {{-- all user table end --}}

   



  </div>

@endsection

<div class="modal fade" id="manageAgendaUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
              <div class="col-md-12">
                <div class="form-group">
                    <label for="agendaUsers">Add User with this Agenda</label>
                    <select class="form-control agendaUsers @error('aum_uu_id') parsley-error @enderror w-100" id="agendaUsers" name="aum_uu_id[]" required="" multiple="multiple">
                 
              @foreach ($user as $ur)
           
                {{-- @if ($ur->um_user_type == 'U') --}}
                    <option value="{{$ur->um_id}}" {{$ur->um_user_type}}>{{ $ur->um_first_name." ".$ur->um_last_name." (".$ur->um_designation.")" }}</option>
                {{-- @endif     --}}
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