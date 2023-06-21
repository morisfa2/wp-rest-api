jQuery('#deactivate-wp-rest-api').click(function(){
    jQuery('#deactivate-wp-rest-api').pointer({
        content: '<div class="confirm">' +
            ' <h1>اخطار : حذف را تایید میکنید ؟</h1> ' +
            '<p>آیا شما واقعا  <em>مطمئن</em>' +
            ' <strong> مطمئن </strong> هستید برای غیر فعال کردن ؟ با غیرفعال سازی تمامی تنظیمات به حالت پیشفرض باز خواهد گشت و تغییرات شما از بین خواهد رفت</p>' +
            ' <button onclick="go()" id="okdelete" autofocus>بله</button> </div>',
        position: {
            my: 'center top',
            at: 'center bottom',
            offset: '-1 0'
        },
        close: function() {
            return true;
        }
    }).pointer('open');
    return false;
});
function go(){
    window.location.href =  "/wp-admin/" + jQuery('#deactivate-wp-rest-api').attr("href");
}
