<?php
if (have_posts()) :
    $title = get_field("title");
    $banner = get_field("banner");
    $banner_mobile = get_field("banner_mobile");
    $bussiness_title = get_field("bussiness_title");
    $business_desc = get_field("business_desc");
    $business_cate = get_field("business_cate");

    $parner_title = get_field("parner_title");
    $parner_desc = get_field("parner_desc");
    $partners = get_field("partners");
    $clients = get_field("clients");
?>
    <div class="bussiness-page">
        <div class="page-banner" style="background-image: url(<?php echo $banner['url']; ?>);">
            <div class="container">
                <h3><?php echo $title; ?></h3>
            </div>
        </div>
        <div class="business-desc">
            <div class="container">
                <div class="business-wrap">
                    <div class="title"><?php echo $bussiness_title; ?></div>
                    <div class="desc"><?php echo $business_desc; ?></div>
                </div>
            </div>
        </div>
        <div class="post-business">
            <div class="container">
                <div class="row">
                    <?php foreach ($business_cate as $cate) :
                        $background_image = get_field('background_image', $cate);
                        $term_child = get_term_children( $cate->term_id, 'category' );
                        $first_child = get_term_by('id', $term_child[0], 'category');
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="business-content">
                                <?php
                                    $link_term = get_term_link($first_child->term_id,'category');
                                    if(!empty($first_child))
                                        $link_term = get_term_link($first_child->term_id,'category');
                                    else
                                        $link_term = get_term_link($cate->term_id,'category');
                                ?>
                                <a href="<?php echo $link_term; ?>">
                                    <div class="business-image" style="background-image: url(<?php echo $background_image['url']; ?>);">
                                        <div class="image-wrap">
                                            <?php echo category_description($cate->term_id); ?>
                                            <img src="/wp-content/uploads/2020/09/right.png" alt="icon">
                                        </div>
                                        <div class="business-title">
                                            <span><?php echo $cate->name; ?></span>
                                        </div>
                                    </div>
                                    
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="section-intro03">
            <div class="container">
                <div class="title">
                    <h3><?php echo $parner_title; ?></h3>
                    <div><?php echo $parner_desc; ?></div>
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
    </div>
    <script>
        $(function() {
            slickjs(".slpartner");
            
            slickawards();
        })
    </script>
<?php
        endif;
        wp_reset_query();
?>
