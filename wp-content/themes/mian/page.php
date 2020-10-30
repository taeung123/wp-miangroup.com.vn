<?php  
    get_header();
    $queriedobjectid = get_queried_object_id();    
    switch ($queriedobjectid) {
        case 90: /*San Pham & Dich Vu*/ 
            get_template_part( 'template-parts/nav/menu', 'main-color' );        
            get_template_part( 'template-parts/pages/content', 'san-pham-dich-vu' );            
            break;
        case 135: /*Ve Mian*/ 
            get_template_part( 'template-parts/nav/menu', 'main' );        
            get_template_part( 'template-parts/pages/content', 've-mian' );            
            break;
        case 176: /*Cau Chuyen Mian*/ 
            get_template_part( 'template-parts/nav/menu', 'main' );        
            get_template_part( 'template-parts/pages/content', 'cau-chuyen-mian' );            
            break;
        case 306: /*Co Dong*/ 
            get_template_part( 'template-parts/nav/menu', 'main' );        
            get_template_part( 'template-parts/pages/content', 'co-dong' );            
            break;
        case 336: /*Lien He*/ 
            get_template_part( 'template-parts/nav/menu', 'main' );        
            get_template_part( 'template-parts/pages/content', 'lien-he' );            
            break;
        case 2237: /*Lĩnh vực kinh doanh*/ 
            get_template_part( 'template-parts/nav/menu', 'main' );        
            get_template_part( 'template-parts/pages/content', 'linh-vuc-kd' );            
            break;
            case 2286: /*Lĩnh vực kinh doanh*/ 
                get_template_part( 'template-parts/nav/menu', 'main' );        
                get_template_part( 'template-parts/pages/content', 'phat-trien-ben-vung' );           
                break;
            
        default:            
          get_template_part( 'template-parts/pages/content', '404' ); /*404*/
          break;     
                       
    }
    
    get_footer();
?>