
$(document).ready(function(){

     let datePcikerOtion ={
      format: 'yyyy-mm-dd',
      startDate: '-0m',
      showOn: 'focus',
      autoclose: true,
      enableOnReadonly: true,
      todayHighlight: true,
    }
      // showUser click
      $(".deleteuser").click(function(e){
            // $("#editUserModal").modal({ "backdrop": "static" });
             showSwal('warning-message-and-cancel')
             .then((c)=>{
                   if(c){
                        $(this).closest("form").submit();
                   }
             });
      })

      $(".deleteDepartment").click(function(e){
             showSwal('warning-message-and-cancel')
             .then((c)=>{ if(c){  $(this).closest("form").submit(); } });
      })
      $(".deleteSection").click(function(e){
            showSwal('warning-message-and-cancel')
            .then((c)=>{ if(c){  $(this).closest("form").submit(); } });
     })
     $(".deleteMeeting").click(function(e){
      showSwal('warning-message-and-cancel')
      .then((c)=>{ if(c){  $(this).closest("form").submit(); } });
     })
     $(".scheduledMeetingClosed").click(function(e){
      showSwal('warning-message-and-cancel')
      .then( (c)=>{ if(c){  $(this).closest("form").submit(); } });
     });

   
    if ($(".datepicker").length) {
      $('.datepicker').datepicker(datePcikerOtion);
    }
    $('#addagendaTaskForm').on('click','#expectedCompletionDate',function(){
        
      if ($("#expectedCompletionDate").length) {
          $('#expectedCompletionDate').datepicker(datePcikerOtion).focus();
      }
    });
    // $('#addagendaTaskForm').on('click','#expectedCompletionDate',function(){
    //   if ($(".expectedCompletionDate").length) {
    //       $('#expectedCompletionDate').datepicker(datePcikerOtion);
    //   }
    // });


  
    //  if ($("#expectedCompletionDate").length) {
    //   $('.datepicker').datepicker(datePcikerOtion);
    // }
    // if ($("#agendaTaskForm .datepicker").length) {
      
    // }

    // $(document).on('click','.selectDate',function(e){
    //   let id =$(this).attr('id');
    //   // alert(id);
    //    console.log(id);
    //    $('#'+id).datepicker(datePcikerOtion);

    // })
    // if($('.expectedCompletionDate').length){
    //   // alert('hello');
    //   $('.expectedCompletionDate').datepicker({
    //     format: 'yyyy-mm-dd',
    //     startDate: '-0m',
    //     autoclose: true,
    //     enableOnReadonly: true,
    //     todayHighlight: true,
    //   });
    // }
    // $(document).click('click','.datepicker',function(){
    //   alert(this.id);
    // })


    // if ($("#inline-datepicker").length) {
    //   $('#inline-datepicker').datepicker({
    //     enableOnReadonly: true,
    //     todayHighlight: true,
    //   });
    // }
    // if ($(".inline-datepicker").length) {
    //   $('.inline-datepicker').datepicker({
    //     enableOnReadonly: true,
    //     todayHighlight: true,
    //   });
    // }
    if ($("#timepicker-example").length) {
      $('#timepicker-example').datetimepicker({
        format: 'LT',
        ignoreReadonly: true,
        format: "HH:mm",
        // disabledTimeIntervals:true,
        sideBySide: true
      });
     }
     if ($(".timepicker-example").length) {
      $('.timepicker-example').datetimepicker({
        format: 'LT',
        ignoreReadonly: true,
        format: "HH:mm",
        // disabledTimeIntervals:true,
        sideBySide: true
      });
     }
    // if ($(".datepicker-autoclose").length) {
    //   $(this).datepicker({
    //     autoclose: true
    //   });
    // }

    $(".js-example-basic-multiple-limit").select2({
      allowClear:true,
      placeholder: 'Search user ',
      maximumSelectionLength: 1
    });
    // $(".agendaDepartment").select2({
    //   allowClear:true,
    //   placeholder: 'Search Department ',

    // });
   $(".agendaSection").select2({
      allowClear:true,
      placeholder: 'Search Section ',
      // maximumSelectionLength: 1
    });

    $(".agendaUsers").select2({
      allowClear:true,
      placeholder: 'Search Users ',
    });

    $(".reScheduleMeeting").click(function(){
       $("#reScheduleMeetingForm").modal({ "backdrop": "static" });
    })

    $(".SelectMeetingAgendaTask").change(function(){
      let meetingId= $(this).val();
      // alert(meetingId);
      if(!meetingId){ alert('please select meeting id') }else{ callGetAgenda(meetingId); }
    })

    function callGetAgenda(meetingId){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: "/agendatask/getAgendaDetail",
        data: { "meetingId": meetingId },
        dataType: "json",
        success: function (res) {
          if(res.session_time_out){
            window.location = res.url;
          }
          if(res.status){
            if(res.data.length > 0){
              console.log(res.data)
              let option = '<option value='+""+'>'+'Select Agenda'+'</option>';
              for(let x of res.data){
                option +="<option value="+`${x.am_id}`+">"+x.am_title+"</option>"
              }
              $('#SelectAgendaAgendaTask').html(option);
              showSwal('auto-close','Now Select agenda !!');
            }else{
              showSwal('auto-close','Agenda Not found with this meeting !!');
            }
          }else{
            showSwal('auto-close',['Some Error','Sever error'])
          }
        }
      });
    }

    $("#removeProduct").click(function(){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


      
    })
    $("#addUserForm").click(function(){
      let userpassword = $("#userpassword").val();
      if(userpassword){
        $("#userpassword").val(SHA256(userpassword))
      }
    })
    $("#valideteUserLogin").click(function(e){
      e.preventDefault();
      let email = $("#email").val();
      // let captcha = $("#captcha").val();
      let password = $("#password").val();
      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      // return re.test(String(email).toLowerCase());
      // if(email && captcha && password){
        if(email && re.test(String(email).toLowerCase()) && password){
        $("#password").val(SHA256(password));
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          url: 'login/attemptLogin',
          // data: {email:email,password:SHA256(password),captcha:captcha},
          data: {email:email,password:password},

          dataType: "json",
          success: function (res) {
           
            if(res.session_time_out){
              window.location = res.url;
            }
            if(!res.status){
              // console.log(res.data.captcha[0]);
              let msg= ''
              if(res.code == 422){
                for(let d in res.data){
                  console.log(d);
                    msg += res.data[d][0]; 
                }
                showSwal('custom-error',msg);
              }
          
              if(res.code == 401 || res.code == 404 || res.code == 1001){
                showSwal('custom-error',res.data);
              }
              $("#password").val('');
              // $(".reset-captcha").trigger("click");
            }else if(res.status == true){
              window.location= res.data
            }
          }
        });
      }
      
    })
    $("#valideteUser").click(function(e){

      let password = $("#password").val();
      let cpassword = $("#password_confirmation").val();
      let rE = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;
      if(!password || !cpassword){
        e.preventDefault();
        alert('Please Provide all field !!!');
        return false;
      }else if(password.length < 8 || cpassword.length < 8 || !rE.test(password) || !rE.test(cpassword)){
        e.preventDefault();
          alert('New password should be minimum 8 characters including numeric and special character.');
          return false;
      }else{
        $("#password").val(SHA256(password))
        $("#password_confirmation").val(SHA256(cpassword))
        if( $("#password").val() != $("#password_confirmation").val() ){
          e.preventDefault();
          alert('New Password and Confirm password does not matched !!');
          return false;
        }
      }
     
    })

    $("#passwordreset").click(function(e){
      if(!$("#oldPassword").val() || !$("#newPassword").val() || !$("#confirmPassword").val()){
        e.preventDefault();
        alert('Please Provide all field !!!');
        return false;
      }else{
        let rE = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

        if($("#newPassword").val().length < 8 || $("#confirmPassword").val().length < 8
        || !rE.test($("#newPassword").val()) || !rE.test($("#confirmPassword").val())){
          e.preventDefault();
          alert('New password should be minimum 8 characters including numeric and special character.');
          return false;
        }
      }

      $(".newpassword").val(SHA256($("#newPassword").val()));
      $("#oldPassword").val(SHA256($("#oldPassword").val()));

      $("#confirmPassword").val(SHA256($("#confirmPassword").val()));
      let oldpassword = $("#oldPassword").val();
      let newpassword = $("#newPassword").val();
      let cpassword = $("#confirmPassword").val();
      if(newpassword != cpassword){
        e.preventDefault();
        alert('New Password and Confirm password does not matched !!');
        return false;
      }

    })



// var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
//       limit:5,
//       formPrefix : "dynamic_form",
//       normalizeFullForm : false
//   });



//   $("#dynamic_form #minus5").on('click', function(){

//     var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
//     if (initDynamicId === 2) {
//       $(this).closest('#dynamic_form').next().find('#minus5').hide();
//     }
//     $(this).closest('#dynamic_form').remove();
//   });




  // $('#usertype').change(function(){
  //   let usertype= $(this).val();
  //   if(usertype == 'D' || usertype == 'S'){

  //     $("#selectUserFOrD").show();
  //     if(usertype == 'D')  $("#selectUserFOrS").hide();
  //     if(usertype == 'S')  $("#selectUserFOrS").show();
  //   }else{

  //     $(".selectUserForDS").hide();
  //   }
  // })
  $("#selectDepartment").change(function(){
    let deptId = $(this).val();
    if(!deptId){
      showSwal('auto-close','Please select Department');
    }
      getSectionDetail(deptId)
  })
  function getSectionDetail(deptId){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: "/mom/public/user/getSectionDetail",
      data: { "sm_dm_id": deptId },
      dataType: "json",
      success: function (res) {
        if(res.session_time_out){
          window.location = res.url;
        }
        if(res.status){

          if(res.data.length > 0){
            console.log(res.data)
            let option = '<option value='+""+'>'+'Select Section'+'</option>';
            for(let x of res.data){
              option +="<option value="+`${x.sm_id}`+">"+x.sm_name+"</option>"
            }
            $('#selectSection').html(option);
            // showSwal('auto-close','Now Select agenda !!');
          }else{

            showSwal('auto-close','Section Not found !!');
          }

        }else{
          showSwal('auto-close',['Some Error','Sever error'])
        }
      }
    });
  }

  $(".agendaDepartment").change(function(){
    let deptId= $(this).val();
    let sel=$(this).attr('id');
    let i =sel.charAt(sel.length-1)
    console.log(i)
    getSectionByDepartment('getSection',deptId,i)
  })

  $(".agendaSection").change(function(){
    let id= $(this).val();
    let sel=$(this).attr('id');
    let i =sel.charAt(sel.length-1)
    console.log(i)
    getSectionByDepartment('getUser',id,i)
  })

  function getSectionByDepartment(flag,id,i){
    if(flag == 'getSection'){
      data = { "deptId": id }
    }
    if(flag == 'getUser'){
      data = { "sectId": id }
    }
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: "/mom/public/agenda/getSectionByDepartment",
      data: data,
      dataType: "json",
      success: function (res) {

        if(res.session_time_out){
          window.location = res.url;
        }
        if(res.status){
          // if(res.data.length > 0){

            if(flag == 'getSection'){
              let option = '<option value='+""+'>'+'Select Section'+'</option>';
              for(let x of res.data){
                option +="<option value="+`${x.sm_id}`+">"+x.sm_name+"</option>"
              }
              // $('#agendaSection'+i).html(option);
              $('#agendaSection').html(option);
              if( res.data.length == 0){
                showSwal('auto-close','Section Not Found !!');
              }

            }
            let useroption = '<option value='+""+'>'+'Select User'+'</option>';
            for(let y of res.user){
              useroption +="<option value="+`${y.um_id}`+">"+`${y.um_first_name} ${y.um_last_name} (${y.um_designation})`+"</option>"
            }
            // $('#agendaUsers'+i).html(useroption);
            $('#agendaUsers').html(useroption);

          // }else{
          //   if(flag == 'getSection'){
          //   showSwal('auto-close','Section Not found with this Department !!');
          //   }
          //   if(flag == 'getUser'){
          //     showSwal('auto-close','Section Not found with this Department !!');
          //   }
          // }
          if(res.user.length > 0){
            let useroption = '<option value='+""+'>'+'Select User'+'</option>';
            for(let y of res.user){
                useroption +="<option value="+`${y.um_id}`+">"+`${y.um_first_name} ${y.um_last_name} (${y.um_designation})`+"</option>"
            }
            $('#agendaUsers').html(useroption);
          }
        }else{
          showSwal('auto-close',['Some Error','Sever error'])
        }
      }
    });
  }

  $(".manageAgendaUser").click(function(){
    let agendaId= $(this).attr('agendaId')
    let url= $(this).attr('url')
    // alert(url);
    getAgendaUser(agendaId,url);
   $("#manageAgendaUserModal").modal({ "backdrop": "static" });

  })

  function getAgendaUser(agendaId,url = null){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url,
      data: {"aum_am_id":agendaId},
      dataType: "json",
      success: function (res) {
        if(res.session_time_out){
          window.location = res.url;
        }
        if(res.status){
          if(res.data.length > 0){
            let userData = '';
            for(let i=0; i < (res.data.length);i++){
              userData += `<tr>
              <th scope="row">${i+1}</th>
              <td>${res.data[i].um_first_name} ${res.data[i].um_last_name}</td>
              <td>${res.data[i].um_email}</td>
              <td>${res.data[i].dm_name}</td>
              <td>${res.data[i].sm_name}</td>`;
              if(res.data[i].mm_status == 'A' && res.editManageUser == true ){
                userData +=`<td>
                <button type="button" class="btn btn-inverse-danger btn-sm btn-icon ml-1 deleteAgendaUser" id="deleteAgendaUser" title="Delete User" data-toggle="popover" data-trigger="hover" data-content="Delete Agenda User" agendaUserId='${res.data[i].aum_id}' agendaId="${res.aum_am_id}">
                  <i class="mdi mdi-delete"></i>
                </button>
              </td>`;
             }
             userData +=`</tr>`
            }
            //alert(userData);
             $("#agendaUserList").html(userData);
             $("#manageAgendaUserForm").attr('agendaId',`${res.aum_am_id}`)
          }else{
            let userData =`<tr>
            <td colspan='4' class="text-center text-danger">
              <b>No User Found</b>
            </td>
            </tr>`;
            $("#agendaUserList").html(userData);
            $("#manageAgendaUserForm").attr('agendaId',`${res.aum_am_id}`)
          }
        }else{
          showSwal('auto-close',['Some Error','Sever error'])
        }
      }
    });
  }
$("#agendaUserList").on('click','.deleteAgendaUser',function(){
  let userId=$(this).attr('agendaUserId');
  let agendaId=$(this).attr('agendaId');
  let url = $("#manageAgendaUserModal").attr('Url');
  showSwal('warning-message-and-cancel')
      .then( (c)=>{ if(c){ deleteAgendaUser(userId,agendaId,url)  } });
})
  function deleteAgendaUser(userId,agendaId,url = null){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url,
      data: {"userId":userId,"agendaId":agendaId,"deleteAgendaUser":true},
      dataType: "json",
      async:false,
      success: function (res) {
        if(res.session_time_out){
          window.location = res.url;
        }
          if(res.status){
            showSwal('success-message');

            getAgendaUser(agendaId,res.url);
            $(".agendaUsers").val('').trigger('change')
          }
      }
    });
  }

  $("#manageAgendaUserForm").on('click','button',function(){
    console.log();
    let agendaId= $("#manageAgendaUserForm").attr('agendaId')
    let url = $("#manageAgendaUserModal").attr('Url');
    if(agendaId){
      saveagendaUsers(agendaId,url)
    }
  })



  function saveagendaUsers(agendaId,url=null){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let users = $("#manageAgendaUserForm").find('.agendaUsers').val()
    console.log(users);
    if(users.length > 0){
       $.ajax({
          type: "POST",
          url: url,
          data: {"saveagendaUsers":true,"agendaId":agendaId,"form":JSON.stringify(users)},
          dataType: "json",
          async:false,
          success: function (res) {
            if(res.session_time_out){
              window.location = res.url;
            }
           if(res.status){
              showSwal('success-message');
              getAgendaUser(agendaId,res.url);
              $(".agendaUsers").val('').trigger('change')
            }
          }
        });
    }else{
      alert('please select atleast one user');
    }
  }



var agedaUser = [];

  $("#addUserplus5").click(function(){
    let a = $("#agendaUsers").val();
    if(a.length > 0){
      a.forEach(function(item, index, arr){
        let itext =$('.agendaUsers option[value='+item+']').text();
        let user ={
          id:item,
          name:itext
        }
        const found = agedaUser.some(el => el.id == item);
        if (!found){
          // $("#addedUsers").append(`<span class="badge badge-success" id="bdg${item}">
          // <span class="selectedUsers" role="presentation" id='${item}'>×</span><span class="text">${itext}</span></span>&nbsp;&nbsp;`)
          $("#addedUsers").append(`<tr id="bdg${item}">
          <td class="text">${itext}</td>
          <td class="selectedUsers" role="presentation" id='${item}'>
          <button type="button" class="btn btn-inverse-danger btn-sm btn-icon deleteuser ml-1">
           <i class="mdi mdi-delete"></i></td></button>
          </tr>`)
          agedaUser.push(user);

          console.log(itext);
        }
      })
    }
  })
  $("#addedUsers").on('click','.selectedUsers',function(){
    let id = $(this).attr("id");
    let ind= agedaUser.findIndex(i => i.id == id);
    agedaUser.splice(ind,1);
    $('#bdg'+id).remove();
    console.log(agedaUser);
  })

  $("#agendacreate").click(function(e){
    e.preventDefault();

    // let url = $("#agendaCreateForm").attr("action");
    if(agedaUser.length > 0){
      let newaUserArry = agedaUser.map(a=> a.id);
      $('#userId').val(newaUserArry.toString());
      // let newUrl = url+"?userId="+newaUserArry.toString();
      // $("#agendaCreateForm").attr("action",newUrl);
    }
     $("#agendaCreateForm").submit();
  })



  //  get getAgendaTask in schedulemeeting page
  $(".getAgendaTask").click(function(e){
    // e.preventDefault();
    // $('html, body').animate({
    //   //scrollTop: $( $(this).attr('href') ).offset().top 
    //   scrollTop: $("#allAgendaTaskDetail").offset().top
    // }, 5000);
    let amId = $(this).attr('amId');
    let aturl =$(this).attr('aturl');
    let agendaTskBtnHideShow =$(this).attr('agbtnshow').trim();
    if(agendaTskBtnHideShow == 'true'){
      console.log('true');
      $("#addAgendaTask").show();
    }else{
      console.log('hide');
      $("#addAgendaTask").hide();
    }

    
    // if (this.hash !== "") {
    //   // Prevent default anchor click behavior
    //   event.preventDefault();

    //   // Store hash
    //   var hash = this.hash;

    //   // Using jQuery's animate() method to add smooth page scroll
    //   // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
    //   $('html, body').animate({
    //     scrollTop: $(hash).offset().top
    //   }, 200, function(){
   
    //     // Add hash (#) to URL when done scrolling (default click behavior)
    //     window.location.hash = hash;
    //   });
    // }
    
    // e.preventDefault();
   
    getAgendatask(amId,aturl);
  
   
  });

  function getAgendatask(amId,aturl){
   
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "POST",
      url: aturl,
      data: {"amId":amId},
      // dataType: "",
      success: function (res) {
        if(res.session_time_out){
          window.location = res.url;
        }
        $("#addAgendaTask").attr('amId',amId)
        $("#allAgendaTaskDetail .boxShadow").html(res);
        $("#allAgendaTaskDetail").show();
        window.scroll({
          top: 10000,
          // left: 100,
          behavior: 'smooth'
        });
        return false;
    // $('html, body').animate({ scrollTop: '100000' },1500 ,'easeInOutExpo');
    // return false;
        //console.log(res);
      }
    });
  }
  //  get getAgendaTask in schedulemeeting page


  // agendatTask action create
  $("#allAgendaTaskDetail").delegate('.agendaTaskcreate','click',function(){
    let atlId= $(this).attr('atlId');
    $("#agendaTaskAction").modal({ "backdrop": "static" });
    $("#agendaTaskListId").val(atlId);

  });
  $(document).on('click', '.agendaTaskView',function(){
    let atlId= $(this).attr('atlId');
    $(".atl-title").html($(this).data('title'));
    $(".atl-desc").html($(this).data('desc'));
    $("#agendaTaskViewModal").modal('show');
  })
  $("#allAgendaTaskDetail").delegate('#agendaActionTakenSubmit','click',function(e){
    e.preventDefault();

    let url= $("#agendaActionTakenForm").attr('action');
    let formd = $("#agendaActionTakenForm")[0];
    let formData = new FormData(formd);
    //alert(formData);
     setAgendaTaskAction(url,formData)
  })


  function setAgendaTaskAction(url,formdata){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url,
      data: formdata,
      processData: false,
      contentType: false,
      success: function (res) {
        if(res.session_time_out){
          window.location = res.url;
        }
       if(res.status){
         showSwal('success-message');
         $('#agendaTaskAction').modal('toggle');
       }else{
        showSwal('auto-close',res.msg);
       }
      }
    });
  }
  // agendatTask action create

  // get agenda task action detail
  $("#allAgendaTaskDetail").delegate('.agendaTaskActionList','click',function(){
     let atlId= $(this).attr('atlId');
     let url = $(this).attr('url');
     getAgendaTaskAction(url,atlId);
  })
  function getAgendaTaskAction(url,atlId){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url,
      data: {"ata_atl_id":atlId},
      success: function (res) {
        if(res.session_time_out){
          window.location = res.url;
        }
        $("#agendaTaskActionListModal .boxShadow").html(res);
        $("#agendaTaskActionListModal").modal({ "backdrop": "static" });
      }
    });
  }



// update agenda task status
$("#allAgendaTaskDetail").delegate('.updateAgendaTaskStatus','click',function(){
     let atlId= $(this).attr('atlId');
    $("#agendaTaskUpdate").modal({ "backdrop": "static" });
    $("#agendataskIdUpdate").val(atlId);
  //   let url= $("#upadateAgTaskAction").attr('action');
  // updateAgendaTaskStatus(url,atlId);
})
$("#allAgendaTaskDetail").delegate('#agendaUpdateStatusSubmit','click',function(e){
  e.preventDefault();

  let url= $("#upadateAgTaskAction").attr('action');
  updateAgendaTaskStatus(url);
})
function updateAgendaTaskStatus(url){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: "POST",
    url: url,
    data: $("#upadateAgTaskAction").serialize(),
    dataType: "json",
    success: function (res) {
      if(res.session_time_out){
        window.location = res.url;
      }
      if(res.status){
        showSwal('success-message');
        $('#agendaTaskUpdate').modal('toggle');
        getAgendatask(res.data.amId,res.data.aturl);
      }else{
       showSwal('auto-close',res.msg);
      }
    }
  });
}

$('#addAgendaTask').click(function(e){
  
  
  let url = $(this).attr('url');
  let amId = $(this).attr('amId')
  getAgendaTaskForm(url,{"amId":amId});
  // console.log("hello shubham");
  // return false;
  // e.preventDefault();
})

// edit agenda task detail
$("#allAgendaTaskDetail").delegate('.editAgendaTask','click',function(e){
  e.preventDefault();
  let href = $(this).attr('href');
  let amId = $(this).attr('amId')
  let atlId= $(this).attr('atlId');
  getAgendaTaskForm(href,{"atlId":atlId});
})

function getAgendaTaskForm(url,data){
  // $("#addagendaTaskForm #expectedCompletionDate").trigger("click");
 
  $.ajax({
    type: "POST",
    url: url,
    data:data,
    // dataType: "json",
    success: function (res) {
      if(res.session_time_out){
        window.location = res.url;
      }
      if(res){
        $("#addagendaTaskForm .modal-body").html(res);
    
        $("#addagendaTaskForm").modal({ "backdrop": "static" });
      
      }else{
       showSwal('auto-close',res.msg);
      }
    }
  });

}

$('#addagendaTaskForm').on('click','#agendataskassign',function(e){
  let url = $("#agendaTaskForm").attr('action');
  e.preventDefault();
  let SelectAgendaAgendaTask = $('#SelectAgendaAgendaTask').val();
  let agendaTaskTitle = $("#agendaTaskTitle").val();
  let expectedCompletionDate = $("#expectedCompletionDate").val();
  let selectUser= $("#selectUser").val();
  if(!SelectAgendaAgendaTask || !agendaTaskTitle || !expectedCompletionDate
    || !selectUser){
      alert('Please fill necessary fields');
      return false;
    }else{
      let formd = $("#agendaTaskForm")[0];
      let formData = new FormData(formd);
      saveAgendaTask(url,formData);
    }
});



function saveAgendaTask(url,formData){
  $.ajax({
    type: "POST",
    url: url,
    data:formData,
    dataType: "json",
    processData: false,
    contentType: false,
    success: function (res) {
      if(res.session_time_out){
        window.location = res.url;
      }
      if(res.status){
        showSwal('success-message');
        $('#addagendaTaskForm').modal('toggle');
        getAgendatask(res.amId,res.url)
      }else{
       showSwal('auto-close',res.msg);
      }
    }
  });
}
$('#addagendaTaskForm').on('change','input[type=file]',function(e){
  // var names = [];
  let str = '<ul class="a">';
  for (var i = 0; i < $(this).get(0).files.length; ++i) {
    str +='<li>'+$(this).get(0).files[i].name+'</li>';
      // names.push($(this).get(0).files[i].name);
  }
  str +='</ul>'
  $(".chooseFileList").html(str);
  // console.log(names);
})
$("#allAgendaTaskDetail").delegate('input[type=file]','change',function(e){
 var names = [];
  let str = '<ul class="a">';
  for (var i = 0; i < $(this).get(0).files.length; ++i) {
    str +='<li>'+$(this).get(0).files[i].name+'</li>';
      names.push($(this).get(0).files[i].name);
  }
  str +='</ul>';
  console.log(names)
  $(".chooseFileList").html(str);
})

// $("#validatedCustomFile").change(function(){
// alert('adasd')
// })
// $("input[type=file]").change(function() {

//   // $("input[name=file]").val(names);
// });

$(".list-group-item").click(function(){
  let url = $(this).attr('videoUrl');
  $('.list-group-item').removeClass('activeVideo');
  // $('#videoTag').attr('src',url);
  let video = document.getElementById('video');
  video.src = url;
  video.play();
  $(this).addClass('activeVideo');
  // $(this).addClass('activeVideo');
});

$(".playVideo").click(function(){
  let url = $(this).attr('videoUrl');
  let videoSrcTag = document.getElementById('videoSrcTag');
  videoSrcTag.src = url;
  videoSrcTag.play();
  $('.VideoModal').modal({ "backdrop": "static" });
  // $(this).addClass('activeVideo');
})

$(".VideoClose").click(function(){
  document.getElementById('videoSrcTag').pause();
})

$("#loginBtn").click(function(e){
    e.preventDefault();
    $("#loginModal").modal({ "backdrop": "static" })
}); 


$("#addImagesBtn").click(function(){
  $("#addImages").modal({ "backdrop": "static" });
})


$("#registrationBtn").click(function(){
  $("#registrationModal").modal({ "backdrop": "static" });
});

$("#ja_type").change(function(){
 
  let jaType = $(this).val();
  if(!jaType){
    $("#jobadfrom").hide();
    return false;
  }
  
  $("#jobadfrom").show();
  $('#postjobad').parsley().destroy();
      if(jaType == 'F'){
        $(".fresherJobAd").show();
        $(".deputationJobAd").hide();
        $('.fresherJobAdField').attr('data-parsley-required', 'true');
        $('.deputationJobAdField').attr('data-parsley-required', 'false');
      }
      if(jaType == 'D'){
        $(".fresherJobAd").hide();
        $(".deputationJobAd").show();
        $('.fresherJobAdField').attr('data-parsley-required', 'false');
        $('.deputationJobAdField').attr('data-parsley-required', 'true');
      }
      $('.commmanField').attr('data-parsley-required', 'true');
      $('#postjobad').parsley();
      
});

// $("#addEmployerFormBtn").click(function(){
//   let url = $("#addEmployerForm").attr('action');
//   addEmployer(url);
// });

// function addEmployer(url){
//   $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
//   $.ajax({
//     type: "POST",
//     url: url,
//     data: $("#addEmployerForm").serialize(),
//     dataType: "json",
//     success: function (res) {
//       console.log(res);
      
//      }
//     });
//   }

// var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
//             limit:10,
//             formPrefix : "dynamic_form",
//             normalizeFullForm : false
//         });

//           dynamic_form.inject([{p_name: 'title1',},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

//         $("#dynamic_form #minus5").on('chooseFileListck', function(){
//           var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
//           if (initDynamicId == 2) {
//             $(this).closest('#dynamic_form').next().find('#minus5').hide();
//           }
//           $(this).closest('#dynamic_form').remove();
//         });


//         $('#uploadingImages').click(function(event){
//           alert("asdasdds")
//           $.each($('#ajaxImagesForm').serializeArray(), function(i, field) {
//                values[field.name] = field.value;
//                console.log(values[field.name]+"dsd  "+field.value);
//           });
//         })
        // $('#uploadingImages').on('click', function(event){

        //     // event.preventDefault();
        //     var values = {};
        //     alert("asdsdasd");
        //   $.each($('#ajaxImagesForm').serializeArray(), function(i, field) {
        //       values[field.name] = field.value;
        //   });
        //    console.log(values)
        // })




        // naukari portal js

       


});
