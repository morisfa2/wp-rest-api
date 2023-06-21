<?php
namespace admin;
require_once 'interface.php';
use showtab;
class login implements showtab {
    public static function show ($data){
        foreach ($data as $datum){
        if ($datum->key == 'adminId'){$adminId =  $datum->value;}
        elseif ($datum->key == 'loggedinuser_url'){$loggedinuser_url =  $datum->value;}
        elseif ($datum->key == 'userJWT_url'){$userJWT_url =  $datum->value;}
       }
$imageUrl = plugin_dir_url( '' ) . PLUGDIR . '/assets/images/question.png';

return '<div class="tab-pane fade shadow rounded bg-white show active p-5" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <h4 class="font-italic mb-4">تنظیمات عمومی ورود و فراموشی</h4>
                       <p class="font-italic text-muted mb-2">در این بخش تنظیمات ورود و فراموشی رمز عبور و تنظیمات عمومی همگی با هم قرار دارند </p>
                  
                  
                   <form action="'.get_admin_url().'admin-post.php" method="post">
  <div class="form-group">
 
 
 
   
<img class="tooltipImage" src="'.$imageUrl.'"
 title="آیدی ادمین برای باز کردن برخی محدودیت ها در rest api لازم است" 
 data-toggle="tooltip">
 
 
 
 
 
    <label for="adminId">آیدی ادمین</label>
    <input type="number" name="adminId" value="'.$adminId.'" class="form-control sm" id="adminId" placeholder="آیدی ادمین در وب سایت خود را وارد فرمایید">
  </div>
  <div class="form-group">
 <img class="tooltipImage" src="'.$imageUrl.'"
 title="آدرس لاگین ، 
 این آدرس به صورت زیر خواهد بود : 
 site.com/wp-json/testone/loggedinuser
 متد ارسالی به صورت post است 
 
 و پارامتر هایی که باید به این ارسال شود username و password است
 json {
 username:test,
 password:test,
 }
 " 
 data-toggle="tooltip">
    <label for="loggedinuser_url">آدرس rest-api لاگین (لطفا همانند نمونه تنها دو بخش ، و توسط - جداشود ، طبق نمونه اما کلمات متفاوت ، سه ادرس مجاز نیست)</label>
    <input type="text" name="loggedinuser_url" value="'.$loggedinuser_url.'" class="form-control" id="loggedinuser_url" placeholder="آدرس">
  </div>
  <div class="form-group">
  <img class="tooltipImage" src="'.$imageUrl.'"
 title="آدرس لاگین به وسیله توکن ، متد ارسالی به صورت get است و 
 و آدرس ارسالی چیزی به صورت زیر میشود 
 site.com/wp-json/testone/loggedinuserJWT?token=
 پارامتری که باید به صورت گت ارسال شود ، token است
     token=token
 " 
 data-toggle="tooltip">
    <label for="userJWT_url">آدرس rest-api لاگین با توکن بدون یوزر و پس (لطفا همانند نمونه تنها دو بخش ، و توسط - جداشود ، طبق نمونه اما کلمات متفاوت ، سه ادرس مجاز نیست)</label>
    <input type="text" name="userJWT_url" value="'.$userJWT_url.'" class="form-control" id="userJWT_url" placeholder="آدرس">
  </div>
<!--   in input hidden action bayad bashe ta admin-post kar kone -->
  <input type="hidden" name="action" value="submit-form" /> 
      <input type="hidden" name="form" value="login"/>
  <input  type="submit" value="ثبت اطلاعات" class="btn btn-primary">
</form>
                   
                   
             
                   
                   
                   
                   
                   
                   
                    </div>';












    }
}
