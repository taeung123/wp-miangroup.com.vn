<?php
    $banner = get_field("banner", 365);
    $banner_mobile = get_field("banner_mobile", 365);
   
?>
    <div class="page-banner" style="background-image: url(<?php echo $banner['url'] ?>);">
        <div class="container">
            <h3><?php echo qtranxf_getLanguage() == 'vi' ? 'Tin tức' : 'News'; ?></h3>
        </div>
    </div>
    <div class="news-des">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="listnews">
                        <div class="row">
                            <?php
                            $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
                            $args = [
                                'post_type'           => 'news',
                                'order '              => 'DESC',
                                'ignore_sticky_posts' => true,
                                'post_status'         => 'publish',
                                'posts_per_page'      => get_option('post_per_page'),
                                'paged'               => $paged,

                            ];
                            $loop = new WP_Query($args);
                            while ($loop->have_posts()) :
                                $loop->the_post();
                                $thumbnail = get_field("thumbnail");
                            ?>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
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
                            <?php
                            endwhile;
                            nf_paging_nav($loop);
                            ?>
                        </div>
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
        </div>
    </div>

<script>
    $(function() {
        setActiveNews();
    });
</script>