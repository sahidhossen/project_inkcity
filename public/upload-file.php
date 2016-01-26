<?php
/**
 * Created by PhpStorm.
 * User: sahid
 * Date: 1/13/16
 * Time: 4:51 PM
 */
require_once(dirname(dirname(__FILE__)) . '/load.php');

if(isset($_FILES['upload_file'])) {


    global $main_db, $session;
    $file = new History();



    foreach($_FILES['upload_file'] as $key=>$value ){
        if(is_array($value)){
            $fileName = array_values(array_filter($_FILES['upload_file']['name']));
            $tmpName = array_values(array_filter($_FILES['upload_file']['tmp_name']));


        }
    }


    for($i=0;$i<count($fileName);$i++) {


        $ext = explode(".",$fileName[$i]);
        $ext = end($ext);


            $file_name = $fileName[$i];
            $tmp_name = $tmpName[$i];

        if($ext =='pdf') {
            $pagenumber = getNumPagesInPDF($tmpName[$i]);
            $fp = fopen($tmp_name, 'r');
            $content = fread($fp, filesize($tmp_name));
            $content = addslashes($content);
            fclose($fp);

            if (!get_magic_quotes_gpc()) {
                $file_name = addslashes($file_name);
            }

            $data['pages'] = $pagenumber;

        }else {
            $content =  addslashes(file_get_contents($tmp_name));
            $data['pages'] = 1;
        }


        $data['name'] = $file_name;
        $data['obj'] = $content;


        if ($file->insert_file($data)) {

            echo '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Your file has been upload successfully! </div>';

        } else {

         echo   '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <strong>Warning!</strong> '.$main_db->last_error.' </div>';
        }

    }




}


function getNumPagesInPDF($arguments )
{
    $PDFPath = $arguments;
    $stream = @fopen($PDFPath, "r");
    $PDFContent = @fread ($stream, filesize($PDFPath));
    if(!$stream || !$PDFContent)
        return false;

    $firstValue = 0;
    $secondValue = 0;
    if(preg_match("/\/N\s+([0-9]+)/", $PDFContent, $matches)) {
        $firstValue = $matches[1];
    }

    if(preg_match_all("/\/Count\s+([0-9]+)/s", $PDFContent, $matches))
    {
        $secondValue = max($matches[1]);
    }
    return (($secondValue != 0) ? $secondValue : max($firstValue, $secondValue));
}