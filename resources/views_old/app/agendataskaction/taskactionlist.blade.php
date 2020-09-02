{{-- <div class="row">
 
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body boxShadow"> --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="meetingList">
                    <thead class="">
                      <tr class="">
                        <th>Sr N.</th>
                        <th>Agenda Task Action Taken</th>
                        <th>Agenda Task Action Remark</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>File</th>
                     
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($ata as $at)
                        <tr>
                            <td>
                              <b>{{$loop->index + 1}}</b>
                            </td>
                            <td>
                                <b>{{$at->ata_action_taken}}</b>
                            </td>
                            <td>
                                <b>{{$at->ata_remarks}}</b>
                            </td>
                            <td class="text-danger">
                                <i class="fa fa-user"></i>
                                <b>{{ ucfirst($at->um_first_name.' '.$at->um_last_name)  }}
                                </b></br>
                                <i class="mdi mdi-email-open"></i>
                                <b>{{ ucfirst($at->um_email) }}</b>
                            </td>
                            <td> 
                                {{ date('d-M-Y',strtotime($at->ata_created_at)) }}
                          
                            </td>
                          <td>
                            <div class="border border-primary rounded boxShadow">
                                @isset($files[$at->ata_id])
                                <ul class="a" style="list-style-type:square;">
                                  @foreach ($files[$at->ata_id] as $fl)
                                  <li>
                                  <a href="{{ url('uploads',$fl->file_name) }}" target="_blank">File {{$loop->index+1}}</a>
                                  </li>
                                  @endforeach
                                </ul>
                                @endisset
                              </div>
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
          {{-- </div>
        </div>
      </div>
  </div> --}}