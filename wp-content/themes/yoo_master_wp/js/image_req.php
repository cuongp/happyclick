<?php

// Echo the image - timestamp appended to prevent caching
echo '<a href=""  id="refreshimg"  title="Click to refresh image"><img src="/wp-content/themes/yoo_master_wp/js/images/image.php?' . time() . '" width="132" height="46" alt="Captcha image" /></a>';

?>