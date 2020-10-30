<?php

    $category = get_category( get_query_var( 'cat' ) );
    $cat_id = $category->cat_ID;
    
    $tmp_terms_child = get_terms('category', array(
        'hide_empty' => false,
        'exclude' => 1,
        'parent' => $cat_id
    ) );
    if(count($tmp_terms_child) > 0) {
        query_posts( array ( 
            'category__in' => $tmp_terms_child[0]->term_id,
        )); 
    } else {
        query_posts( array ( 
            'category__in' => $cat_id
        )); 
    }
    
    $curIndexSlick = 0;
    if(have_posts()):
        the_post();
        $postid = get_the_ID();
        $termsofpost = wp_get_post_terms( $postid, 'category'); 
        $terms_parent_ids = 0;
        $term_cur_id = 0;
        
        
        $sgallery = get_field("sgallery");
        $ptitle = get_the_title(); 
        $pcontent = get_the_content_with_formatting();
        $link_website = get_field("link_website");
        
        $prev_post = get_previous_post(true, '', 'category' );
        $next_post = get_next_post( true, '', 'category' );
        
        foreach ( $termsofpost as $term ) {
            if($term->parent){
                $terms_parent_ids = $term->parent;
                $term_cur_id = $term->term_id;
            }
        }
        if($terms_parent_ids == 0) {
            $term_child = array();
        }else {
            $term_child = get_terms('category', array(
                'hide_empty' => false,
                'exclude' => 1,
                'parent' => $terms_parent_ids
            ) );
        }
        
?>
    <div class="buffer-top"></div>
    <div class="banner-title">
        <?php _e("Sản phẩm & Dịch vụss", "mian") ?>
    </div>
    <div class="terms">
        <div class="terms-slide">
            <?php 
                $terms = get_terms('category', array(
                    'hide_empty' => false,
                    'exclude' => 1,
                    'parent' => 0
                ) );
                foreach ($terms as $key => $value) : 
                    $title_des = get_field( 'title_des', 'category_' . $value->term_id );
                    $icon_menu = get_field( 'icon_menu', 'category_' . $value->term_id );
                    if(!$title_des){
                        $title_des = $value->name;
                    }
                    if($value->term_id == $terms_parent_ids){
                        $curIndexSlick = $key;
                    }
            ?>
            <div class="terms-item <?php if($value->term_id == $terms_parent_ids || ( $cat_id == $value->term_id && $terms_parent_ids == 0) ): echo 'hasactive'; endif; ?>">
                <div class="arrow-bottom"></div>
                <div class="middle">
                    <a href="<?php echo get_term_link($value->term_id) ?>">
                        <img src="<?php echo $icon_menu['url'] ?>" />
                        <div><?php echo wpautop($title_des) ?></div>
                    </a>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    
    <div class="terms-child">
        
        <?php if(!empty($term_child)): ?>
        <ul class="col<?php echo count($term_child) ?>">
            <?php 
                foreach ($term_child as $key => $value) : 
                    $title_des = get_field( 'title_des', 'category_' . $value->term_id );
                    $icon_menu = get_field( 'icon_menu', 'category_' . $value->term_id );
                    $background_image = get_field( 'background_image', 'category_' . $value->term_id );
                    if(!$title_des){
                        $title_des = $value->name;
                    }
            ?>
                <li <?php if($value->term_id == $term_cur_id): ?> class="active" <?php endif; ?>>
                    <div class="bgimg" style="background-image: url(<?php echo $background_image['url'] ?>)"></div>
                    <div class="bgmask"></div>
                    <div class="middle">
                        <a href="<?php echo get_term_link($value->term_id) ?>">
                            <img src="<?php echo $icon_menu['url'] ?>" />
                            <div class="title-des"><?php echo wpautop($title_des) ?></div>
                        </a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="clearfix"></div>
        <?php endif; ?>
        <?php 
            foreach ($term_child as $key => $value) : 
                if($value->term_id == $term_cur_id):
        ?>
        <div class="cate-title"><?php echo $value->name ?></div>
        <div class="term-describe">
            <?php echo  get_field( 'descritionm', 'category_' . $term_cur_id ) ; ?>
        </div>
        <?php endif; endforeach; ?>

        
        <div class="pro-detail">
            <div class="pro-info">
                <ul class="nextprevious">
                    <?php if( !empty( $prev_post)): ?>
                        <li class="next" onclick="gotoproject(<?php echo $prev_post->ID ?>)"><?php _e("Dự án tiếp theo", "mian") ?></li>
                    <?php endif; ?>
                    <?php if( !empty( $next_post)): ?>
                        <li class="previous" onclick="gotoproject(<?php echo $next_post->ID ?>)"><?php _e("Dự án trước", "mian") ?></li>
                    <?php endif; ?>
                    
                </ul>
                <div class="clearfix"></div>
                <div class="pro-info-contain">
                    <h1><?php echo $ptitle ?></h1>
                    <?php if ( wp_is_mobile() ):?>
                            <div><?php echo $pcontent; ?></div>
                        <?php else:?>
                            <div class="con-scrollbar"><?php echo $pcontent; ?></div>
                        <?php endif;?>
                    <?php if($link_website): ?>
                        <div class="linkwebsite">
                            <a target="_blank" href="<?php echo $link_website ?>"><?php _e("Trang web dự án", "mian") ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pro-slide">
                <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1484px;height:800px;overflow:hidden;visibility:hidden;">
                    <!-- Loading Screen -->
                    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo get_template_directory_uri()?>/images/spin.svg" />
                    </div>
                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1484px;height:800px;overflow:hidden;">
                        <?php foreach ($sgallery as $key => $value) : ?>
                            <div>
                                <img data-u="image" src="<?php echo $value['url'] ?>" />
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                    <?php if(count($sgallery) > 1): ?>
                    <!-- Bullet Navigator -->
                    <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:26px;right:100px;" data-autocenter="0" data-scale="0.5" data-scale-bottom="0.75">
                        <div data-u="prototype" class="i" style="width:16px;height:16px;">
                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                            </svg>
                        </div>
                    </div>
                    <!-- Arrow Navigator -->
                    <div data-u="arrowleft" class="jssora051" style="width:38px;height:38px;top:calc(100% - 100px);right:200px;" data-autocenter="0" data-scale="1" data-scale-left="1">
                        <img src="<?php echo get_template_directory_uri()?>/images/arrow-left-pro.png" />
                        <div class="number-slide"><span class="numcur">1</span>/<?php echo count($sgallery); ?></div>
                    </div>
                    <div data-u="arrowright" class="jssora051" style="width:38px;height:38px;top:calc(100% - 100px);right:100px;" data-autocenter="0" data-scale="1" data-scale-right="1">
                        <img src="<?php echo get_template_directory_uri()?>/images/arrow-right-pro.png" />
                    </div>
                    <?php endif; ?>
                </div>
                <script type="text/javascript">jssor_pro_init();</script>
                
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

<script>
    $(function(){
        slickMenu(".terms-slide", <?php echo $curIndexSlick ?>);
        setActiveSPDV();
        scrollSPDV();
    });
</script>
<?php 
    else:
     $terms_parent_ids =   $cat_id;
     if($category->parent > 0) {
         $terms_parent_ids = $category->parent;
     }
?>
<div class="buffer-top"></div>
<div class="banner-title">
    <?php _e("Sản phẩm & Dịch vụ", "mian") ?>
</div>
<div class="terms">
    <div class="terms-slide">
        <?php 
            $terms = get_terms('category', array(
                'hide_empty' => false,
                'exclude' => 1,
                'parent' => 0
            ) );
            $term_child = get_terms('category', array(
                'hide_empty' => false,
                'exclude' => 1,
                'parent' => $terms_parent_ids
            ) );
            foreach ($terms as $key => $value) : 
                $title_des = get_field( 'title_des', 'category_' . $value->term_id );
                $icon_menu = get_field( 'icon_menu', 'category_' . $value->term_id );
                if(!$title_des){
                    $title_des = $value->name;
                }
                if($value->term_id == $terms_parent_ids){
                    $curIndexSlick = $key;
                }
        ?>
        <div class="terms-item <?php if($value->term_id == $cat_id): echo 'hasactive'; endif; ?>">
            <div class="arrow-bottom"></div>
            <div class="middle">
                <a href="<?php echo get_term_link($value->term_id) ?>">
                    <img src="<?php echo $icon_menu['url'] ?>" />
                    <div><?php echo wpautop($title_des) ?></div>
                </a>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>

<div class="terms-child">
    <ul class="col<?php echo count($term_child) ?>">
        <?php 
            foreach ($term_child as $key => $value) : 
                $title_des = get_field( 'title_des', 'category_' . $value->term_id );
                $icon_menu = get_field( 'icon_menu', 'category_' . $value->term_id );
                $background_image = get_field( 'background_image', 'category_' . $value->term_id );
                if(!$title_des){
                    $title_des = $value->name;
                }
        ?>
            <li <?php if($value->term_id == $cat_id): ?> class="active" <?php endif; ?>>
                <div class="bgimg" style="background-image: url(<?php echo $background_image['url'] ?>)"></div>
                <div class="bgmask"></div>
                <div class="middle">
                    <a href="<?php echo get_term_link($value->term_id) ?>">
                        <img src="<?php echo $icon_menu['url'] ?>" />
                        <div class="title-des"><?php echo wpautop($title_des) ?></div>
                    </a>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
    <div class="clearfix"></div>
    <?php 
        foreach ($term_child as $key => $value) : 
            if($value->term_id == $cat_id):
    ?>
    <div class="cate-title"><?php echo $value->name ?></div>
    <div class="term-describe">
        <?php echo get_field( 'descritionm', 'category_' . $term_cur_id ) ; ?>
    </div>
    <?php endif; endforeach; ?>
    
</div>

<script>
    $(function(){
        slickMenu(".terms-slide", <?php echo $curIndexSlick ?>);
        setActiveSPDV();
        
    });
</script>
<?php endif; ?>