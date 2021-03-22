<?php get_header(); the_post(); ?>
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
				<?php
					$categories = get_the_category();
					if($categories[0]->cat_ID == 1): ;
						$i = 9;
						get_sidebar();
					else:  
						$i = 12;
					endif;
				?>
				<div class="col-xs-12 col-sm-<?php echo $i; ?> col-md-<?php echo $i; ?>">
					<div class="contents-page">
						<div class="page-item-title">
							<h4><?php the_title(); ?></h4>
						</div>
						<div class="page-contents">
							<?php theContent(); ?>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<!-- end main -->

<?php get_footer() ?>