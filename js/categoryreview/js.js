/**
 * Created by Dmytryi on 05.01.2015.
 */

var CaptchaError = 0;

    function captchaError(){
    if(CaptchaError === 1){
        window.setTimeout(function(){
            jQuery('.expand-form').click();
            scrollTo('categoryreview_captcha');
        },500);

    }
}

function scrollTo(hash) {
    location.hash = "#" + hash;
}

jQuery(document).ready(function(){

    jQuery(document).on('click', '.expand-form', function(){
        if(jQuery(this).hasClass('act')) {
            jQuery(this).removeClass('act');
            jQuery('.review-form').show(300);
        } else {
            jQuery(this).addClass('act');
            jQuery('.review-form').hide(300);
        }
        return false;
    });

    captchaError();

});

