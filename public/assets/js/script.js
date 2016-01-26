/**
 * Created by lenovo_pc on 12/10/2015.
 */

jQuery(document).ready(function(e){


    $pro = window.location.protocol;
    $host = window.location.host;
    $root = $pro +'//'+$host;
    $path = window.location.pathname;

    $str = $path.split('/');

    $str = $str.filter(function(e){ return e.replace(/(\r\n|\n|\r)/gm,"")});
    $ajaxurl = $root+'/'+$str[0]+'/includes/catch_ajax.php';
    $fileAjaxUrl = $root+'/'+$str[0]+'/public/upload-file.php';


jQuery("#register-form").submit(function(e) {
    e.preventDefault();

    var fields =  $( this ).serializeArray();
    var msg = jQuery(".message_area");
    var clock = false;
    var pass = '';
    msg.html(" ");
    jQuery.each( fields, function( i, field ) {
        if(field.name=='username'){
            if(field.value.length < 6 ){
                msg.append('<p class="error_msg"> Username Must be Greater Than 6 character! </p>');
                clock= true;
            }
        }

        if(field.name=='email_id'){
            if (!isValidEmailAddress(field.value) || field.value=='') {
                clock = true;
                msg.append('<p class="error_msg"> Please enter valied email ID ! </p>');
            }
        }

        if(field.name=='password'){
            if(field.value.length<6){
                msg.append('<p class="error_msg"> Password Must be Greater Than 6 character! </p>');
                clock= true;

            }else {
                pass = field.value;
            }
        }

        if(field.name=='confirm-password'){

            var pass = jQuery("#register-form").find('input[name="password"]').val();
            console.log(pass);
            if(field.value.length<6 || pass != field.value ){
                msg.append('<p class="error_msg"> Your password should be match !  </p>');
                clock= true;
            }
        }

    })
    if( clock == false ) {
        $.ajax({
            url: $ajaxurl,
            data: {action: 'user_registration', fields: fields},
            dataType: 'html',
            type: 'POST',
            success: function (data, textStatus, jQxhr) {
                if(data=='yes') {
                    msg.html('<div class="alert alert-success"> Registration Successfull!  </div>');
                    jQuery(this).find('input[type=text],input[type=password],input[type=email]').val('');

                }else if(data=='duplicate'){
                    msg.html('<div class="alert alert-danger">This email ID already exists ! </div>');
                }else{
                    jQuery('body').html(data);
                }
            },
            404: function () {
                alert("page not found");
            }
        });
    }

})

/*
* Message area
* */

    jQuery("#send_contact").submit(function(e) {

        var fields =  $( this ).serializeArray();
        var msg = jQuery(this).find(".message_area");
        var clock = false;

        msg.html(" ");
        jQuery.each( fields, function( i, field ) {
            if(field.name=='u_name'){
                if(field.value == '' ){
                    msg.append('<p class="error_msg"> Please type your name! </p>');
                    clock= true;
                }
            }

            if(field.name=='u_email'){
                if (!isValidEmailAddress(field.value) || field.value=='') {
                    clock = true;
                    msg.append('<p class="error_msg"> Please enter valied email ID ! </p>');
                }
            }

            if(field.name=='u_msg_type'){
                if(field.value=='0'){
                    msg.append('<p class="error_msg"> Please select message type. </p>');
                    clock= true;

                }
            }

        })
        if( clock == false ) {
            return true;
        }else {
            return false;
        }

    })

});



jQuery(document).ready(function(){

//    pagination page send


    jQuery(document).on('click','.pagination li a',function(e){
        e.preventDefault();

        var page = jQuery(this).data('page');
        var space = jQuery(".upload_data");
        console.log(page);
        $.ajax({
            url: $ajaxurl,
            data: {action: 'get_pageniation_result', page: page},
            dataType: 'html',
            type: 'POST',
            success: function (data, textStatus, jQxhr) {
                space.html(data);
            },
            404: function () {
                alert("page not found");
            }
        });

    })


    // Define our constructor
    var DragAndDropFile = function() {
        // Define option defaults
        var defaults = {
            dragArea: '#dragandrophandler',
            formID:'#yourregularuploadformId',
            ajaxUrl:'Your Ajax Url Past Here',
            progressID: "#progressContainer",
            validExtensions: ['jpg','gif','pdf'],
            message : '.file_uploadmsg',
            result:'#filelist',
            isSingle:'no',
            showParcent:false, //.percent
        };


        // Create options by extending defaults with the passed in arugments
        if (arguments[0] && typeof arguments[0] === "object") {
            this.options = extendDefaults(defaults, arguments[0]);
        }
        // jQuery(this.options.ulClassName).find('li').
        this.activateDrag() ;

        //this.avoidunnecessaryDrop();


        this.uploadFile(this.options);

    }

    // Utility method to extend defaults with user options
    function extendDefaults(source, properties) {
        var property;

        for (property in properties) {
            if (properties.hasOwnProperty(property)) {
                source[property] = properties[property];
            }
        }
        return source;
    }


    DragAndDropFile.prototype.activateDrag = function(){

        var obj = jQuery(this.options.dragArea);
        var options = this.options;

        obj.on('dragenter', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
            $(this).css('border', '2px solid #0B85A1');
        });
        obj.on('dragover', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
        });
        obj.on('drop', function (e)
        {

            $(this).css('border', '2px dotted #0B85A1');
            e.preventDefault();
            var files = e.originalEvent.dataTransfer.files;

            // If all is ok then call the server for send file into php file
            DragAndDropFile.prototype.callFileServer(files, options);

        });

    }

    DragAndDropFile.prototype.callFileServer = function(droppedFiles, options){

        var progressID = jQuery(options.progressID);

        progressID.removeClass('hide').addClass('hide');


        if( droppedFiles === 'undefined') {
            console.log('sorry')
        }else {

            var ThisForm = jQuery(options.formID),
                FieldName = ThisForm.find('input[type=file]').attr('name');

            var uploadFormData = new FormData(ThisForm[0]);

            if(droppedFiles.length > 0) { // checks if any files were dropped

                for(var f = 0; f < droppedFiles.length; f++) { // for-loop for each file dropped

                    var fileName = droppedFiles[f].name;
                    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
                    if ($.inArray(fileNameExt, options.validExtensions) == -1){
                        jQuery(options.message).html('Sorry '+fileNameExt+" file no allow!");
                        return false;
                    }

                    uploadFormData.append(FieldName,droppedFiles[f]);  // adding every file to the form so you could upload multiple files
                }

                $.ajax({
                    url: options.ajaxUrl,
                    data: uploadFormData,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    xhr: function() {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();

                        if(myXhr.upload){ // check if upload property exists

                            myXhr.upload.addEventListener('progress',function(evt){

                                //console.log(options.progressID);
                                if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded*100) / evt.total;
                                    progressID.removeClass('hide').find(".progress-bar").css('width',percentComplete+'%');

                                } else {
                                    // Unable to compute progress information since the total size is unknown
                                    console.log('unable to complete');
                                }

                            }, false); // for handling the progress of the upload
                        }
                        return myXhr;
                    },
                    success: function (data, textStatus, jQxhr) {
                        //jQuery('body').html(data);
                        if(options.isSingle=='no') {
                            jQuery(options.result).find('ul').append(data);
                        }else {
                            jQuery(options.result).find('ul').html(data);
                        }
                    },
                    404: function () {
                        alert("page not found");
                    }
                });

            }
        }
    }

    DragAndDropFile.prototype.avoidunnecessaryDrop = function(){
        var obj = jQuery(this.options.dragArea);
        $(document).on('dragenter', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
        });
        $(document).on('dragover', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
            obj.css('border', '2px dotted #0B85A1');
        });
        $(document).on('drop', function (e)
        {
            e.stopPropagation();
            e.preventDefault();
        });
    }


    DragAndDropFile.prototype.uploadFile = function(options){
        var formID = jQuery(this.options.formID);

        var progressID = jQuery(options.progressID);

        progressID.removeClass('hide').addClass('hide');

        formID.find('input[type=file]').on('change',function(e){
            var droppedFiles = jQuery(this)[0].files,
                ThisName = jQuery(this).attr('name');

            var uploadFormData = new FormData();

            if(droppedFiles.length > 0) { // checks if any files were dropped

                for (var f = 0; f < droppedFiles.length; f++) { // for-loop for each file dropped
                    uploadFormData.append(ThisName, droppedFiles[f]);  // adding every file to the form so you could upload multiple files
                   // console.log(droppedFiles[f]);
                    var fileName = droppedFiles[f].name;
                    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
                    if ($.inArray(fileNameExt, options.validExtensions) == -1){
                        jQuery(options.message).html('Sorry '+fileNameExt+" file type not allow!");
                        return false;
                    }
                }

                $.ajax({
                    url: options.ajaxUrl,
                    data: uploadFormData,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    xhr: function() {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();

                        if(myXhr.upload){ // check if upload property exists

                            myXhr.upload.addEventListener('progress',function(evt){

                                //console.log(options.progressID);
                                if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded*100) / evt.total;

                                    progressID.removeClass('hide').find(".progress-bar").css('width',percentComplete+'%');
                                    if(options.showParcent==true){
                                        progressID.find('.progress-bar').find('.percent').find('span').html(percentComplete).css('margin-left',(percentComplete-3)+'%');

                                    }
                                } else {
                                    // Unable to compute progress information since the total size is unknown
                                    console.log('unable to complete');
                                }

                            }, false); // for handling the progress of the upload
                        }
                        return myXhr;
                    },
                    success: function (data, textStatus, jQxhr) {

                         jQuery(options.result).html(data);

                        setTimeout(function(){
                            progressID.addClass('hide');
                        },5000)
                        formID[0].reset();
                    },
                    404: function () {
                        alert("page not found");
                    }
                });
            }

        })
    }




    /*

    UPLOAD FILES
     */

    var uploadFiles = new DragAndDropFile({
        ajaxUrl : $fileAjaxUrl,
        formID:'#fileploadForm',
        progressID: ".file_upload_footer_msg",
        validExtensions: ['pdf','jpg','png'],
        message : '.ajaxMsg',
        result:'#ajaxpdfList',
        showParcent:true,
    });




    /*
    Delete hisotry
    @param: change status 0 to 1
     */

    jQuery(document).on('click','.delete_file',function(e){
        var tr = jQuery(this).parents('tr');
      var id=  tr.data('id');

        $.ajax({
            url: $ajaxurl,
            data: {action: 'update_file_status', id: id},
            dataType: 'html',
            type: 'POST',
            success: function (data, textStatus, jQxhr) {
               if(data=='yes'){
                   tr.slideUp('slow').remove();
               }else {
                   console.log(data);
               }
            },
            404: function () {
                alert("page not found");
            }
        });
        e.preventDefault();
    })




    /*
     Delete hisotry
     @param: change status 0 to 1
     */

    jQuery(document).on('click','.delete_history',function(e){
        var tr = jQuery(this).parents('tr');
        var id=  tr.data('id');

        $.ajax({
            url: $ajaxurl,
            data: {action: 'update_history_status', id: id},
            dataType: 'html',
            type: 'POST',
            success: function (data, textStatus, jQxhr) {
                if(data=='yes'){
                    tr.slideUp('slow').remove();
                }else {
                    console.log(data);
                }
            },
            404: function () {
                alert("page not found");
            }
        });
        e.preventDefault();
    })

    /*
     Delete all hisotry
     @param: change status 0 to 1
     */

    jQuery(document).on('click','.clearhistory a',function(e){

        var home = jQuery(this).parents("p").next(".upload_file_info");

        $.ajax({
            url: $ajaxurl,
            data: {action: 'update_all_history_status', status: 'all'},
            dataType: 'html',
            type: 'POST',
            success: function (data, textStatus, jQxhr) {
                if(data=='yes'){
                    home.find('tbody tr').slideUp('slow').remove();
                }else {
                    console.log(data);
                }
            },
            404: function () {
                alert("page not found");
            }
        });
        e.preventDefault();
    })


    /*
    * View pdf and jpg file
    * */

})