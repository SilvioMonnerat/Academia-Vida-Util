<?php

/**
 * Adicionamos uma acção no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_logo' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_logo() {

    /**
     * Labels customizados para o tipo de post
     * 
     */
    $labels = array(
	    'name'                 => _x('Logo', 'post type general name'),
	    'singular_name'        => _x('Logo', 'post type singular name'),
	    'add_new'              => _x('Adicionar Novo', 'noticia'),
	    'add_new_item'         => __('Adicionar Novo Logo'),
	    'edit_item'            => __('Editar Logo'),
	    'new_item'             => __('Novo Logo'),
	    'all_items'            => __('Logo'),
	    'view_item'            => __('Vizualizar Logo'),
	    'search_items'         => __('Pesquisar por Logo'),
	    'not_found'            => __('Nenhum Logo encontrado'),
	    'not_found_in_trash'   => __('Nenhum Logo encontrado na lixeira'),
	    'parent_item_colon'    => '',
	    'menu_name'            => 'Logo'
    );
    
    /**
     * Registamos o tipo de post ´noticia através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'logo', array(
	    'labels'               => $labels,
	    'public'               => true,
	    'publicly_queryable'   => true,
	    'show_ui'              => true,
	    'show_in_menu'         => true,
	    //'menu_icon'            => get_bloginfo('template_directory') . '/images/cp-icon-logo.png',
	    'has_archive'          => 'logo',
	    'rewrite'              => array('slug' 
	    	                   => 'logo','with_front' 
	    	                   => false,),
	    'capability_type'      => 'post',
	    'has_archive'          => true,
	    'hierarchical'         => false,
	    'menu_position'        => 2,
	    'supports'             => array('title','thumbnail')
	    )
    );    
    
    
}