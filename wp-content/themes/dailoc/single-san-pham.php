<?php get_header(); the_post(); ?>
<?php
	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));
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
		<div class="container main-page single-pro">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="owl-carousel owl-theme my-carousel gal-single-pro">
						<?php $images = carbon_get_post_meta(get_the_ID(), 'images') ?>
						<?php foreach($images as $image) : ?>
						<div class="item">
							<div class="img">
								<img src="<?php echo wp_get_attachment_image_url($image, 'full') ?>" alt="<?php the_title(); ?>">
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="contents-page">
						<div class="page-item-title">
							<h4><?php the_title(); ?></h4>
						</div>
						<div class="page-contents">
							<div class="price">
								<?php
								   	$price = getCarbonPostMeta('price');
								   	if(!empty($price)):
								   		echo 'Giá: '.number_format($price) . 'đ';
								   	endif;
								?>
							</div>
							<div class="view">Lượt xem: 
								<?php setPostViews(get_the_ID()); ?>
				 				<?php echo getPostViews(get_the_ID()); ?>
			                </div>
			                <div class="social-post" style="margin-top: 20px;">
		                        <div class="share-buttons">
		                           <div class="fb-like" data-href="<?php echo $current_url ;?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
		                        </div>
		                        <div class="share-face" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url ;?>','_blank')" class="fa fa-facebook">Chia sẻ</div>
		                        <div style="clear:both"></div>
		                    </div>
						</div>
					</div>	
				</div>
				<div class="col-lg-12">
     				<div class="single-info-pro">
         				<ul class="nav nav-tabs">
						    <li class="active"><a data-toggle="tab" href="#home">Thông tin sản phẩm</a></li>
						    <li><a data-toggle="tab" href="#menu1">Bình luận</a></li>
						</ul>

					  <div class="tab-content">
					    <div id="home" class="tab-pane fade in active">
					   		<?php if(the_content() !=''): the_content(); else: echo 'Đang cập nhật'; endif; ?>
					    </div>
					    <div id="menu1" class="tab-pane fade">
					     	<div class="fb-comments" data-href="<?php echo $current_url ;?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>
					    </div>
					  </div>
         			</div>
     			</div>
			</div>
		</div>
	</div>
	<!-- end main -->

<?php get_footer() ?>