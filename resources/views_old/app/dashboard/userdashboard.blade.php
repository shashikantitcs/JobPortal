@extends('app.dashboard.dashboard')

<style type="text/css">#circle {
  width: 70px;
  height:70px;
  -webkit-border-radius: 35px;
  -moz-border-radius: 35px;
  border-radius: 35px;
  background: white;


}
img.center {
display: block;
margin: 0 auto;
}</style>
@section('dyanamicpage')
<div class="content-wrapper">
    <div class="dashboard-header d-flex flex-column grid-margin">
      <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pb-3 mb-3">
        <div class="d-flex align-items-center">
         <!--  <button class="btn btn-danger btn-sm">Shubham</button> -->
          <h4 class="mb-0 font-weight-bold">Dashboard</h4>
          {{-- <button class="btn btn-inverse-info tx-12 btn-sm btn-rounded mx-3">User Master View</button> --}}
          <div class="d-none d-md-flex ml-3">
            <p class="text-muted mb-0 tx-13 cursor-pointer">Dashboard</p>
            {{-- <i class="mdi mdi-chevron-right text-muted"></i>
            <p class="text-muted mb-0 tx-13 cursor-pointer">User List</p> --}}
          </div>
        </div>
   
      </div>
      
    </div>

    {{-- include alert msg --}}
    @include('app.shared.alert-msg')
    {{-- include alert msg --}}



    <div class="row grid-margin boxShadow">
      <div class="col-12">
        <div class="card">
          <div class="row">
            <div class="col-lg-4 grid-margin grid-margin-lg-0">
              <div class="card-body">
              <img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/pending.png') }}" class="img-lg rounded" alt="profile image">
             <span>13099  Minutes</span>
               
              
              </div>
            </div>
            <div class="col-lg-4 grid-margin grid-margin-lg-0">
              <div class="card-body">
                  <img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/meeting.png') }}" class="img-lg rounded" alt="profile image">
               567  Agenda
                
               
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card-body">
                <img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/user.png') }}" class="img-lg rounded" alt="profile image">
               567  Participant
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 grid-margin stretch-card">
          <div class="card" style="background-color: #f10075;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                  <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/business.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                          <h6 class="mb-0" style="color:#fff;font-weight: bold;">Total Agenda</h6>
                      
                          <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">30    </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #800080;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                    <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/interface.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                           <h6 class="mb-0" style="color:#fff;">Agenda Completed</h6>
                         <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">25</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #B3C100;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                     <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/gear.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                          <h6 class="mb-0" style="color:#fff;">Agenda Progress</h6>
                          <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">5</p>
                      </div>
                  </div>
              </div>
          </div>

      </div>
<div class="col-md-3 grid-margin stretch-card">
            <div class="card" style="background-color: #FF0000;font-weight: bold;">
              <div class="card-body">
                  <div class="d-sm-flex d-md-block d-xl-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                    <div id="circle">
<img style="width: 50px;height: 50px;margin-top: 10px;margin-left: 10px;" src="{{ asset('assets/images/pending.png') }}" class="img-lg rounded" alt="profile image">
                </div>
                      <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                          <h6 class="mb-0" style="color:#fff;">Overdue Agenda</h6>
                          <p class="mb-0  font-weight-bold" style="color:#fff;text-align: center;font-weight: bold;">5</p>
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
  </div>




   {{-- all user table start --}}

   <div class="row">
    <div class="col-md-12 justify-content-end align-items-center d-flex mb-2">
  
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body boxShadow" style="height:350px;overflow:auto;">
              <div class="card-body">
                <h4 class="card-title">Today Agenda</h4>
               
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Meeting </th>
                        <th>Created</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Jacob</td>
                        <td>12 May 2017</td>
                        <td><label class="badge badge-danger">Overdue</label></td>
                      </tr>
                      <tr>
                        <td>Messsy</td>
                        <td>15 May 2017</td>
                        <td><label class="badge badge-warning">In progress</label></td>
                      </tr>
                      <tr>
                        <td>John</td>
                        <td>14 May 2017</td>
                        <td><label class="badge badge-info">Fixed</label></td>
                      </tr>
                      <tr>
                        <td>Peter</td>
                        <td>16 May 2017</td>
                        <td><label class="badge badge-success">Completed</label></td>
                      </tr>
                      <tr>
                        <td>Dave</td>
                        <td>20 May 2017</td>
                        <td><label class="badge badge-warning">In progress</label></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
               
              </div>
       
        </div>
      </div>

      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
        <div class="card boxShadow" style="height:350px;overflow:auto;">
          <div class="card-body">
            <h4 class="card-title">Agenda Overdue</h4>
           
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Agenda Title</th>
                    <th>Created Date</th>
                     <th>Due</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Jacob</td>
                   <td>20 May 2017</td>
                    <td>1 Day</td>
                    <td><label class="badge badge-danger">Overdue</label></td>
                  </tr>
                  <tr>
                    <td>Messsy</td>
                   <td>20 May 2017</td>
                    <td>2 Day</td>
                     <td><label class="badge badge-danger">Overdue</label></td>
                  </tr>
                  <tr>
                    <td>John</td>
                   <td>20 May 2017</td>
                    <td>1 Day</td>
                    <td><label class="badge badge-danger">Overdue</label></td>
                  </tr>
                  <tr>
                    <td>Peter</td>
                   <td>20 May 2017</td>
                    <td>9 Day</td>
                    <td><label class="badge badge-danger">Overdue</label></td>
                  </tr>
                  <tr>
                    <td>Dave</td>
                    <td>53275535</td>
                     <td>10 Day</td>
                     <td><label class="badge badge-danger">Overdue</label></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
        <div class="card boxShadow" style="height:350px;overflow:auto;">
          <div class="card-body">
            <h4 class="card-title">Total Agenda This Month</h4>
           
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Title
                    </th>
                    <th>
                      Created
                    </th>
                    <th>
                      Status
                    </th>
                    
                  </tr>
                </thead>

                <tbody>
                  <tr class="table-info">
                    <td>
                      1
                    </td>
                    <td>
                      Herman Beck
                    </td>
                     <td>
                      May 15, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                    
                   
                  </tr>
                  <tr class="table-warning">
                    <td>
                      2
                    </td>
                    <td>
                      Messsy Adam
                    </td>
                     <td>
                      July 1, 2015
                    </td>
                    <td>
                     <label class="badge badge-warning">In progress</label>
                    </td>
                   
                   
                  </tr>
                  <tr class="table-danger">
                    <td>
                      3
                    </td>
                    <td>
                      John Richards
                    </td>
                    <td>
                      Apr 12, 2015
                    </td>
                    <td>
                    <label class="badge badge-success">Completed</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-success">
                    <td>
                      4
                    </td>
                    <td>
                      Peter Meggik
                    </td>
                      <td>
                      May 15, 2015
                    </td>
                    <td>
                       <label class="badge badge-success">Completed</label>
                    </td>
                    
                  
                  </tr>
                  <tr class="table-primary">
                    <td>
                      5
                    </td>
                    <td>
                      Edward
                    </td>
                    <td>
                      May 03, 2015
                    </td>
                    <td>
                    <label class="badge badge-success">Completed</label>
                    </td>
                   
                    
                  </tr>
                   <tr class="table-info">
                    <td>
                      1
                    </td>
                    <td>
                      Herman Beck
                    </td>
                    <td>
                      May 15, 2015
                    </td>
                    <td>
                      <label class="badge badge-warning">In progress</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-warning">
                    <td>
                      2
                    </td>
                    <td>
                      Messsy Adam
                    </td>
                    <td>
                     Apr 12, 2015 
                    </td>
                    <td>
                    <label class="badge badge-warning">In progress</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-danger">
                    <td>
                      3
                    </td>
                    <td>
                      John Richards
                    </td>
                     <td>
                      Apr 12, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                   
                   
                  </tr>
                  <tr class="table-success">
                    <td>
                      4
                    </td>
                    <td>
                      Peter Meggik
                    </td>

                    <td>
                      May 15, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                  
                  </tr>
                  <tr class="table-primary">
                    <td>
                      5
                    </td>
                    <td>
                      Edward
                    </td>
                    <td>
                      May 03, 2015
                    </td>
                    <td>
                     <label class="badge badge-danger">Overdue</label>
                    </td>
                    
                    
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card boxShadow">
          <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <h4 class="card-title">This Month Agenda (20 Agenda)</h4>
            <canvas id="doughnutChart" width="710" height="355" class="chartjs-render-monitor" style="display: block; width: 568px; height: 284px;"></canvas>
          </div>
        </div>
      </div>


      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
        <div class="card boxShadow" style="height:350px;overflow:auto;">
          <div class="card-body">
            <h4 class="card-title">Previous Month Agenda</h4>
           
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Title
                    </th>
                    <th>
                      Created
                    </th>
                    <th>
                      Status
                    </th>
                    
                  </tr>
                </thead>

                <tbody>
                  <tr class="table-info">
                    <td>
                      1
                    </td>
                    <td>
                      Herman Beck
                    </td>
                     <td>
                      May 15, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                    
                   
                  </tr>
                  <tr class="table-warning">
                    <td>
                      2
                    </td>
                    <td>
                      Messsy Adam
                    </td>
                     <td>
                      July 1, 2015
                    </td>
                    <td>
                     <label class="badge badge-warning">In progress</label>
                    </td>
                   
                   
                  </tr>
                  <tr class="table-danger">
                    <td>
                      3
                    </td>
                    <td>
                      John Richards
                    </td>
                    <td>
                      Apr 12, 2015
                    </td>
                    <td>
                    <label class="badge badge-success">Completed</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-success">
                    <td>
                      4
                    </td>
                    <td>
                      Peter Meggik
                    </td>
                      <td>
                      May 15, 2015
                    </td>
                    <td>
                       <label class="badge badge-success">Completed</label>
                    </td>
                    
                  
                  </tr>
                  <tr class="table-primary">
                    <td>
                      5
                    </td>
                    <td>
                      Edward
                    </td>
                    <td>
                      May 03, 2015
                    </td>
                    <td>
                    <label class="badge badge-success">Completed</label>
                    </td>
                   
                    
                  </tr>
                   <tr class="table-info">
                    <td>
                      1
                    </td>
                    <td>
                      Herman Beck
                    </td>
                    <td>
                      May 15, 2015
                    </td>
                    <td>
                      <label class="badge badge-warning">In progress</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-warning">
                    <td>
                      2
                    </td>
                    <td>
                      Messsy Adam
                    </td>
                    <td>
                     Apr 12, 2015 
                    </td>
                    <td>
                    <label class="badge badge-warning">In progress</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-danger">
                    <td>
                      3
                    </td>
                    <td>
                      John Richards
                    </td>
                     <td>
                      Apr 12, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                   
                   
                  </tr>
                  <tr class="table-success">
                    <td>
                      4
                    </td>
                    <td>
                      Peter Meggik
                    </td>

                    <td>
                      May 15, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                  
                  </tr>
                  <tr class="table-primary">
                    <td>
                      5
                    </td>
                    <td>
                      Edward
                    </td>
                    <td>
                      May 03, 2015
                    </td>
                    <td>
                     <label class="badge badge-danger">Overdue</label>
                    </td>
                    
                    
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card boxShadow">
          <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <h4 class="card-title">Previous Month Agenda (20 Agenda)</h4>
          <canvas id="pieChart" width="710" height="355" class="chartjs-render-monitor" style="display: block; width: 568px; height: 284px;"></canvas>
        </div>
        </div>
      </div>


      <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
        <div class="card boxShadow" style="height:350px;overflow:auto;">
          <div class="card-body">
            <h4 class="card-title">Total Agenda Attanted</h4>
           
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Title
                    </th>
                    <th>
                      Created
                    </th>
                    <th>
                      Status
                    </th>
                    
                  </tr>
                </thead>

                <tbody>
                  <tr class="table-info">
                    <td>
                      1
                    </td>
                    <td>
                      Herman Beck
                    </td>
                     <td>
                      May 15, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                    
                   
                  </tr>
                  <tr class="table-warning">
                    <td>
                      2
                    </td>
                    <td>
                      Messsy Adam
                    </td>
                     <td>
                      July 1, 2015
                    </td>
                    <td>
                     <label class="badge badge-warning">In progress</label>
                    </td>
                   
                   
                  </tr>
                  <tr class="table-danger">
                    <td>
                      3
                    </td>
                    <td>
                      John Richards
                    </td>
                    <td>
                      Apr 12, 2015
                    </td>
                    <td>
                    <label class="badge badge-success">Completed</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-success">
                    <td>
                      4
                    </td>
                    <td>
                      Peter Meggik
                    </td>
                      <td>
                      May 15, 2015
                    </td>
                    <td>
                       <label class="badge badge-success">Completed</label>
                    </td>
                    
                  
                  </tr>
                  <tr class="table-primary">
                    <td>
                      5
                    </td>
                    <td>
                      Edward
                    </td>
                    <td>
                      May 03, 2015
                    </td>
                    <td>
                    <label class="badge badge-success">Completed</label>
                    </td>
                   
                    
                  </tr>
                   <tr class="table-info">
                    <td>
                      1
                    </td>
                    <td>
                      Herman Beck
                    </td>
                    <td>
                      May 15, 2015
                    </td>
                    <td>
                      <label class="badge badge-warning">In progress</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-warning">
                    <td>
                      2
                    </td>
                    <td>
                      Messsy Adam
                    </td>
                    <td>
                     Apr 12, 2015 
                    </td>
                    <td>
                    <label class="badge badge-warning">In progress</label>
                    </td>
                   
                    
                  </tr>
                  <tr class="table-danger">
                    <td>
                      3
                    </td>
                    <td>
                      John Richards
                    </td>
                     <td>
                      Apr 12, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                   
                   
                  </tr>
                  <tr class="table-success">
                    <td>
                      4
                    </td>
                    <td>
                      Peter Meggik
                    </td>

                    <td>
                      May 15, 2015
                    </td>
                    <td>
                    <label class="badge badge-danger">Overdue</label>
                    </td>
                  
                  </tr>
                  <tr class="table-primary">
                    <td>
                      5
                    </td>
                    <td>
                      Edward
                    </td>
                    <td>
                      May 03, 2015
                    </td>
                    <td>
                     <label class="badge badge-danger">Overdue</label>
                    </td>
                    
                    
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Over All Report</h4>
            <div class="flot-chart-container">
              <div id="pie-chart" class="flot-chart" style="padding: 0px;"><canvas class="flot-base" width="520" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 520.5px; height: 400px;"></canvas><canvas class="flot-overlay" width="520" height="400" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 520.5px; height: 400px;"></canvas><div class="pieLabelBackground" style="position: absolute; width: 30.0156px; height: 36px; top: 84px; left: 358.242px; background-color: rgb(250, 186, 102); opacity: 0.5;"></div><span class="pieLabel" id="pieLabel0" style="position: absolute; top: 84px; left: 358.242px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Progress<br>27%</div></span><div class="pieLabelBackground" style="position: absolute; width: 27.7188px; height: 36px; top: 315px; left: 315.391px; background-color: rgb(243, 99, 104); opacity: 0.5;"></div><span class="pieLabel" id="pieLabel1" style="position: absolute; top: 315px; left: 315.391px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Pending<br>30%</div></span>

              <div class="pieLabelBackground" style="position: absolute; width: 47.0312px; height: 36px; top: 251px; left: 103.734px; background-color: rgb(118, 193, 250); opacity: 0.5;"></div>
              <span class="pieLabel" id="pieLabel2" style="position: absolute; top: 251px; left: 103.734px;">

                  <div style="font-size:8pt; text-align:center; padding:2px; color:white;">Hold<br>20%</div></span>

                  <div class="pieLabelBackground" style="position: absolute; width: 39.9219px; height: 36px; top: 69px; left: 142.289px; background-color: rgb(99, 207, 114); opacity: 0.5;"></div><span class="pieLabel" id="pieLabel3" style="position: absolute; top: 69px; left: 142.289px;"><div style="font-size:8pt; text-align:center; padding:2px; color:white;">Completed<br>23%</div></span></div>
            </div>
          </div>
        </div>
    </div>

      

      <div class="col-lg-12 grid-margin grid-margin-lg-0 stretch-card" style="margin-top:50px;margin-bottom: 150px;">
        <div class="card boxShadow" >
          <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    
                    <div class="mt-4">
                        <p>Filter board</p>
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" checked="">
                                Project Board
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check form-check-danger">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" checked="">
                                Kamban Board
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check form-check-info">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" checked="">
                                Summary Board
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                        <div class="form-check form-check-success">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" checked="">
                                Planner Board
                                <i class="input-helper"></i>
                            <i class="input-helper"></i></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" style="height:auto;overflow:auto;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">UpComing Meeting</h4>
                            <div id="calendar" class="full-calendar fc fc-unthemed fc-ltr">
                               
                                
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
          </div>
        </div>
      </div>

    </div>

   {{-- all user table end --}}



  </div>

@endsection
