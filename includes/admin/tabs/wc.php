<?php
namespace admin;
require_once 'interface.php';
use showtab;
class wc implements showtab {
    public static function show ($data){
        foreach ($data as $datum){
            if ($datum->key == 'checkPay_orderid'){$checkPay_orderid =  $datum->value;}
            elseif ($datum->key == 'checkPay_Token'){$checkPay_Token =  $datum->value;}
            elseif ($datum->key == 'checkPay_status'){$checkPay_status =  $datum->value;
                if ($checkPay_status == 1){
                    $status = 'checked';
                }
            }
            elseif ($datum->key == 'checkPay_marja'){$checkPay_marja =  $datum->value;}
            elseif ($datum->key == 'checkPay_peygiri'){$checkPay_peygiri =  $datum->value;}
            elseif ($datum->key == 'checkPay_faild'){$checkPay_faild =  $datum->value;}
            elseif ($datum->key == 'checkPay_success'){$checkPay_success =  $datum->value;}
            elseif ($datum->key == 'checkPay_url'){$checkPay_url =  $datum->value;}
            elseif ($datum->key == 'checkPay_verify_ResCode'){$checkPay_verify_ResCode =  $datum->value;}
        }

        $imageUrl = plugin_dir_url( '' ) . PLUGDIR . '/assets/images/question.png';

        $url = get_admin_url()."admin-post.php";
        return <<<HTML

  <div class="tab-pane fade shadow rounded bg-white p-5" id="wc" role="tabpanel" aria-labelledby="wc-tab">
                        <h4 class="font-italic mb-4">هوک و فیلتر های ووکامرس</h4>
                        <p class="font-italic text-muted mb-2">در این بخش ، برخی مواردی که در دیفالت  rest-api موجود نیست ، با هوک و فیلتر ها قابلیت هایی اضافه میکنیم تا به وسیه رست ای پی ای به صورت کامل تری عملیات خرید محصول و ... را کنترل کنیم </p>
                  
                   <form action="{$url}" method="post">
                   
                   
                   <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="در صورتی که این گزینه را غیر فعال کنید تمامی اپشن های این بخش غیر فعال میشوند" 
 data-toggle="tooltip">
    <label for="phone_sms_check_status">امکانات ووکامرس فعال باشد ؟</label>
<div class="form-check form-switch">
  <input name="checkPay_status" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {$status}></div>
  </div>
                   
                   
                  <div class="form-group">
   <img class="tooltipImage" src="{$imageUrl}"
 title="این آپشن برای تعیین آدرس این رست ای پی ای میباشد 
 
 از این api باید سمت کد های درگاه پرداخت استفاده شود ، کد های سمت درگاه های پرداخت همیشه چند مورد دارد ، یکی از آنها رسپانس کد و وریفای کد است
 به این api باید چند مورد ارسال شود : 
 
orderid /
Token /
status /
marja /
peygiri /
verify_ResCode /
 
 موارد ارسالی هستند
 متد این api ، پست است و در صورتی که ResCode ، صفر باشد و همچنین وریفای کد هم اوکی باشد ، محصول مورد نظر را به عنوان پرداخت شده و در حال تکمیل تغییر میدهد و اطلاعات خرید را داخل سفارش اضافه میکند
 
 
 " 
 data-toggle="tooltip">
    <label for="checkPay_url">آدرس این رست ای پی ای</label>
    <input type="text" name="checkPay_url" value="{$checkPay_url}" class="form-control" id="checkPay_url" placeholder="آدرس">
  </div> 
                   
  <div class="form-group">
   <img class="tooltipImage" src="{$imageUrl}"
 title="رسپانس این api ، یک ایدی سفارش برمیگرداند ، متن اختصاصی خود را به صورت انگلیسی بنویسید" 
 data-toggle="tooltip">
    <label for="checkPay_orderid">نام کلید خروجی آیدی سفارش در رسپانس جیسان</label>
    <input type="text" name="checkPay_orderid" value="{$checkPay_orderid}" class="form-control" id="checkPay_orderid" placeholder="آدرس">
  </div> 
  
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="رسپانس این api ، یک توکن سفارش برمیگرداند ، متن اختصاصی خود را به صورت انگلیسی بنویسید" 
 data-toggle="tooltip">
    <label for="checkPay_Token">نام کلید خروجی توکن سفارش در رسپانس جیسان</label>
    <input type="text" name="checkPay_Token" value="{$checkPay_Token}" class="form-control" id="checkPay_Token" placeholder="آدرس">
  </div>
  
  

  
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="رسپانس این api ، یک کد مرجع برمیگرداند ، متن اختصاصی خود را به صورت انگلیسی بنویسید" 
 data-toggle="tooltip">
    <label for="checkPay_marja">نام کلید خروجی کد مرجع سفارش در رسپانس جیسان</label>
    <input type="text" name="checkPay_marja" value="{$checkPay_marja}" class="form-control" id="checkPay_marja" placeholder="آدرس">
  </div>
  
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="رسپانس این api ، یک کلید خروجی برمیگرداند ، متن اختصاصی خود را به صورت انگلیسی بنویسید" 
 data-toggle="tooltip">
    <label for="checkPay_peygiri">نام کلید خروجی کد پیگیری سفارش در رسپانس جیسان</label>
    <input type="text" name="checkPay_peygiri" value="{$checkPay_peygiri}" class="form-control" id="checkPay_peygiri" placeholder="آدرس">
  </div>
  
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="در صورتی که تراکنش نا موفق باشد ، متن بازگشتی در رسپانس را بنویسید" 
 data-toggle="tooltip">
    <label for="checkPay_faild">متن تراکنش نا موفق کاربر</label>
    <input type="text" name="checkPay_faild" value="{$checkPay_faild}" class="form-control" id="checkPay_faild" placeholder="آدرس">
  </div>
  
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="در صورتی که تراکنش  موفق باشد ، متن بازگشتی در رسپانس را بنویسید" 
 data-toggle="tooltip">
    <label for="checkPay_success">متن تراکنش موفق کاربر</label>
    <input type="text" name="checkPay_success" value="{$checkPay_success}" class="form-control" id="checkPay_success" placeholder="آدرس">
  </div>
  

  
   <div class="form-group">
   <img class="tooltipImage" src="{$imageUrl}"
 title="رسپانس این api ، یک کلید خروجی تایید پرداخت برمیگرداند ، متن اختصاصی خود را به صورت انگلیسی بنویسید" 
 data-toggle="tooltip">
    <label for="checkPay_verify_ResCode">نام کلید خروجی جیسان تایید پرداخت در رسپانس کد</label>
    <input type="text" name="checkPay_verify_ResCode" value="{$checkPay_verify_ResCode}" class="form-control" id="checkPay_verify_ResCode" placeholder="آدرس">
  </div>
 
        <!--   in input hidden action bayad bashe ta admin-post kar kone -->
  <input type="hidden" name="action" value="submit-form" /> 
      <input type="hidden" name="form" value="wc"/>
  <input value="ثبت اطلاعات" type="submit" class="btn btn-primary">
</form>
                    
                    
                    
                    
                    
                    
                    
                    
                    </div>


HTML;
    }



}
