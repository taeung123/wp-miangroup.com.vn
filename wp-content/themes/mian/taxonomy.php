<?php
    get_header();
    $queried_object = get_queried_object();
    $term_id = $queried_object->term_id;
    switch ($term_id) {
        case 7: /*For investors*/
            get_template_part( 'template-parts/nav/menu', 'main-white' );          
            get_template_part( 'template-parts/taxonomy/content', 'investors' );            
            break; 
        case 8: /*For sales*/
            get_template_part( 'template-parts/nav/menu', 'main-white' );          
            get_template_part( 'template-parts/taxonomy/content', 'sales' );            
            break; 
        default:
            switch ($queried_object->parent) {
                case 8: /*For sub sales*/
                    get_template_part( 'template-parts/nav/menu', 'main-white' );          
                    get_template_part( 'template-parts/taxonomy/content', 'sub-sales' );            
                    break;
                default:
                   get_template_part( 'template-parts/pages/content', '404' ); /*404*/            
                    break;   
            }
             
    }
    get_footer();
?>