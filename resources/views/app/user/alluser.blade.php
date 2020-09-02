@extends('app.dashboard.dashboard')


@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Manage User</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">User Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">Manage User</p>
          
          </div>
          
        </div>
        <div class="justify-content-end align-items-center d-flex">
          <a  href="{{ route('user.create') }}" class="btn btn-info ml-2">Add User</a>
          </div>
   
      </div>
      
    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}

   <div class="row">
    {{-- <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
       <a href="{{ route('user.index') }}" class="btn btn-primary">User List</a> 
      <a  href="{{ route('user.create') }}" class="btn btn-info ml-2">Add User</a>
    </div> --}}
    {{-- <div class="col-md-6 justify-content-end align-items-center d-flex">
         
    </div> --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body boxShadow">
            <h4 class="card-title text-success">All User List</h4>
            {{-- <p class="card-description">
              Add class <code>.table-hover</code>
            </p> --}}
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Officer Name</th>
                    <th>Designation</th>
                    {{-- <th>Department</th> --}}
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Action</th>
                    {{-- <th>Edit</th>
                    <th>Delete</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($user as $u)
                  <tr>
                  <td>
                    <b>{{($user->currentPage() - 1) * $user->perPage() + $loop->iteration}}</b>
                    {{-- {{ $loop->iteration }} --}}
                  </td>
                  <td><b>{{ ucfirst($u->um_first_name." ".$u->um_last_name) }}</b></td>
                  <td> 
                      {{ ucfirst($u->um_designation) }}
                      {{-- 28.76% <i class="mdi mdi-arrow-down"></i> --}}
                  </td>
                  {{-- <td>
                  
                      <label class="badge badge-danger">Pending</label>
                  </td> --}}
                    <td> {{ $u->um_mobile }}</td>
                    <td class="text-danger">
                      <i class="mdi mdi-email-open"></i>
                      <b>{{ $u->um_email }}</b>
                    </td>
                    <td class="text-primary">
                      <i class="fa fa-user"></i>
                      @if ($u->um_user_type == 'A' )
                      <b>Admin</b>
                      @elseif($u->um_user_type == 'MA')
                      <b>Meeting Admin</b>
                      @elseif($u->um_user_type == 'U')
                      <b>User</b>
                      @endif
                    
                    </td>
                    <td class="text-danger">
                      @if ($u->um_status == 'A' )
                      <label class="badge badge-success">Active</label>
                      @elseif($u->um_status == 'D')
                      <label class="badge badge-warning">Delete</label>
                      @elseif($u->um_status == 'I')
                      <label class="badge badge-danger">In Active</label>
                      @endif
                     
                    </td>
                    <td class="d-flex">
                      {{-- <button type="button" class="btn btn-inverse-danger btn-icon">
                        <i class="mdi mdi-email-open"></i>
                      </button> --}}
                        {{-- <button class="btn btn-inverse-success btn-sm btn-icon accordion-toggle collapsed" id="accordion{{($user->currentPage() - 1) * $user->perPage() + $loop->iteration}}" data-toggle="collapse" data-parent="#accordion{{($user->currentPage() - 1) * $user->perPage() + $loop->iteration}}" href="#collapse{{($user->currentPage() - 1) * $user->perPage() + $loop->iteration}}" title="Show" data-toggle="popover" data-trigger="hover" data-content="Show User Detail">
                          <i class="mdi mdi-eye btn-icon-prepend"></i>
                        </button> --}}
                    
                        <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="editUser" href="{{ route('user.edit', ['user'=>$u->um_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit User">
                          <i class="mdi mdi-grease-pencil"></i>
                        </a>

                        
                   
                      <form id="deleteUserForm" action="{{ route('user.destroy', ['user'=>$u->um_id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteuser" id="deleteuser" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete User">
                          <i class="mdi mdi-delete"></i>
                        </button>
                     
                      </form>
                      
                    </td>
                  </tr>
                  {{-- hidden table row --}}
                  {{-- <tr class="hide-table-padding boxShadow" style="border-left: 9px solid #3bb001;">
                    <td colspan="7">
                      <div id="collapse{{($user->currentPage() - 1) * $user->perPage() + $loop->iteration}}" class="collapse in p-3">
                        <div class="row">
                          <div class="col-2">label</div>
                          <div class="col-6">value 1</div>
                        </div>
                        <div class="row">
                          <div class="col-2">label</div>
                          <div class="col-6">value 2</div>
                        </div>
                        <div class="row">
                          <div class="col-2">label</div>
                          <div class="col-6">value 3</div>
                        </div>
                        <div class="row">
                          <div class="col-2">label</div>
                          <div class="col-6">value 4</div>
                        </div>
                      </div>
                    </td>
                  </tr>  --}}
                   {{-- hidden table row --}}
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="row mt-4">
              <div class="col-md-12 justify-content-end d-flex">
                  {{ $user->links() }}
                
              </div>
              
          </div>
          </div>
        </div>
      </div>
    </div>

   {{-- all user table end --}}

   



  </div>

@endsection
{{-- 
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="mb-0">Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div> --}}