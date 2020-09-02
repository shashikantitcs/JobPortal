@extends('app.dashboard.dashboard')


@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Manage Department</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">Department Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">Manage Department</p>
          </div>
        </div>
        <div class="justify-content-end align-items-center d-flex">
          <a  href="{{ route('department.create') }}" class="btn btn-info ml-2">Add Department</a>
        </div>
      </div>
      
    </div>


    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}

   <div class="row">
    {{-- <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
   <a href="{{ route('department.index') }}" class="btn btn-primary">Department List</a> 
      <a  href="{{ route('department.create') }}" class="btn btn-info ml-2">Add Department</a>
    </div> --}}
    {{-- <div class="col-md-6 justify-content-end align-items-center d-flex">
         
    </div> --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body boxShadow">
            <h4 class="card-title text-success">All Department List</h4>
            {{-- <p class="card-description">
              Add class <code>.table-hover</code>
            </p> --}}
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Department Name</th>
                    <th>D. Short Name</th>
                    {{-- <th>Department</th> --}}
                    <th>D. Description</th>
                    {{-- <th>D. Head</th>
                    <th>Head Email</th> --}}
                    <th>D. Status</th>
                    <th>Action</th>
                  
                  </tr>
                </thead>
                <tbody>
                    @forelse ($department as $d)
                    <tr>
                    <td>
                      <b>{{($department->currentPage() - 1) * $department->perPage() + $loop->iteration}}</b>
                      {{-- {{ $loop->iteration }} --}}
                    </td>
                    <td><b>{{ ucfirst($d->dm_name) }}</b></td>
                    <td> 
                        {{ ucfirst($d->dm_short_name) }}
                        {{-- 28.76% <i class="mdi mdi-arrow-down"></i> --}}
                    </td>
                    
                      <td> {{ ucfirst($d->dm_description) }}</td>
                      {{-- <td>{{ ucfirst($d->um_first_name.' '.$d->um_last_name)  }}</td> --}}
                      {{-- <td class="text-danger">
                        <i class="mdi mdi-email-open"></i>
                        <b>{{ ucfirst($d->um_email) }}</b>
                         @if ($u->um_status == 'A' )
                        <label class="badge badge-success">Active</label>
                        @elseif($u->um_status == 'D')
                        <label class="badge badge-warning">Delete</label>
                        @elseif($u->um_status == 'I')
                        <label class="badge badge-danger">In Active</label>
                        @endif
                       
                      </td> --}}
                      <td class="text-danger">
                       
                        @if ($d->dm_status == 'A' )
                        <label class="badge badge-success">Active</label>
                        @elseif($d->dm_status == 'D')
                        <label class="badge badge-danger">Delete</label>
                        @elseif($d->dm_status == 'I')
                        <label class="badge badge-warning">In Active</label>
                        @endif
                       
                      </td>
                      <td class="d-flex">
                          {{-- <button class="btn btn-inverse-success btn-sm btn-icon" title="Show" data-toggle="popover" data-trigger="hover" data-content="Show Department Detail">
                              <i class="mdi mdi-eye"></i>
                          </button>
                         --}}
                      
                          <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" href="{{ route('department.edit', ['department'=>$d->dm_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Department">
                              <i class="mdi mdi-grease-pencil"></i>
                          </a>
                    
                        <form id="deleteDepartmentForm" action="{{ route('department.destroy', ['department'=>$d->dm_id]) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-inverse-danger btn-sm btn-icon ml-1 deleteDepartment" id="deleteDepartment" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Delete Department">
                            <i class="mdi mdi-delete"></i>
                          </button>
                        </form>

                        <button type="button" class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="addImagesBtn" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Delete Department">
                            <i class="mdi mdi-plus"></i>
                          </button>
                 
                       
                      </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-danger">
                            <b>No Result Found<b>
                        </td>
                      </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
            <div class="row mt-4">
              <div class="col-md-12 justify-content-end d-flex">
                  {{ $department->links() }}
                
              </div>
              
          </div>
          </div>
        </div>
    </div>
  

   {{-- all user table end --}}

  </div>

  
</div>
@endsection


<div class="modal fade" id="addImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form method="POST" action="{{ route('uploadimages.upload')}}" method="POST" data-parsley-validate="" id="ajaxImagesForm" enctype="multipart/form-data">
                {{ csrf_field() }}
          <div class="form-group" id="dynamic_form">
                <div class="row">
                  <div class="col-md-3">
                      <input type="text" name="p_name" id="p_name" placeholder="Enter Product Name" class="form-control">
                  </div>
                  <div class="col-md-3">
                      <input type="file" class="form-control" name="fileName"  placeholder="Enter Product Quantity">
                  </div> 
                 <!--  <div class="col-md-4">
                     <input type="file" name="fileName" id="p_name" placeholder="Enter Product Name" class="form-control">
                      <textarea class="form-control" rows="1" name="remarks" placeholder="Enter Remarks" id="remarks"></textarea> 
                  </div> -->
                  <div class="button-group">
                      <a href="javascript:void(0)" class="btn btn-primary" id="plus5">Add More</a>
                      <a href="javascript:void(0)" class="btn btn-danger" id="minus5">Remove</a>
                  </div>
              </div>
            </div>
          <button type="submit" class="btn btn-primary" id="uploadingImages">Submit</button>
        </form>
          </div>
        </div>
        
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>