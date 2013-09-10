<?php
	add_action( 'init', 'create_post_type_logo' );

	function create_post_type_logo() {

	    $labels = array(
		    'name'                 => _x('Logo', 'post type general name'),
		    'singular_name'        => _x('Logo', 'post type singular name'),
		    'add_new'              => _x('Adicionar Novo', 'logo'),
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
	     * Registamos o tipo de post curso através desta função
	     * passando-lhe os labels e parâmetros de controlo.
	     */
	    register_post_type( 'logo', array(
		    'labels'               => $labels,
		    'public'               => true,
		    'publicly_queryable'   => true,
		    'show_ui'              => true,
		    'show_in_menu'         => true,
		    'menu_icon'            => get_bloginfo('template_directory') . '/images/custom-post-icon.png',
		    'has_archive'          => 'logo',
		    'rewrite'              => array('slug' => 'logo','with_front' => false),
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
	    register_taxonomy( 'logo_category', array( 'logo' ), array(
	        'hierarchical'         => true,
	        'label'                => __( 'Logo Category' ),
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
	                               => 'logo','with_front' 
	                               => false,),
	        )
	    );
	    
	    /** 
	     * Esta função associa tipos de categorias com tipos de posts.
	     * Aqui associamos as tags ao tipo de post curso.
	     */
	    register_taxonomy_for_object_type( 'tags', 'logo' );
	    
	}
