<?php 
/*
* @This page contain all the formating system like email, password etc 
*/



function checkPassword($pwd) {
    
    $errors='';
    if (strlen($pwd) < 8) {
        $errors = "Password too short!";
    }

    if( strlen($pwd) > 20 ) {
		$errors = "Password too long!";
	}

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors = "Password must include at least one letter!";
    }     

    if($errors) {
        return  $errors; 
    }else {
        return true;
    }
}

/*
* @ Check the valid email address from the preg_match functions 
*/

function check_email($email) {

	$regex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
	if( !empty($email) ) {
		if ( preg_match( $regex, $email ) !=1 ) 
				return false; 
		else 
			return true;
	}
}
function get_date($time=true) {
    if ( $time ) {
       return date('Y-m-d g:i:s A'); 
    }else {
        return date('Y-m-d');
    }
}

function is_number( $number ) {
    $result = preg_match('/^[0-9]*$/', $number); 
    return $result;
}

function formatTk($tk)
{
    return "Tk ".number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $tk)),2);
}

function random_number($digit){
    $digits = $digit;
    return rand(pow(10, $digits-1), pow(10, $digits)-1);
}
/*
FUnction for add 0 before a single number 
*/
function add_zero( $number ) {
    $num_padded = sprintf("%02s", $number);
    return $num_padded; // returns 04
}

function add_double_zero( $number ){
    $num_padded = sprintf("%03s", $number);
    return $num_padded; // returns 004
}

/*
* Get ID from the requested URL 
*/
function get_requested_ID( $url  ){
           
            $ID = NULL;
           // if ( preg_match ( '/acount_info_([0-9]+)/', $url, $matches ) )
            if ( preg_match ( '/_([0-9]+)/', $url, $matches ) )

            {
                $ID = (isset($matches[1])) ? $matches[1] : NULL; 

            } 
            return $ID;

}   


/**
 * Get the HTTP Origin of the current request.
 *
 * @since 3.4.0
 *
 * @return string URL of the origin. Empty string if no origin.
 */
function get_http_origin() {
    $origin = '';
    if ( ! empty ( $_SERVER[ 'HTTP_ORIGIN' ] ) )
        $origin = $_SERVER[ 'HTTP_ORIGIN' ];

    /**
     * Change the origin of an HTTP request.
     *
     * @since 3.4.0
     *
     * @param string $origin The original origin for the request.
     */
    // return apply_filters( 'http_origin', $origin );
    return $origin;
}

/**
 * Retrieve list of allowed HTTP origins.
 *
 * @since 3.4.0
 *
 * @return array Array of origin URLs.
 */
function get_allowed_http_origins() {
   // $admin_origin = parse_url( admin_url() );
    $home_origin = parse_url( get_home_url() );

    // @todo preserve port?
    $allowed_origins = array_unique( array(
        //'http://' . $admin_origin[ 'host' ],
       // 'https://' . $admin_origin[ 'host' ],
        'http://' . $home_origin[ 'host' ],
        'https://' . $home_origin[ 'host' ],
    ) );

    /**
     * Change the origin types allowed for HTTP requests.
     *
     * @since 3.4.0
     *
     * @param array $allowed_origins {
     *     Default allowed HTTP origins.
     *     @type string Non-secure URL for admin origin.
     *     @type string Secure URL for admin origin.
     *     @type string Non-secure URL for home origin.
     *     @type string Secure URL for home origin.
     * }
     */
    return   $allowed_origins;
}

/**
 * Determines if the HTTP origin is an authorized one.
 *
 * @since 3.4.0
 *
 * @param string Origin URL. If not provided, the value of get_http_origin() is used.
 * @return bool True if the origin is allowed. False otherwise.
 */
function is_allowed_http_origin( $origin = null ) {
    $origin_arg = $origin;

    if ( null === $origin )
        $origin = get_http_origin();

    if ( $origin && ! in_array( $origin, get_allowed_http_origins() ) )
        $origin = '';

    /**
     * Change the allowed HTTP origin result.
     *
     * @since 3.4.0
     *
     * @param string $origin Result of check for allowed origin.
     * @param string $origin_arg original origin string passed into is_allowed_http_origin function.
     */
    //return apply_filters( 'allowed_http_origin', $origin, $origin_arg );
    return $origin;
}

/**
 * Send Access-Control-Allow-Origin and related headers if the current request
 * is from an allowed origin.
 *
 * If the request is an OPTIONS request, the script exits with either access
 * control headers sent, or a 403 response if the origin is not allowed. For
 * other request methods, you will receive a return value.
 *
 * @since 3.4.0
 *
 * @return bool|string Returns the origin URL if headers are sent. Returns false
 * if headers are not sent.
 */
function send_origin_headers() {
    $origin = get_http_origin();

    if ( is_allowed_http_origin( $origin ) ) {
        @header( 'Access-Control-Allow-Origin: ' .  $origin );
        @header( 'Access-Control-Allow-Credentials: true' );
        // if ( 'OPTIONS' === $_SERVER['REQUEST_METHOD'] )
        //     exit;
        return $origin;
    }

    // if ( 'OPTIONS' === $_SERVER['REQUEST_METHOD'] ) {
    //     status_header( 403 );
    //     exit;
    // }

    return false;
}

function get_month_name( $num ){
    global $session; 
    $all_month = $session->month_name;
    $getmonth = 'wrong';
    if( $num > 12 )
        return $getmonth; 
    else{
        foreach ($all_month as $key => $month) {
           if( $key == $num )
            $getmonth = $all_month[$key];
        }
    }
    return $getmonth;
}