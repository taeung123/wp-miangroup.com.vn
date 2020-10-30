<?php
/**
 *
 * @package xx
 * @subpackage xx
 * @since xx
 * 
 */
 ?>
<?php 

    get_header();
    if(is_taxonomy("category")) {
        get_template_part( 'template-parts/nav/menu', 'main-color' );  
        get_template_part( 'template-parts/category/content', 'thoi-trang-may-mac' );      
    } else {
        get_template_part( 'template-parts/pages/content', '404' ); /*404*/
    }
    get_footer(); 
?>
