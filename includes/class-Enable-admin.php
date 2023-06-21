<?php
require 'class-admin-menu.php';
require_once plugin_dir_path( __FILE__ ) . 'class-Acticate-RestApi-plugin.php';
class Enable_admin {





 public function getdata($key,$type){
     //type = int , string
     global $wpdb;
     $sql = "SELECT `value` FROM `wp_RestApiMorisfa` WHERE `key` = '{$key}' ; ";
     $results = $wpdb->get_results($sql);
     return $type == "int" ? (int)$results[0]->value : $results[0]->value;
 }


    public static function run (){

        
        
        $menu = new menues();
         $Morisfa_Activator = new Morisfa_Activator();
$menu->register();
        
        
        $Morisfa_Activator->DeactiveMessage();
        $Morisfa_Activator->registerActionLinks();

        }













        public function register(){










            $url = $_SERVER['REQUEST_URI'];
            $string = '/wp-json/wp/v2/users';
            $string2 = 'products/reviews';
            if (strpos($_SERVER['REQUEST_URI'],$string  )){
                add_filter( 'rest_authentication_errors', function(){
                    wp_set_current_user($this->getdata('adminId','int'));
                }, 101 );
            }

            add_filter( 'rest_prepare_user', function( $response, $user, $request ) {

                $response->data[ 'first_name' ] = get_user_meta( $user->ID, 'first_name', true );
                $response->data[ 'last_name' ] = get_user_meta( $user->ID, 'last_name', true );
                $response->data[ 'user_email' ] = get_userdata( $user->ID, 'user_email', true )->user_email;
                $response->data[ 'user_login' ] = get_userdata( $user->ID, 'user_login', true )->user_login;
                $response->data[ 'user_registered' ] = get_userdata( $user->ID, 'user_registered', true )->user_registered;
                return $response;
            }, 10, 3 );
           // add_action( 'rest_api_init', 'rest_get_user_field' );
         //   function rest_get_user_field( $user, $field_name, $request ) {
         //       return get_user_meta( $user[ 'id' ], $field_name, true );
         //   }


            function wpse_20160421_get_author_meta($object, $field_name, $request) {
                $user_data = get_userdata($object['author']); // get user data from author ID.
                $array_data = (array)($user_data->data); // object to array conversion.
                $array_data['first_name'] = get_user_meta($object['author'], 'first_name', true);
                $array_data['last_name']  = get_user_meta($object['author'], 'last_name', true);
                $array_data['image']  = get_avatar_url($object['author'], array('size' => 40));

                unset($array_data['user_login']);
                unset($array_data['user_pass']);
                unset($array_data['user_nicename']);
                unset($array_data['Morisfa_jwt_react']);
                unset($array_data['user_activation_key']);
                return array_filter($array_data);

            }

            function wpse_20160421_register_author_meta_rest_field() {
                register_rest_field('post', 'author_meta', array(
                    'get_callback'    => 'wpse_20160421_get_author_meta',
                    'update_callback' => null,
                    'schema'          => null,
                ));
            }
            if($this->getdata('author_meta_status','int') == 1){
                add_action('rest_api_init', 'wpse_20160421_register_author_meta_rest_field');
            }

            function checkloggedinuser($req)
            {
                $creds = array('user_login'    => $req['username'], 'user_password' => $req['pass'], 'remember' => true);
                $user = wp_signon( $creds, false );
                if ( is_wp_error( $user ) ) {
                    $data = [
                        'status' => 404

                    ];
                    return rest_ensure_response($data);
                }
                else {
                    $SeetaCookie = $user->ID;


                    $SeetaCookie = base64_encode(md5("766220383gghCheckAuth&rejectOOp!noLogin@{$user->ID}*da888/111/755/645"));
                    $SeetaCookieMd = md5("766220383gghCheckAuth&rejectOOp!noLogin@{$user->ID}*da888/111/755/645");
                    $data = [
                        'name' => $user->display_name,
                        'id' => $user->id ,
                        'cookie' => $SeetaCookie,
                        'status' => 200,
                        'loggedin' => is_user_logged_in($user->id)
                    ];

                    return rest_ensure_response($data);
                }
            }
            add_action('rest_api_init', function ()
            {
                $fullurl = $this->getdata('loggedinuser_url','string');
                $bw = explode("-",$fullurl);

                register_rest_route( $bw[0], $bw[1],array(
                    'methods' => 'POST',
                    'callback' => 'checkloggedinuser'
                ));
            });

//return rest_ensure_response($data);
            function checkPay($req)
            {
                $foobar = new Enable_admin;  // correct



                $OrderId = $req["orderid"];
                $Token   = $req["Token"];
                $ResCode = $req["status"];
                $marja = $req["marja"];
                $peygiri = $req["peygiri"];
                $verify_ResCode = $req["verify_ResCode"];



                if (!$ResCode == 0 ){


                    $order = new WC_Order($OrderId);
                    $order->update_status('failed', $foobar->getdata('checkPay_faild','string')); // order note is optional, if you want to

                    $data = [
                        'error' => "error",
                        'OrderId' => $OrderId,
                        'Token' =>  $Token,
                        'ResCode' => $ResCode];
                    return rest_ensure_response($data);


                }
                //$ee = $this->getdata('checkPay_success','string');
                if ($ResCode == 0 && $verify_ResCode == 0){

                    $order = new WC_Order($OrderId);
                    $order->update_status('processing', $foobar->getdata('checkPay_success','string')); // order note is optional, if you want to
                    $order2 = wc_get_order(  $OrderId );
                    $note = __("پرداخت با موفقیت انجام شد ، کد پیگیری : {$peygiri}          شماره مرجع : {$marja} ");
                    $order2->add_order_note( $note );



                    $data = [
                        'success' => "success",
                        $foobar->getdata('checkPay_orderid','string') => $OrderId,
                        $foobar->getdata('checkPay_Token','string') =>  $Token,
                        $foobar->getdata('checkPay_peygiri','string') =>  $peygiri,
                        $foobar->getdata('checkPay_marja','string') =>  $marja,
                        $foobar->getdata('checkPay_verify_ResCode','string') => $ResCode
                    ];
                    return rest_ensure_response($data);
                }

            }


            if ($this->getdata('checkPay_status','int') ==  1){

                add_action('rest_api_init', function ()
                {

$fullurl = $this->getdata('checkPay_url','string');
$bw = explode("-",$fullurl);


                    register_rest_route( $bw[0], $bw[1],array(
                        'methods' => 'POST',
                        'callback' => 'checkPay'
                    ));
                });

            }





            function phone_sms_check($req){
                $uid = $req['phone'];
                $codePOst = $req['code'];

                $user = get_user_by('login', $uid);

               // if($user->user_activation_key === $codePOst){
               $test = true;
                if($test){
                    global $wpdb;
                    $SeetaCookie = base64_encode(md5("766220383gghCheckAuth&rejectOOp!noLogin@{$user->ID}*da888/111/755/645"));
                    $SeetaCookieMd = md5("766220383gghCheckAuth&rejectOOp!noLogin@{$user->ID}*da888/111/755/645");
                    $wpdb->update('wp_users', array( 'user_status' => 1), array( 'user_login' => $uid ) );

                    $wpdb->query(
                        $wpdb->prepare(
                            "UPDATE wp_users SET Morisfa_jwt_react = %s  WHERE wp_users.ID = %s",
                            $SeetaCookieMd,
                            $user->ID
                        ));

                    $data = [
                        'response' => 'true',
                        'cook' => base64_encode($SeetaCookieMd),
                        'status' => $uid
                    ];

                    header('Content-type: application/json');
                    return rest_ensure_response( $data );
                }
                else {
                    $data = [
                        'response' => 'none',
                        'status' => $uid
                    ];
                    header('Content-type: application/json');
//    echo json_encode( $data );
                    return rest_ensure_response( $data );
                }

            }
            if($this->getdata('phone_sms_check_status','int') == 1){
                add_action('rest_api_init', function ()
                {
                    $fullurl = $this->getdata('checkCodePhone_url','string');
                    $bw = explode("-",$fullurl);
                    register_rest_route( $bw[0], $bw[1],array(
                        'methods' => 'POST',
                        'callback' => 'phone_sms_check'
                    ));
                });
            }






            add_action('rest_api_init', 'wp_rest_user_endpoints');

            function wp_rest_user_endpoints($request) {



                $class = new Enable_admin();
                $fullurl = $class->getdata('register_url','string');

                register_rest_route('wp/v2', $fullurl, array(
                    'methods' => 'POST',
                    'callback' => 'wc_rest_user_endpoint_handler',
                ));
            }
            function wc_rest_user_endpoint_handler($request) {
                $response = array();
                $class = new Enable_admin();
                $parameters = $request->get_json_params();
                $username = sanitize_text_field($request['username']);
                $email = sanitize_text_field($request['email']);
                $password = sanitize_text_field($request['password']);

                $error = new WP_Error();
                if (empty($username)) {

                    $error->add(400, __($class->getdata('register_response_username','string'), 'wp-rest-user'), array('status' => 400));
                    return $error;
                }
                if (empty($email)) {
                    $error->add(401, __($class->getdata('register_response_email','string'), 'wp-rest-user'), array('status' => 400));
                    return $error;
                }
                if (empty($password)) {
                    $error->add(404, __($class->getdata('register_response_password','string'), 'wp-rest-user'), array('status' => 400));
                    return $error;
                }

                $user_id = username_exists($username);
                if (!$user_id && email_exists($email) == false) {
                    $user_id = wp_create_user($username, $password, $email);



  $fullurl = $class->getdata('register_role','string');
  $bw = explode("-",$fullurl);
                    if (!is_wp_error($user_id)) {
                        $user = get_user_by('id', $user_id);
                        $user->set_role($bw[0]);
                        $code = rand(3000,90000);
                        
                        $length = rand(40, 50);
                        $random_string = bin2hex(random_bytes($length));
 
                        wp_update_user( array( 'ID' => $user_id, 'user_activation_key' => $code ) );
                       // wp_update_user( array( 'ID' => $user_id, 'Morisfa_jwt_react' => $random_string ) );
                        if (class_exists('WooCommerce')) {
                            $user->set_role($bw[1]);
                        }
                        $response['status'] = 200;
                        $response['active_code'] = $code;
                        $response['message'] = __("User '" . $username . "' Registration was Successful", "wp-rest-user");
                    } else {
                        return $user_id;
                    }
                } elseif($user_id){
//        $error->add(407, __("user exists", 'wp-rest-user'));
//        return $error;
                    $response['status'] = 407;

                }
                elseif(email_exists($email)){
//        $error->add(406, __("Email already exists, please try 'Reset Password'", 'wp-rest-user'));
//        return $error;
                    $response['status'] = 406;
                }

                else{
//        $error->add(408, __("none", 'wp-rest-user'));
//        return $error;
                    $response['status'] = 406;
                }
                return new WP_REST_Response($response, 123);
            }










            function checkloggedinuserJWT($req)
            {

                $token = base64_decode($_GET['token']);
                global $wpdb;
                $getUser = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT * FROM wp_users WHERE Morisfa_jwt_react = %s",
                        $token
                    ));



                if (!$getUser  ) {
                    $data = [
                        'status' => 404

                    ];
                    return rest_ensure_response($data);
                }
                else {

                    $data = [
                        'id' => $getUser[0]->ID,
                        'nicename' => $getUser[0]->display_name,
                        'email' => $getUser[0]->user_email,
                        'ustatus' => $getUser[0]->user_status

                    ];

                    return rest_ensure_response($data);
                }
            }
            add_action('rest_api_init', function ()
            {
                $fullurl = $this->getdata('userJWT_url','string');
                $bw = explode("-",$fullurl);
                register_rest_route( $bw[0], $bw[1],array(
                    'methods' => 'GET',
                    'callback' => 'checkloggedinuserJWT'
                ));
            });

        }



    }



