<?php 
get_header();
get_template_part( 'template-parts/nav/menu', 'main' );
if(have_posts()):
    the_post();    
    $slide = get_field("slide");

    $business_title = get_field("business_title");
    $business_desc = get_field("business_desc");
    $business_cate = get_field("business_cate");
    
    $news_title = get_field("news_title");
    $news_desc = get_field("news_desc");
    $news_video = get_field("news_video");
    $news_gallery = get_field("news_gallery");

    $partner_title = get_field("partner_title");
    $partner_description = get_field("partner_description");
    $partners = get_field("partners");

    $clients = get_field("clients");

    $video_url = explode ( '?v=' , $news_video);
    $terms = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => 0

    ) );
    $featured_args = array(
        'posts_per_page' => 1,
        'post_type' => 'news',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => [
            'key' => 'featured_post',
            'value' => 'yes',
            'compare' => '='
        ]
    );
    $featured_post = new WP_Query( $featured_args );
    $args = array(
        'post_type' => 'news',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order ' => 'DESC',
        'ignore_sticky_posts' => true,
        'posts_per_page' => 3,
        'post__not_in' => [$featured_post->posts[0]->ID]
    );
    
    $posts = new WP_Query( $args );

    
?>
<div class="fullpage">
    <section class="section section-slide">
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1920px;height:970px;overflow:hidden;visibility:hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo get_template_directory_uri()?>/images/spin.svg" />
            </div>
            <div id="jssorc_1" data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1920px;height:970px;overflow:hidden;">
                <?php foreach ($slide as $key => $value) : ?>
                <div data-fillmode="2">
                    <img data-u="image" src="<?php echo $value['simage']['url'] ?>" />
                    <div class="bgmask-slide"></div>
                    <?php if($value['scontent']): ?>
                    <div class="scaption">
                        <!--<div data-t="1" class="logo-inslide"></div>-->
                        <div data-t="0">
                            <?php echo $value['scontent']; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
                
            </div>
            
            <!-- Arrow Navigator -->
            <div data-u="arrowleft" class="jssora055 jssora055-left"  data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                </svg>
            </div>
            <div data-u="arrowright" class="jssora055 jssora055-right" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                </svg>
            </div>
        </div>
        <div class="scrolldown" onclick="scrollNext()"></div>
        <script type="text/javascript">jssor_1_slider_init();</script>
    </section>
     <section class="section">                  
        <div class="section-intro">
            <div class="container">
                <div class="row">
                    <?php while( have_rows('intros') ): the_row(); 
                        $number = get_sub_field('number');
                        $name = get_sub_field('name');
                        $description = get_sub_field('description');
                    ?>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="intro-content">
                                <div class="intro-title">
                                    <h3><?php echo $number; ?></h3>
                                    <p><?php echo $name; ?></p>
                                </div>
                                <p class="intro-desc">
                                    <?php echo $description; ?>
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <div class="section-business">
            <div class="container">
                <div class="title">
                    <h3><?php echo $business_title; ?></h3>
                    <?php if(!empty($business_desc)): ?>
                        <p><?php echo $business_desc; ?></p>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php foreach($terms as $term):
                        $background_image = get_field('background_image', $term);
                        $term_child = get_term_children( $term->term_id, 'category' );
                        $first_child = get_term_by('id', $term_child[0], 'category');
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="business-content">
                            <?php
                                    $link_term = get_term_link($first_child->term_id,'category');
                                    if(!empty($first_child))
                                        $link_term = get_term_link($first_child->term_id,'category');
                                    else
                                        $link_term = get_term_link($term->term_id,'category');
                                ?>
                                <a href="<?php echo $link_term; ?>">
                                    <div class="featured-image">
                                        <img class="business-image" src="<?php echo $background_image['url']; ?>" />
                                    </div>
                                    <h3 class="business-title">
                                        <?php echo $term->name; ?>
                                    </h3>                           
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section> 
    <section class="section section-news">
        <div class="container">
            <div class="title">
                <h3><?php echo $news_title; ?></h3>
                <?php if(!empty($news_desc)): ?>
                    <p><?php echo $news_desc; ?></p>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                <?php while ($featured_post->have_posts()): $featured_post->the_post();
                $thumbnail = get_field('thumbnail', get_the_ID());
                ?>
                    <div class="featured-post">
                        <a href="<?php the_permalink(); ?>">
                            <div class="featured-image">
                                <img src="<?php echo $thumbnail['url']; ?> " alt="">                          
                            </div>
                            <div class="entry-main">
                                <div class="news-title"><?php the_title() ?></div>
                                <div class="news-excerpt"><?php the_excerpt() ?></div>     
                            </div>
                        </a>
                    </div>
                <?php endwhile;            
                wp_reset_postdata();
                ?>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <?php while ($posts->have_posts()): $posts->the_post();
                        $thumbnail = get_field('thumbnail', get_the_ID());
                    ?>
                    <div class="post-items">
                        <div class="featured-post">
                            <a href="<?php the_permalink(); ?>">
                                <div class="news-title"><?php the_title() ?></div>
                                <div class="entry-main">
                                    <div class="featured-image">
                                        <img src="<?php echo $thumbnail['url']; ?> " alt="">                          
                                    </div>
                                    <div class="news-excerpt"><?php the_excerpt() ?></div>     
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endwhile;            
                        wp_reset_postdata();
                    ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="news-video">
                        <h3 class="video-title"><span><?php echo 'Video Clip';  ?></span></h3>
                        <iframe src="https://www.youtube.com/embed/<?php echo $video_url[1]; ?>" frameborder="0"></iframe>
                    </div>
                    <div class="news-gallery">
                        <h3 class="gallery-title"><span><?php echo qtranxf_getLanguage() =='vi' ? 'Hình ảnh' : 'Gallery';  ?> </span></h3>
                        <div class="gallery-content">
                            <?php foreach($news_gallery as $key => $value):
                                ?>
                                <div class="image">
                                    <img src="<?php echo $value['url'] ?>" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="gallery-nav">
                            <?php foreach($news_gallery as $key => $value):
                                ?>
                                <div class="image">
                                    <img src="<?php echo $value['url'] ?>" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-intro03">
            <div class="container">
                <div class="title">
                    <h3><?php echo $partner_title; ?></h3>
                    <?php if(!empty($partner_description)): ?>
                    <div><?php echo $partner_description; ?></div>
                    <?php endif; ?>
                </div>
                <ul class="tab">
                    <li class="active" onclick="showPartners()"><?php _e("Đối tác chiến lược", "mian") ?></li>
                    <li onclick="showClients()"><?php _e("Khách hàng chiến lược", "mian") ?></li>
                </ul>
                <div class="clearfix"></div>
                <div class="slpartner">
                    <?php foreach ($partners as $key => $value) : ?>
                        <div class="itempartner"><img src="<?php echo $value['url'] ?>" /></div>
                    <?php endforeach; ?>
                    
                </div>
                <div class="slclients">
                    <?php foreach ($clients as $key => $value) : ?>
                        <div class="itempartner"><img src="<?php echo $value['url'] ?>" /></div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        </div>

        <script>
            $(function(){
                slickjs(".slpartner");
                slickgallery(".gallery-content", ".gallery-nav");
            })
        </script>
        <?php
        endif; 
        // get_footer(); 
        ?>
        <div class="footer">
            <?php nf_footer(); ?>
            <div class="copyright">
                <div class="container">
                <div class="copyright-wrap"><?php _e("Copyright © " . date('Y') . " MIAN Group. All rights reserved.", "mian"); ?></div>
                </div>
            </div>
        </div>
    </section>
    
</div>