			<footer>
				<div class="footer">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="info-footer">
								    <h4><?php theCompanyName(); ?></h4>
							        <p>Địa chỉ: <?php theAddress(); ?></p>
							        <p>Điện thoại: <?php thePhone(); ?></p>
							        <p>Email:<?php theEmail(); ?></p>
							        <p>Website:<?php theWeb(); ?></p>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="fan-page">
									<h4>Kết nối với chúng tôi</h4>
									<div class="fb-page" data-href="<?php theFacebook();?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="cont-footer">
									<h4>Đăng ký mail</h4>
									<p>Đăng kí email để nhận được thông tin về các sự kiện và chương trình giảm giá sớm nhất!</p>
									<form id="gmSubmitEmail" action="/wp-admin/admin-ajax.php" method="post">
										<input type="email" name="email" placeholder="Nhập địa chỉ email" required="" class="form-control">
										<button type="submit" name="submit" class="btn-primary">Gửi đi</button>
										<?php wp_nonce_field(get_bloginfo('url') . '_submit_email') ?>
          					<input type="hidden" name="action" value="registration_of_consultants">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="copy-right">
					<div class="container">
						<?php the_time('Y'); ?> Copyright © <?php bloginfo('name') ?>. All rights reserved. Design by <a href="http://nrglobal.vn/" target="_blank">NR GLOBAL</a>
					</div>
				</div>
			</footer>
			<a href="javascript:void(0)" title="Lên đầu trang" id="go-top"></a>
			<nav id="menu">
				<?php
					wp_nav_menu([
		                        'menu'           => 'gm-primary',
		                        'theme_location' => 'gm-primary',
		                        'container'      => false,
		                        'menu_class' => '',
		                    ])
		        ?>
			</nav>
		</div>
		<?php wp_footer(); ?>
		<script>
			jssor_slider1_starter('_slider');
		</script>
		<script type="text/javascript">
			$(function() {
				$('nav#menu').mmenu({
					extensions	: [ 'effect-slide-menu', 'pageshadow' ],
					searchfield	: true,
					counters	: false,
					navbar 		: {
						title	: '<?php theCompanyName(); ?>'
					},
					offCanvas   : {
						position: "right"
					},
					navbars 	: [
						{
							position	: 'top',
							content		: [ 'searchfield' ]
						}, {
							position	: 'top',
							content		: [
								'prev',
								'title',
								'close'
							]
						}
					]
				});
			});
		</script>
	</body>
</html>
