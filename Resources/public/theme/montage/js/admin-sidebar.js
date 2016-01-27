jQuery(document).ready(function () {

    if(jQuery('.switch-button').length > 0){
        $('.switch-button').click(function () {
            console.log('close');
            if (jQuery(this).is('.open')) {
                jQuery(this).addClass('closed');
                jQuery(this).removeClass('open');
                jQuery('.rzcms-admin-cmsmenu').animate({
                    'left': '-210px'
                });
            } else {
                console.log('open');
                jQuery(this).addClass('open');
                jQuery(this).removeClass('closed');
                jQuery('.rzcms-admin-cmsmenu').animate({
                    'left': '0px'
                });
            }
        });
    }

    if(jQuery('.switch-button').length > 0){
        jQuery('.switch-button').addClass('closed');
    }

    if(jQuery('.rzcms-admin-cmsmenu').length > 0){
        jQuery('.rzcms-admin-cmsmenu').animate({
            'left': '-210px'
        });
    }
});