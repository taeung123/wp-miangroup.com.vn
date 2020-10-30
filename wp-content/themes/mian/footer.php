<section class="section footer">
  <?php nf_footer(); ?>
  <div class="copyright">
    <div class="container">
      <div class="copyright-wrap"><?php _e("Copyright © " . date('Y') . " MIAN Group. All rights reserved.", "mian"); ?></div>
    </div>
  </div>
</div>
<div id="thankyou">
  <?php
    query_posts( array (  'post_type' => 'page', 'post__in' => array( 435 ) ));
    if(have_posts()): 
        the_post();
        the_content();
    endif;
    wp_reset_query();
  
  ?>
</div>
</body>

</html>