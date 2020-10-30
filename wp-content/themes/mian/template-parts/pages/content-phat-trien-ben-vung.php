<?php 
    if(have_posts()):
        $title = get_field("title");
        $desc = get_field("desc");
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");

?>
<div class="develope-mian-page">
    <div class="page-banner" style="background-image: url(<?php echo $banner['url']; ?>);">
        <div class="container">
            <h3><?php echo $title; ?></h3>
        </div>
    </div>
    <div class="develope-desc">
        <div class="container">
            <div class="develope-wrap">
                <div class="title"><?php echo $title; ?></div>
                <div class="desc"><?php echo $desc; ?></div>
            </div>
        </div>
    </div>
    <div class="post-develope">
        <div class="container">
            <div class="row">
            <?php
             $args = array(
                'post_type' => 'develope',
                'orderby' => 'date',
                'order ' => 'DESC',
                'ignore_sticky_posts' => true,
                'posts_per_page' => -1,
                'paged' => false,
                );
                $developes = new WP_Query( $args );
                while ($developes->have_posts()):
                    $developes->the_post();
                     $featured_image = get_field('featured_image');
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="develope-content">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <div class="featured-image">
                                <img src="<?php echo $featured_image; ?>">
                            </div>
                            <h3><span><?php echo get_the_title(); ?></span></h3>
                        </a>
                    </div>
                </div>
                <?php
                endwhile;
                wp_reset_query();
            ?>
            </div>
        </div>
    </div>
    <?php
        $object = get_queried_object();
    ?>
        <div class="related renews-related">
            <div class="container">
            <div class="related-heading">
                <h3><?php echo qtranxf_getLanguage() == 'vi' ? 'Tin tức' : 'News'; ?></h3>
                <a href="/tin-tuc"><?php echo qtranxf_getLanguage() == 'vi' ? 'Xem tất cả' : 'View all'; ?></a>
            </div>
            <?php

            $args = array(
            'post_type' => 'news',
            'orderby' => 'date',
            'order ' => 'DESC',
            'ignore_sticky_posts' => true,
            'posts_per_page' => 5,
            'paged' => false,
            'post__not_in' => [$object->ID],
            );
            $query = new WP_Query( $args );
            ?>
                <div id="cms-related-<?php the_ID(); ?>" class="related">
                    <div class="post-items">
                        <?php while ($query->have_posts()):
                        $query->the_post();
                        $thumbnail = get_field("thumbnail"); ?>
                            <div class="slide-space">
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
    wp_reset_query();
?>
<script>
    $(function(){
        slickdev(".post-items");

    })
</script>