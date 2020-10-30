<?php 
    if(have_posts()):
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");
        
        $content_bld = get_field("content_bld");
        $image_bld = get_field("image_bld");
        $link_bld = get_field("link_bld");
        
        $contents_ccm = get_field("contents_ccm");
        
        $contents_msdn = get_field("contents_msdn");
        $background_msdn = get_field("background_msdn");
        
        $prizes = get_field("prizes");
        
?>
<div class="page-banner" style="background-image: url(<?php echo $banner['url']; ?>);">
    <div class="container">
        <h3><?php echo $title; ?></h3>
    </div>
</div>
<div class="story-mian">
    <div class="container">
        <div class="leadership">
                <div class="content-des">
                    <?php echo $content_bld; ?>
                    <?php if($link_bld): ?>
                        <div class="linkwebsite" style="display: none">
                            <a  href="<?php echo $link_bld['url'] ?>" href="image.jpg" data-fancybox><?php _e("Cơ cấu tổ chức Ban lãnh đạo", "mian") ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <div class="clearfix"></div>
        </div>

        <div class="mian-story">
            <ul>
                <?php foreach ($contents_ccm as $key => $value) : ?>
                    <li>
                        <div class="col-content">
                            <div class="content-des">
                                <?php echo $value['content_ccm']; ?>
                            </div>
                            
                        </div>
                        <div class="col-img">
                            <img src="<?php echo $value['image_ccm']['url'] ?>" />
                        </div>
                        <div class="clearfix"></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
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
    <div class="section-awards">
            <div class="section-title"><?php _e("Giải thưởng", "mian") ?></div>
            <div class="slick-awards">
                <?php foreach ($prizes as $key => $value) : ?>
                <div class="award-item">
                    <img src="<?php echo $value['url'] ?>" />
                </div>
                <?php endforeach; ?>
            </div>
        </div>
</div>
<script>
    $(function(){
        slickhistory();
        slickhistorycontent();
        slickawards();
    })
</script>
<?php endif; ?>