<!DOCTYPE html>
<html <?php echo language_attributes(); ?> >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title><?php wp_title(""); ?></title>
        <?php wp_head();  ?>
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri()?>/favicon/favicon-32x32.png">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri()?>/favicon/favicon-32x32.png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=vietnamese" rel="stylesheet">
        <?php
        
            $a_css = array(
                '/css/materialize.min.css',
                '/css/slick.css',
                '/css/slick-theme.css',
                '/js/jquery.mCustomScrollbar.css',
                '/css/jquery.fancybox.min.css',
                '/style.css',
                '/css/animate.css',
                '/scss/main.css'
            );
        ?>
        
        <?php foreach ($a_css as $css) { ?>
        <link rel="stylesheet" type="text/css" href='<?php echo get_template_directory_uri() . $css ?>' media="screen,projection"/>
        <?php } ?>
        <script type="text/javascript">var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>   
        <?php
            $a_js = array(
                '/js/jquery.min.js',
                '/js/materialize.min.js',
                '/js/jssor.slider.min.js',
                '/js/slick.min.js',
                '/js/jquery.mCustomScrollbar.concat.min.js',
                '/js/jquery.fancybox.min.js',
            );
            $a_js[] = '/js/script.js';
        ?>
        <?php foreach ($a_js as $js) { ?>
        <script type="text/javascript" src='<?php echo get_template_directory_uri() . $js?>' ></script>

        <?php } 
        if(is_front_page()) {
        ?>

        <script type="text/javascript" src="https://rawgit.com/peachananr/onepage-scroll/master/jquery.onepage-scroll.js"></script>
        <?php }?>
    </head>
<body <?php body_class()  ?> >



    