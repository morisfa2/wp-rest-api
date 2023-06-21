<?php
require_once "admin/adminTheme.php";

class menuPages {

    public static function page_func (){
        $theme = new admin\adminTheme();
        $theme->landing();
    }
    public static function apiSetting (){
        $theme = new admin\adminTheme();
        $theme->run();

    }

}
