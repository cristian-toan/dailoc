<?php 
    $obj = get_queried_object();
?>

<div class="box-spnbnb col-xs-6 col-sm-3 col-md-3">
    <div class="tintucspnb">
        <div class="item_spnb">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php thePostThumbnailUrl('full') ?>" alt="<?php the_title(); ?>">
            </a>

            <div class="tinspnb" onclick="document.location.href ='<?php the_permalink(); ?>'">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php
                    if($obj->term_id != 5):
                ?>
                    <p>
                        Giá : 
                        <?php
                            $price = getCarbonPostMeta('price');
                            if(!empty($price)) echo number_format($price) . 'VNĐ';
                            else echo __('Liên hệ', 'gaumap');
                        ?>
                    </p>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>