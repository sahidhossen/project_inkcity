<?php
/**
 * Created by sahidhossen.
 * User: Sahid
 * Date: 1/9/2016
 * Time: 2:35 PM
 */

class Contact{

    private $table='contact';


    /*
     * Insert contact information into the contact table
     * */

    public function insert_contact( $data ){
        global $main_db;
        $data['c_date'] = date('Y-m-d H:i:s');
        $data['status'] = 0;
        $insert = $main_db->insert($this->table, $data);

        if($insert)
            return true;
        return false;
    }

    /*
     * Email send function
     * */

    public function send_email($_to, $_subject,$_message, $sender){
        $to      = $_to;
        $subject = $_subject;
        $message = $_message;
        $headers = 'From: '.$sender . "\r\n" .
            'Reply-To: '.$sender . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

       if( mail($to, $subject, $message, $headers)){
           return true;
       }else {
           return false;
       }
    }

}