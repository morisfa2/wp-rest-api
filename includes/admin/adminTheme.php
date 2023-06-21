<?php

namespace admin;
require_once 'tabs/login.php';
require_once 'tabs/checkStatus.php';
require_once 'tabs/register.php';
require_once 'tabs/sitemap.php';
require_once 'tabs/sms.php';
require_once 'tabs/wc.php';
//models
require_once 'model/login.php';
require_once 'model/register.php';
require_once 'model/sitemap.php';
require_once 'model/sms.php';
require_once 'model/wc.php';
require_once 'model/checkStatus.php';



class adminTheme {
    public static function save_data(){
        $data = $_POST['form'];
        switch ($data) {
            case "login":
                (new model\login())->update($_POST);
                break;
            case "checkStatus":
                (new model\checkStatus())->update($_POST);
                break;
            case "register":
                (new model\register())->update($_POST);
                break;
            case "sitemap":
                (new model\sitemap())->update($_POST);
                break;
            case "sms":
                (new model\sms())->update($_POST);
                break;
            case "wc":
                (new model\wc())->update($_POST);
                break;
            default:
                echo "please back to home . nooww !";
        }
    }


    public function run(){
        wp_enqueue_style( 'admin1', plugin_dir_url( '' ) . PLUGDIR . '/assets/admin/css/admin.css', false, '1.0', 'all' );
        wp_enqueue_style( 'admin2', plugin_dir_url( '' ) . PLUGDIR . '/assets/admin/css/rtlBootstrapv5.css', false, '1.0', 'all' );
        wp_enqueue_script( 'admin3', plugin_dir_url( '' ) . PLUGDIR . '/assets/admin/js/jquery-3.3.1.slim.js', false, '1.0', 'all' );
        wp_enqueue_script( 'admin4', plugin_dir_url( '' ) . PLUGDIR . '/assets/admin/js/popper.min.js', false, '1.0', 'all' );
        wp_enqueue_script( 'admin5', plugin_dir_url( '' ) . PLUGDIR . '/assets/admin/js/bootstrap.min.js', false, '1.0', 'all' );
        wp_enqueue_script( 'admin6', plugin_dir_url( '' ) . PLUGDIR . '/assets/admin/js/tooltip.js', false, '1.0', 'all' );


        $login = (new login())->show((new model\login())->get());
        $checkStatus = (new checkStatus())->show((new model\checkStatus())->get());
        $register = (new register())->show((new model\register())->get());
        $sitemap = (new sitemap())->show((new model\sitemap())->get());
        $sms = (new sms())->show((new model\sms())->get());
        $wc = (new wc())->show((new model\wc())->get());

      function alert (){
          if (isset($_GET['type'])){
              if($_GET['type'] == 'success'){
                  echo '<div class="alert alert-success" role="alert">تنظیمات با موفقیت ذخیره شد</div>';

              }
          }
      }


echo <<<HTML
<html dir="rtl">
<body>

<section class="py-5 header">
    <div class="container py-4">
        <header class="text-center mb-5 pb-5 text-white">
            <h1 class="display-4">تنظیمات افزونه wp-rest-api</h1>
            <p class="font-italic mb-1">تنظیمات را به سلیقه خودتان شخصی سازی کنید </p>

        </header>
HTML;
      alert();
      echo <<<HTML
        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
              <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">


 <a class="nav-link mb-3 p-3 shadow active" id="login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">تنظیمات عمومی ورود و فراموشی</span></a>

 <a class="nav-link mb-3 p-3 shadow" id="register-tab" data-toggle="pill" href="#register" role="tab" aria-controls="register" aria-selected="false">
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">تنظیمات ثبت نام</span></a>

<a class="nav-link mb-3 p-3 shadow" id="sitemap-tab" data-toggle="pill" href="#sitemap" role="tab" aria-controls="sitemap" aria-selected="false">
                        <i class="fa fa-star mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">تنظیمات سایت مپ</span></a>

<a class="nav-link mb-3 p-3 shadow" id="sms-tab" data-toggle="pill" href="#sms" role="tab" aria-controls="sms" aria-selected="false">
                        <i class="fa fa-check mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">تنظیمات درگاه پیامکی</span></a>

<a class="nav-link mb-3 p-3 shadow" id="wc-tab" data-toggle="pill" href="#wc" role="tab" aria-controls="wc" aria-selected="false">
                        <i class="fa fa-check mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">تنظیمات ووکامرس</span></a>

 <a class="nav-link mb-3 p-3 shadow" id="checkStatus-tab" data-toggle="pill" href="#checkStatus" role="tab" aria-controls="checkStatus" aria-selected="false">
                        <i class="fa fa-star mr-2"></i>
                      <span class="font-weight-bold small text-uppercase">برسی پیش نیاز ها و وضعیت کارکرد</span></a>
                    </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
{$login}
{$register}
{$sitemap}
{$sms}
{$checkStatus}
{$wc}




                </div>
            </div>
        </div>
    </div>
</section>
<div class="footerRest">
<span>
<p>افزونه wp-rest-api نسخه 1.2</p>
<img src="https://morisfa.com/images/logo.png">
</span>
</div>
</html>
</body>

HTML;

    }

















































    public function landing (){
        wp_enqueue_style( 'landing', plugin_dir_url( '' ) . PLUGDIR . '/assets/css/landing-css.css', false, '1.0', 'all' ); // Inside a plugin
        wp_enqueue_style( 'landing', plugin_dir_url( '' ) . PLUGDIR . '/assets/css/boot4-5.css.css', false, '1.0', 'all' ); // Inside a plugin
        echo <<<END

   <body>
<!-- partial:index.partial.html -->
<section class="hero">
  <h1><span>افزونه</span>Wp Headless</h1>
  <h2></h2>
</section>
<section class="section">
  <div class="wrapper">
    <h2 class="section__title">افزونه wp rest api</h2>
    <p class="section__intro">
     افزونه wp rest api ، افزونه ای بابت ایجاد کاربر ، لاگین ، فراموشی رمز عبور ، دریافت اطلاعات user ، و همچنین قابلیت ویژه ایجاد تغییر در سایت مپ yoast seo است تا بتوانید به عنوان وردپرس به راحتی به عنوان بکند استفاده فرمایید


    </p>
    <div class="box__grid">
      <article class="box"><a class="box__content" href="#"><i class="fa fa-lightbulb-o fa-3x"></i>
          <h3 class="box__title">سازگار با ووکامرس</h3>
          <p>این افزونه تنها با ووکامرس و محصولات آن سازگار است و با افزونه هایی مانند اد همخوانی ندارد</p><span class="box__more">تنظیمات <i class="fa fa-arrow-right"></i></span></a></article>
      <article class="box"><a class="box__content" href="#"><i class="fa fa-code fa-3x"></i>
          <h3 class="box__title">yoast seo sitemap</h3>
          <p>این افزونه ، برای هیدلس کردن وردپرس لازم است تا تغییراتی در لینک های سایت مپ yoast نجام دهد ، به همین دلیل تنها از افزونه yoast seo پشتیبانی میکند</p><span class="box__more">تنظیمات <i class="fa fa-arrow-right"></i></span></a></article>
      <article class="box"><a class="box__content" href="#"><i class="fa fa-mobile fa-3x"></i>
          <h3 class="box__title">لاگین رجیستر اسان</h3>
          <p>با این افزونه میتوان برای قالب فرانت خود لاگین رجیستر اسان انجام داد</p><span class="box__more">تنظیمات <i class="fa fa-arrow-right"></i></span></a></article>
    </div>
  </div>
</section>
<div class="section section--cta">
  <div class="wrapper">
    <h2 class="section__title">معرفی افزونه های دیگر</h2>
    <p class="section__intro">
    افزونه های دیگری هم موجود است که به شما فرانت کار عزیز در روند بهتر headless شدن وردپرس کمک میکند :
    <br>
    1: افزونه WP REST Yoast Meta
    لینک مخزن = <a href="https://fa.wordpress.org/plugins/wp-rest-yoast-meta/">download</a>
<br>
کاربرد : این پلاگین توضیحات متا تایتل و دسکریپشن یوست سئو شما را به rest-api پیشفرض وردپرس مربوط به جزئیات پست اضافه میکند ، اگر سایت شما تایتلش با تایتل سئو آن فرق دارد ازین ویژگی میتوانید بابت ضرر نخوردن به مقالات خود در گوگل استفاده کنید

    </p><a class="btn" href="#"></a>
  </div>
</div>
<div class="footer">
  <p>افزونه wp-rest-api</p>
</div>
<!-- partial -->

</body>





END;
    }










}
