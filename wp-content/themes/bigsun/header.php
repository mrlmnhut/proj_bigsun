<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="<?= get_template_directory_uri() ?>/assets/images/logoevent.ico" type="image/x-icon"/>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<header id="main">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="nav">
        <div class="container">
            <a class="navbar-brand" href="<?= home_url(); ?>" id="logo">
                <div id="img-logo-bg">
                    <div id="img-logo">
                        <p><?php echo get_theme_mod('header_text_logo'); ?>
                            <img src="<?php echo get_theme_mod('blogo'); ?>"></p>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul id="" class="navbar-nav ml-auto">
                    <li class=""><a href="<?= get_bloginfo('url') ?>/#about-us">GIỚI THIỆU</a></li>
                    <li class=""><a href="<?= get_bloginfo('url') ?>/#what-we-do">DỊCH VỤ</a></li>
                    <li class=""><a href="<?= get_bloginfo('url') ?>/#section-photo">HÌNH ẢNH </a>
                    </li>
                    <li class=""><a href="<?= get_bloginfo('url') ?>/#section-news">TIN TỨC</a></li>
                    <li class=""><a href="<?= get_bloginfo('url') ?>/#partner">ĐỐI TÁC</a></li>
                    <li class=""><a href="<?= get_bloginfo('url') ?>/#contact-us">LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

