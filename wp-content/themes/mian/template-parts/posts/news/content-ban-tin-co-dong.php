<?php
    query_posts( array (  'post_type' => 'page', 'post__in' => array( 905 ) ));
    if(have_posts()): 
        the_post();
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");
    endif;
    wp_reset_query();
    if(have_posts()): 
        the_post();
        $curId = get_the_ID();
        
?>
<div class="page-banner">
    <img src="<?php echo $banner['url'] ?>" data-bmobile="<?php echo $banner_mobile['url'] ?>" id="banner_mobile" />
</div>
<div class="new-detail">
    <div class="new-detail-des">
        <h1><div class="cate-title"><?php the_title(); ?></div></h1>
        <?php the_content() ?>
    </div>
    <div class="relative-side">
        <h2><?php _e("Related News", "mian") ?></h2>
        <ul class="listnewsr">
        
            <?php
                $args = [
                    'post_type'      => array('newsletter'),
                    'nopaging' => true,
                    'post__not_in' => array($curId),
                ];
                $loop = new WP_Query($args);
                while ($loop->have_posts()) : 
                    $loop->the_post();
                    $thumbnail = get_field("thumbnail");
            ?>
            <li>
                <div class="new-img"><a href="<?php the_permalink() ?>"><div class="softover"><img src="<?php echo $thumbnail['url'] ?>" /></div></a></div>
                <div class="new-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
            </li>
            <?php
                endwhile;
                wp_reset_query();
            ?>
            
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<?php
    endif;
?>
<script>
    $(function(){
       setActiveNews(); 
    });
</script>