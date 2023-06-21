<?php
require 'class-admin-pages.php';
 class menues {

    public function register (){
        function menues() {
            add_menu_page(
                __( 'wp headless plugin', 'textdomain' ),
                'WP HEADLESS',
                'manage_options',
                'MorisfaRestApi',
                'page_func',
                plugins_url(PLUGDIR . '/assets/images/api.png' ),
                6
            );
            add_submenu_page(
                'MorisfaRestApi',
                'تنظیمات',
                'تنظیمات',
                'edit_themes',
                'apiSetting',
                'apiSetting'
            );

        }
        add_action( 'admin_menu', 'menues' );
        function page_func () {menuPages::page_func();}
        function apiSetting () {menuPages::apiSetting();}
       
    }

}
