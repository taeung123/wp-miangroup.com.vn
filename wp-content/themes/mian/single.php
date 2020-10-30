<?php
    get_header();     
    $post_type = get_post_type();  
    switch( $post_type )    {
        case 'post': /*post */
            get_template_part( 'template-parts/nav/menu', 'main-color' ); 
            $category = get_the_category();
            $cat_id = $category[0]->cat_ID;
            if( in_array($cat_id, array(24,25,26))  ) {
                get_template_part('template-parts/posts/san-pham-dich-vu/content', 'thoi-trang-may-mac'); 
            } else {
                get_template_part('template-parts/posts/san-pham-dich-vu/content', 'bat-dong-san'); 
            }
                       
            break;
        case 'news': /*News*/
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/posts/news/content', 'news' );
            break; 
        case 'newsletter': /*newsletter*/
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/posts/news/content', 'ban-tin-co-dong' );
            break;  
        case 'about_mian': /*about_mian*/
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/posts/news/content', 'about-mian' );
            break;  
        case 'develope': /*about_mian*/
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/posts/news/content', 'develope' );
            break; 
        default:         
            get_template_part( 'template-parts/nav/menu', 'main' );
            get_template_part( 'template-parts/posts/news/content', 'news' );           
            break;    
    }    
    get_footer(); 
?>