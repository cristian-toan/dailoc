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
				<?php get_sidebar(); ?>
				<div class="col-xs-12 col-sm-9 col-md-9">
					<div class="contents-page">
						<div class="page-item-title text-center">
							<h4>Lỗi 404: Không tìm thấy trang bạn yêu cầu</h4>
						</div>
						<div class="page-contents">
							Không tìm thấy trang bạn yêu cầu
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<!-- end main -->

<?php get_footer() ?>