<article id="item-<?php the_ID(); ?>" class="item courses-sub" data-permalink="<?php the_permalink(); ?>">
    <?php if (has_post_thumbnail()) : ?>
        <?php
        $width = '295'; //get the width of the thumbnail setting
        $height = '195'; //get the height of the thumbnail setting
        ?>
        <div class="course-thumbnail"><?php the_post_thumbnail(array($width, $height), array('class' => 'size-auto')); ?></div>
    <?php endif; ?>
    <div class="item-global-info">
        <p><strong><?php echo get_the_date('d/m/Y') ?></strong></p>
        <h3 class="course-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
        <a class="course-readmore black-arrow" href="<?php the_permalink(); ?>">Xem chi tiết</a>
    </div>
</article>