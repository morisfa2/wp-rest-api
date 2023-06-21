<?php
namespace admin\model;
require_once 'interface.php';
use model;
class login implements model{
    public static function get(){
        global $wpdb;
        $result = $wpdb->get_results ( "select * from `wp_RestApiMorisfa` where `key` in (
                                                  'adminId', 
                                                  'userJWT_url', 
                                                  'loggedinuser_url')" );
        return $result;
    }
    public static function update($post){
    global $wpdb;
       $SQL1 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['adminId']}' WHERE `wp_RestApiMorisfa`.`key` = 'adminid' ;";
        $SQL2 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['loggedinuser_url']}' WHERE `wp_RestApiMorisfa`.`key` = 'loggedinuser_url' ;";
        $SQL3 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['userJWT_url']}' WHERE `wp_RestApiMorisfa`.`key` = 'userJWT_url'; ";
        $wpdb->query( $SQL1 );
        $wpdb->query( $SQL2 );
        $wpdb->query( $SQL3 );
      //  $wpdb->print_error(); //for debug
   wp_redirect(admin_url('admin.php?page=apiSetting&type=success'));
  die();
    }
}