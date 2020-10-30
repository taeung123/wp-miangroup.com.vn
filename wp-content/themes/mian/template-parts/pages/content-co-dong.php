<?php 
    if(have_posts()):
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");
        
        $title_hdqt = get_field("title_hdqt");
        $staff_hdqt = get_field("staff_hdqt");
        
        $title_bldcc = get_field("title_bldcc");
        $staff_bldcc = get_field("staff_bldcc");
        
        $title_bgd = get_field("title_bgd");
        $staff = get_field("staff");

        $title_bgdnew = get_field("title_bgd_new");
        $staffnew = get_field("staff_bgd");
?>
<div class="page-banner" style="background-image: url(<?php echo $banner['url'] ?>);">
        <div class="container">
            <h3><?php echo get_the_title(); ?></h3>
        </div>
    </div>

<div class="co-dong">
    <div class="container">
        <div class="hdqt">
            <h2><?php echo $title_hdqt; ?></h2>
            <?php foreach ($staff_hdqt as $key => $value) : ?>
                <div class="staff">
                    <div class="staff-img">
                        <img src="<?php echo $value['image_hdqtr']['url'] ?>" />
                    </div>
                    <div class="staff-content">
                        <?php echo $value['content_hdqtr'] ?> 
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php endforeach; ?>
            
        </div>
        
        <div class="bldcc">
            <div class="titlestaff"><?php echo $title_bldcc; ?></div>
            <ul class="staff-bgd">
                <?php foreach ($staff_bldcc as $key => $value) : ?>
                    <li>
                        <div class="bl-img">
                            <img src="<?php echo $value['image_bldccr']['url'] ?>" />
                        </div>
                        <div class="bl-content">
                            <?php echo $value['content_bldccr'] ?> 
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="bldcc">
            <div class="titlestaff"><?php echo $title_bgdnew; ?></div>
            <ul class="staff-bgd">
                <?php foreach ($staffnew as $key => $value) : ?>
                    <li>
                        <div class="bl-img">
                            <img src="<?php echo $value['image_bgd_new']['url'] ?>" />
                        </div>
                        <div class="bl-content">
                            <?php echo $value['content_bgd_new'] ?> 
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        
        <div class="bgd">
            <div class="titlestaff"><?php echo $title_bgd; ?></div>
            
            <ul class="staff-bgd">
                <?php foreach ($staff as $key => $value) : ?>
                    <li>
                        <div class="bl-img">
                            <img src="<?php echo $value['image_bgdr']['url'] ?>" />
                        </div>
                        <div class="bl-content">
                            <?php echo $value['content_bgdr'] ?> 
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="clearfix"></div>
        </div>
    </div>
    
</div>
<script>
    $(function(){
    });
    
    function detectTogglSub() {
        var hash = window.location.hash;
        if(hash == "#bao-cao-tai-chinh") {
            $(".bao-cao-tai-chinh ul").show();
            $(".dai-hoi-co-dong ul").hide();
            $(".dccd-left ul li").removeClass("active");
            $(".dccd-left ul li:nth-child(1)").addClass("active");
        } else if (hash == "#dai-hoi-co-dong"){
            $(".bao-cao-tai-chinh ul").hide();
            $(".dai-hoi-co-dong ul").show();
            $(".dccd-left ul li").removeClass("active");
            $(".dccd-left ul li:nth-child(2)").addClass("active");
        } else {
            $(".bao-cao-tai-chinh ul").hide();
            $(".dai-hoi-co-dong ul").show();
            $(".dccd-left ul li").removeClass("active");
            $(".dccd-left ul li:nth-child(1)").addClass("active");
        }
    }
    
    function showBCTC(){
        $(".bao-cao-tai-chinh ul").show();
        $(".dai-hoi-co-dong ul").hide();
        $(".dccd-left ul li").removeClass("active");
        $(".dccd-left ul li:nth-child(1)").addClass("active");
    }
    
    function showDHCD() {
        $(".bao-cao-tai-chinh ul").hide();
        $(".dai-hoi-co-dong ul").show();
        $(".dccd-left ul li").removeClass("active");
        $(".dccd-left ul li:nth-child(2)").addClass("active");
    }
    
</script>
<?php endif; ?>