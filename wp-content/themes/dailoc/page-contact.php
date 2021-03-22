<?php 
    //Template name: Liên hệ
    get_header(); the_post(); 
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
        <div class="container main-page contact-us">
            <div class="row">
                <?php get_sidebar(); ?>
                <div class="col-xs-12 col-sm-9 col-md-9">
                    <div class="contents-page">
                        <div class="page-item-title">
                            <img src="<?php echo get_template_directory_uri(); ?>/public/images/Capture.jpg" alt="" width="100%" height="auto">
                            <h4><?php the_title(); ?></h4>
                        </div>
                        <div class="page-contents">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php theMap(); ?>
                                </div>
                            </div>
                            <div class="row content-contact">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <h6><?php theCompanyName() ?></h6>
                                    <p><i class="fa fa-map-marker" aria-hidden="true" style="margin-right: 19px;"></i>Địa chỉ:  <?php theAddress() ?> </p>
                                    <p><i class="fa fa-phone-square" aria-hidden="true"></i> Điện thoại : <?php thePhone() ?></p>
                                    <p><i class="fa fa-envelope" aria-hidden="true"></i> Email : <?php theEmail() ?></p>
                                    <p><i class="fa fa-globe" aria-hidden="true"></i> Website : <?php theWeb() ?></p>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="contact-form">
                                        <h4>Hoặc liên hệ trực tiếp tại đây:</h4>
                                        <form id="gmContactForm" action="/wp-admin/admin-ajax.php" method="post" role="form">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" id="gm-input--name" placeholder="<?php echo __('Họ và tên', 'gaumap') ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="tel" id="gm-input--tel" placeholder="<?php echo __('Điện thoại', 'gaumap') ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" id="gm-input--email" placeholder="<?php echo __('Email', 'gaumap') ?>">
                                            </div>
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" name="message" id="gm-input--message" rows="5" style="resize: none;"></textarea>
                                            </div>
                                            <input type="hidden" name="action" value="submit_contact_form">
                                            <?php wp_nonce_field(get_bloginfo('url') . '_submit_contact')?>
                                            <button type="submit" class="btn btn-primary">Liên hệ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->

<?php get_footer() ?>