<?php header("Content-type: text/css; charset: UTF-8"); ?>

<?php require_once( '../../../../wp-load.php' );?>

<?php
  
  $predefined_skins = get_option('ezine_predefined_skins');
  $background_color = get_option('ezine_background_color');
  $body_text_color = get_option('ezine_body_text_color');
  $bgpattern = get_option('ezine_bg_pattern');
  $custom_css = get_option('ezine_custom_css');
  $custom_body_text = get_option('ezine_custom_body_text');
  $permalinks_color = get_option('ezine_permalinks_color');
  $permalinks_hover_color = get_option('ezine_permalinks_hover_color');
  $sidebar_heading_color = get_option('ezine_sidebar_heading_color');
  
  if ($predefined_skins == "#80A53F") {
    echo '@import url("'.get_bloginfo('template_directory').'/css/styles/green-bar.css");';
  } else if ($predefined_skins == "#53B3C1") {
    echo '@import url("'.get_bloginfo('template_directory').'/css/styles/grey-bar.css");';
  } else if ($predefined_skins == "#f00000") {
    echo '@import url("'.get_bloginfo('template_directory').'/css/styles/red-bar.css");';
  }

  if ($background_color == "#333333") {
    echo '@import url("'.get_bloginfo('template_directory').'/css/dark-global.css");';
  } 
  
  if ($background_color != "") {
    echo 'body { background-color: '.$background_color.';}';
  }
  if ($bgpattern != "") {
    echo 'body { background-image: url(../images/pattern/'.$bgpattern.');}' ;
    if ($bgpattern == "no pattern") {
      echo 'body { background-image: none;}' ;  
    }
  }  
  
  if ($custom_body_text != "") {
    echo 'body { font : 62.5% '.$custom_body_text['face'].';}'; 
    echo 'p { color:'.$custom_body_text['color'].';font-size:'.$custom_body_text['size'].'px;font-style:'.$custom_body_text['style'].'}';
    echo 'ol li { color:'.$custom_body_text['color'].'}';
    echo '.arrowlist li { color:'.$custom_body_text['color'].'}';
    echo '.checklist li { color:'.$custom_body_text['color'].'}';
    echo '.bulletlist li { color:'.$custom_body_text['color'].'}';
    echo '.itemlist li { color:'.$custom_body_text['color'].'}';
  }
  
  if ($permalinks_color != "") {
    echo 'a,a:link,a:visited { color:'.$permalinks_color.';}';
    echo '.archivelist li a { color:'.$permalinks_color.';}';
  }
  
  if ($permalinks_hover_color != "") {
    echo 'a:hover{ color:'.$permalinks_hover_color.';}';
    echo '.archivelist li a:hover { color:'.$permalinks_hover_color.';}';
  }
  
  if ($sidebar_heading_color != "") {
     echo '.sidebox h3,.leftbox h3 { color: '.$sidebar_heading_color.';}';
  }  
  
  if ($custom_css !="") {
    echo $custom_css;
  }
?>