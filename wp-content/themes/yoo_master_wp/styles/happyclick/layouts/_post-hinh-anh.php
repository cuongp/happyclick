<div class="gallery_item">
    <a href="<?php the_permalink(); ?>">
        <div class="gallery_thumb">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?> 
        </div>
    </a>
    <span class="remove_link"><?php echo get_the_category_list(); ?></span>
    <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
    <span class="event_date"><?php echo get_the_date('d/m/Y') ?></span>
</div>