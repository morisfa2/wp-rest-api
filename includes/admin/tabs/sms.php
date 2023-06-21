<?php
namespace admin;
require_once 'interface.php';
use showtab;
class sms implements showtab {

    public static function show ($data){
        foreach ($data as $datum){
            if ($datum->key == 'phone_sms_check_status'){
                $phone_sms_check_status =  $datum->value;
                if ($phone_sms_check_status == 1){
                    $status = 'checked';
                }
            }
            elseif ($datum->key == 'checkCodePhone_url'){$checkCodePhone_url =  $datum->value;}
        }


        $imageUrl = plugin_dir_url( '' ) . PLUGDIR . '/assets/images/question.png';

        $url = get_admin_url()."admin-post.php";
        return <<<HTML

  <div class="tab-pane fade shadow rounded bg-white p-5" id="sms" role="tabpanel" aria-labelledby="sms-tab">
                        <h4 class="font-italic mb-4">تنظیمات برسی کد فعال سازی</h4>
                        <p class="font-italic text-muted mb-2">در تنظیمات ثبت نام پس از ثبت نام یک کد فعال سازی به عنوان خروجی جیسان تحویل میشود و برنامه نویس میتواند با ارسال آن کد به ایمیل یا شماره موبایل ، از قابلیت فعال سازی اکانت با کد فعال سازی استفاده نماید ، حال آن کد را با قرار دادن در این رست ، میتوانید چک کنید صحیح است یا خیر ، اگر صحیح باشد استاتوس کاربر تغییر خواهد کرد</p>
                    
                    
                                      
                   <form action="{$url}" method="post">
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="در صورتی که این آپشن را ببندید این رست ای پی ای غیر فعال میشود" 
 data-toggle="tooltip">
    <label for="phone_sms_check_status">برسی کننده کد تایید فعال باشد ؟</label>
    
    
  
<div class="form-check form-switch">
  <input name="phone_sms_check_status" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {$status}></div>

    
 
  </div>
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="
 آدرس این rest-api به این صورت میشود : 
 example : site.com/wp-json/testone/checkCodePhone
 
 این سرویس به صورت متد post است و دو پارامتر code-phone باید به آن ارسال شود ، در رست ای پی ای ثبت نام پس از ثبت نام در خروجی جیسان یک عدد پارامتر کد میدهد ، شما با استفاده از ان کد میتوانید سمت فرانت این کد را ارسال فرمایید به ایمیل یا موبایل کاربر و کاربر با وارد کردن این کد ارسال شده در این رست ای پی ای ، میتوانیم چک کنیم کد صحیح است یا نه ، اگر صحیح بود در تیبل یوزر استاتوس یوزر 1 میشود
 " 
 data-toggle="tooltip">
    <label for="checkCodePhone_url">آدرس این رست ای پی ای</label>
    <input type="text" name="checkCodePhone_url" value="{$checkCodePhone_url}" class="form-control" id="checkCodePhone_url" placeholder="آدرس">
  </div>
  
  
  
  
        <!--   in input hidden action bayad bashe ta admin-post kar kone -->
  <input type="hidden" name="action" value="submit-form" /> 
      <input type="hidden" name="form" value="sms"/>
  <input value="ثبت اطلاعات" type="submit" class="btn btn-primary">
</form>
          
                    
                    </div>


HTML;
    }



}
