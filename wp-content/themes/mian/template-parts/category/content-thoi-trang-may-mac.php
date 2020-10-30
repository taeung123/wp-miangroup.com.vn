<?php

$category = get_category(get_query_var('cat'));
$page_query = get_queried_object();
$root_parent_id = $category->parent;

$cat_parent_id = $category->cat_ID;
if ($category->parent == 0) :
    $banner = get_field('banner', $page_query);
?>
    <?php
    $term_child = get_terms('category', array(
        'hide_empty' => false,
        'exclude' => 1,
        'parent' => $cat_parent_id
    ));

    $member_title = get_field("member_title",$page_query);
    $member_desc = get_field("member_desc",$page_query);


    $parner_title = get_field("parner_title",$page_query);
    $parner_desc = get_field("parner_desc",$page_query);
    $partners = get_field("partners",$page_query);
    $clients = get_field("clients",$page_query);
    ?>
    <div class="buffer-top"></div>
    <div class="page-banner" style="background-image: url(<?php echo $banner; ?>);">
        <div class="container">
            <h3><?php _e("Sản phẩm & Dịch vụ", "mian") ?></h3>
        </div>
    </div>
    <div class="content-term">
        <div class="container">
            <div class="terms">
                <div class="terms-slide">
                    <?php
                    $terms = get_terms('category', array(
                        'hide_empty' => false,
                        'exclude' => 1,
                        'parent' => 0
                    ));
                    foreach ($terms as $key => $value) :
                        $title_des = get_field('title_des', 'category_' . $value->term_id);
                        $icon_menu = get_field('icon_menu', 'category_' . $value->term_id);
                        if (!$title_des) {
                            $title_des = $value->name;
                        }
                        if ($value->term_id == $terms_parent_ids) {
                            $curIndexSlick = $key;
                        }
                        $g_term_child = get_term_children( $value->term_id, 'category' );
                        if(!empty($g_term_child)):
                            $first_child = get_term_by('id', $g_term_child[0], 'category');
                        else: 
                            $first_child = $value;
                        endif;
                        
                    ?>
                        <div class="terms-item <?php 
                        if ( ($value->term_id == $page_query->term_id) || ($value->term_id == $parent_term->term_id)):
                             
                            echo 'hasactive';
                        endif; ?>">
                            <div class="arrow-bottom"></div>
                            <div class="middle">
                                <a href="<?php echo get_term_link($first_child->term_id) ?>">
                                    <img src="<?php echo $icon_menu['url'] ?>" />
                                    <div><?php echo wpautop($title_des) ?></div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cat-info">
        <?php
            $title_des = get_field('title_des', 'category_' . $cat_parent_id);
            $descritionm = get_field('descritionm', $page_query);
        ?>
        <div class="container">
            <div class="col-cat-title" style="<?php if(empty($descritionm)) echo 'width: 100%;' ?>">
                <?php
                if (!$title_des) {
                    $title_des = $category->name;
                }
                echo wpautop($title_des);
                ?>
            </div>

            <div class="col-cat-info">
                <?php echo $descritionm; ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>


    <div class="terms-child">
        <div class="container">
            <?php if (!empty($term_child)) :  ?>
                <div class="slsubmobile-c">
                    <div class="mbarrowleft" onclick="presubmenu()">
                        <img src="<?php echo get_template_directory_uri() ?>/css/arrow-left-menu.png" />
                    </div>
                    <div class="slsubmobile">
                        <ul class="col<?php echo count($term_child) ?>">
                            <?php
                            foreach ($term_child as $key => $value) :
                                $title_des = get_field('title_des', 'category_' . $value->term_id);
                                $icon_menu = get_field('icon_menu', 'category_' . $value->term_id);
                                $background_image = get_field('background_image', 'category_' . $value->term_id);
                                if (!$title_des) {
                                    $title_des = $value->name;
                                }
                                if ($root_parent_id == 0 && $key == 0) {
                                    $term_cur_id  = $value->term_id;
                                }
                                $linkcat = get_term_link($value->term_id);
                                $urlname = $value->name;
                            ?>
                                <li class="samecat cat<?php echo $value->term_id ?> <?php if ($key == 0) : ?> active curmb <?php endif; ?>" style="cursor: pointer" onclick="getPostFashion( <?php echo $value->term_id ?>, '<?php echo $linkcat ?>', '<?php echo $urlname ?>')">
                                    <div class="middle">
                                        <a href="<?php echo get_term_link($value->term_id,'category'); ?>">
                                            <div class="title-des"><?php echo wpautop($title_des) ?></div>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mbarrowright" onclick="nextsubmenu()"><img src="<?php echo get_template_directory_uri() ?>/css/arrow-right-menu.png" /></div>
                </div>
                <div class="clearfix"></div>
            <?php endif; ?>
            <div class="fashion-detail">

                <?php
                $g_term_child = get_term_children( $page_query->term_id, 'category' );
                if(!empty($g_term_child)) {
                    $first_child = get_term_by('id', $g_term_child[0], 'category');
                    $sgallery = get_field("sgallery", $first_child);
                }
                else {
                    $first_child = $page_query;
                    $sgallery = get_field("sgallery", $first_child);
                    $title_des = get_field("title_des", $first_child);
                    $descritionm = get_field("descritionm", $first_child);
                }
                if(!empty($title_des)):
                    ?>
                        <div class="cate-title"><?php echo $title_des; ?></div>
                    <?php
                        endif;
                    ?>
                        
                    <?php if ($sgallery) : ?>
                        <div class="banner-cat-deatail">
                            <?php foreach ($sgallery as $value) : ?>
                                <img src="<?php echo $value['url'] ?>" />
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

            </div>
        </div>

    </div>
    <?php if( have_rows('members', $first_child) ): ?>
        <div class="members-section">
            <div class="container">
                <div class="member-title">
                    <h3 style="width: <?php if(empty($member_desc)) echo '100% !important;'?>;"><?php echo $member_title; ?></h3>
                    <?php if(!empty($member_desc)): ?>
                        <div><?php echo $member_desc; ?></div>
                    <?php endif; ?>
                </div>
            
                <div class="member-items">
                    <div class="row">
                        <?php
                            // Loop through rows.
                            while( have_rows('members', $first_child) ) : the_row();
                            $image_member = get_sub_field('image_member');
                            $name_member = get_sub_field('name_member');
                            $member_add = get_sub_field('member_add');
                            $member_quantity = get_sub_field('member_quantity');
                            $member_acreage = get_sub_field('member_acreage');
                            $link_member = get_sub_field('link_member');
                            $desc_member = get_sub_field('desc_member');
                            ?>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="item">
                                    <?php if( !empty($link_member)): ?>
                                        <a href="//<?php echo $link_member; ?>" target="_blank">
                                    <?php endif; ?>
                                        <div class="featured-image">
                                            <img src="<?php echo $image_member; ?>" alt="">
                                        </div>
                                        <div class="content-item">
                                            <h3 class="title"><?php echo $name_member; ?></h3>
                                            <ul class="list-item">
                                            <?php if( have_rows('custom_fields') ):
                                                while( have_rows('custom_fields') ) : the_row();
                                                    $custom_title = get_sub_field('custom_title');
                                                    $custom_content = get_sub_field('custom_content');
                                                ?>
                                                <li class="item"><span><?php echo $custom_title; ?></span> <?php echo $custom_content; ?></li>
                                            <?php 
                                                endwhile; 
                                                endif; 
                                            ?>

                                                <?php if( !empty($link_member)): ?>
                                                    <li class="link-member"><span>Website: </span><span><?php echo $link_member; ?></span></li>
                                                <?php endif; ?>
                                            </ul>
                                            <p class="desc"><?php echo $desc_member; ?></p>
                                        </div>
                                    <?php if( !empty($link_member)): ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile;
                        
                    ?>
                    </div>
                </div>
            </div>
        </div>  
    <?php endif; ?>                            
    <script>
        $(function() {
            slickjs(".slpartner");
            slick_slider(".banner-cat-deatail",1,1,1,1);
            slickMenu(".terms-slide", <?php echo get_field('business_number','option') ?>, <?php echo $curIndexSlick ?>);
            setActiveSPDV();
            if ($(window).width() <= 767) {
                var currentX;
                var lastX = 0;
                var lastT;
                $(".slsubmobile ul").bind('touchmove', function(e) {
                    // If still moving clear last setTimeout
                    clearTimeout(lastT);

                    currentX = e.originalEvent.touches[0].clientX;

                    // After stoping or first moving
                    if (lastX == 0) {
                        lastX = currentX;
                    }

                    if (currentX < lastX) {
                        nextsubmenu();

                    } else if (currentX > lastX) {
                        presubmenu();
                    }

                    // Save last position
                    lastX = currentX;

                    // Check if moving is done
                    lastT = setTimeout(function() {
                        lastX = 0;
                    }, 100);
                });
                var licur = $(".slsubmobile li.active").index() * 1;
                var countli = $(".slsubmobile ul li").length;
                var wul = $(".slsubmobile ul").width() / countli;
                if (licur == (countli - 1)) {
                    $(".slsubmobile li.curmb").removeClass("curmb");
                    $(".slsubmobile li:nth-child(" + licur + ")").addClass("curmb");
                    licur--;
                }
                wul = wul * (licur) * -1;
                $(".slsubmobile ul").animate({
                    "margin-left": wul
                }, 500, function() {});

            }
        });
    </script>
<?php
else :
    
    $child_term = get_term( $cat_parent_id, 'category' );
    $parent_term = get_term( $child_term->parent, 'category' );
    $banner = get_field('banner', $parent_term);
    $parentid = $category->parent;
    $cat_id = $category->cat_ID;
    $term_child = get_terms('category', array(
        'hide_empty' => false,
        'exclude' => 1,
        'parent' => $parentid
    ));
    $member_title = get_field("member_title",$page_query);
    $member_desc = get_field("member_desc",$page_query);

    $parner_title = get_field("parner_title",$page_query);
    $parner_desc = get_field("parner_desc",$page_query);
    $partners = get_field("partners",$page_query);
    $clients = get_field("clients",$page_query);
    
?>

    <div class="buffer-top"></div>
    <div class="page-banner" style="background-image: url(<?php echo $banner; ?>);">
        <div class="container">
            <h3><?php _e("Sản phẩm & Dịch vụ", "mian") ?></h3>
        </div>
    </div>
    <div class="content-term">
        <div class="container">
            <div class="terms">
                <div class="terms-slide">
                    <?php
                    $terms = get_terms('category', array(
                        'hide_empty' => false,
                        'exclude' => 1,
                        'parent' => 0
                    ));
                    foreach ($terms as $key => $value) :
                        $title_des = get_field('title_des', 'category_' . $value->term_id);
                        $icon_menu = get_field('icon_menu', 'category_' . $value->term_id);
                        if (!$title_des) {
                            $title_des = $value->name;
                        }
                        if ($value->term_id == $terms_parent_ids) {
                            $curIndexSlick = $key;
                        }
                        
                        $g_term_child = get_term_children( $value->term_id, 'category' );
                        if(!empty($g_term_child)):
                            $first_child = get_term_by('id', $g_term_child[0], 'category');
                        else: 
                            $first_child = $value;
                        endif;
                    ?>
                        <div class="terms-item <?php if ( ($value->term_id == $page_query->term_id) || ($value->term_id == $parent_term->term_id)) echo 'hasactive';
                                                 ?>">
                            <div class="arrow-bottom"></div>
                            <div class="middle">
                                <a href="<?php echo get_term_link($first_child->term_id) ?>">
                                    <img src="<?php echo $icon_menu['url'] ?>" />
                                    <div><?php echo wpautop($title_des) ?></div>
                                </a>
                            </div>
                        </div>
                        <?php  endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cat-info">
        <div class="container">
            <?php
                $child_term = get_term( $cat_parent_id, 'category' );
                $parent_term = get_term( $child_term->parent, 'category' );
                $title_des = get_field('title_des', $parent_term);
                $descritionm = get_field('descritionm', $parent_term);
             ?>
            <div class="col-cat-title" style="<?php if(empty($descritionm)) echo 'width: 100%;' ?>">
                <?php
                if (empty($title_des)) {
                    $title_des = $parent_term->name;
                }
                echo wpautop($title_des);
                ?>
            </div>

            <div class="col-cat-info">
                <?php echo $descritionm; ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>


    <div class="term-info terms-child">
        <div class="container">
            <?php if (!empty($term_child)) :  ?>
                <div class="slsubmobile-c">
                    <div class="mbarrowleft" onclick="presubmenu()">
                        <img src="<?php echo get_template_directory_uri() ?>/css/arrow-left-menu.png" />
                    </div>
                    <div class="slsubmobile">
                        <ul class="col<?php echo count($term_child) ?>">
                            <?php
                            foreach ($term_child as $key => $value) :
                                
                                $title_des = get_field('title_des', 'category_' . $value->term_id);
                                $icon_menu = get_field('icon_menu', 'category_' . $value->term_id);
                                $background_image = get_field('background_image', 'category_' . $value->term_id);
                                if (!$title_des) {
                                    $title_des = $value->name;
                                }
                                if ($root_parent_id == 0 && $key == 0) {
                                    $term_cur_id  = $value->term_id;
                                }
                                $linkcat = get_term_link($value->term_id);
                                $urlname = $value->name;
                            ?>
                                <li class="samecat cat <?php echo $value->term_id ?> <?php if ($value->term_id == $page_query->term_id) : ?> active curmb <?php endif; ?>" style="cursor: pointer" >
                                    <div class="middle">
                                        <a href="<?php echo get_term_link($value->term_id,'category'); ?>">
                                            <div class="title-des"><?php echo wpautop($title_des) ?></div>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mbarrowright" onclick="nextsubmenu()"><img src="<?php echo get_template_directory_uri() ?>/css/arrow-right-menu.png" /></div>
                </div>
                <div class="clearfix"></div>
            <?php endif; ?>
            <div class="fashion-detail">

                <?php
                    $sgallery = get_field("sgallery", $page_query);
                    $title_des = get_field("title_des", $page_query);
                    $descritionm = get_field("descritionm", $page_query);
                if(!empty($title_des)):
                ?>
                    <div class="cate-title"><?php echo $title_des; ?></div>
                <?php
                    endif;
                    if(!empty($descritionm)):
                ?>
                    <div class="term-describe">
                        <?php echo $descritionm; ?>
                    </div>
                <?php endif; ?>
                    <?php if ($sgallery) : ?>
                        <div class="banner-cat-deatail">
                            <?php foreach ($sgallery as $value) : ?>
                                <img src="<?php echo $value['url'] ?>" />
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
            </div>
        </div>

    </div>
    <?php if( have_rows('members', $page_query) ): ?>
    <div class="members-section">
        <div class="container">
            <div class="member-title">
                <h3 style="width: <?php if(empty($member_desc)) echo '100%;'?>;"><?php echo $member_title; ?></h3>
                <?php if(!empty($member_desc)): ?>
                    <div><?php echo $member_desc; ?></div>
                <?php endif; ?>
            </div>
            <div class="member-items">
                <div class="row">
                    <?php
                        // Loop through rows.
                        while( have_rows('members', $page_query) ) : the_row();
                        $image_member = get_sub_field('image_member');
                        $name_member = get_sub_field('name_member');
                        $member_add = get_sub_field('member_add');
                        $member_quantity = get_sub_field('member_quantity');
                        $member_acreage = get_sub_field('member_acreage');
                        $link_member = get_sub_field('link_member');
                        $desc_member = get_sub_field('desc_member');
                        ?>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="item">
                                <?php if( !empty($link_member)): ?>
                                    <a href="//<?php echo $link_member; ?>" target="_blank">
                                <?php endif; ?>
                                    <div class="featured-image">
                                        <img src="<?php echo $image_member; ?>" alt="">
                                    </div>
                                    <div class="content-item">
                                        <h3 class="title"><?php echo $name_member; ?></h3>
                                        <ul class="list-item">
                                        <?php if( have_rows('custom_fields') ):
                                            while( have_rows('custom_fields') ) : the_row();
                                                $custom_title = get_sub_field('custom_title');
                                                $custom_content = get_sub_field('custom_content');
                                            ?>
                                            <li class="item"><span><?php echo $custom_title; ?></span> <?php echo $custom_content; ?></li>
                                        <?php 
                                            endwhile; 
                                            endif; 
                                        ?>

                                            <?php if( !empty($link_member)): ?>
                                                <li class="link-member"><span>Website: </span><span><?php echo $link_member; ?></span></li>
                                            <?php endif; ?>
                                        </ul>
                                        <p class="desc"><?php echo $desc_member; ?></p>
                                    </div>
                                <?php if( !empty($link_member)): ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile;
                   
                ?>
                </div>
            </div>                    
                                
        </div>
    </div>
    <?php  endif; ?>                              
    <script>
        $(function() {
            slickjs(".slpartner");
            slick_slider(".banner-cat-deatail",1,1,1,1);
            slickMenu(".terms-slide", <?php echo get_field('business_number','option') ?>, <?php echo $curIndexSlick ?>);
            setActiveSPDV();
            if ($(window).width() <= 767) {
                var currentX;
                var lastX = 0;
                var lastT;
                $(".slsubmobile ul").bind('touchmove', function(e) {
                    // If still moving clear last setTimeout
                    clearTimeout(lastT);

                    currentX = e.originalEvent.touches[0].clientX;

                    // After stoping or first moving
                    if (lastX == 0) {
                        lastX = currentX;
                    }

                    if (currentX < lastX) {
                        nextsubmenu();

                    } else if (currentX > lastX) {
                        presubmenu();
                    }

                    // Save last position
                    lastX = currentX;

                    // Check if moving is done
                    lastT = setTimeout(function() {
                        lastX = 0;
                    }, 100);
                });
                var licur = $(".slsubmobile li.active").index() * 1;
                var countli = $(".slsubmobile ul li").length;
                var wul = $(".slsubmobile ul").width() / countli;
                if (licur == (countli - 1)) {
                    $(".slsubmobile li.curmb").removeClass("curmb");
                    $(".slsubmobile li:nth-child(" + licur + ")").addClass("curmb");
                    licur--;
                }
                wul = wul * (licur) * -1;
                $(".slsubmobile ul").animate({
                    "margin-left": wul
                }, 500, function() {});

            }
        });
    </script>
<?php endif; ?>