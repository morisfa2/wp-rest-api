<?php

class Morisfa_Activator {
    public static function activate() {
        global $wpdb;
        $collate = $wpdb->get_charset_collate();
        $RestApiTableName = $wpdb->prefix . 'RestApiMorisfa';
        $query   = "CREATE TABLE IF NOT EXISTS `$RestApiTableName` (
					 `id` int(10) NOT NULL AUTO_INCREMENT,
					 `key` varchar(100)  ,
					 `value` varchar(100) ,
					 PRIMARY KEY (`id`)
					) $collate";
        $sql   = "ALTER TABLE `wp_users` ADD `morisfa_jwt_api` VARCHAR(2500) NOT NULL DEFAULT 'none';";
        $sqlInsert   = "INSERT INTO `wp_RestApiMorisfa` (`id`, `key`, `value`) VALUES ('1', 'adminId', '110'), ('2', 'author_meta_status', '1'), ('3', 'loggedinuser_url', 'testone/loggedinuser'), ('4', 'checkPay_orderid', 'orderid'), ('5', 'checkPay_Token', 'Token'), ('6', 'checkPay_status', 'status'), ('7', 'checkPay_marja', 'marja'), ('8', 'checkPay_peygiri', 'peygiri'), ('9', 'checkPay_verify_ResCode', 'verify_ResCode'), ('10', 'checkPay_faild', 'تراکنش این کاربر نا موفق بود'), ('11', '', NULL), ('12', 'checkPay_success', 'تراکنش این کاربر موفق  بود'), ('13', 'checkPay_url', 'checkpay/pay'), ('14', 'phone_sms_check_status', '1'), ('15', 'checkCodePhone_url', 'testone/checkCodePhone'), ('16', 'register_response_username', 'Username field username is required'), ('17', 'register_response_email', 'Email field email is required'), ('18', 'register_response_password', 'Password field password is required'), ('19', 'register_role', 'subscriber/customer'), ('20', 'register_url', 'users/register'), ('21', 'userJWT_url', 'testone/loggedinuserJWT'); ";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $query );

        $wpdb->query($sql);
        $wpdb->query($sqlInsert);
    }
    public static function deactivate() {
        global $wpdb;
        $sql   = "DROP TABLE wp_RestApiMorisfa;";
        $wpdb->query($sql);
    }
public static function DeactiveMessage () {
    function ApiMessage() {
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
        wp_enqueue_script( 'utils' );
        wp_enqueue_style( 'deactive', plugin_dir_url( '' ) . PLUGDIR . '/assets/css/confrimcss.css', false, '1.0', 'all' ); // Inside a plugin
        wp_enqueue_script( 'deactive', plugin_dir_url( '' ) . PLUGDIR . '/assets/js/confirm-message.js', false, '1.0', 'all' ); // Inside a plugin
    }
    add_action( 'admin_footer', 'ApiMessage' );

}

public function registerActionLinks (){
    add_filter( 'plugin_action_links_' . PLUGDIR."/morisfa.php", 'morisfa' );
    function morisfa( $links )
    {
        $url1 = 'https://morisfa.com/coffee';
        $url2 = bloginfo('siteurl') . "/wp-admin/admin.php?page=MorisfaRestApi";
        $links[] = '<a href="'.$url1.'" target="_blank">' . __( 'حمایت میکنم ☕', 'domain' ) . '</a>';
        $links[] =  '<a href="'.$url2.'" target="_blank">' . __( 'راهنمای استفاده 📚', 'domain' ) . '</a>' ;
        return $links;
    }
}









}
