/**
 * Created by lenovo_pc on 12/10/2015.
 */

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



/* For popup modal */


jQuery(document).ready(function() {
    var Modal = function (msg_box) {

        this.current_target = '.'+msg_box;

        this.target_box = jQuery('#'+jQuery(this.current_target).data('target')) ;

        this.type = jQuery(this.current_target).data('type') ;

        this.trash = '.trash';


        this.show(this.target_box, this.type);

        this.close(this.target_box);

    };

    Modal.prototype.show = function(target_box, type){

        jQuery(this.current_target).click(function(e){
            //e.preventDefault();

            // if( (type =='slide') || type=='' )  {
            target_box.fadeIn().find(".popup_main").animate({
                top: '30%',
            });
            //}

            //if( type !='slide' || type !=''){
            //
            //    target_box.find(".popup_main").hide().css('top','30%');
            //
            //    target_box.fadeIn().find('.popup_main').slideDown('5000','easeOutBounce');
            //}
        })
    }

    Modal.prototype.close = function(target_box){
        jQuery(this.trash).click(function (e) {
            e.preventDefault();
            target_box.find(".popup_main").animate({
                top:'-50%'
            }, function() {
                target_box.fadeOut();
            })
        })
    }




    /*
     * Login form submition
     * @params : Get valid Email
     * @params : Get valid number
     * */

    jQuery(".form-send-code").submit(function(event) {

        var fields =  $( this ).serializeArray();
        var clock = email = mobile= false;
        var email_id ='',mobile_no='';
        jQuery.each( fields, function( i, field ) {
            if (field.name == 'email_id'){
                if (!isValidEmailAddress(field.value) || field.value=='') {
                    email = true;
                }else {
                    email_id = field.value;
                }
            }

            if( field.name == 'mobile_no'){
                if(isNumber(field.value) ||  field.value=='') {
                    mobile = true;
                }else {
                    mobile_no = field.value;
                }
            }

        });

        if(email==false || mobile == false ){
            clock = false;
        }else {
            clock=true;
        }
        if(clock == true ){
            clock=false;
            var modal = new Modal('show_warning_msg');
            jQuery(".show_warning_msg").click();
            jQuery(".form_hover").fadeIn();
        }else {


            $.ajax({
                url: $ajaxurl,
                data: {action: 'check_password_code', mobile:mobile_no, email:email_id },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {

                    //jQuery('body').append(data);

                     if(data=='yes'){

                         jQuery(this).find(".btn-txt").html("RESENT");
                         var modal = new Modal('show_allmost_done_msg');
                         jQuery(".show_allmost_done_msg").click();
                         jQuery(".form_hover").fadeOut();
                     }else {
                         clock=false;
                         var modal = new Modal('show_warning_msg');
                         jQuery(".show_warning_msg").click();
                         jQuery(".form_hover").fadeIn();
                     }
                },
                404: function () {
                    alert("page not found");
                }
            });



        }
        event.preventDefault();
    });
    /* Sending new password request*/
    jQuery(".form-change-password").submit(function(event) {

        var fields =  $( this ).serializeArray();
        var clock = false;
        var new_pass= '',
            code = '',
            re_pass = '';
        jQuery.each( fields, function( i, field ) {

            if(field.value=='') {
                clock = true;
                console.log("empty");
            }

            if (field.name == 'code'){
                if (isNumber(field.value)) {
                    clock = true;
                }else {
                    code = field.value;
                }
            }

            if(field.name=='new_pass')
                new_pass = field.value;

            if(field.name=='re_pass')
                re_pass = field.value;

        });

        if(clock == false && new_pass==re_pass ){

            $.ajax({
                url: $ajaxurl,
                data: {action: 'reset_password', pass:new_pass,code:code },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {

                     if(data=='yes') {

                         var modal = new Modal('show_success_msg');
                         jQuery(".show_success_msg").click();
                     }else {
                         clock=false;
                         var modal = new Modal('show_error_msg');
                         jQuery(".show_error_msg").click();
                     }
                },
                404: function () {
                    alert("page not found");
                }
            });

        }else {
            clock=false;
            var modal = new Modal('show_error_msg');
            jQuery(".show_error_msg").click();
        }
        event.preventDefault();
    })



    /*
    * Send a code for change the email id
    * Store the code into the $_session variable
    * */

    jQuery(".get_code").click(function(event) {
        event.preventDefault();
        var new_email = current_email= '';
        var form = jQuery(this).parents('form.send_code_email');
        var fields =  form.serializeArray();
        var errormsg = jQuery(this).parents(".send_code_email").find(".login_error");
        var clock = false;
        jQuery.each( fields, function( i, field ) {
            if(field.name!='email_varification_code') {
                if (field.value != '') {
                    if (!isValidEmailAddress(field.value)) {
                        clock = true;

                    }
                } else {
                    clock = true;
                }

                if(field.name=='current_email'){
                    current_email = field.value;
                }
                if(field.name=='new_email'){
                   new_email = field.value;
                }
            }
        });

        if(clock == true ){
            clock=false;
            var modal = new Modal('get_invalid_msg');
            jQuery(".get_invalid_msg").click();
        }else {

            $.ajax({
                url: $ajaxurl,
                data: {action: 'varified_email_change', new_email:new_email,current_email : current_email },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {

                    jQuery('body').append(data);

                    if(data=='yes') {
                        errormsg.fadeOut();
                        var modal = new Modal('allmost_done_msg');

                        jQuery(".active_account").html(new_email);
                        jQuery(".allmost_done_msg").click();

                    }else {
                        errormsg.html("Please type valied email address!").fadeIn();
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });

        }

    });

    /*
     * Show success message if passsword changed
     * Argument is varification code
     *
     * Send Ajax request for each valied (mobile and email)
     * */

    //jQuery("input[name='email_change'], input[name='mobile_change']").click(function(e) {
    jQuery("input[name='email_change']").click(function(e) {
        e.preventDefault();
        var varification_code  = jQuery(this).parents('form').find('.varification_code').val();

        //Check if the varification code is matched to your send code
        console.log(varification_code);
        if(varification_code.length !='' ){

            $.ajax({
                url: $ajaxurl,
                data: {action: 'change_email', code:varification_code },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {

                    //jQuery('body').append(data);

                    if(data=='yes') {

                        var modal = new Modal("email_change_success");
                        jQuery(".email_change_success").click();
                        jQuery(document).find(".change_success_full_msg").html('Email Change Success Full !');

                    }else {
                        var modal = new Modal("email_change_code_invalied");
                        jQuery(".email_change_code_invalied").click();
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });



        }else {
            var modal = new Modal("email_change_code_invalied");
            jQuery(".email_change_code_invalied").click();
        }

    });

    jQuery("input[name='mobile_change']").click(function(e) {
        e.preventDefault();
        var varification_code  = jQuery(this).parents('form').find('.varification_code').val();

        //Check if the varification code is matched to your send code
        if(varification_code.length !=''){

            $.ajax({
                url: $ajaxurl,
                data: {action: 'change_mobile', code:varification_code },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {

                    //jQuery('body').append(data);

                    if(data=='yes') {

                        var modal = new Modal("email_change_success");
                        jQuery(".email_change_success").click();
                        jQuery(document).find(".change_success_full_msg").html('Mobile Change Success Full !');

                    }else {
                        var modal = new Modal("email_change_code_invalied");
                        jQuery(".email_change_code_invalied").click();
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });

        }else {
            var modal = new Modal("email_change_code_invalied");
            jQuery(".email_change_code_invalied").click();
        }

    });

    jQuery("#activate_registration input[name='activate_confirm']").on('change', function(e) {
        var message = jQuery(this).next(".input-group-addon");
        if(jQuery(this).val().length == 7 ){
            jQuery(this).css('border-color','#9bcc70');
            message.show().removeClass('box-singnal-error').addClass('box-singnal');
            message.find('.fa').removeClass('fa-times').addClass('fa-check');
        }else {
            jQuery(this).css('border-color','#ED1C24');
            message.show().removeClass('box-singnal').addClass('box-singnal-error');
            message.find('.fa').removeClass('fa-check').addClass('fa-times');
        }
    });

    /*
     * Open resent message box
     * */




    jQuery(document).on('click','.varification_resend',function(e){
        e.preventDefault();
        var modal = new Modal("varification_resend_next");
        $.ajax({
            url: $ajaxurl,
            data: {action: 'resend_varification', status:'progress' },
            dataType: 'html',
            type: 'POST',
            cache: false,
            success: function (data, textStatus, jQxhr) {
                jQuery('body').append(data);
                jQuery('.varification_resend_next').click();
            },
            404: function () {
                alert("page not found");
            }
        });
    })

    jQuery("#activate_registration").submit(function(e) {
        e.preventDefault();

        var code =  jQuery(this).find("input[name='activate_confirm']").val();

        if(code !='' ){
            $.ajax({
                url: $ajaxurl,
                data: {action: 'registration_confirm', code:code },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {
                    jQuery('body').html(data);
                    if(data == 'yes' ){
                        var modal = new Modal("registration_success");
                        jQuery(".registration_success").click();
                    }else {
                        var modal = new Modal("get_invalid_msg_pass");
                        jQuery(".get_invalid_msg_pass").click();
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });
        }



    })
    /* Send current code for mobile*/
    jQuery(".get_code_no").click(function(event) {
        event.preventDefault();
        var new_mobile = current_mobile = '';
        var form = jQuery(this).parents('form.send_code_mobile');
        var fields =  form.serializeArray();

        var clock = false;
        jQuery.each( fields, function( i, field ) {

            if (field.value != '' ){
                if (isNumber(field.value) || field.value=='') {
                    clock = true;
                }
            }else {
                clock=true;
            }
            if(field.name=='new_mobile')
                new_mobile = field.value;

            if(field.name=='current_mobile')
                current_mobile = field.value;
        });

        if(clock == true ){
            clock=false;
            var modal = new Modal('get_invalid_msg');
            jQuery(".get_invalid_msg").click();
        }else {

            $.ajax({
                url: $ajaxurl,
                data: {action: 'varified_mobile_no', new_mobile:new_mobile, current_mobile : current_mobile },
                dataType: 'html',
                type: 'POST',
                cache: false,
                success: function (data, textStatus, jQxhr) {

                    jQuery('body').append(data);

                    if(data=='yes') {
                        var modal = new Modal('allmost_done_msg');

                        jQuery(".active_account").html(new_mobile);
                        jQuery(".allmost_done_msg").click();

                    }else {
                        clock=false;
                        var modal = new Modal('get_invalid_msg');
                        jQuery(".get_invalid_msg").click();
                    }
                },
                404: function () {
                    alert("page not found");
                }
            });


        }

    });

    jQuery(".change_password").submit(function(event) {
        event.preventDefault();
        var new_pass = '';
        var renew_pass = '';
        var current_pass = '';
        var fields =   jQuery(this).serializeArray();

        var clock = false;
        jQuery.each( fields, function( i, field ) {

            if (field.value == '' || field.value.length < 6 ) {
                clock=true;
            }
            if(field.name=='new_password')
                new_pass = field.value;
            if(field.name=='re_new_pass')
                renew_pass = field.value;

            if(field.name=='current_password')
                current_pass = field.value;
        });

        if(clock == true ){
            clock=false;
            var modal = new Modal('get_invalid_msg_pass');
            jQuery(".get_invalid_msg_pass").click();

        }else {

            if(new_pass == renew_pass ) {

                $.ajax({
                    url: $ajaxurl,
                    data: {action: 'change_user_loged_pass', new_pass:new_pass, current_pass : current_pass },
                    dataType: 'html',
                    type: 'POST',
                    cache: false,
                    success: function (data, textStatus, jQxhr) {

                        //jQuery('body').append(data);

                        if(data=='yes') {
                            var modal = new Modal('success_msg');

                            jQuery(".success_msg").click();
                            jQuery(document).find(".change_success_full_msg").html("Password Reset Successful ! ");

                        }else {
                            var modal = new Modal('get_invalid_msg_pass');
                            //jQuery(".sendMessage").html('Please Match your password!');
                            jQuery(".get_invalid_msg_pass").click();
                        }
                    },
                    404: function () {
                        alert("page not found");
                    }
                });



            }else {
                var modal = new Modal('get_invalid_msg_pass');
                //jQuery(".sendMessage").html('Please Match your password!');
                jQuery(".get_invalid_msg_pass").click();
            }
        }



    });


    /*
     * Varification code validation
     * */

    //jQuery(".varification_code").keypress(function() {
    jQuery(".varification_code").on('keypress change', function() {
        var code= jQuery(this).val();
        if(code !='' && code.length==7 ){
            jQuery(this).prev().show();
        }else {
            jQuery(this).prev().hide();
        }
    });



    jQuery("#profile input").on('change',function(e) {
        e.preventDefault();
        var values =  jQuery(this).val(),
            message = jQuery(this).next(".input-group-addon"),

            name = jQuery(this).attr('name');

        if(values.length < 6 ){
            jQuery(this).css("border-color","red");
        }else {
            jQuery(this).css("border-color","green");
        }

        if(name=='current_email' || name=='new_email') {
            var errormsg = jQuery(this).parents(".send_code_email").find(".login_error");

            if(!isValidEmailAddress(values)) {
                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                errormsg.html("Please type valied email address!").fadeIn();
                message.find('.fa').removeClass('fa-check').addClass('fa-times');

            }else {
                jQuery(this).css('border-color', '#398439');
                errormsg.fadeOut();
                message.show().removeClass('box-singnal-error').addClass(' box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='current_mobile' || name=='new_mobile') {
            var errormsg = jQuery(this).parents(".send_code_mobile").find(".login_error");
            if(isNumber(values)) {
                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                errormsg.html("Only numerice character allow for this field.").fadeIn();
                message.find('.fa').removeClass('fa-check').addClass('fa-times');

            }else {
                jQuery(this).css('border-color', '#398439');
                errormsg.hide();
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='current_password' || name=='new_password' || name=='re_new_pass'){
            var errormsg = jQuery(this).parents(".change_password").find(".login_error");
            if(values.length<6){
                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                errormsg.html("Password should be greater than 6 character!").fadeIn();
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {

                if(name=='re_new_pass'){
                    var newpss = jQuery(document).find('input[name="new_password"]').val();
                    if(newpss==values){
                        jQuery(this).css('border-color', '#398439');
                        errormsg.fadeOut();
                        message.show().removeClass('box-singnal-error').addClass('box-singnal');
                        message.find('.fa').removeClass('fa-times').addClass('fa-check');
                    }else{
                        jQuery(this).css('border-color', '#ED1C24');
                        errormsg.html("Please Re-check your password!").fadeIn();
                        message.show().removeClass('box-singnal').addClass('box-singnal-error');
                        message.find('.fa').removeClass('fa-check').addClass('fa-times');
                    }
                }else {
                    jQuery(this).css('border-color', '#398439');
                    errormsg.fadeOut();
                    message.show().removeClass('box-singnal-error').addClass('box-singnal');
                    message.find('.fa').removeClass('fa-times').addClass('fa-check');
                }

            }
        }

    })


    jQuery(".upload").click(function(e) {
        e.preventDefault();
        jQuery(this).next(".fileupload").click();
        return false;
    })

    jQuery(".fileupload").on("change", function(e) {

        var sizeinbytes = jQuery(this)[0].files[0].size;
        var totalFile = jQuery(this)[0].files.length

        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
        var fSize = sizeinbytes; var i=0;
        while(fSize>900){fSize/=1024;i++;}

        jQuery(".file_upload_footer_msg .show_length").html((Math.round(fSize*100)/100)+' '+fSExt[i]);
        jQuery(".file_upload_footer_msg .totalFile").html(totalFile);
        jQuery(".file_upload_footer_msg").fadeIn();
    });

    jQuery('.file_upload_footer_msg .btn-cancel').click(function(e) {
        e.preventDefault();
        jQuery(this).parents(".file_upload_footer_msg").fadeOut();
    })

})

$(document).ready(function() {

    $("#home-slide").owlCarousel({

        //navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        responsive: true,

        // "singleItem:true" is a shortcut for:
        // items : 1,
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false

    });


    $("#customer-slide").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        pagination:false,
        navigation:true,
        navigationText:["<",">"],
        items : 3,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        autoplay:false

    });

    $("#sponser-slide").owlCarousel({

        //autoPlay: 2500, //Set AutoPlay to 3 seconds
        pagination:false,
        navigation:true,
        navigationText:["<",">"],
        items : 3,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        autoplay:true

    });
    /* Welcome Tab */
    var Tab1 = new Tab({
        ulClassName:".tab_lists",
        idName:'#content_holder',
    });

    /* Admin Tab */
    var Tab1 = new Tab({
        ulClassName:".admin_tab_list",
        idName:'#admin_tab_holder',
    });

    /* Admin Tab */
    var Tab1 = new Tab({
        ulClassName:".dropdown-menu",
        idName:'#admin_tab_holder',
    });


    jQuery(".advantage, .printbox").click(function() {
        jQuery(".advantage-content").slideToggle();

    });


    jQuery(".show_search").click(function() {
        jQuery(this).next(".pagination_search").fadeToggle('fast','easeOutBounce');
    })


    jQuery("#sponser-slide .item").click(function(e) {
        jQuery(this).parent().nextAll().find(".item-message").fadeOut();
        jQuery(this).parent().prevAll().find(".item-message").fadeOut();
        if(e.target.className == '' || e.target.className !='close-message') {
            jQuery(this).find(".item-message").fadeIn();
        }
    })
    jQuery(".close-message").click(function(e) {

        jQuery(this).parents('.item-message').fadeOut();
    });



    $('.navmenu li a[href*=#]').click(function(event){
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 1000,'easeInQuart');
        event.preventDefault();
    });


    /* Login form validation */


    jQuery("#loginform").submit(function(e){

        var clock = email = phone = false ;
        var emailID = phoneNo = '';
        var fields = jQuery(this).serializeArray();

        jQuery.each( fields, function( i, field ) {

            if(field.name=='email'){
                if(!isValidEmailAddress(field.value) || field.value=='') {
                    email = true;
                }else {
                    emailID = field.value;
                }
            }

            if(field.name=='mobile'){
                if(isNumber(field.value) || field.value.length < 5 ) {
                    phone = true;
                }else {
                    phoneNo = field.value;
                }
            }

            if(field.name=='password'){
                if(field.value.length < 6)
                    clock = true;
            }

            if(field.name=='re_password'){
                var pass = jQuery(document).find('input[name="password"]').val();

                if(field.value.length<6 || field.value != pass ){
                    clock=true;

                }
            }

        });

        if(email==false || phone==false) {

            if(clock==false){

                if(jQuery(document).find('.iagree').length > 0 ){
                    if(jQuery(document).find('.iagree').is(':checked')){
                        $.ajax({
                            url: $ajaxurl,
                            data: {action: 'checkDuplicatMail', uemail: emailID, phone:phoneNo },
                            dataType: 'json',
                            type: 'POST',
                            context: this,
                            success: function (data, textStatus, jQxhr) {
                                if(data.status=='0') {
                                    jQuery(".login_error").fadeIn().find('p').html(data.message);
                                    return false;
                                }else {
                                    this.submit();
                                }

                            },
                            404: function () {
                                alert("page not found");
                            }
                        });

                        return false;
                    }else {
                        jQuery(".login_error").fadeIn().find('p').html('Accept our term and condition!');
                        return false;
                    }

                }else {
                    return true;
                }

            }else {
                jQuery(".login_error").fadeIn().find('p').html('* Your Mobile/Email or password not valied !');
                return false;
            }
        }else {
            jQuery(".login_error").fadeIn().find('p').html('* Your Mobile/Email or password not valied !');
            return false;
        }

    })

    /* Registration form submission */

    jQuery(".register_form input").on('change',function(e){

        e.preventDefault();
        var env = jQuery('.env'),
            mob = jQuery(".mob");

        var clock = false;

        var message = jQuery(this).next(".input-group-addon");
        var values =  jQuery(this).val(),
            name = jQuery(this).attr('name');



        if(name=='email'){
            if(!isValidEmailAddress(values)){

                jQuery(this).css('border-color', '#ED1C24');
                env.removeClass('success-signal').addClass("error-signal");
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');

            }else {

                env.removeClass("error-signal").addClass("success-signal");
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='mobile'){
            if(isNumber(values) || values.length<6){

                jQuery(this).css('border-color', '#ED1C24');
                mob.removeClass('success-signal').addClass("error-signal");
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {
                mob.removeClass("error-signal").addClass("success-signal");
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='password'){
            if(values.length<6){
                jQuery(this).css('border-color', '#ED1C24');
                jQuery(this).prev().removeClass('success-signal').addClass("error-signal");
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {
                jQuery(this).prev().removeClass("error-signal").addClass("success-signal");
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='re_password'){
            var pass_field = jQuery(document).find('input[name="password"]'),
                pass_value = pass_field.val();

            if(pass_value==''){
                jQuery(this).css('border-color', '#ED1C24');
                jQuery(this).prev().removeClass('success-signal').addClass("error-signal");
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
                pass_field.focus();
            }else {
                if(pass_value == values ){
                    jQuery(this).prev().removeClass("error-signal").addClass("success-signal");
                    jQuery(this).css('border-color', '#398439');
                    message.show().removeClass('box-singnal-error').addClass('box-singnal');
                    message.find('.fa').removeClass('fa-times').addClass('fa-check');
                }else {
                    jQuery(this).css('border-color', '#ED1C24');
                    jQuery(this).prev().removeClass('success-signal').addClass("error-signal");
                    message.show().removeClass('box-singnal').addClass('box-singnal-error');
                    message.find('.fa').removeClass('fa-check').addClass('fa-times');
                }
            }
        }

    })


    /*
     * Validate login form
     * input email, mobile, and password
     * */

    jQuery("#loginform input").on('change',function(e){
        e.preventDefault();
        var env = jQuery('.env'),
            mob = jQuery(".mob");
        var message = jQuery(this).next(".input-group-addon");
        var values =  jQuery(this).val(),
            name = jQuery(this).attr('name');

        if(name=='email'){

            if(!isValidEmailAddress(values)){

                jQuery(this).css('border-color', '#ED1C24');
                env.removeClass('success-signal').addClass("error-signal");
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');

            }else {
                env.removeClass("error-signal").addClass("success-signal");
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='mobile'){

            if(isNumber(values) || values.length<6){

                jQuery(this).css('border-color', '#ED1C24');
                mob.removeClass('success-signal').addClass("error-signal");
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {
                mob.removeClass("error-signal").addClass("success-signal");
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='password'){

            if(values.length<6){
                jQuery(this).css('border-color', '#ED1C24');
                jQuery(this).prev().removeClass('success-signal').addClass("error-signal");
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {
                jQuery(this).prev().removeClass("error-signal").addClass("success-signal");
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }


    });

    jQuery(".form-send input").on('change',function(e){

        var values =  jQuery(this).val(),
            name = jQuery(this).attr('name');
        var message = jQuery(this).next(".input-group-addon");
        if(name=='email_id'){
            if(!isValidEmailAddress(values)){

                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');

            }else {
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='mobile_no'){
            if(isNumber(values) || values.length<6){

                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='code'){
            if(values.length<2){

                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }


        if(name=='new_pass'){
            if(values.length<6){
                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
            }else {
                jQuery(this).css('border-color', '#398439');
                message.show().removeClass('box-singnal-error').addClass('box-singnal');
                message.find('.fa').removeClass('fa-times').addClass('fa-check');
            }
        }

        if(name=='re_pass'){
            var pass_field = jQuery(document).find('input[name="new_pass"'),
                pass_value = pass_field.val();

            if(pass_value==''){
                jQuery(this).css('border-color', '#ED1C24');
                message.show().removeClass('box-singnal').addClass('box-singnal-error');
                message.find('.fa').removeClass('fa-check').addClass('fa-times');
                pass_field.focus();
            }else {
                if(pass_value == values ){
                    jQuery(this).css('border-color', '#398439');
                    message.show().removeClass('box-singnal-error').addClass('box-singnal');
                    message.find('.fa').removeClass('fa-times').addClass('fa-check');
                }else {
                    jQuery(this).css('border-color', '#ED1C24');
                    message.show().removeClass('box-singnal').addClass('box-singnal-error');
                    message.find('.fa').removeClass('fa-check').addClass('fa-times');
                }
            }
        }
    });


//    Admin login form validation

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });



});



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