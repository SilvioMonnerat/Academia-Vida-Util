<?php

/**
 * Adicionamos uma acção no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_foto' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_foto() {

    /**
     * Labels customizados para o tipo de post
     * 
     */
    $labels = array(
	    'name'                 => _x('Foto', 'post type general name'),
	    'singular_name'        => _x('Foto', 'post type singular name'),
	    'add_new'              => _x('Adicionar Novo', 'foto'),
	    'add_new_item'         => __('Adicionar Novo Foto'),
	    'edit_item'            => __('Editar Foto'),
	    'new_item'             => __('Novo Foto'),
	    'all_items'            => __('Foto'),
	    'view_item'            => __('Vizualizar Foto'),
	    'search_items'         => __('Pesquisar por Foto'),
	    'not_found'            => __('Nenhum Foto encontrado'),
	    'not_found_in_trash'   => __('Nenhum Foto encontrado na lixeira'),
	    'parent_item_colon'    => '',
	    'menu_name'            => 'Foto'
    );
    
    /**
     * Registamos o tipo de post curso através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'foto', array(
	    'labels'               => $labels,
	    'public'               => true,
	    'publicly_queryable'   => true,
	    'show_ui'              => true,
	    'show_in_menu'         => true,
	    'menu_icon'            => get_bloginfo('template_directory') . '/images/custom-post-icon.png',
	    'has_archive'          => 'foto',
	    'rewrite'              => array('slug' 
	    	                   => 'foto','with_front' 
	    	                   => false,),
	    'capability_type'      => 'post',
	    'has_archive'          => true,
	    'hierarchical'         => false,
	    'menu_position'        => 8,
	    'supports'             => array('title','thumbnail')
	    )
    );
    
    /**
     * Registamos a categoria de curso para o tipo de post curso
     */
    register_taxonomy( 'foto_category', array( 'foto' ), array(
        'hierarchical'         => true,
        'label'                => __( 'Foto Category' ),
        'labels'               => array( // Labels customizadas
	    'name'                 => _x( 'Categories', 'taxonomy general name' ),
	    'singular_name'        => _x( 'Category', 'taxonomy singular name' ),
	    'search_items'         => __( 'Search Categories' ),
	    'all_items'            => __( 'All Categories' ),
	    'parent_item'          => __( 'Parent Category' ),
	    'parent_item_colon'    => __( 'Parent Category:' ),
	    'edit_item'            => __( 'Edit Category' ),
	    'update_item'          => __( 'Update Category' ),
	    'add_new_item'         => __( 'Add New Category' ),
	    'new_item_name'        => __( 'New Category Name' ),
	    'menu_name'            => __( 'Categorias' ),
	),
        'show_ui'              => true,
        'show_in_tag_cloud'    => true,
        'query_var'            => true,
        'rewrite'              => array('slug'
                               => 'foto','with_front' 
                               => false,),
        )
    );
    
    /** 
     * Esta função associa tipos de categorias com tipos de posts.
     * Aqui associamos as tags ao tipo de post curso.
     */
    register_taxonomy_for_object_type( 'tags', 'foto' );
    
}