@php
$ses_um_full_name = Session::get('user')['um_full_name'];
$ses_um_id = Session::get('user')['um_id'];
$ses_um_user_type = Session::get('user')['um_user_type'];
@endphp

<h4 class="card-title text-success">Task List - {{$agenda[0]->am_title}}</h4>
<div class="table-responsive task-list">
  <table class="table">
    <thead class="">
      <tr>
        <th>Sr No</th>
        <th>Tilte</th>
        <th>Assigned To</th>
        <th>Status</th>
        <th>Attachments</th>
        <th>Action Taken </th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($agenda as $at)
      {{-- @foreach ($atskl[$a->am_id] as $at) --}}
      <tr>
        <th scope="row">{{$loop->index+1}}</th>
        <td class="text-primary">
          <b>{{ ucfirst($at->atl_title) }}</b>
        </td>
        <td class="text-danger">
          <b>{{ ucfirst($at->um_first_name." ".$at->um_last_name) }}</b>
        </td>
        <td>
          @if ($at->atl_status == 'O')
          <small class="badge badge-danger">Ongoing</small>
          @else
          <small class="badge badge-success">Completed</small>
          @endif
        </td>
        <td>
          <div class=" border-primary rounded ">
            @isset($files[$at->atl_id])
            <ul class="a" style="list-style-type:square;">
              @forelse ($files[$at->atl_id] as $fl)
              <li>
                <a href="{{ asset('uploads') }}/{{$fl->file_name}}" target="_blank">File {{$loop->index+1}}</a>
              </li>
              @empty

              @endforelse
            </ul>
            @endisset
          </div>

        </td>
        <td>
         
          <a href="javascript:void(0)" class="btn btn-inverse-info btn-sm btn-icon ml-1 agendaTaskActionList" title="Task Action" data-toggle="popover" url='{{route("agendataskaction.getAgendaActionList")}}' data-trigger="hover" data-content="Agenda Task Action Detail" atlId="{{$at->atl_id}}">
            <i class="fa fa-tasks"></i>
          </a>
         
        </td>
        <td>
          @if ($at->mm_status == 'A')
          <a href="javascript:void(0)" class="btn btn-inverse-info btn-sm btn-icon ml-1 agendaTaskcreate" title="Add Task Action" data-toggle="popover" data-trigger="hover" data-content="Action Taken on Agenda Task" atlId="{{$at->atl_id}}">
            <i class="fa fa-comment"></i>
          </a>
          @endif
          <a href="javascript:void(0)" class="btn btn-inverse-info btn-sm btn-icon ml-1 agendaTaskView" title="View Task" data-toggle="popover" data-trigger="hover" data-title="{{ ucfirst($at->atl_title) }}" data-desc="{{ ucfirst($at->atl_description) }}"  atlId="{{$at->atl_id}}">
            <i class="fa fa-eye"></i>
          </a>
          @if ($ses_um_user_type == 'A' ||  $agenda[0]->mm_um_id == $ses_um_id || $at->atl_created_by == $ses_um_id)
          @if ($at->mm_status == 'A' && $at->atl_status != 'C')
          <a href="javascript:void(0)" class="btn btn-inverse-primary btn-sm btn-icon ml-1 updateAgendaTaskStatus" title="Update Task Status" data-toggle="popover" url='{{route("agendataskaction.updateAgendaTaskS")}}' data-trigger="hover" data-content="Update Task Status" atlId="{{$at->atl_id}}">
            <i class="fa fa-check"></i>
          </a>
          @endif
          @endif
          @if ($ses_um_user_type == 'A' ||  $agenda[0]->mm_um_id == $ses_um_id || $at->atl_created_by == $ses_um_id)
          @if ($at->mm_status == 'A' && $at->atl_status != 'C')
          <a class="btn btn-inverse-primary btn-sm btn-icon ml-1 editAgendaTask" title="Edit Task"  href="{{ route('agendatask.edit',['agendatask'=>$at->atl_id])}}" data-content="Edit Task" atlId="{{$at->atl_id}}">
            <i class="fa fa-edit"></i>
          </a>
            @endif
            @endif
        </td>
      </tr>
      {{-- @endforeach --}}
      @empty
      <tr>
        <td colspan="8" class="text-center text-danger">
          <b>No Result Found<b>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="agendaTaskAction" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success text-bold" id="exampleModalLabel">Add Task Action</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="card">

            <div class="card-body boxShadow">
              <div class="row">
                <div class="col-md-12">
                  <form method="POST" action="{{ route('agendataskaction.create') }}" id="agendaActionTakenForm" data-parsley-validate="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="agendaActionTaken">Action Taken Summary</label>
                        <textarea  class="form-control agendaActionTaken @error('ata_action_taken') parsley-error @enderror" id="agendaActionTaken" placeholder="Agenda Action Taken" name="ata_action_taken" required="" data-parsley-trigger="change" rows="5"></textarea>
                        @error('ata_action_taken')
                        <small class="validate-err">{{$message}}</small>
                        @enderror

                      </div>
                      <div class="form-group">
                        <label for="agendaTaskRemark">Action Taken Detail</label>
                        <textarea  class="form-control agendaTaskRemark @error('ata_remarks') parsley-error @enderror" id="agendaActionTaken" placeholder="Agenda Task Action Remark" name="ata_remarks" data-parsley-trigger="change" rows="5"></textarea>
                        @error('ata_remarks')
                        <small class="validate-err">{{$message}}</small>
                        @enderror

                      </div>
                      <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="img[]" multiple>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        <small class="text text-danger text-bold">( Only .pdf file allowed, Max. Size 2.0 MB)</small>
                      </div>
                      <div class="col-md-12 mb-3 mt-3 boxShadow">
                        <p class="text-danger text-bold">Browse File's Name</p>
                        <div class="form-group chooseFileList">
                        </div>
                      </div>

                      <input type="hidden" name="ata_atl_id" id="agendaTaskListId">
                      <div class="col-md-12 justify-content-lg-end align-items-end
                      d-flex">
                      <input type="submit" id="agendaActionTakenSubmit" class="btn btn-success mr-2" value="Submit">

                    </div>
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





<div class="modal fade" id="agendaTaskActionListModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success text-bold" id="exampleModalLabel">Agenda Task Action List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="card">

          <div class="card-body boxShadow">

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="agendaTaskViewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success text-bold" id="exampleModalLabel">Task Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label for="agendaActionTaken">Task Title</label>
            <div class="form-control atl-title"></div>
          </div>
          <div class="form-group">
            <label for="agendaActionTaken">Task Description</label>
            <div class="form-control atl-desc"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="agendaTaskUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Update Task Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('agendataskaction.updateAgendaTaskS') }}" id="upadateAgTaskAction" data-parsley-validate="">
          {{ csrf_field() }}
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleSelectGender">Select Status</label>
              <select class="form-control" id="" name="atl_status" required="" data-parsley-trigger="change">
                <option value="">Select Status</option>
                <option value="C">Completed</option>
              </select>
            </div>
            <input type="hidden" name="atl_id" id="agendataskIdUpdate">
            <div class="col-md-12 justify-content-lg-end align-items-end
            d-flex">
            <input type="submit" id="agendaUpdateStatusSubmit" class="btn btn-success mr-2" value="Submit">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
