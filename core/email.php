<?php
/**
 * Created by PhpStorm.
 * User: lenovo_pc
 * Date: 1/9/2016
 * Time: 5:37 PM
 */

class Email{


    public $sender_email = '';

    public function __construct(){
        $this->sender_email = $this->sender_email();
    }
    /*
     * Email Sender
     * */
    public function send_email($_to, $_subject,$_message, $sender){
        $to      = $_to;
        $subject = $_subject;
        $message = $_message;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$sender . "\r\n" .
            'Reply-To: '.$sender . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        if( mail($to, $subject, $message, $headers)){
            return true;
        }else {
            return false;
        }
    }

    /*
     * Admin emailID
     * */

    private function sender_email(){
        $post = new posts();

        $getEmail = $post->get_single_post_by('sender_email');

        if($getEmail!=NULL)
            return $getEmail->post_content;
        return 'youremail@mail.com';
    }
}