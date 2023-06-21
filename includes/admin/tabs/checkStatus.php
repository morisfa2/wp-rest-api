<?php
namespace admin;
require_once 'interface.php';
use showtab;
class checkStatus implements showtab {
    public static function show ($data){
        foreach ($data as $datum){
            if ($datum->key == 'register_response_username'){$register_response_username =  $datum->value;}
            elseif ($datum->key == 'register_response_email'){$register_response_email =  $datum->value;}
            elseif ($datum->key == 'register_response_password'){$register_response_password =  $datum->value;}
            elseif ($datum->key == 'register_role'){$register_role =  $datum->value;}
            elseif ($datum->key == 'register_url'){$register_url =  $datum->value;}
        }


        $url = get_admin_url()."admin-post.php";
        return <<<HTML

 <div class="tab-pane fade shadow rounded bg-white p-5" id="checkStatus" role="tabpanel" aria-labelledby="checkStatus-tab">
                        <h4 class="font-italic mb-4">برسی وضعیت کارکرد سیستم</h4>
                        <p class="font-italic text-muted mb-2">
                           تنظیمات سایت مپ بزودی در این ماه اضافه خواهد شد
                        </p>
                 
                 
                  <form action="{$url}" method="post">
                   <!--   in input hidden action bayad bashe ta admin-post kar kone -->
  <input type="hidden" name="action" value="submit-form" /> 
      <input type="hidden" name="form" value="checkStatus"/>
  <input value="ثبت اطلاعات" type="submit" class="btn btn-primary">
</form>
                    </div>
                    
                  

HTML;
    }



}
