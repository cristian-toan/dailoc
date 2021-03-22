<div class="gm-list--post">
    <div class="row">
        <div class=" col-xs-12 col-lg-3">
            <a href="<?php the_permalink(); ?>"><img src="<?php thePostThumbnailUrl() ?>" alt="<?php the_title(); ?>"></a>
        </div>
        <div class=" col-xs-12 col-lg-9">
            <div class="post-right">
                <div class="gm-content--post_title">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                </div>
                <div class="post-excerpt">
                    <?php theExcerpt(100) ?>
                </div>
            </div>
        </div>
    </div>
</div>