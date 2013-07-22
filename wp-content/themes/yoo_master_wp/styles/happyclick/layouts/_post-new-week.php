<article id="item-<?php the_ID(); ?>" class="item courses" data-permalink="<?php the_permalink(); ?>">
    <header class="course-wrapper">
        <h3 class="course-title"><?php the_title() ?></h3>
    </header>
	<div class="content clearfix">
		<?php the_content(''); ?>
	</div>
    <script type="text/javascript">
        (function($){
            var $total_point    = 0;
            var $array          = new Array();
            $(".quiz input").click(function(){
                key = $(this).attr('name');
                if(!$array[key]) $array[key] = 0;
                $total_point    -= $array[key];
                $total_point    += parseInt($(this).val());
                $array[key]      = parseInt($(this).val());
                console.log($array);
                console.log('Total = ' + $total_point);
            });
            $(".tong_diem a").click(function(){
                return false;
            });
        })(jQuery);
    </script>
</article>