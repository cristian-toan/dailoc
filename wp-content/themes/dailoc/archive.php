<?php 
	get_header(); 
	$obj = get_queried_object();
?>

<!-- main-content -->
	<div class="main">
		<div class="breadcrumb">
	        <div class="container">
	            <div class="row">
	            	<div class="col-lg-12">
		            	<div class="main-breadcrumb">
		            		<?php echo yoast_breadcrumb() ?>
		            	</div>
		            </div>
	            </div>
	        </div>
	    </div>
		<div class="container main-page">
			<div class="row">
				<?php get_sidebar(); ?>
				<div class="col-xs-12 col-sm-9 col-md-9">
					<div class="contents-page">
						<div class="page-item-title text-center">
							<h4><?php echo $obj->name ?></h4>
						</div>
						<div class="page-contents">
							<?php if(have_posts()) : ?>
								<?php while(have_posts()) : the_post(); ?>
									<?php if($obj->term_id != 1): ?>
										<?php get_template_part('content', 'contract'); ?>
									<?php else: ?>
										<?php get_template_part('content'); ?>
									<?php endif; ?>
								<?php endwhile; ?>
			                    <?php wp_reset_postdata() ?>
			                    <?php wp_reset_query() ?>
			                <?php else: ?>
			                	<p class="text-center" style="color: red; font-size: 20px">Nội dung chưa được cập nhật</p>
							<?php endif; ?>
						</div>
						<div class="row pagi">
		                    <div class="col-lg-12">
		                        <?php thePagination() ?>
		                    </div>
		                </div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<!-- end main -->

<?php get_footer() ?>