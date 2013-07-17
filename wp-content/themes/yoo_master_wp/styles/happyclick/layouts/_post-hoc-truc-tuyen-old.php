<li class="jcarousel-item jcarousel-item-horizontal">
    <a href="<?php the_permalink(); ?>">
        <div class="course-thumbnail-old">
            <?php if (has_post_thumbnail()) : ?>
                <?php
                $width = '295'; //get the width of the thumbnail setting
                $height = '195'; //get the height of the thumbnail setting
                ?>
                <?php the_post_thumbnail(array($width, $height), array('class' => 'size-auto')); ?>
            <?php endif; ?> 
        </div>
    </a>
    <?php the_title() ?>
</li>