<?php 
    if(have_posts()):
        $title = get_field("title");
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");
        $title_tn = get_field("title_tn");
        $icon_tn = get_field("icon_tn");
        $contents_tn= get_field("contents_tn");
        
        $title_gt = get_field("title_gt");
        $icon_gt = get_field("icon_gt");
        $contents_gt = get_field("contents_gt");
        
        $content_cthdqt = get_field("content_cthdqt");
        $history = get_field("history");
        $prize_desc = get_field("prize_desc");
        $prizes = get_field("prizes");
        $abouts = get_field("abouts");

        $contents_msdn = get_field("contents_msdn");
        $background_msdn = get_field("background_msdn");
?>
<div class="about-mian-page">
    <div class="page-banner" style="background-image: url(<?php echo $banner['url']; ?>);">
        <div class="container">
            <h3><?php echo $title; ?></h3>
        </div>
    </div>
    <div class="about-desc">
        <div class="container">
            <div class="contain-col2">
                <?php if(wp_is_mobile()): ?>
                    <?php echo str_replace( array("<br>", "MIAN Group Mang"), array(" ", "MIAN Group mang"), get_the_content_with_formatting());  ?>
                <?php else: ?>
                    <?php the_content() ?>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
    <div class="post-about">
        <div class="container">
            <div class="row">
            <?php 
            if( have_rows('abouts') ):
                while( have_rows('abouts') ) : the_row();
                $post_image = get_sub_field('post_image');
                $post_title = get_sub_field('post_title');
                $post_link = get_sub_field('post_link');

                ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="about-content">
                        <a href="<?php echo $post_link; ?>">
                            <div class="about-image" style="background-image: url(<?php echo $post_image; ?>);">
                                
                            </div>
                            <h3><span><?php echo $post_title; ?></span></h3>
                        </a>
                    </div>
                </div>
            <?php endwhile;
            endif; 
         ?>
            </div>
        </div>
    </div>
    <div class="section-awards">
        <div class="section-title"><?php _e("Giải thưởng", "mian") ?></div>
        <div class="section-desc"><?php _e($prize_desc, "mian") ?></div>
        <div class="slick-awards">
            <?php foreach ($prizes as $key => $value) : ?>
            <div class="award-item">
                <img src="<?php echo $value['url'] ?>" />
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if(!empty($contents_msdn)): ?>
        <div class="mian-history" style="background-image: url(<?php echo $background_msdn['url'] ?>)">
            <div class="section-title"><?php _e("Mốc son đáng nhớ", "mian") ?></div>
            <div class="container-slick-history">
                <div class="slick-history">
                    <?php foreach ($contents_msdn as $key => $value) : ?>
                    <div class="his-point">
                        <div class="shape-point"></div>
                        <div class="title-point"><?php echo $value['year_msdn'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="history-content">
                <div class="slick-history-content">
                    <?php foreach ($contents_msdn as $key => $value) : ?>
                    <div class="his-item">
                        <div class="his-item-content">
                            <div class="his-year"><?php echo $value['year_msdn'] ?></div>
                            <?php echo $value['content_msdn'] ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php
    endif;
        query_posts( array (  'post_type' => 'page', 'post__in' => array( 8 ) ));
        if(have_posts()): the_post();
            $partners = get_field("partners");
            $clients = get_field("clients");
    ?>

</div>
<script>
    $(function(){
        slickjs(".slpartner");
        slickhistory();
        slickhistorycontent();
        slickawards();
        drawSharp();
        hoverHistory();
        $(window).resize(function(){
            drawSharp();
        });
    })
</script>
<?php
    endif;
    wp_reset_query();
?>
<?php endif; ?>