<div class="col-sx-12 col-sm-3 col-md-3 side-bar">
	<div class="left-ser">
		<h6>Tin tức nổi bật</h6>
		<ul>
			<?php
                $specPost = new WP_Query([
                                           'post_type'      => 'post',
                                           'post_status'    => 'publish',
                                           'posts_per_page' => 20,
                                           'cat'            => 1,
                                           'meta_query' =>[
                                           		array(
											   'key'     => '_feature',
											   'value'   => 'yes',
											)
                                           ],
											  
                                       ]);

            ?>
            <?php if($specPost->have_posts()) : ?>
    	 		<?php while($specPost->have_posts()) : $specPost->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endwhile; ?>
	            <?php wp_reset_postdata() ?>
	            <?php wp_reset_query() ?>
	        <?php endif; ?>
		</ul>	
	</div>
</div>