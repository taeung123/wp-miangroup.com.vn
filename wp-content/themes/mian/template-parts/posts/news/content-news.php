<?php
    query_posts( array (  'post_type' => 'page', 'post__in' => array( 365 ) ));
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
<div class="page-banner" style="background-image: url(<?php echo $banner['url'] ?>);">
    <div class="container">
        <h3><?php the_title(); ?></h3>
    </div>
</div>

<div class="new-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="new-detail-des">
                    <h3 class="post-title"><?php the_title(); ?></h3>
                    <div class="post-date">
                        <time class="updated" datetime="<?php echo get_post_time('c', true); ?>">
                            <img src="/wp-content/themes/mian/images/calendar.png" alt=""><span><?php echo get_the_date('d/m/Y') ?></span>
                        </time>
                    </div>
                    <div class="detail-content">
                    <?php 
                        the_content(); ?>
                    </div>
                    <?php 
                        single_social_sharing();
                   ?>
                    
                </div>
                
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <?php
                    if (is_active_sidebar('main-sidebar')) {
                        echo '<div  id="widget-area" class="widget-area" >';
                        dynamic_sidebar('main-sidebar');
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        <?php
$object = get_queried_object();

?>
        <div class="related renews-related">
        <div class="related-heading">
            <h3><?php esc_html_e( 'TIN TỨC LIÊN QUAN', 'mian' ); ?></h3>
        </div>
        <?php

        $args = array(
        'post_type' => 'news',
        'orderby' => 'date',
        'order ' => 'DESC',
        'ignore_sticky_posts' => true,
        'posts_per_page' => 3,
        'paged' => false,
        'post__not_in' => [$object->ID],
        );
        $query = new WP_Query( $args );
        ?>
            <div id="cms-related-<?php the_ID(); ?>" class="related">
                <div class="row">
                    <?php while ($query->have_posts()):
                    $query->the_post();
                    $thumbnail = get_field("thumbnail"); ?>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="post-item">
                            <a href="<?php the_permalink() ?>">
                                <div class="new-img">
                                    <div class="softover"><img src="<?php echo $thumbnail['url'] ?>" /></div>

                                </div>
                                <div class="post-content">
                                    <div class="post-date">
                                        <time class="updated" datetime="<?php echo get_post_time('c', true); ?>">
                                            <img src="/wp-content/themes/mian/images/calendar.png" alt=""><span><?php echo get_the_date('d/m/Y') ?></span>
                                        </time>
                                    </div>
                                    <div class="new-title"><?php the_title() ?></div>
                                    <div class="new-excerpt"><?php the_excerpt() ?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    endif;
?>
<script>
    $(function(){
       setActiveNews(); 
    });
</script>