(function($) {
    /* Jquery carousel script */
    $(document).ready(function() {
        jQuery('#mycarousel').jcarousel();
<<<<<<< HEAD
=======
        /* ---
            jQuery(".video-item a").fancybox({
                width: 560,
                height: 315,
                type: "iframe",
                iframe : {
                  preload: false
                }
            });
        --- */
        /* remove links from .remove_link */
        $('.remove_link a').attr('href', 'javascript:void(0)');
        $('.remove_link a').attr('title', '');
        
>>>>>>> 5ffabdff88e709ea9e3b4ae624a1b365c3c5395d
    });
})(jQuery);