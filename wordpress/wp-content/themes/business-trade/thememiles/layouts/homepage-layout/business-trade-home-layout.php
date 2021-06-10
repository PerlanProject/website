<?php

if( ! function_exists( 'business_trade_home_page_section_hook' ) ):
     
      function business_trade_home_page_section_hook() { 
     
           get_template_part( 'thememiles/home-section-parts/section', 'slider'); 
     }
endif;
   
    add_action( 'business_trade_home_page_section', 'business_trade_home_page_section_hook', 10 );
?>