<?php
namespace admin\model;
require_once 'interface.php';
use model;
class register implements model{

    public static function get(){
        global $wpdb;
        $result = $wpdb->get_results ( "select * from `wp_RestApiMorisfa` where `key` in (
                                                  'register_response_username',
                                                  'register_response_email',
                                                  'register_response_password',
                                                  'register_role',
                                                  'register_url')" );
        return $result;


    }


    public static function update($post){
        global $wpdb;
        $SQL1 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['register_response_username']}' WHERE `wp_RestApiMorisfa`.`key` = 'register_response_username' ;";
        $SQL2 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['register_response_email']}' WHERE `wp_RestApiMorisfa`.`key` = 'register_response_email' ;";
        $SQL3 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['register_response_password']}' WHERE `wp_RestApiMorisfa`.`key` = 'register_response_password'; ";
        $SQL4 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['register_role']}' WHERE `wp_RestApiMorisfa`.`key` = 'register_role'; ";
        $SQL5 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['register_url']}' WHERE `wp_RestApiMorisfa`.`key` = 'register_url'; ";
        $wpdb->query( $SQL1 );
        $wpdb->query( $SQL2 );
        $wpdb->query( $SQL3 );
        $wpdb->query( $SQL4 );
        $wpdb->query( $SQL5 );
        //  $wpdb->print_error(); //for debug
        wp_redirect(admin_url('admin.php?page=apiSetting&type=success'));
        die();
    }




}