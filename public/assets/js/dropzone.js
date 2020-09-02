(function($) {
    'use strict';
    // $("agendataskassign").dropzone({
    //   url: "{{URL::to('agendatask/store')}}"
    // });

    Dropzone.options.agendaTaskForm = {
        autoProcessQueue: false,
        acceptedFiles: '.pdf',
        init: function() {
            let submitButton = document.getElementById("agendataskassign");
            myDropZone = this;
            submitButton.addEventListener("click",function(){
                console.log(this.getOueuedFiles());
                myDropZone.processQueue()
            })
            // this.on("sending", function(file) {
            //     // Show the total progress bar when upload starts
            //    console.log(file);
            // });
            this.on("complete",function(){
                console.log(this.getOueuedFiles());
                console.log(this.getUploadedFiles());
                if(this.getOueuedFiles().length == 0 && this.getUploadedFiles().length == 0){
                    var _this = this;
                    _this.removeAllFiles();
                }
            })
        }
    }

    // Dropzone.options.agendaTaskForm= {
    //     // url: 'upload.php',
    //     autoProcessQueue: false,
    //     uploadMultiple: true,
    //     parallelUploads: 5,
    //     maxFiles: 5,
    //     maxFilesize: 1,
    //     acceptedFiles: '.pdf',
    //     addRemoveLinks: true,
    //     init: function() {
    //         dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
    
    //         // for Dropzone to process the queue (instead of default form behavior):
    //         document.getElementById("agendataskassign").addEventListener("click", function(e) {
    //             // Make sure that the form isn't actually being sent.
    //             e.preventDefault();
    //             e.stopPropagation();
    //             dzClosure.processQueue();
    //         });
    
    //         //send all the form data along with the files:
    //         this.on("sendingmultiple", function(data, xhr, formData) {
    //             alert("hello shubham")
    //             formData.append("firstname", jQuery("#firstname").val());
    //             formData.append("lastname", jQuery("#lastname").val());
    //             console.log(data);
    //             console.log(xhr);
    //             console.log(formData);
    //         });
    //     }
    // }

  })(jQuery);