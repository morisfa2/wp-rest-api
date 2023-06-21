<?php
namespace admin\model;
require_once 'interface.php';
use model;
class wc implements model{

    public static function get(){

        global $wpdb;

        $result = $wpdb->get_results ( "select * from `wp_RestApiMorisfa` where `key` in (
                                                  'checkPay_orderid',
                                                  'checkPay_Token',
                                                  'checkPay_status',
                                                  'checkPay_marja',
                                                  'checkPay_peygiri',
                                                  'checkPay_faild',
                                                  'checkPay_success',
                                                  'checkPay_url',
                                                  'checkPay_verify_ResCode')" );

        return $result;


    }


    public static function update($post){
        global $wpdb;
        $checkPay_status = $post['checkPay_status'] == "on" ? 1 : 0;

        $SQL1 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_orderid']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_orderid' ;";
        $SQL2 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_Token']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_Token' ;";
        $SQL3 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$checkPay_status}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_status'; ";
        $SQL4 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_marja']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_marja'; ";
        $SQL5 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_peygiri']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_peygiri'; ";
        $SQL6 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_faild']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_faild'; ";
        $SQL7 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_success']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_success'; ";
        $SQL8 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_url']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_url'; ";
        $SQL9 = "UPDATE `wp_RestApiMorisfa` SET `value` = '{$post['checkPay_verify_ResCode']}' WHERE `wp_RestApiMorisfa`.`key` = 'checkPay_verify_ResCode'; ";
        $wpdb->query( $SQL1 );
        $wpdb->query( $SQL2 );
        $wpdb->query( $SQL3 );
        $wpdb->query( $SQL4 );
        $wpdb->query( $SQL5 );
        $wpdb->query( $SQL6 );
        $wpdb->query( $SQL7 );
        $wpdb->query( $SQL8 );
        $wpdb->query( $SQL9 );
        //  $wpdb->print_error(); //for debug
       wp_redirect(admin_url('admin.php?page=apiSetting&type=success'));
        die();
    }




}