<?php
    $query = get_queried_object();
    $featured_image = get_field("featured_image",$query);
    
?>
<div class="image-featured" style="background-image: url(<?php echo $featured_image; ?>);">
    <div class="container">
        <h3><?php the_title(); ?></h3>
    </div>
</div>
<div class="about-detail">
    <div class="container">
        <div class="about-detail-des">
            <?php the_content() ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script>
    $(function(){
       setActiveNews(); 
    });
</script>
