<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 18-11-15
 * Time: 20.44
 */


function pretty_print( $result  ){
    echo '<pre>';
    var_dump($result);
    echo '</pre>';
}

function removeSlash($string) {
    if( $string[strlen($string) - 1]== '/')
        $string = rtrim($string, '/');

    return $string;
}


/*
 * Admin user registration
 * @prama : username, password, email_id
 * supper_login.php
 * */

function user_registration(){
    $user = new User();
    global $main_db, $session;

    if(isset($_POST['action'])){
        $fields =  $_POST['fields'];
        $data = array();
        foreach( $fields as $field ){
            $data[$field['name']] = $field['value'];
        }


        $data['date_time'] = date('Y-m-d H:i:s');

//       change password as md5 hahsing
        $data['password'] = md5($data['password']);


        /* Remove confirm password field*/
        $data['confirm-password'] = '';
        $data = array_filter($data);

        // If user already exists
        if($user->check_duplicate_user($data['email_id']))
        {
            echo 'duplicate';

        }else {
        //  Register as new user
            if ($user->register_admin($data)) {
                echo 'yes';
            } else {
               echo 'no';
            }
        }
    }
}


/*
 * User contact form information
 * Get all user contact information and send it to admin email id
 * */
function contact_information(){
    $contact = new Contact();
    $post = new posts();
    global $session, $main_db;
    $admin_mail = $post->get_single_post_by('sender_email');
    $sender = (isset($admin_mail->post_content)) ? $admin_mail->post_content : 'sahidhossenbd@gmail.com';

    if(isset($_POST['user_contact_form'])){
        $data['u_name'] = $_POST['u_name'];
        $data['u_mail'] = $_POST['u_email'];
        $data['msg_type'] = $_POST['u_msg_type'];
        $data['comment'] = $_POST['u_comment'];
        $message = '<h3> A user try to contact you! </h3>';
        $message .= '<p>   Name : '.$_POST['u_name'].' </p>';
        $message .='<p> Email : '.$_POST['u_email'].' </p>';
        $message .='<p> Message Type: '. $_POST['u_msg_type'].' </p>';
        $message .='<p> Comment : '.$_POST['u_comment'].' </p>';

        $contact->send_email($_POST['u_email'],'User contact Information',$message,$sender);

        if($contact->insert_contact($data)){
            $session->message("Thank you for your contact! We will touch you very soon! ");
            safe_redirect(get_home_url());
        }else {
            echo $main_db->last_query;
            exit();
        }
    }
}
//Apply here this function
contact_information();


/*
 * Public user registration information
 * */

function public_user_registration(){
    $p_user = new PublicUser();
    global $session, $main_db;
    if(isset($_POST['iagree'])) { //submit button not catch (u_register)

        $data['email'] = $_POST['email'];
        $data['pass'] = $_POST['password'];
        $data['mobile'] = $_POST['mobile'];
        $data['code'] = rand(0,100000);

        if(isset($_SESSION['new_user']))
            unset($_SESSION['new_user']);

        $_SESSION['new_user'] = $data;

        if(isset($_SESSION['new_user'])){
            safe_redirect(get_home_url().'/step_2.php');
        }
    }
}
public_user_registration();
/*
 * Confirm registration with varification code
 * Varification code store in the $_SESSION variable
 * */

function registration_confirm()
{
    $p_user = new PublicUser();
    if(isset($_POST['action'])) {

        //If session has been set
        if (isset($_SESSION['new_user'])) {

           if($_POST['code'] == $_SESSION['new_user']['code']){

                if($p_user->register_user($_SESSION['new_user'])) {
                    //After registration complete clear the $_SESSION variable
                    unset($_SESSION['new_user']);

                    //Do no echo anything else
                    echo 'yes';
                }
           }else {
               echo $_POST['code']." ". $_SESSION['new_user']['code'];
           }

        } else {
            //If not set the varication code then resent it into the registration page
            safe_redirect(get_home_url() . '/registration.php');
        }
    }
}

/*
 * Resend the varification code if code has lost by user
 * */
function resend_varification(){
    $mail = new Email();
    if(isset($_POST['action'])){
        if(isset($_SESSION['new_user'])){
            $code =  rand(0,100000);
            $_SESSION['new_user']['code'] = $code;
            $msg = 'Code: '.$code;

            /*
             * NEED SMTP access to send the email
             * */
            //$mail->send_email($_SESSION['email'],'Resend Code',$msg,$mail->sender_email);
            echo $msg;
        }
    }
}

/*
 * function for the login page
 * */
function public_login(){
    $p_user = new PublicUser();

    global $main_db,$session;
        if(isset($_POST['login_submit'])){
            $login = false;

           if($_POST['email'] != ''){
                if($user = $p_user->loged_in($_POST['email'], $_POST['password'])){
                    $_SESSION['p_user'] = $user->id;
                }
           }else{
               if($user = $p_user->loged_in($_POST['mobile'], $_POST['password'],'mobile')){
                   $_SESSION['p_user'] = $user->id;
               }
           }

            if(isset($_SESSION['p_user'])){
                safe_redirect(get_home_url().'/user-admin.php');
            }else {
                $session->message('* The username or password you entered was incorrect !'.$main_db->last_query);
                safe_redirect(get_home_url().'/login.php');
            }
        }
}

/*
 * Send password retrive code into user account
 * */
function check_password_code(){
    global $main_db;
    $p_user = new PublicUser();
    $email = new Email();

    if(isset($_POST['action'])){
        if($_POST['email'] != '' ) {
            $user = $p_user->get_user_by($_POST['email']);
        }else{
            $user = $p_user->get_user_by($_POST['mobile'],false);
        }
        if($user !=NULL ){
            $data['user_id'] = $user->id;
            $code =  rand(0,100000);
            $data['code'] = $code;
            $data['email'] = $user->email;
            $msg = 'Varification Code: '.$code;
            /*
             * send varification code into the email id
             * NEED SMTP setup
             * */

            //$email->send_email($data['email'],'Varification Code',$msg,$email->sender_email);

            if(!isset($_SESSION['change_password']))
                unset($_SESSION['change_password']);

            $_SESSION['change_password'] = $data;

            echo 'yes';

        }else {
            //Please don't change it
            echo 'no';
        }
    }
}

/*
 * Reset password for the foreget password
 * Varified the code from $_SESSION['change_password']
 * */

function reset_password(){
    $p_user = new PublicUser();
    global $main_db;

    if(isset($_POST['action'])){
        $code = $_POST['code'];
        $pass = $_POST['pass'];

        if(isset($_SESSION['change_password'])){
            if($_SESSION['change_password']['code']==$code){
                //Get the current user
                $user = $p_user->get_user_by_id($_SESSION['change_password']['user_id']);
                $data['pass'] = md5($pass);
                $data['code'] = $_SESSION['change_password']['code'];
                //update the user password
                if($p_user->update_user($data,array('id'=>$user->id))){
                    unset($_SESSION['change_password']);
                    echo 'yes';
                }

            }else {
                echo 'no';
            }
        }
    }
}

/*
 * Varified Email and generate a code
 * */
function varified_email_change(){
    global $main_db;
    $p_user = new PublicUser();
    $email = new Email();

    if(isset($_POST['action'])){

        $user = $p_user->get_user_by($_POST['current_email']);

        if($user !=NULL ){
            $data['user_id'] = $user->id;
            $code =  rand(0,100000);
            $data['code'] = $code;
            $data['email'] = $user->email;
            $data['new_email'] = $_POST['new_email'];
            $msg = 'Varification Code: '.$code;
            /*
             * send varification code into the email id
             * NEED SMTP setup
             * */

            //$email->send_email($data['new_email'],'Varification Code',$msg,$email->sender_email);

            if(!isset($_SESSION['change_email']))
                unset($_SESSION['change_email']);

            $_SESSION['change_email'] = $data;

            echo 'yes';

        }else {
            //Please don't change it
            echo 'no';
        }
    }
}

/*
 * Varified code with the sender
 * If varified than the email address
 * */
function change_email(){
    $p_user = new PublicUser();
    global $main_db;

    if(isset($_POST['action'])){
        $code = $_POST['code'];

        if(isset($_SESSION['change_email'])){
            if($_SESSION['change_email']['code']==$code){
                //Get the current user
                $user = $p_user->get_user_by_id($_SESSION['change_email']['user_id']);
                $data['email'] = $_SESSION['change_email']['new_email'];
                $data['code'] = $_SESSION['change_email']['code'];
                //update the user password
                if($p_user->update_user($data,array('id'=>$user->id))){
                    unset($_SESSION['change_email']);
                    echo 'yes';
                }

            }else {
                echo 'no';
            }
        }
    }
}




/*
 * Varified Email and generate a code
 * */
function varified_mobile_no(){
    global $main_db;
    $p_user = new PublicUser();
    $email = new Email();

    if(isset($_POST['action'])){

        /*
         * Have a problem if mobile not appear
         * */
        $user = $p_user->get_user_by($_POST['current_mobile'], false);

        if($user !=NULL ){
            $data['user_id'] = $user->id;
            $code =  rand(0,100000);
            $data['code'] = $code;
            $data['mobile'] = $user->mobile;
            $data['new_mobile'] = $_POST['new_mobile'];
            $msg = 'Varification Code: '.$code;
            /*
             * send varification code into the email id
             * NEED SMTP setup
             * */

            //$email->send_email($data['new_mobile'],'Varification Code',$msg,$email->sender_email);

            if(!isset($_SESSION['change_mobile']))
                unset($_SESSION['change_mobile']);

            $_SESSION['change_mobile'] = $data;

            echo 'yes';

        }else {
            //Please don't change it
            echo 'no';
        }
    }
}

/*
 * Varified code with the sender
 * If varified than the email address
 * */
function change_mobile(){
    $p_user = new PublicUser();
    global $main_db;

    if(isset($_POST['action'])){
        $code = $_POST['code'];

        if(isset($_SESSION['change_mobile'])){
            if($_SESSION['change_mobile']['code']==$code){
                //Get the current user
                $user = $p_user->get_user_by_id($_SESSION['change_mobile']['user_id']);
                $data['mobile'] = $_SESSION['change_mobile']['new_mobile'];
                $data['code'] = $_SESSION['change_mobile']['code'];
                //update the user password
                if($p_user->update_user($data,array('id'=>$user->id))){
                    unset($_SESSION['change_mobile']);
                    echo 'yes';
                }

            }else {
                echo 'no';
            }
        }
    }
}

/*
 * Change current password when use is logged in
 * */


function change_user_loged_pass(){
    global $main_db, $session;
    $p_user = new PublicUser();
    $email = new Email();

    if(isset($_POST['action'])){

        /*
         * Have a problem if mobile not appear
         * */
        $user = $p_user->get_user_by_id($session->p_userID);

        if($user !=NULL ){
             if($user->pass==md5($_POST['current_pass'])){
                $data['pass'] = md5($_POST['new_pass']);
                 if($p_user->update_user($data, array('id'=>$user->id)))
                     echo 'yes';
             }else {
                 echo 'no';
             }

        }else {
            //Please don't change it
            echo 'no';
        }
    }
}

/*
 *Get Social icons
 * */

function social_urls(){
    $post = new posts();
    $socials = $post->get_post_by('social');
    $icons = $post->social_icons;
      for($i=0;$i<count($icons); $i++ ){
        $data[$icons[$i]] = (isset($socials[$i])) ?  ($icons[$i]==$socials[$i]->post_title) ? $socials[$i]->post_content : '#' : '#';
      }
    return $data;
}


/*
 * Check duplicate
 * */
function checkDuplicatMail(){
    $user = new PublicUser();

    if(isset($_POST['action'])){
        $email = $_POST['uemail'];
        $phone = $_POST['phone'];

        if($email !=''){
            if($user->check_duplicate_user($email)){
                $data['status']='0';
                $data['message'] = "* Email ID already exists";
            }else{
                $data['status']='1';
            }
        }else {
            if($user->check_duplicate_user($phone,'phone')){
                $data['status']='0';
                $data['message'] = "* Phone Number Already Exists!";
            }else{
                $data['status']='1';
            }
        }

        echo json_encode($data);
    }
}

/*
 * If no function catch ajax request then catch blah()
 *
 */

function blah(){
    echo "Sorry You ajax request missed the target";
    die(0);
}