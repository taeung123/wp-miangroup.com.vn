<?php
    query_posts( array ( 'category__in' => $_POST['proid'] ));
    if(have_posts()):
        the_post();
        $sgallery = get_field("sgallery");
?>
<div class="cate-title"><?php the_title(); ?></div>
<div class="term-describe">
    <?php the_content(); ?>
</div>

<?php if($sgallery): ?>
<div class="banner-cat-deatail">           
            <?php foreach ($sgallery as $value) : ?>                   
                <img src="<?php echo $value['url'] ?>" />                        
            <?php endforeach; ?>           
        </div>
<?php endif; ?>

<?php endif; wp_reset_query(); ?>
<script>
        $(function() {
            slick_slider(".banner-cat-deatail",1,1,1,1);
        });
</script>