<div id="system">   
<?php  
if ( get_query_var('paged') ) $paged = get_query_var('paged');    
if ( get_query_var('page') ) $paged = get_query_var('page');  
global $query_string;  
query_posts($query_string . '&post_type=hoithao&posts_per_page=-10&paged=' . $paged);  
if (have_posts()) : ?>
<?php
endif;
?>
</div>