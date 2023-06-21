<?php
namespace admin\model;
require_once 'interface.php';
use model;
class sms implements model{
    public static function get(){
        global $wpdb;
        $result = $wpdb->get_results ( "select * from `wp_RestApiMorisfa` where `key` in (
                                                  'phone_sms_check_status',
                                                  'checkCodePhone_url'
                                                 
                                                 )" );
        return $result;
    }


    public static function update($post){



        global $wpdb;
        $phone_sms_check_status = $post['phone_sms_check_status'] == "on" ? 1 : 0;
        $SQL1 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$phone_sms_check_status}' WHERE `wp_RestApiMorisfa`.`key` = 'phone_sms_check_status' ;";
        $SQL2 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkCodePhone_url']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkCodePhone_url' ;";
        $wpdb->query( $SQL1 );
        $wpdb->query( $SQL2 );
        //  $wpdb->print_error(); //for debug
        wp_redirect(admin_url('admin.php?page=apiSetting&type=success'));
        die();




    }




}