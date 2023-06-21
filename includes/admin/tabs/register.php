<?php
namespace admin;
require_once 'interface.php';
use showtab;
class register implements showtab {
    public static function show ($data){

        foreach ($data as $datum){
            if ($datum->key == 'register_response_username'){$register_response_username =  $datum->value;}
            elseif ($datum->key == 'register_response_email'){$register_response_email =  $datum->value;}
            elseif ($datum->key == 'register_response_password'){$register_response_password =  $datum->value;}
            elseif ($datum->key == 'register_role'){$register_role =  $datum->value;}
            elseif ($datum->key == 'register_url'){$register_url =  $datum->value;}
        }

        $url = get_admin_url()."admin-post.php";
        $imageUrl = plugin_dir_url( '' ) . PLUGDIR . '/assets/images/question.png';

        return <<<HTML

  <div class="tab-pane fade shadow rounded bg-white p-5" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <h4 class="font-italic mb-4">تنظیمات ثبت نام</h4>
                      <p class="font-italic text-muted mb-2">لطفا اطلاعات را با دقت ویرایش فرمایید و در صورت متوجه نشدن یک بخش از علامت سوال استفاده فرمایید</p>
                   
                   
                   
                   
                   <form action="{$url}" method="post">
  <div class="form-group">
  
  <img class="tooltipImage" src="{$imageUrl}"
 title="در صورتی که از سمت کلاینت یوزرنیم خالی ارسال شود ، چه نوع اروری نمایش داده شود ، متنش را بنویسید" 
 data-toggle="tooltip">
  
    <label for="register_response_username">متن خالی بودن فیلد یوزر نیم ارسالی</label>
    <input type="text" name="register_response_username" value="{$register_response_username}" class="form-control" id="register_response_username" placeholder="آیدی ادمین در وب سایت خود را وارد فرمایید">
  </div>
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="در صورتی که از سمت کلاینت ایمیل خالی ارسال شود ، چه نوع اروری نمایش داده شود ، متنش را بنویسید" 
 data-toggle="tooltip">
    <label for="register_response_email">متن خالی بودن فیلد ایمیل ارسالی</label>
    <input type="text" name="register_response_email" value="{$register_response_email}" class="form-control" id="register_response_email" placeholder="آدرس">
  </div>
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="در صورتی که از سمت کلاینت رمز خالی ارسال شود ، چه نوع اروری نمایش داده شود ، متنش را بنویسید" 
 data-toggle="tooltip">
    <label for="register_response_password">متن خالی بودن فیلد رمز ارسالی</label>
    <input type="text" name="register_response_password" value="{$register_response_password}" class="form-control" id="register_response_password" placeholder="آدرس">
  </div>
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="اگر افزونه ووکامرس نصب باشد ، مورد دوم شناسایی میشود ، مثلا این نمونه : 
 wp-wc = subscriber-customer
 یعنی اگر ووکامرس نصب نبود wp اعمال شود اما اگر نصب بود wc اعمال شود
 
 " 
 data-toggle="tooltip">
    <label for="register_role">نقش کاربری کاربر در زمان ثبت نام (wp-wc)=>(subscriber-customer)</label>
    <input type="text" name="register_role" value="{$register_role}" class="form-control" id="register_role" placeholder="آدرس">
  </div>
  
  <div class="form-group">
  <img class="tooltipImage" src="{$imageUrl}"
 title="آدرس این rest-api
 example : site.com/wp-json/wp/v2/users/register
 پارامتر های ارسالی به صورت پست و username-email-password است
 " 
 data-toggle="tooltip">
    <label for="register_url">آدرس rest api</label>
    <input type="text" name="register_url" value="{$register_url}" class="form-control" id="register_url" placeholder="آدرس">
  </div>
  
        <!--   in input hidden action bayad bashe ta admin-post kar kone -->
  <input type="hidden" name="action" value="submit-form" /> 
      <input type="hidden" name="form" value="register"/>
  <input type="submit" value="ثبت اطلاعات" class="btn btn-primary">
  
  
</form>
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                    </div>

  
HTML;
    }



}
