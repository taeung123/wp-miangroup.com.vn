<?php
    if(have_posts()):
        the_post();
        $parentid = 5;
        $category = get_the_category();
        $cat_id = $category[0]->cat_ID;
        $term_child = get_terms('category', array(
            'hide_empty' => false,
            'exclude' => 1,
            'parent' => $parentid
        ) );
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
            foreach ($terms as $key => $value) : 
                $title_des = get_field( 'title_des', 'category_' . $value->term_id );
                $icon_menu = get_field( 'icon_menu', 'category_' . $value->term_id );
                if(!$title_des){
                    $title_des = $value->name;
                }
                if($value->term_id == $parentid){
                    $curIndexSlick = $key;
                }
        ?>
        <div class="terms-item <?php if($value->term_id == $parentid  ): echo 'hasactive'; endif; ?>">
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
<div class="cat-info">
    <div class="col-cat-title">
        <?php
            $catParent =   get_term( $parentid );
            $title_des = get_field( 'title_des', 'category_' . $parentid );
            $descritionm = get_field( 'descritionm', 'category_' . $parentid );
            
            if(!$title_des){
                $title_des = $catParent->name;
            }
            echo wpautop($title_des);
         ?>
    </div>
    <div class="col-cat-info">
        <?php echo $descritionm; ?>
    </div>
    <div class="clearfix"></div>
</div>
<div class="terms-child">
    <?php if(!empty($term_child)): ?>
        <div class="slsubmobile-c s">
        <div class="mbarrowleft" onclick="presubmenu()">
            <img src="<?php echo get_template_directory_uri() ?>/css/arrow-left-menu.png" />
        </div>
        <div class="slsubmobile">
    <ul class="col<?php echo count($term_child) ?>">
        <?php 
            foreach ($term_child as $key => $value) : 
                $title_des = get_field( 'title_des', 'category_' . $value->term_id );
                $icon_menu = get_field( 'icon_menu', 'category_' . $value->term_id );
                $background_image = get_field( 'background_image', 'category_' . $value->term_id );
                if(!$title_des){
                    $title_des = $value->name;
                }
                if($root_parent_id == 0 && $key == 0) {
                    $term_cur_id  = $value->term_id;
                }
                $linkcat = get_term_link($value->term_id );
                $urlname = $value->name;
        ?>
            <li class="samecat cat<?php echo $value->term_id ?> <?php if($value->term_id == $cat_id): ?> curmb active <?php endif; ?> " style="cursor: pointer" onclick="getPostFashion( <?php echo $value->term_id ?>, '<?php echo $linkcat ?>', '<?php echo $urlname ?>')">
                <div class="bgimg" style="background-image: url(<?php echo $background_image['url'] ?>)"></div>
                <div class="bgmask"></div>
                <div class="middle">
                    <a href="javascript: void(0)">
                        <img src="<?php echo $icon_menu['url'] ?>" />
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
            query_posts( array ( 'category__in' => $cat_id ));
            if(have_posts()):
                the_post();
                $big_image = get_field("big_image");
                $otherphotos = get_field("other_photos");
                $conents = get_field("conents");
        ?>
        <div class="cate-title"><?php the_title(); ?></div>
        <div class="term-describe">
            <?php the_content(); ?>
        </div>

        <?php if($conents): ?>
        <div class="banner-cat-deatail">           
            <?php foreach ($conents as $key => $value) : ?>                   
                        <img src="<?php echo $value['image_rp']['url'] ?>" />                        
            <?php endforeach; ?>           
        </div>
        <?php endif; ?>
        
        <?php endif; wp_reset_query(); ?>
    </div>
    
</div>
<script>
    $(function(){
        slickMenu(".terms-slide", <?php echo $curIndexSlick ?>);
        setActiveSPDV();
        if($(window).width() <= 767) {
            var currentX;
            var lastX = 0;
            var lastT;
            $(".slsubmobile ul").bind('touchmove', function(e) {
                // If still moving clear last setTimeout
                clearTimeout(lastT);
            
                currentX = e.originalEvent.touches[0].clientX;
            
                // After stoping or first moving
                if(lastX == 0) {
                    lastX = currentX;
                }
            
                if(currentX < lastX) {
                    nextsubmenu();
                   
                } else if(currentX > lastX){
                     presubmenu();
                }
            
                // Save last position
                lastX = currentX;
            
                // Check if moving is done
                lastT = setTimeout(function() {
                    lastX = 0;
                }, 100);
            });
            
            var licur = $(".slsubmobile li.active").index()*1;
            var countli = $(".slsubmobile ul li").length;
            var wul = $(".slsubmobile ul").width() / countli;
            if(licur == (countli - 1)) {
                $(".slsubmobile li.curmb").removeClass("curmb");
                $(".slsubmobile li:nth-child(" + licur + ")").addClass("curmb");
                licur--; 
            }
            wul = wul * (licur ) * -1;
            $( ".slsubmobile ul" ).animate({
                "margin-left": wul
              }, 500, function() {
            });
            
        }
    });
</script>
<?php
    endif;
?>