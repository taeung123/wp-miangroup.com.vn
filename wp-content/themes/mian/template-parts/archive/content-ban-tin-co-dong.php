<?php
    query_posts( array (  'post_type' => 'page', 'post__in' => array( 905 ) ));
    if(have_posts()): 
        the_post();
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");
?>
<div class="page-banner">
    <img src="<?php echo $banner['url'] ?>" data-bmobile="<?php echo $banner_mobile['url'] ?>" id="banner_mobile"/>
</div>
<div class="news-des">
    <div class="term-describe"><?php the_content() ?></div>
    <ul class="listnews">
        
        <?php
            $args = [
                'post_type'      => array('newsletter'),
                'nopaging' => true,
            ];
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : 
                $loop->the_post();
                $thumbnail = get_field("thumbnail");
        ?>
        <li>
            <div class="new-img"><a href="<?php the_permalink() ?>"><div class="softover"><img src="<?php echo $thumbnail['url'] ?>" /></div></a></div>
            <div class="new-title"><?php the_title() ?></div>
            <div class="new-excerpt"><?php the_excerpt() ?></div>
            <div class="linkwebsite">
                <a  href="<?php the_permalink() ?>"><?php _e("Chi tiết", "mian") ?></a>
            </div>
        </li>
        <?php
            endwhile;
            wp_reset_query();
        ?>
        
    </ul>
    <div class="clearfix"></div>
</div>
<?php
    endif;
    wp_reset_query();
?>
<script>
    $(function(){
       setActiveNews(); 
    });
</script>