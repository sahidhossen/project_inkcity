

(function() {


    // Define our constructor
    this.Tab = function() {
        // Define option defaults
        var defaults = {
            ulClassName: '.tab-ul-list',
            idName:'#tab-container-holder',

        }

        // Create options by extending defaults with the passed in arugments
        if (arguments[0] && typeof arguments[0] === "object") {
            this.options = extendDefaults(defaults, arguments[0]);
        }
        // jQuery(this.options.ulClassName).find('li').
        this.click_tab();
        //console.log(this.options);
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


    Tab.prototype.click_tab = function() {
        var tabholder = jQuery(this.options.idName);

        jQuery(this.options.ulClassName).children('li').click(function(e) {
            var currentTab = "#"+$(this).data('target');
            console.log(currentTab);
            /*
             * Only active this tab name
             * */
            $(this).addClass("active").nextAll().removeClass("active");
            $(this).prevAll().removeClass("active");

            tabholder.find(''+currentTab+'').addClass("active");

            /*
             * Remove all active class for all others div
             * */
            $(currentTab).nextAll("div").removeClass("active");
            $(currentTab).prevAll("div").removeClass("active");

        })

    }


}());


/* Function for validate email id*/
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

/*
 * check if given number is number or not
 * */

function isNumber(x)
{
    var regex=/^[0-9]+$/;
    if (!x.match(regex))
        return true
}


jQuery(document).ready(function() {

    $pro = window.location.protocol;
    $host = window.location.host;
    $root = $pro +'//'+$host;
    $path = window.location.pathname;

    $str = $path.split('/');

    $str = $str.filter(function(e){ return e.replace(/(\r\n|\n|\r)/gm,"")});
    $ajaxurl = $root+'/'+$str[0]+'/includes/catch_ajax.php';
    $file_admin_path = $root+'/'+$str[0]+'/admin/file-upload.php';


    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });

    /* Welcome Tab */
    var Tab1 = new Tab({
        ulClassName:".home_settings_tab_lists",
        idName:'#home_tab_content_holder',
    });



/*
* Drag and drop system
* */
    var obj = $("#dragsandrophandler");
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

       // return false;
        //We need to send dropped files to Server
        handleFileUpload(files);

    });


//    If someone drag a file outsite of the div then igonre it

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


    jQuery("#yourregularusploadformId input[type=file]").on('change', function(e) {
        var droppedFiles = jQuery(this)[0].files,
            ThisName = jQuery(this).attr('name');

        uploadFormData = new FormData();

        if(droppedFiles.length > 0) { // checks if any files were dropped

            for(var f = 0; f < droppedFiles.length; f++) { // for-loop for each file dropped
                uploadFormData.append(ThisName,droppedFiles[f]);  // adding every file to the form so you could upload multiple files
            }
            $.ajax({
                url: $file_admin_path,
                data: uploadFormData,
                type: 'POST',
                processData: false,
                contentType: false,
                xhr: function() {  // custom xhr
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){ // check if upload property exists
                        myXhr.upload.addEventListener('progress',updateProgress, false); // for handling the progress of the upload
                    }
                    return myXhr;
                },
                    success: function (data, textStatus, jQxhr) {
                    //console.log(data);
                },
                404: function () {
                    alert("page not found");
                }
            });
        }
    })



     jQuery(document).find('.richText').froalaEditor({
        toolbarButtons: [ 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontSize', '|', 'color',  'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '-', 'insertLink', 'insertVideo', 'insertFile', 'insertTable', '|', 'quote', 'insertHR', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html']
    })


})

function updateProgress(evt) {
    if (evt.lengthComputable) {
        var percentComplete = (evt.loaded*100) / evt.total;
        console.log(percentComplete);
    } else {
        // Unable to compute progress information since the total size is unknown
        console.log('unable to complete');
    }
}

function handleFileUpload(droppedFiles)
{
    var uploadFormData = new FormData($("#yourregularuploadformId")[0]);

    if(droppedFiles.length > 0) { // checks if any files were dropped

        for(var f = 0; f < droppedFiles.length; f++) { // for-loop for each file dropped
            uploadFormData.append("files[]",droppedFiles[f]);  // adding every file to the form so you could upload multiple files
            //console.log(droppedFiles);
        }
        $.ajax({
            url: $file_admin_path,
            data: uploadFormData,
            type: 'POST',
            processData: false,
            contentType: false,
            xhr: function() {  // custom xhr
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ // check if upload property exists
                    myXhr.upload.addEventListener('progress',updateProgress, false); // for handling the progress of the upload
                }
                return myXhr;
            },
            success: function (data, textStatus, jQxhr) {
              // console.log(data);
            },
            404: function () {
                alert("page not found");
            }
        });
    }

}


jQuery(function() {

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
            reload:false,

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
                    console.log(droppedFiles[f]);
                    var fileName = droppedFiles[f].name;
                    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
                    if ($.inArray(fileNameExt, options.validExtensions) == -1){
                        jQuery(options.message).html('Sorry '+fileNameExt+" file type not allow!");
                        return false;
                    }
                }

                $.ajax({
                    url: $file_admin_path,
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
                        if(options.isSingle=='no') {
                            jQuery(options.result).find('ul').append(data);
                        }else {
                            jQuery(options.result).find('ul').html(data);
                        }
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


    var topSlide = new DragAndDropFile({
        dragArea:'#dragandrophandler',
        ajaxUrl : $file_admin_path,
        validExtensions: ['jpg','gif','png'],
        progressID: "#progressContainer",
        validExtensions: ['jpg','gif','png'],
        message : '.file_uploadmsg',
        result:'#filelist',
    });

    /*
    * Only for customer slider
    * */
    var customerSlide = new DragAndDropFile({
        dragArea: '#dragandrophandler_customer',
        formID:'#customer_slider_form',
        ajaxUrl:$file_admin_path,
        progressID: "#customer_progressContainer",
        validExtensions: ['jpg','gif','png'],
        message : '.customer_file_uploadmsg',
        result:'#customer_filelist',

    });

    /*
     * Only for pertner slider
     * */
    var customerSlide = new DragAndDropFile({
        dragArea: '#dragandrophandler_pertner',
        formID:'#pertner_slider_form',
        ajaxUrl:$file_admin_path,
        progressID: "#pertner_progressContainer",
        validExtensions: ['jpg','gif','png'],
        message : '.pertner_file_uploadmsg',
        result:'#pertner_filelist',
        reload:true,

    });

    /*
    * UPload Site Logo
    * */
    var topLogo = new DragAndDropFile({
        formID:'#logo_form',
        ajaxUrl:$file_admin_path,
        progressID: "#logo_progress",
        validExtensions: ['jpg','gif','png'],
        message : '.logo_message',
        result:'#logo_holder',
        isSingle:'yes',
    });

    /*
     * UPload Site Footer Logo
     * */
    var footerLogo = new DragAndDropFile({
        formID:'#footer_logo_form',
        ajaxUrl:$file_admin_path,
        progressID: "#footer_logo_progress",
        validExtensions: ['jpg','gif','png'],
        message : '.footer_logo_message',
        result:'#footer_logo_holder',
        isSingle:'yes',
    });

})


jQuery(document).ready(function() {


    /*
     Create tab in admin page
     ----------
     NO NEED
     ----------
     */

    jQuery(".addTab").click(function(e){
        e.preventDefault();
        var ajaxUpdate = jQuery(".ajaxUpdate");
        var targetID = jQuery("."+jQuery(this).data('target'));
        var data = '';
        targetID.find('textarea').each(function(e){
           data = jQuery(this).val();
        })
       if((targetID).find('input[name="title"]').val()==''){

          targetID.find('.error_msg').removeClass('hide');
       }else {
            var title = targetID.find('input[name=title]').val();
           $.ajax({
               url: $ajaxurl,
               data: {action: 'insert_tab', title: title, content:data },
               dataType: 'html',
               type: 'POST',
               cache: false,
               success: function (data, textStatus, jQxhr) {

                  if(data!='no'){
                      jQuery('.message-success').html('<div class="alert alert-success"> Tab Create Successfull ! </div>');
                      targetID.find('input, textarea').each(function(e){
                          jQuery(this).val('');
                      });
                      ajaxUpdate.hide().append(data).slideDown();

                      $('.richText').froalaEditor();

                  }else {
                      jQuery('.message-success').html('<div class="alert alert-danger"> There is some technical problem ! </div>');
                  }
               },
               404: function () {
                   alert("page not found");
               }
           });
       }

    });


    /*
    Delete tab
    @param : id
    ---------No NEED -----------
     */

    jQuery(document).on('click','.delete_post',function(e) {
        e.preventDefault();
        var ID = jQuery(this).data('id');
        var msg = jQuery(this).parents('.main-content');
        var tr = jQuery(this).parents('tr');
        $.ajax({
            url: $ajaxurl,
            data: {action: 'delete_tab', ID: ID },
            dataType: 'html',
            type: 'POST',
            cache: false,
            success: function (data, textStatus, jQxhr) {
                if(data=='1') {
                    msg.find(".show_msg").removeClass('hide').find('p').html("Tab Sucessfully Deleted! ");
                    tr.slideUp('slow', function(e){
                        jQuery(this).remove();
                    });
                }else {
                    console.log(data);
                }
            },
            404: function () {
                alert("page not found");
            }
        });

    });

    /*
    Update tab data
    @param : id, title, tabcontent
    --------NO NEED---------
     */

    jQuery(document).on('click','.update-panel',function(e) {
        e.preventDefault();
        var ID = jQuery(this).data('id');
        var targetID = jQuery("#update_"+ID);
        var removeTab = jQuery(this).parents('.update'),
            title = removeTab.find('input[name=title_'+ID+']').val(),
            tabContent = removeTab.find('textarea[name=tabcontent_'+ID+']').val();
        if( title!='' ) {

            $.ajax({
                url: $ajaxurl,
                data: {action: 'update_tab', ID: ID, title: title, content: tabContent},
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {
                    targetID.find('.error_msg').removeClass('hide');
                    if (data == '1') {
                        jQuery('.message-success').html('<div class="alert alert-info"> Tab Updated Successful ! </div>');

                    } else {
                        console.log(data);
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });
        }else {
            targetID.find('.error_msg').removeClass('hide');
        }

    });











    jQuery(".advanceForm").on('submit',function(e){
        //e.preventDefault();
        var title = jQuery(this).find('input[name="tab_title"]').val();

        if(title=='') {
            jQuery(this).find('.error_msg').removeClass('hide');
            return false;
        }else {
            jQuery(this).find('.error_msg').addClass('hide');
            return true;
        }
    })

/*
Insert admin email
 */
    jQuery(document).on('click','.add_admin_email',function(e) {
        e.preventDefault();
        var panel = jQuery(this).parents('.panel-body');
        panel.slideDown();
       var email = panel.find('input[type=email]').val(),
           post_id = jQuery(this).data('id');
        console.log(post_id);
        if(!isValidEmailAddress(email)){
            panel.find('.box-singnal').addClass('color-error').removeClass('color-success');
            panel.find('.box-singnal').show();
        }else {

            $.ajax({
                url: $ajaxurl,
                data: {action: 'sender_email', email_id:email, id:post_id },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {
                    panel.find('.box-singnal').hide();
                    panel.find('.box-singnal').addClass('color-error').removeClass('color-success');

                    if (data == '1') {
                       // panel.find('.message-success').removeClass('hide').html('Email Added Successfull');

                        location.reload();
                    }else if(data =='2'){
                        panel.find('.message-success').removeClass('hide').html('Email Update Successfull');
                    } else {
                        jQuery(this).attr('data-id',data);
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });
        }

    });

    /*
     Insert location map information
     */

    jQuery(document).on('click','.add_map',function(e) {
        e.preventDefault();
        var panel = jQuery(this).parents('.panel-body');
        panel.slideDown();
        var lang = panel.find('input[name=lang]').val(),
            lat = panel.find('input[name=lat]').val(),
            post_id = $(this).data('id'),
            post_target = jQuery(this).data('target');
        var clock = true;
        console.log(post_id);
        panel.find('input').each(function(e){
            if(jQuery(this).val()=='') {
                jQuery(this).next('.box-singnal').addClass('color-error').removeClass('color-success');
                jQuery(this).next('.box-singnal').show();
                clock=false;
            }else {
                jQuery(this).next('.box-singnal').addClass('color-success').removeClass('color-error');
                jQuery(this).next('.box-singnal').show();
                clock=true;
            }
        })


        if(clock==true){
            panel.find('.box-singnal').hide();
            $.ajax({
                url: $ajaxurl,
                data: {action: 'location_map', lat:lat,lang:lang, id:post_id, target:post_target },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {
                    panel.find('.box-singnal').hide();
                    panel.find('.box-singnal').addClass('color-error').removeClass('color-success');

                    if (data != 2) {
                        //panel.find('.message-success').removeClass('hide').html('Location Add Successfull!');
                        jQuery(this).attr('data-id',data);
                        location.reload();

                    }else if(data =='2'){
                        panel.find('.message-success').removeClass('hide').html('Location Update Successfull');
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });
        }

    });

    //Contact title validation

    jQuery(document).on('submit','.contactForm', function(e){
        if(jQuery(this).find('input[name=contact_title]').val() !=''){
            return true;
        }else {
            jQuery(this).find('.error_msg').removeClass('hide');
            return false;
        }
    });

    //Term title validation

    jQuery(document).on('submit','.termForm', function(e){
        if(jQuery(this).find('input[name=term_title]').val() !=''){
            return true;
        }else {
            jQuery(this).find('.error_msg').removeClass('hide');
            return false;
        }
    });
    //Contact title validation

    jQuery(document).on('submit','.tabForm', function(e){
        if(jQuery(this).find('input[name=tab_title]').val() !=''){
            return true;
        }else {
            jQuery(this).find('.error_msg').removeClass('hide');
            return false;
        }
    });
    // Social Page validation

    jQuery(document).on('submit','.socialForm', function(e){
            var clock = true;
        jQuery(this).find('select,input').each(function(e){
            if($(this).attr('name')=='social_name'){

                if($(this).val()=='0'){
                    $(this).parent('.form-box').prev('label').find('.error_msg').removeClass('hide');
                    clock = false;
                }else {
                    $(this).parent('.form-box').prev('label').find('.error_msg').addClass('hide');
                }
            }

            if($(this).attr('name')=='url'){
                if($(this).val()==''){
                    $(this).parent('.form-box').prev('label').find('.error_msg').removeClass('hide');
                    clock = false;
                }else {
                    $(this).parent('.form-box').prev('label').find('.error_msg').addClass('hide');
                }
            }
        });

      if(clock==false)
        return false;

       return true;
    })


    /*
    * Delete media from database and remove from the url
    * */
    jQuery(document).on('click','.media_trash', function (e) {
        e.preventDefault();
        var post_id = jQuery(this).parent('a').data('id');

        $.ajax({
            url: $ajaxurl,
            data: {action: 'delete_media', id:post_id, },
            dataType: 'html',
            type: 'POST',
            cache: false,
            success: function (data, textStatus, jQxhr) {
                if(data=='yes'){
                    location.reload();
                }
            },
            404: function () {
                alert("page not found");
            }
        });
    });


    /*
     Insert admin email
     */
    jQuery(document).on('click','.add_hotline',function(e) {
        e.preventDefault();
        var panel = jQuery(this).parents('.home_setting_container');

        var hotline = panel.find('input[type=text]').val();

            $.ajax({
                url: $ajaxurl,
                data: {action: 'check_hotline', hotline:hotline },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {

                    if (data == '1') {
                         panel.find('.message-success').removeClass('hide').html('Hotline Added Successfull');
                    }else if(data =='2'){
                        panel.find('.message-success').removeClass('hide').html('Hotline Update Successfull');
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });
    });


    /*
    * Google map API
    * Add google map with multiple pointer
    * */
    var points =[];
    var map = null;
    var mapTitle= jQuery('input[name=label_title]').val();
    var mapContent = jQuery('textarea[name=label_content]').val();

    jQuery(".location").on("change",function(e){
       var location =  jQuery(this).val(),
           msg = jQuery("#map_result");
            //mapTitle = " Knjižnica Kamnik ";
            //mapContent = "Ljubljanska cesta 1, 1240 Kamnik";
        $.ajax({
            url: $ajaxurl,
            data: {action: 'map_location', location:location },
            dataType: 'json',
            type: 'POST',
            success: function (results, textStatus, jQxhr) {

                jQuery('.lat').val(results['lat']);
                jQuery('.lng').val(results['lng']);
                points = [];
                 points.push( new google.maps.LatLng( parseFloat(results['lat']), parseFloat(results['lng'])));
                addMarkers_location(points);
                points = [];
            },
            404: function () {
                alert("page not found");
            }
        });

    });

    if(jQuery("#new_location").length>0){
        google.maps.event.addDomListener(window, 'load', new_location);
    }


    var lats = jQuery('.lat').val();
    var lngs = jQuery('.lng').val();

    if(lats=='' && lngs =='' && points.length == 0 ) {
        lats = -33.9;
        lngs = 151.2;

    }else {
        if(jQuery("#new_location").length>0) {
            points.push(new google.maps.LatLng(parseFloat(lats), parseFloat(lngs)));
            addMarkers_location(points);
        }
       // points = [];
    }

    function new_location(){

        var mapOptions = {
            zoom: 10,
            center: {lat: lats, lng: lngs}
        }
         map = new google.maps.Map(document.getElementById('new_location'), mapOptions);

        addMarkers_location(points);
    }


    function addMarkers_location(points) {

        // when the map is initialized and the points have been initialized, add them to the map
        console.log(points);
         if(points.length>0) {
             var marker = new google.maps.Marker({
                 map: map,
                 position: points[0],
                 animation: google.maps.Animation.DROP,
             });
             map.setCenter(marker.getPosition());

             var content = "<h3> " + mapTitle +  '</h3>'  + mapContent;

             var infowindow = new google.maps.InfoWindow()

             google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                 return function() {
                     infowindow.setContent(content);
                     infowindow.open(map,marker);
                 };
             })(marker,content,infowindow));
         }
    }

    /*
    * Animate marker
    * */
    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }


    /*
    * Valided map form before insert into database
    * */

    jQuery("#location_form").on('submit',function(e){

        var fields = jQuery(this).serializeArray();
        var clock = true;
        jQuery.each( fields, function( i, field ) {

            if( field.name!='label_content'){
                if(field.value=='') {

                    jQuery(document).find('input[name='+field.name+']').css('border','1px solid red');
                    clock = false;
                }

            }
        });

        if(clock==false) {
            return false;
        }else {
            return true;
        }

    });

    jQuery(document).on("click",".post_edit", function(e){
        e.preventDefault();
        var parent_item = jQuery(this).parents("li");
        parent_item.find('.slide_modal').fadeIn('slow');
    })


    jQuery(document).on('click','.modal_hide',function(e){
        e.preventDefault();
        jQuery(".slide_modal").fadeOut();

    });

    jQuery(document).on('click','.post_update',function(e){
        e.preventDefault();
        var post_id = jQuery(this).data('id');
       var form =  jQuery(this).parents('.slide_modal').find('form');
        var fields = form.serializeArray();

        $.ajax({
            url: $ajaxurl,
            data: {action: 'custom_slide_update', slide_fields:fields, post_id:post_id, },
            dataType: 'html',
            type: 'POST',
            success: function (results, textStatus, jQxhr) {
                console.log(results);
                if(results=='update'){
                    jQuery('.slide_modal').fadeOut();
                }else {
                    jQuery('body').html(results);
                }
            },
            404: function () {
                alert("page not found");
            }
        });
    })
})
