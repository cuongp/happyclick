<li class="jcarousel-item jcarousel-item-horizontal">
    <a href="<?php the_permalink(); ?>">
        <div class="course-video-thumb">
            <?php if (has_post_thumbnail()) : ?>
                <?php
                $width = '185'; //get the width of the thumbnail setting
                $height = '105'; //get the height of the thumbnail setting
                ?>
                <?php the_post_thumbnail(array($width, $height), array('class' => 'size-auto')); ?>
            <?php endif; ?> 
        </div>
    </a>
    <?php the_title() ?>
</li>