<?php
/**
 * Created by PhpStorm.
 * User: PC2
 * Date: 18-11-15
 * Time: 20.10
 */
ini_set("display_errors", 1);
if(!defined('CORE_F'))
    define('CORE_F',dirname(__FILE__).'/core');

if(!defined('INC'))
    define('INC',dirname(__FILE__).'/includes');

    require_once(CORE_F.'/core.php');
    require_once(INC.'/default-contstant.php');


/*
 * Set defualt time stamp for Asia
 * */
date_default_timezone_set("Asia/Dhaka");

intial_constant();

create_db_connect();

//include all of the setting below
require_once(CORE_F.'/check_format.php');
require_once(CORE_F.'/url-access.php');
require_once(CORE_F.'/admin.php');
require_once(CORE_F.'/session.php');
require_once(CORE_F.'/email.php');
require_once(CORE_F.'/user.php');
require_once(CORE_F.'/public-user.php');
require_once(CORE_F.'/posts.php');
require_once(CORE_F.'/contact.php');
require_once(CORE_F.'/history.php');
//require_once(CORE_F.'/location_map.php');



require_once(INC.'/setting.php');
require_once(INC.'/config.php');
require_once(INC.'/functions.php');


require_once(dirname(__FILE__).'/model/map.php');
require_once(dirname(__FILE__).'/model/sitemaps.php');

if(!defined('PUBLIC_DIR'))
    define('PUBLIC_DIR',ABSPATH.'public');

require_once(dirname(__FILE__).'/admin/admin-functions.php');

if(file_exists(PUBLIC_DIR.'/functions.php'))
    require_once(PUBLIC_DIR.'/functions.php');

