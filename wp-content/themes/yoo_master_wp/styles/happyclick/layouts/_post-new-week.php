<article id="item-<?php the_ID(); ?>" class="item courses" data-permalink="<?php the_permalink(); ?>">
    <header class="course-wrapper">
        <h3 class="course-title"><?php the_title() ?></h3>
    </header>
	<div class="content clearfix">
		<?php the_content(''); ?>
	</div>
    <script type="text/javascript">
        (function($){
            $('.nw_answers').hide();
            var $total_point    = 0;
            var $array          = new Array();
            var $count          = 0;
            $(".quiz input").click(function(){
                key = $(this).attr('name');
                if(!$array[key]){ 
                    $array[key] = 0;
                    $count      += 1;
                }
                $total_point    -= $array[key];
                $total_point    += parseInt($(this).val());
                $array[key]      = parseInt($(this).val());
                $('#total_point').text(' '+$total_point);
                console.log($count);
            });
            $(".tong_diem a").click(function(){
                $('.nw_answers').hide();
                if($count < 10){
                    alert('Vui lòng lựa chọn đầy đủ các đáp án để biết được kết quả!')
                    return false;
                }
                if($total_point >= 24){
                    $("#answer1").show('slow');
                    return false;
                }
                if($total_point >= 17){
                    $("#answer2").show('slow');
                    return false;
                }
                if($total_point >= 10){
                    $("#answer3").show('slow');
                    return false;
                }
                return false;
            });
        })(jQuery);
    </script>
</article>