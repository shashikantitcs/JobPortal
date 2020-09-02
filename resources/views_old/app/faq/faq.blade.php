@extends('app.dashboard.dashboard')

<style>
  .card-header{
    padding: .3rem .5rem !important;
  }
</style>
@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">FAQ'S</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">User Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Home</p>
            <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">FAQ'S</p>
          
          </div>
          
        </div>
        {{-- <div class="justify-content-end align-items-center d-flex">
          <a  href="{{ route('user.create') }}" class="btn btn-info ml-2">Add User</a>
        </div> --}}
   
      </div>
      
    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}

   {{-- all user table start --}}

   <div class="row">
    <div class="col-md-12 text-center p-2 text-white bg-primary text-bold learnMomBckgrund grid-margin stretch-card learnMomBckgrund" >
        Frequently Asked Questions
    </div>
    {{-- <div class="col-lg-12 grid-margin stretch-card">
        <div class="card faqBckgrund">
          <div class="card-body boxShadow">
           
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item faqQuesCss activeVideo"
                        videoUrl="{{asset('videos/AddMeeting.mov')}}"> Learn How to add meeting ? </li>
                        <li class="list-group-item faqQuesCss"
                        videoUrl="{{asset('videos/AddAgenda.mov')}}">  Learn How to add agenda ? </li>
                        <li class="list-group-item faqQuesCss"
                        videoUrl="{{asset('videos/AgendaTaskAssign.mov')}}">  Learn How to add assign agenda task ? </li>
                        <li class="list-group-item faqQuesCss" videoUrl="{{asset('videos/UserActionTaken.mov')}}">Learn How to do action on assigned agenda task ? </li>
                     
                      </ul>
                </div>
                <div class="col-md-6">
                    <video id="video" width="100%" height="286" controls style="background: black;">
                        <source id="videoTag" src="{{asset('videos/AddMeeting.mov')}}" type="video/mp4">
                          
                        Your browser does not support the video tag.
                     </video>
                </div>
            </div>
            
            
          </div>
        </div>
      </div> --}}
    </div>

    <div class="row" style="background: linear-gradient(45deg, #5846f9 0%, #7b27d8 100%);border-radius: 10px;">
      <div class="col-md-10 offset-md-1" style="
      margin-top: 20px;margin-bottom: 53px;">
       {{-- faq start --}}
       <div id="accordion">
        <div class="card boxShadow">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h5>How to Login in MOM Software</h5>
              </button>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
             <p><strong> STEP 1:</strong> Login with Email ID and Password</p>
             <p><strong> STEP 2:</strong> If don’t have Login Credential You have Contact to you Admin.</p>
            </div>
          </div>
        </div>
        <div class="card boxShadow">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h5>How to Add the User in MOM application</h5>
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login with Admin or Meeting Admin Credential.</p>
              <p><strong> STEP 2:</strong> After Successful Login, Click on Manage User Tab Which is in Left Side.</p>
              <p><strong> STEP 3:</strong>After Clicking on Manage user Tab List of previous Added user will Appear, on right Top You will see the Add user button. Click on the Add user Button.</p>
              <p><strong> STEP 4:</strong> Form Will Appear after clicking on Add user button, Fill the form now user is created.</p>
              <p><strong> STEP 5:</strong> You can check the created user in the user list.</p>
            </div>
          </div>
        </div>
        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h5>How to Edit the User</h5>
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application.</p>
              <p><strong> STEP 2:</strong>Click on Manage user Tab</p>
              <p><strong> STEP 3:</strong>User List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the user list under the action, click on Pencil icon to Edit the User.</p>
              <p><strong> STEP 5:</strong>After changing the detail click on Update button</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the User List</p>
            </div>
          </div>
        </div>
        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <h5>How to Activate and Deactivate the User</h5>
              </button>
            </h5>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application.</p>
              <p><strong> STEP 2:</strong>Click on Manage user Tab</p>
              <p><strong> STEP 3:</strong>User List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the user list under the action, click on Pencil icon to Activate or Deactivate the User.</p>
              <p><strong> STEP 5:</strong>After clicking on Pencil icon pre field user form will appear, in which you will find drop down from that dropdown you can select the Activate or deactivate user According to requirement</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the User List</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <h5>How to Add the Department in MOM Application</h5>
              </button>
            </h5>
          </div>
          <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application with Admin Role.</p>
              <p><strong> STEP 2:</strong>Click on Manage Department Tab</p>
              <p><strong> STEP 3:</strong>Department List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>After Clicking on Manage Department Tab List of previous Added Department will Appear, on right Top You will see the Add Department button. Click on the Add Department Button.</p>
              <p><strong> STEP 5:</strong>Form Will Appear after clicking on Add Department button, Fill the form now Department is created.</p>
              <p><strong> STEP 6:</strong>You can check the created Department in the Department list.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <h5>How to Edit the Department in MOM Application</h5>
              </button>
            </h5>
          </div>
          <div id="collapseSix" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Department Tab</p>
              <p><strong> STEP 3:</strong>Department List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the Department list under the action, click on Pencil icon to Edit the Department.</p>
              <p><strong> STEP 5:</strong>After changing the detail click on Update button</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Department List</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <h5>How to Activate and Deactivate the Department</h5>
              </button>
            </h5>
          </div>
          <div id="collapseSeven" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Department Tab</p>
              <p><strong> STEP 3:</strong>Department List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the Department list under the action, click on Pencil icon to Activate or Deactivate the Department.</p>
              <p><strong> STEP 5:</strong>After clicking on Pencil icon pre field Department form will appear, in which you will find drop down from that dropdown you can select the Activate or deactivate Department According to requirement</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Department List</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                <h5>How to Add the Section in MOM application</h5>
              </button>
            </h5>
          </div>
          <div id="collapseEight" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application with Admin Role</p>
              <p><strong> STEP 2:</strong>Click on Manage Section Tab</p>
              <p><strong> STEP 3:</strong>Section List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>After Clicking on Manage Section Tab List of previous Added Section will Appear, on right Top You will see the Add Section button. Click on the Add Section Button.</p>
              <p><strong> STEP 5:</strong>Form Will Appear after clicking on Add Section button, Fill the form now Section is created.</p>
              <p><strong> STEP 6:</strong>You can check the created Section in the Section list.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                <h5>How to Edit the Section in MOM Application</h5>
              </button>
            </h5>
          </div>
          <div id="collapseNine" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Section Tab</p>
              <p><strong> STEP 3:</strong>Section List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the Section list under the action, click on Pencil icon to Edit the Section.</p>
              <p><strong> STEP 5:</strong>After changing the detail click on Update button</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Section List.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                <h5>How to Activate and Deactivate the Section</h5>
              </button>
            </h5>
          </div>
          <div id="collapseTen" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Section Tab</p>
              <p><strong> STEP 3:</strong>Section List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the Section list under the action, click on Pencil icon to Activate or Deactivate the Section.</p>
              <p><strong> STEP 5:</strong>After clicking on Pencil icon pre field Section form will appear, in which you will find drop down from that dropdown you can select the Activate or deactivate Section According to requirement</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Section List.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                <h5>How to Activate and Deactivate the Section</h5>
              </button>
            </h5>
          </div>
          <div id="collapseEleven" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Section Tab</p>
              <p><strong> STEP 3:</strong>Section List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the Section list under the action, click on Pencil icon to Activate or Deactivate the Section.</p>
              <p><strong> STEP 5:</strong>After clicking on Pencil icon pre field Section form will appear, in which you will find drop down from that dropdown you can select the Activate or deactivate Section According to requirement</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Section List.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                <h5>How to Activate and Deactivate the Section</h5>
              </button>
            </h5>
          </div>
          <div id="collapseTwelve" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Section Tab</p>
              <p><strong> STEP 3:</strong>Section List will Appear After clicking on Manage Tab.</p>
              <p><strong> STEP 4:</strong>From the Section list under the action, click on Pencil icon to Activate or Deactivate the Section.</p>
              <p><strong> STEP 5:</strong>After clicking on Pencil icon pre field Section form will appear, in which you will find drop down from that dropdown you can select the Activate or deactivate Section According to requirement</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Section List.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                <h5>How to Create the Meeting and who can create the meeting</h5>
              </button>
              <button class="btn btn-sm btn-outline-danger btn-icon-text playVideo pull-right" style="padding:0.2rem 1.6rem;"
            videourl="{{ asset('videos/AddMeeting.mov') }}">
                <i class="fa fa-play"></i> Watch Video
              </button>
            </h5>
          </div>
          <div id="collapseThirteen" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application with Admin or Meeting Role</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>After Clicking on Manage Meeting Tab List of previous Added Meeting will Appear, on right on Top You will see the Add Meeting button. Click on the Add Meeting Button.</p>
              <p><strong> STEP 5:</strong>Form Will Appear after clicking on Add Meeting button, Fill the form now Meeting is created.</p>
              <p><strong> STEP 6:</strong>You can check the created Meeting in the Meeting list.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                <h5>How to Edit the Meeting in MOM Application</h5>
              </button>
            </h5>
          </div>
          <div id="collapseFourteen" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>From the Section list under the action, click on Pencil icon to Edit the Meeting.</p>
              <p><strong> STEP 5:</strong>After changing the detail click on Update button</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Meeting List.</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFiveteen" aria-expanded="false" aria-controls="collapseFiveteen">
                <h5>Meeting Reschedule</h5>
              </button>
            </h5>
          </div>
          <div id="collapseFiveteen" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>From the Meeting list under the action, click on Eye icon after clicking on icon Meeting Schedule, meeting Detail will Appear Under Meeting Detail you will find Meeting schedule list from that list in action click the icon to Reschedule the Meeting.</p>
              <p><strong> STEP 5:</strong>After Re-schedule the meeting detail click on Submit button.</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Meeting List</p>
            </div>
          </div>
        </div>

        
        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                <h5>Meeting Close</h5>
              </button>
            </h5>
          </div>
          <div id="collapseSixteen" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>From the Meeting list under the action, click on Pencil icon to Edit the Meeting. Form will open in this form you will find Status Drop down, from this drop down select the Completed to close the meeting</p>
              <p><strong> STEP 5:</strong>After changing the detail click on Update button</p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Meeting List</p>
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                <h5>Cancel Meeting</h5>
              </button>
            </h5>
          </div>

          <div id="collapse17" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>From the Meeting list under the action, click on eye icon. After clicking the meeting schedule detail will appear, in which under Action you will find Cancel meeting icon click on that icon, after clicking on that icon a popup will come you have to choose ok.</p>
              <p><strong> STEP 5:</strong>Check the Updated Detail in the Meeting List</p>
          
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                <h5>How to Create the Agenda</h5>
              </button>
              <button class="btn btn-sm btn-outline-danger btn-icon-text playVideo pull-right" style="padding:0.2rem 1.6rem;"
            videourl="{{ asset('videos/AddAgenda.mov') }}">
                <i class="fa fa-play"></i> Watch Video
              </button>
            </h5>
          </div>

          <div id="collapse18" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>From the Meeting list under the action, click on eye icon. After clicking on that icon you will find Add Agenda button, Below Meeting Schedule detail. Click on that Add agenda Button.</p>
              <p><strong> STEP 5:</strong>
                After clicking the button below form will appear, we have to fill the form to create the
                Agenda. You can also create the multiple agenda in a single Meeting. Means single meeting
                can have multiple Agenda.
                To create the Agenda you have to fill the required field like, you have to select the meeting under which meeting your agenda will come.
                Then you have to enter the Agenda title, Agenda Description and Expected complication Date of
                agenda. Then you have to select the Department, section and user who will be involved in the
                Agenda. You can add multiple users by clicking on Add User button.
              </p>
              <p><strong> STEP 6:</strong>Check the Updated Detail in the Meeting List.
              </p>
          
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
                <h5>How to Create the Task</h5>
              </button>
              <button class="btn btn-sm btn-outline-danger btn-icon-text playVideo pull-right" style="padding:0.2rem 1.6rem;"
            videourl="{{ asset('videos/AgendaTaskAssign.mov') }}">
                <i class="fa fa-play"></i> Watch Video
              </button>
            </h5>
          </div>

          <div id="collapse19" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>From the Meeting list under the action, click on eye icon. After clicking on that icon you will find Agenda list. In agenda list under Task View you will find the eye icon click on that icon.</p>
              <p><strong> STEP 5:</strong>
                After clicking the icon Add agenda task will Appear click on that button and fill that Task.
              </p>
              <p><strong> STEP 6:</strong>After clicking on Add Agenda task below form will appear.
                In this you have to choose the meeting and the Agenda for which task is going to assign.
                Then you have to give task title, Task description, task expected compilation date and from drop down you can select the particular user to assign the task. If any document related to the task you want to upload there is also provision for that.
              </p>

               <p><strong> STEP 7:</strong>Check the Updated Detail in the Task List
              </p>
          
            </div>
          </div>
        </div>

        <div class="card boxShadow">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                <h5>How to Take the action On a Particular task?</h5>
              </button>
              <button class="btn btn-sm btn-outline-danger btn-icon-text playVideo pull-right" style="padding:0.2rem 1.6rem;"
              videourl="{{ asset('videos/UserActionTaken.mov') }}">
                  <i class="fa fa-play"></i> Watch Video
              </button>
            </h5>
          </div>

          <div id="collapse20" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p><strong> STEP 1:</strong>Login to MOM Application</p>
              <p><strong> STEP 2:</strong>Click on Manage Meeting Tab</p>
              <p><strong> STEP 3:</strong>Meeting List will Appear After clicking on Manage Meeting Tab.</p>
              <p><strong> STEP 4:</strong>From the Meeting list under the action, click on eye icon. After clicking on that icon you will find Agenda task list. In agenda task list under Action click on the icon, Popup window will appear to fill that action taken by you and click on Submit</p>
              <p><strong> STEP 5:</strong>
                Check the Updated Detail in the Task List.
              </p>
            </div>
          </div>
        </div>

        

      </div>
        {{-- faq end --}}
      </div>
    </div>

   {{-- all user table end --}}

   



  </div>

@endsection

<!-- Modal -->
<div class="modal fade VideoModal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> --}}
        <button type="button" class="close VideoClose" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <video id="videoSrcTag" width="100%" height="286" controls style="background: black;">
          <source id="videoTag" src="{{ asset('videos/AddMeeting.mov')}}" type="video/mp4">
            {{-- <source src="movie.ogg" type="video/ogg"> --}}
          Your browser does not support the video tag.
       </video>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
