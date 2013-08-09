<?php

/**
 * Adicionamos uma acção no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_agenda' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_agenda() {

    /**
     * Labels customizados para o tipo de post
     * 
     */
    $labels = array(
	    'name'                 => _x('Agenda', 'post type general name'),
	    'singular_name'        => _x('Agenda', 'post type singular name'),
	    'add_new'              => _x('Adicionar Novo', 'agenda'),
	    'add_new_item'         => __('Adicionar Novo Agenda'),
	    'edit_item'            => __('Editar Agenda'),
	    'new_item'             => __('Novo Agenda'),
	    'all_items'            => __('Agenda'),
	    'view_item'            => __('Vizualizar Agenda'),
	    'search_items'         => __('Pesquisar por Agenda'),
	    'not_found'            => __('Nenhum Agenda encontrado'),
	    'not_found_in_trash'   => __('Nenhum Agenda encontrado na lixeira'),
	    'parent_item_colon'    => '',
	    'menu_name'            => 'Agenda'
    );
    
    /**
     * Registamos o tipo de post agenda através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'agenda', array(
	    'labels'               => $labels,
	    'public'               => true,
	    'publicly_queryable'   => true,
	    'show_ui'              => true,
	    'show_in_menu'         => true,
	    'menu_icon'            => get_bloginfo('template_directory') . '/images/custom-post-icon.png',
	    'has_archive'          => 'agendas',
	    'rewrite'              => array('slug' 
	    	                   => 'agendas','with_front' 
	    	                   => false,),
	    'capability_type'      => 'post',
	    'has_archive'          => true,
	    'hierarchical'         => false,
	    'menu_position'        => 6,
	    'supports'             => array('title','thumbnail')
	    )
    );
    
    /**
     * Registamos a categoria de agenda para o tipo de post agenda
     */
    register_taxonomy( 'agenda_category', array( 'agenda' ), array(
        'hierarchical'         => true,
        'label'                => __( 'Agenda Category' ),
        'labels'               => array( 
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
        'rewrite'              => array('slug' => 'agenda/categories','with_front' => false,),
        )
    );
    
    /** 
     * Esta função associa tipos de categorias com tipos de posts.
     * Aqui associamos as tags ao tipo de post agenda.
     */
    register_taxonomy_for_object_type( 'tags', 'agenda' );
    
}
