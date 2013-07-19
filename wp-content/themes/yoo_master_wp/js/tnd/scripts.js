(function($) {
    $(document).ready(function() {
        /* Jquery carousel script */
        jQuery('#mycarousel').jcarousel();
        
        /* remove links from .remove_link */
        $('.remove_link a').attr('href', 'javascript:void(0)');
        $('.remove_link a').attr('title', '');
        
    });
})(jQuery);