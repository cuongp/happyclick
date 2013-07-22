(function($) {
    $(document).ready(function() {
        /* Jquery carousel script */
        jQuery('#mycarousel').jcarousel();
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
    });
})(jQuery);