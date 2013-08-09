<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = wp_get_theme(STYLESHEETPATH . '/style.css');
$themename = "Tema Hostnet";
$shortname = "ezine";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
  $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
}    
//$categories_tmp = array_unshift($of_categories, "Select a category:");    

$of_slide_categories = array();
$slideshow_categories = get_categories('taxonomy=slideshow_category&orderby=ID&title_li=&hide_empty=0');
foreach ($slideshow_categories as $slide_category) { 
  $of_slide_categories[$slide_category->cat_ID] = $slide_category->cat_name;
}

$of_product_categories = array();
$product_categories = get_categories('taxonomy=product_category&orderby=ID&title_li=&hide_empty=0');
foreach ($product_categories as $product_category) { 
  $of_product_categories[$product_category->cat_ID] = $product_category->cat_name;
}


//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('parent=0');
foreach ($of_pages_obj as $of_page) {
  $of_pages[$of_page->ID] = $of_page->post_title; 
}
//$of_pages_tmp = array_unshift($of_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

$slide_effects = array("random","fold","fade","sliceDown","sliceDownLeft","sliceUp","sliceUpLeft","sliceUpDown","sliceUpDownLeft");

// Set the Options Array
$options = array();


$options[] = array( "name" => "Configurações gerais",
                    "icon" => "general",
                    "type" => "heading");

$options[] = array( "type" => "info",
				//	"std" => "<b>Configurações gerais!</b>",
                    "std" => '
					<b>Precisa de ajuda para as Configurações gerais?</b><br />
					Clique <a rel="facebox" href="#conf_gerais" style="text-decoration:none;">aqui </a>e veja o tutorial que mostra todas as funcionalidades da tela!
					<div id="conf_gerais" style="display: none;">
					  <div class="quadro_facebox">
						<div class="quadro_facebox_content">
						  <h3 class="azul_4">Precisa de ajuda para as Configurações Gerais?</h3>
							<p>
							  <object height="344" width="560">
								<param name="movie" value="http://www.youtube.com/v/Esn1k3knxsk?version=3&feature=player_detailpage" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<embed allowfullscreen="true" allowscriptaccess="always" height="360" src="http://www.youtube.com/v/Esn1k3knxsk?version=3&feature=player_detailpage" type="application/x-shockwave-flash" width="560">
								</embed>
							  </object>
							</p>
						</div>
					  </div>
					</div>');
    
$options[] = array( "name" => "Logo",
					"desc" => "Envie sua logo ou especifique a URL onde ela se encontra",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
          
$options[] = array( "name" => "Favicon",
					"desc" => "Envie uma imagem 16px x 16px PNG/GIF que será o favicon de seu site.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
          
$options[] = array( "name" => "Página 'Sobre'",
					"desc" => "Selecione a página que falará sobre você ou sua empresa ",
					"id" => $shortname."_about_pid",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);
                                      
$options[] = array( "name" => "Depoimentos",
					"desc" => "Selecione uma categoria referente aos depoimentos que seus clientes deixarão sobre você ou sua empresa.",
					"id" => $shortname."_testimonial_cid",
					"std" => "",
					"type" => "select",
					"options" => $of_categories);
					
$options[] = array( "name" => "Google Analytics",
					"desc" => "Coloque aqui o código do Google Analytics (ou de outra ferramenta de audiência). Será inserido no rodapé do site.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");                       
                                       
$options[] = array( "name" => "404",
					"desc" => "Coloque aqui o texto que será exibido quando um usuário não encontrar algo em seu site.",
					"id" => $shortname."_404_text",
					"std" => "",
					"type" => "textarea");         

$options[] = array( "name" => "Rodapé",
					"desc" => "Coloque aqui o texto que deseja exibir no rodapé do site.",
					"id" => $shortname."_footer_text",
					"std" => "",
					"type" => "textarea");
          
$options[] = array( "name" => "Configurações do Slideshow",
                    "icon" => "slideshow",
                    "type" => "heading");

$options[] = array( "type" => "info",
				//	"std" => "<b>Configurações do Slideshow!</b>",
                    "std" => '
					<b>Precisa de ajuda para as Configurações do Slideshow?</b><br />
					Clique <a rel="facebox" href="#config_slide" style="text-decoration:none;">aqui </a>e veja o tutorial que mostra todas as funcionalidades da tela!
					<div id="config_slide" style="display: none;">
					  <div class="quadro_facebox">
						<div class="quadro_facebox_content">
						  <h3 class="azul_4">Precisa de ajuda para as Configurações do Slideshow?</h3>
							<p>
							  <object height="344" width="560">
								<param name="movie" value="http://www.youtube.com/v/0Tth3hX4X30?version=3&feature=player_detailpage" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<embed allowfullscreen="true" allowscriptaccess="always" height="360" src="http://www.youtube.com/v/0Tth3hX4X30?version=3&feature=player_detailpage" type="application/x-shockwave-flash" width="560">
								</embed>
							  </object>
							</p>
						</div>
					  </div>
					</div>');
                    
$options[] = array( "name" => "Tipos de transições",
					"desc" => "Selecione o tipo de efeito para as transições do slider.",
					"id" => $shortname."_nivo_transition",
					"type" => "select",
					"options" => $slide_effects);
          
$options[] = array( "name" => "Quantidade de slides",
					"desc" => "Informe a quantidade desejada de slides.",
					"id" => $shortname."_nivo_slices",
					"type" => "text");

$options[] = array( "name" => "Velocidade de transição dos slides",
					"desc" => "Informe a velocidade desejada para os slides (em milisegundos).",
					"std" => "500",
					"id" => $shortname."_nivo_animspeed",
					"type" => "text");

$options[] = array( "name" => "Tempo de pausa dos slides",
					"desc" => "Informe o tempo de duração de cada slide, entre cada transição (in milliseconds).",
					"std" => "3000",
					"id" => $shortname."_nivo_pausespeed",
					"type" => "text");

$options[] = array( "name" => "Habilitar navegação direcional?",
					"desc" => "Caso falso, não mostrará as opções 'próximo' e 'anterior' nos slides",
					"id" => $shortname."_nivo_directionNav",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));

$options[] = array( "name" => "Esconder as setas de navegação dos slides?",
					"desc" => "Somente mostrar as setas de navegação dos slides quando o mouse estiver sobre o slide",
					"id" => $shortname."_nivo_directionNavHide",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));

$options[] = array( "name" => "Habilitar controle de navegação por círculos?",
					"desc" => "Caso falso, não mostrará o controle por círculos exibido abaixo do slider",
					"id" => $shortname."_nivo_controlNav",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));					

$options[] = array( "name" => "Habilitar legenda?",
					"desc" => "Habilitar legenda de imagens no slide",
					"id" => $shortname."_nivo_caption",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));	
					
$options[] = array( "name" => "Opções de posts",
					"icon" => "blog",
					"type" => "heading"); 
					
$options[] = array( "type" => "info",
                //	"std" => "<b>Opções de Posts!</b>",
                    "std" => '
					<b>Precisa de ajuda para as Configurações de Posts?</b><br />
					Clique <a rel="facebox" href="#config_post" style="text-decoration:none;">aqui </a>e veja o tutorial que mostra todas as funcionalidades da tela!
					<div id="config_post" style="display: none;">
					  <div class="quadro_facebox">
						<div class="quadro_facebox_content">
						  <h3 class="azul_4">Precisa de ajuda para as Configurações de posts?</h3>
							<p>
							  <object height="344" width="560">
								<param name="movie" value="http://www.youtube.com/v/pnT8uZ-KGAs?version=3&feature=player_detailpage" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<embed allowfullscreen="true" allowscriptaccess="always" height="360" src="http://www.youtube.com/v/pnT8uZ-KGAs?version=3&feature=player_detailpage" type="application/x-shockwave-flash" width="560">
								</embed>
							  </object>
							</p>
						</div>
					  </div>
					</div>');
          	   
$options[] = array(	"name" => "Número de palavras para o resumo do post",
			"desc" => "Insira o número de palavras desejado para o resumo do post automático",
      "id" => $shortname."_post_excerpt_num",
      "type" => "text");

$options[] = array(	"name" => "Desabilitar botão de Tweet?",
    "desc" => "Marque essa opção se desejar desabilitar o botão de Tweet",
    "id" => $shortname."_disable_tweetbutton",
    "std" => "false",
    "type" => "checkbox");

$options[] = array(	"name" => "Desabilitar botão de 'Curtir' do Facebook?",
    "desc" => "Marque essa opção se desejar desabilitar o botão 'Curtir' do Facebook",
    "id" => $shortname."_disable_fblikebutton",
    "std" => "false",
    "type" => "checkbox");
           
$options[] = array(	"name" => "Desabilitar o box do Autor do post?",
    "desc" => "Marque essa opção se desejar desabilitar o box do Autor do post",
    "id" => $shortname."_disable_authorbox",
    "std" => "false",
    "type" => "checkbox");
    
$options[] = array(	"name" => "Desabilitar botões de redes sociais?",
    "desc" => "Marque essa opção se desejar desabilitar os botões de redes sociais",
    "id" => $shortname."_disable_sb",
    "std" => "false",
    "type" => "checkbox");
    
$options[] = array(	"name" => "Desabilitar posts relacionados?",
    "desc" => "Marque essa opção se desejar desabilitar a seção de posts relacionados",
    "id" => $shortname."_disable_relatedpost",
    "std" => "false",
    "type" => "checkbox");
                
$options[] = array(	"name" => "Quantidade de posts exibidos na opção 'Posts relacionados'",
			"desc" => "Insira a quantidade desejada de posts para a seção 'Posts relacionados",
			"id" => $shortname."_relatedposts_num",
			"std" => "",
      "type" => "text");    
                                
$options[] = array( "name" => "Galeria de fotos",
          "icon" => "portfolio",
					"type" => "heading");

$options[] = array( "type" => "info",
                //	"std" => "<b>Galeria de Fotos!</b>",
                    "std" => '
					<b>Precisa de ajuda para a Galeria de Fotos?</b><br />
					Clique <a rel="facebox" href="#galeria" style="text-decoration:none;">aqui </a>e veja o tutorial que mostra todas as funcionalidades da tela!
					<div id="galeria" style="display: none;">
					  <div class="quadro_facebox">
						<div class="quadro_facebox_content">
						  <h3 class="azul_4">Precisa de ajuda para a Galeria de fotos?</h3>
							<p>
							  <object height="344" width="560">
								<param name="movie" value="http://www.youtube.com/v/D4IBt61P9Ns?version=3&feature=player_detailpage" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<embed allowfullscreen="true" allowscriptaccess="always" height="360" src="http://www.youtube.com/v/D4IBt61P9Ns?version=3&feature=player_detailpage" type="application/x-shockwave-flash" width="560">
								</embed>
							  </object>
							</p>
						</div>
					  </div>
					</div>');

$options[] = array( "name" => "Categorias",
					"desc" => "Selecione as categorias que você deseja incluir na galeria de fotos",
					"id" => $shortname."_portfolio_cats_include",
					"std" => "",
					"type" => "multicheck",
					"options" => $of_categories);			
          
$options[] = array( "name" => "Descrição da página",
					"desc" => "Insira a descrição desejada para a página de galeria de fotos",
					"id" => $shortname."_portfolio_desc",
					"std" => "",
					"type" => "textarea");  
					
$options[] = array( "name" => "Número de imagens exibidos por página",
					"desc" => "Insira o número de imagens desejado por página",
					"id" => $shortname."_porto_num",
					"std" => "",
					"type" => "text");  
					
$options[] = array( "name" => "Ordem das imagens",
					"desc" => "Selecione os parâmetros para ordenação das imagens na página",
					"id" => $shortname."_portfolio_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				                                                    

$options[] = array( "name" => "Texto 'Ver detalhes'",
					"desc" => "Insira o texto desejado para a opção 'Ver detalhes' exibido abaixo das imagens",
					"id" => $shortname."_portfolio_readmore",
					"std" => "",
					"type" => "text");  

$options[] = array( "name" => "Texto 'Visitar site'",
					"desc" => "Insira o texto desejado para a opção 'Visitar site' exibido abaixo das imagens",
					"id" => $shortname."_portfolio_visitsite",
					"std" => "",
					"type" => "text");
					                           
$options[] = array( "name" => "Opções de estilo",
          "icon" => "styling",
					"type" => "heading");
					
$options[] = array( "type" => "info",
				//	"std" => "<b>Opções de Estilo!</b>",
                    "std" => '
					<b>Precisa de ajuda para as Opções de Estilo?</b><br />
					Clique <a rel="facebox" href="#estilo" style="text-decoration:none;">aqui </a>e veja o tutorial que mostra todas as funcionalidades da tela!
					<div id="estilo" style="display: none;">
					  <div class="quadro_facebox">
						<div class="quadro_facebox_content">
						  <h3 class="azul_4">Precisa de ajuda para as Opções de estilo?</h3>
							<p>
							  <object height="344" width="560">
								<param name="movie" value="http://www.youtube.com/v/Gs5_8u-cl54?version=3&feature=player_detailpage" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<embed allowfullscreen="true" allowscriptaccess="always" height="360" src="http://www.youtube.com/v/Gs5_8u-cl54?version=3&feature=player_detailpage" type="application/x-shockwave-flash" width="560">
								</embed>
							  </object>
							</p>
						</div>
					  </div>
					</div>');
					
$url_bgcolor =  get_bloginfo('stylesheet_directory') . '/admin/images/bgcolor/';

$options[] = array( "name" => "Cor de fundo",
					"desc" => "Escolha uma das cores de fundo para o site",
					"id" => $shortname."_background_color",
					"std" => "",
					"type" => "images",
					"options" => array(
						'#ffffff' => $url_bgcolor . 'white.png',
            '#333333' => $url_bgcolor . 'dark.png'                       
            ));
            
$options[] = array( "name" => "Esquema de cor do site",
					"desc" => "Escolha uma das cores pré-definidas para o layout do site",
					"id" => $shortname."_predefined_skins",
					"std" => "",
					"type" => "images",
					"options" => array(
						'#ffffff' => $url_bgcolor . 'blue-sky.png',
						'#80A53F' => $url_bgcolor . 'green.png',
            '#53B3C1' => $url_bgcolor . 'grey.png',
						'#f00000' => $url_bgcolor . 'red.png'                        
            ));

$url_bgpattern =  get_bloginfo('stylesheet_directory') . '/admin/images/bgpattern/';
$options[] = array( "name" => "Imagem de fundo",
					"desc" => "Selecione uma das imagens para ser a imagem de fundo do seu site.",
					"id" => $shortname."_bg_pattern",
					"std" => "",
					"type" => "images",
					"options" => array(
            'no pattern' => $url_bgcolor . 'white.png',
            'grid2.png' => $url_bgpattern . 'grid2.png',
            'grid3.png' => $url_bgpattern . 'grid3.png',
            'grid4.png' => $url_bgpattern . 'grid4.png',
            'horizontal-line1.png' => $url_bgpattern . 'horizontal-line1.png',
            'horizontal-line2.png' => $url_bgpattern . 'horizontal-line2.png',
            'diagonal-line1.png' => $url_bgpattern . 'diagonal-line1.png',
            'vertical-line1.png' => $url_bgpattern . 'vertical-line1.png',
            'vertical-line2.png' => $url_bgpattern . 'vertical-line2.png',
            'vertical-line3.png' => $url_bgpattern . 'vertical-line3.png',
            'mozaic1.png' => $url_bgpattern . 'mozaic1.png',
            'mozaic2.png' => $url_bgpattern . 'mozaic2.png',
            'mozaic2.png' => $url_bgpattern . 'mozaic2.png',
            'dot.png' => $url_bgpattern . 'dot.png',
            'flower-swirl1.png' => $url_bgpattern . 'flower-swirl1.png',
            'flower-swirl2.png' => $url_bgpattern . 'flower-swirl2.png',
            'flower-swirl3.png' => $url_bgpattern . 'flower-swirl3.png',
            'flower-swirl4.png' => $url_bgpattern . 'flower-swirl4.png',
            'flower-swirl5.png' => $url_bgpattern . 'flower-swirl5.png',
            'flower-swirl6.png' => $url_bgpattern . 'flower-swirl6.png',
            'flower-swirl7.png' => $url_bgpattern . 'flower-swirl7.png',
            'flower-swirl8.png' => $url_bgpattern . 'flower-swirl8.png',
            'flower-swirl9.png' => $url_bgpattern . 'flower-swirl9.png',
          ));

$options[] = array( "name" => "Tipografia do corpo do texto",
					"desc" => "Use essa opção se quiser customizar a fonte do corpo do texto",
					"id" => $shortname."_custom_body_text",
					"std" => array('size' => '12','unit' => 'em','face' => 'Arial','color' => '#8f8f8f'),
					"type" => "typography");
					
$options[] = array( "name" => "Cor dos links",
					"desc" => "Defina a cor dos links do site",
					"id" => $shortname."_permalinks_color",
					"std" => "",
					"type" => "color"); 					
					
$options[] = array( "name" => "Cor dos links, quando o cursor do mouse estiver sobre ele",
					"desc" => "Defina a cor dos links quando houver aproximação do mouse",
					"id" => $shortname."_permalinks_hover_color",
					"std" => "",
					"type" => "color"); 					
					
$options[] = array( "name" => "Cor dos títulos da barra lateral",
					"desc" => "Defina a cor dos títulos da barra lateral",
					"id" => $shortname."_sidebar_heading_color",
					"std" => "",
					"type" => "color"); 					
					
$options[] = array( "name" => "CSS customizado",
          "desc" => "Adicione rapidamente estilos CSS para seu site nesta área",
          "id" => $shortname."_custom_css",
          "std" => "",
          "type" => "textarea");
          
$options[] = array( "name" => "Informações de contato",
          "icon" => "contact",
					"type" => "heading");
					
$options[] = array( "type" => "info",
				//	"std" => "<b>Informações de Contato!</b>",
                    "std" => '
					<b>Precisa de ajuda para as Informações de Contato?</b><br />
					Clique <a rel="facebox" href="#contato" style="text-decoration:none;">aqui </a>e veja o tutorial que mostra todas as funcionalidades da tela!
					<div id="contato" style="display: none;">
					  <div class="quadro_facebox">
						<div class="quadro_facebox_content">
						  <h3 class="azul_4">Precisa de ajuda para as Informações de contato?</h3>
							<p>
							  <object height="344" width="560">
								<param name="movie" value="http://www.youtube.com/v/drO5CKWSxYs?version=3&feature=player_detailpage" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<embed allowfullscreen="true" allowscriptaccess="always" height="360" src="http://www.youtube.com/v/drO5CKWSxYs?version=3&feature=player_detailpage" type="application/x-shockwave-flash" width="560">
								</embed>
							  </object>
							</p>
						</div>
					  </div>
					</div>');

$options[] = array( "name" => "Google Maps",
					"desc" => "Informe o link do seu Google Maps aqui.",
					"id" => $shortname."_gmap_source",
					"std" => "",
					"type" => "textarea");
					
$options[] = array( "name" => "Endereço",
					"desc" => "Informe o endereço do seu escritório.",
					"id" => $shortname."_info_address",
					"std" => "",
					"type" => "textarea");    

$options[] = array( "name" => "Número de telefone",
					"desc" => "Informe seu número de telefone aqui",
					"id" => $shortname."_info_phone",
					"std" => "",
					"type" => "text");    

$options[] = array( "name" => "FAX",
					"desc" => "Informe seu número de FAX aqui",
					"id" => $shortname."_info_fax",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Endereço de e-mail",
					"desc" => "Informe seu endereço de e-mail aqui",
					"id" => $shortname."_info_email",
					"std" => "",
					"type" => "text");
          
$options[] = array( "name" => "Website",
					"desc" => "Informe o nome de seu site aqui",
					"id" => $shortname."_info_website",
					"std" => "",
					"type" => "text");

$options[] = array( "type" => "info",
            "std" => "Redes Sociais");
           	  
$options[] = array( "name" => "Linkedin",
					"desc" => "Informe seu Linkedin aqui",
					"id" => $shortname."_linkedin_id",
					"std" => "",
					"type" => "text");                                    

$options[] = array( "name" => "Twitter",
					"desc" => "Informe seu Twitter aqui",
					"id" => $shortname."_twitter_id",
					"std" => "",
					"type" => "text");             
                             		
$options[] = array( "name" => "Facebook",
					"desc" => "Informe seu Facebook aqui",
					"id" => $shortname."_facebook_id",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Flickr",
					"desc" => "Informe seu ID do Flickr aqui, você pode descobrí-lo nesse site <a href=\"http://www.idgettr.com\">IDGettr</a>",
					"id" => $shortname."_flickr_id",
					"std" => "",
					"type" => "text"); ;

update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>