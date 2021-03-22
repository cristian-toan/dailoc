<!doctype html>
<html lang="vi">
<head>
    <?php wp_head() ?>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0&appId=868416699997009&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
   
</head>
<body>
	<div class="wrapper">
		<header class="header">
			<div class="header-top" style="background: url(<?php theBannerUrl(); ?>) no-repeat center center;">
				<div class="container">
				    <div class="row">
					    <div class="col-xs-12 col-sm-3 col-md-3">
						    <div class="logo wow zoomInDown">
						       <a href="/">
								    <img src="<?php theLogoUrl() ?>" alt="<?php bloginfo('name') ?>">
								</a>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<h1 class="name-com"><?php theCompanyName(); ?></h1>
							<div class="address">
								<p><?php theSlogan(); ?></p>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3 md-3">
							<div class="right_head">
						        <div class="social-footer">
		                          	<a href="<?php theFacebook(); ?>" target="blank"><img src="<?php echo get_template_directory_uri(); ?>/public/images/face.png" alt="facebook"></a>
		                          	<a href="<?php theGooglePlus(); ?>" target="blank"><img src="<?php echo get_template_directory_uri(); ?>/public/images/google.png" alt="t"></a>
		                          	<a href="<?php theTwitter(); ?>" target="blank"><img src="<?php echo get_template_directory_uri(); ?>/public/images/twitter.png" alt="g"></a>
		                         	<a href="<?php theYoutube(); ?>" target="blank"><img src="<?php echo get_template_directory_uri(); ?>/public/images/youtube.png" alt="y"></a>
		                      	</div>  
						        <div class="hotline	">
						            <p>Hotline hỗ trợ</p>
						            <span><?php thePhone(); ?></span>
						         </div>
					        </div>
						</div>
					</div>
				</div>
			</div>
			<div class="menu">
				<div class="container">
					<nav class="navigation" role="navigation">
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
			</div>
		</header>
		<header class="header-sm Fixed clearfix">
			<div class="logo animated zoomInLeft">
				<a href="/"><img src="<?php theLogoUrl() ?>"></a>
			</div>
			<a id="hamburger" href="#menu"><span></span></a>
		</header>
		<div class="slider">
		   <div id="_slider" style="position: relative; margin: 0; top: 0; left: 0; width: 1920px; height: 846px; overflow: hidden; max-width: 100%;">

				<div u="loading" style="position: absolute; top: 0; left: 0;">
					<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0; left: 0; width: 100%; height: 100%;">
					</div>
					<div style="position: absolute; display: block;  top: 0; left: 0; width: 150%; height: 100%;">
					</div>
				</div>
				<div u="slides" style="position: absolute; left: 0; top: 0; width: 1920px; height: 846px; overflow: hidden; ">
					<?php $sliders = getSlideShow() ?>
					<?php foreach($sliders as $slider) : ?>
					<div>
						<a class="link-banner" href="#" title="">
							<img class="banner" u="image" src="<?php echo wp_get_attachment_image_url($slider['image'], 'full') ?>" alt="<?php bloginfo('name') ?>" />
						</a>
					</div>
					<?php endforeach; ?>
				</div>
				<span u="arrowleft" class="jssoral" style="top: 50%; left: 67px;"></span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssorar" style="top: 50%; right: 67px;"></span>
			</div>
		</div>