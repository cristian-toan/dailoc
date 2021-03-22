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
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="contents-page">
						<div class="page-item-title text-center">
							<h4>
								<?php 
									if($obj->name == 'san-pham'):
										echo "Sản phẩm";
									else:
										echo $obj->name;
									endif;
								?>
							</h4>
						</div>
						<div class="page-contents">
							<?php if(have_posts()) : ?>
								<?php while(have_posts()) : the_post(); ?>
									<?php get_template_part('content', 'san-pham'); ?>
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