<?php
    $query_obj = get_queried_object();
    query_posts( array (  'post_type' => 'page', 'post__in' => array( 2286 ) ));
    if(have_posts()): 
        the_post();
        $banner = get_field("banner");
        $banner_mobile = get_field("banner_mobile");

        $dev_title = get_field("dev_title",$query_obj);
        $dev_desc = get_field("dev_desc", $query_obj);

    endif;
    wp_reset_query();
    
?>
<div class="page-banner" style="background-image: url(<?php echo $banner['url'] ?>);">
    <div class="container">
        <h3><?php the_title(); ?></h3>
    </div>
</div>

<div class="develope-detail">
    <div class="container">
        <div class="develope-detail-des">
            <div class="detail-content">
            <?php 
                the_content(); ?>
            </div>
            
        </div>
    </div>
    <div class="download-content">
        <div class="download-desc">
            <div class="container">
                <div class="download-wrap">
                    <div class="title"><?php echo $dev_title; ?></div>
                    <div class="desc"><?php echo $dev_desc; ?></div>
                </div>
            </div>
        </div>
        <?php
            // Check rows exists.
        if( have_rows('dev_downloads', $query_obj) ):

            // Loop through rows.
            while( have_rows('dev_downloads', $query_obj) ) : the_row();

                // Load sub field value.
                $download_heading = get_sub_field('download_heading');
                $padding_top = get_sub_field('padding_top');
                $padding_bottom = get_sub_field('padding_bottom');
                $background_download = get_sub_field('background_download');
                ?>
                <div class="download-block" style="background-color: <?php echo $background_download; ?>; padding-top: <?php echo $padding_top ?>;padding-bottom: <?php echo $padding_bottom; ?>">
                    <div class="container">
                        <div class="download-heading">
                            <?php echo $download_heading; ?>
                        </div>
                        <?php
                            if( have_rows('downloads') ):
                                ?>
                                <ul class="list-download">
                                    <?php
                                    // Loop through rows.
                                    while( have_rows('downloads') ) : the_row();
                                        
                                        $download_title = get_sub_field('download_title');
                                        $date_download = get_sub_field('date_download');
                                        $link_dowload = get_sub_field('link_dowload');
                                        ?>
                                            
                                                <li>
                                                    <a href="<?php echo $link_dowload; ?>">
                                                        <span><?php echo $download_title; ?></span>
                                                        <div class="download-left">
                                                            <span class="download-date"><?php echo $date_download; ?></span>
                                                            <span class="download-button"><?php echo qtranxf_getLanguage() == 'vi' ? 'Tải xuống' : 'Download'; ?></span>
                                                        </div>
                                                    </a>
                                                </li>
                                            
                                        <?php
                                    endwhile;
                                    ?>
                                </ul>
                                <?php
                            endif;
                        ?>
                    </div>
                </div>
                
                <?php
                
            endwhile;
            
        endif;
        ?>
        <div class="detail-dev">
            <div class="container">
         <?php
            single_social_sharing();
            ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
       setActivedevelopes(); 
    });
</script>