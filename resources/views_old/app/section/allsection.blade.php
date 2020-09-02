@extends('app.dashboard.dashboard')


@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Manage Section</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">Section Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">Manage Section</p>
          </div>
        </div>
        <div class="justify-content-end align-items-center d-flex">
          <a  href="{{ route('section.create') }}" class="btn btn-info ml-2">Add Section</a>
        </div>
      </div>
      
    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}

   <div class="row">
    {{-- <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
       <a href="{{ route('section.index') }}" class="btn btn-primary">Section List</a> 
      <a  href="{{ route('section.create') }}" class="btn btn-info ml-2">Add Section</a>
    </div> --}}
    {{-- <div class="col-md-6 justify-content-end align-items-center d-flex">
         
    </div> --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body boxShadow">
            <h4 class="card-title text-success">All Section List</h4>
            {{-- <p class="card-description">
              Add class <code>.table-hover</code>
            </p> --}}
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Section Name</th>
                    <th>S. Short Name</th>
                    <th>S. Description</th>
                    <th>D. Name</th>
                    <th>D. Short Name</th>
                    <th>S. Status</th>
                    <th>Action</th>
                 
                  </tr>
                </thead>
                <tbody>
                    @forelse ($section as $s)
                    <tr>
                    <td>
                      <b>{{($section->currentPage() - 1) * $section->perPage() + $loop->iteration}}</b>
                      {{-- {{ $loop->iteration }} --}}
                    </td>
                    <td><b>{{ ucfirst($s->sm_name) }}</b></td>
                    <td> 
                        {{ ucfirst($s->sm_short_name) }}
                    </td>
                    
                      <td> {{ ucfirst($s->sm_description) }}</td>
                      {{-- <td>{{ ucfirst($s->um_first_name.' '.$s->um_last_name)  }}</td> --}}
                      <td class="text-danger">
                        <i class="mdi mdi-email-open"></i>
                        <b>{{ ucfirst($s->dm_name) }}</b>
                      </td>
                      <td class="text-danger">
                        <i class="mdi mdi-email-open"></i>
                        <b>{{ ucfirst($s->dm_short_name) }}</b>
                      </td>
                      <td class="text-danger">
                       
                        @if ($s->sm_status == 'A' )
                        <label class="badge badge-success">Active</label>
                        @elseif($s->sm_status == 'D')
                        <label class="badge badge-danger">Delete</label>
                        @elseif($s->sm_status == 'I')
                        <label class="badge badge-warning">In Active</label>
                        @endif
                       
                      </td>
                      <td class="d-flex">
                          {{-- <button class="btn btn-inverse-success btn-sm btn-icon" title="Show" data-toggle="popover" data-trigger="hover" data-content="Show Section detail">
                              <i class="mdi mdi-eye" ></i>
                          </button> --}}
                  
                          <a class="btn btn-inverse-primary btn-sm btn-icon ml-1" id="editSection" href="{{ route('section.edit', ['section'=>$s->sm_id]) }}" title="Edit" data-toggle="popover" data-trigger="hover" data-content="Edit Section detail">
                              <i class="mdi mdi-grease-pencil"></i>
                          </a>
                        
                     
                        <form id="deleteSectionForm" action="{{ route('section.destroy', ['section'=>$s->sm_id]) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1 deleteSection" id="deleteSection" title="DELETE" data-toggle="popover" data-trigger="hover" data-content="Delete Section">
                            <i class="mdi mdi-delete"></i>
                          </button>
                        </form>
                 
                       
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
                  {{ $section->links() }}
                
              </div>
              
          </div>
          </div>
        </div>
      </div>
    </div>

   {{-- all user table end --}}



  </div>

@endsection
