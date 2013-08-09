    <?php
    $testi_cid      = get_option('ezine_testimonial_cid');
    $portfolio_cats_include = get_option('ezine_portfolio_cats_include');
    
    if(is_array($portfolio_cats_include)) {
      $portfolio_include = implode(",",$portfolio_cats_include);
    } 
        
    if ( is_category($testi_cid) ) {
      include(TEMPLATEPATH . '/category-testimonial.php');
    } else if (is_category($portfolio_include)) {
      include(TEMPLATEPATH . '/category-portfolio.php');
    } else if (is_array($portfolio_cats_include)) {
        foreach ($portfolio_cats_include as $catinclude) {
          if( is_category($catinclude)) {
            include(TEMPLATEPATH . '/category-portfolio.php');
          } else {
            include(TEMPLATEPATH . '/archive.php');
          }
        }
    } else {
      include(TEMPLATEPATH . '/archive.php');
    }
    ?>