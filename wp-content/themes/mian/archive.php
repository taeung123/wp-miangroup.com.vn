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
    $post_type = $wp_query->query;
    switch( $post_type['post_type'] )
    {
        case 'news': /*News*/
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/archive/content', 'news' );            
            break;
        case 'newsletter': /*newsletter*/
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/archive/content', 'ban-tin-co-dong' );            
            break;
        case 'career': /*career*/
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/archive/content', 'tuyen-dung' );            
            break;
        default:
            get_template_part( 'template-parts/pages/content', '404' ); /*404*/            
            break;
    }
    get_footer(); 
?>