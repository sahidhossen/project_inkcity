<?php

require_once(dirname(dirname(__FILE__)) . '/load.php');
global $session;
if(!empty($session->message)):

echo '<h3>'.$session->message() .'</h3>';

else :
?>
<h1> 404 ERROR  :( </h1>

<P> You should fo back to your main page. </P>

<?php
endif;
