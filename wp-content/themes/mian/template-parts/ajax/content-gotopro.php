<?php
    query_posts( array (  'post__in' => array( $_POST['proid'] ), 'posts_per_page' => 1 ));
    if(have_posts()):
        the_post();
        
        $prev_post = get_previous_post(true, '', 'category' );
        $next_post = get_next_post( true, '', 'category' );
        
        $sgallery = get_field("sgallery");
        $ptitle = get_the_title(); 
        $pcontent = get_the_content_with_formatting();
        $link_website = get_field("link_website");
        
        
    
?>
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
        
    </div>
    <div class="clearfix"></div>
</div>
<span id="changurl" style="display: none" data-ptitle="<?php the_title() ?>" data-plink="<?php the_permalink() ?>"></span>
<?php endif; wp_reset_query(); ?>