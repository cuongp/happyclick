<li class="jcarousel-item jcarousel-item-horizontal video-item">
    <?php 
    $youtubeVideo = get_post_custom_values('youtube-video'); 
    $youtubeVideo_link = $youtubeVideo[0];
    ?>
    <a href="<?php the_permalink() ?>" class="iframe">
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
    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
</li>