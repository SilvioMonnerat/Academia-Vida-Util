<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', '_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_meta_boxes() {
  $project_meta_box = array(
      'id'          => 'project_meta_box',
      'title'       => 'Galeria de Fotos Vida Útil',
      'desc'        => '',
      'pages'       => array('galeria' ),
      'context'     => 'normal',
      'priority'    => 'high',
      'fields'      => array(     
      array(
        'label'       => 'Galeria de Fotos Vida Útil',
        'id'          => 'theme_project_gallery',
        'type'        => 'list-item',
        'desc'        => 'Use esta ferramenta para construir o seu projeto de galeria.',
        'settings'    => array(     
          array(
          'label'       => 'Imagem do Projeto',
          'id'          => 'theme_project_item_image',
          'type'        => 'upload',
          'desc'        => 'Envie sua imagem usando o builtin de gerenciamento de mídia.',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => ''
          ),
          array(
          'label'       => 'Adicionar um Vídeo ao projeto',
          'id'          => 'theme_project_item_video',
          'type'        => 'text',
          'desc'        => 'Cole a URL do vídeo.',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => ''
          ), 
          array(
          'label'       => 'Tamanho Vídeo',
          'id'          => 'theme_project_item_size',
          'type'        => 'select',
          'desc'        => 'Escolha a largura de vídeo que você gostaria de usar.',
          'choices'     => array(
            array(
            'label'       => 'Pequeno',
            'value'       => '597'
            ),
            array(
            'label'       => 'Grande',
            'value'       => '940'
            )
          ),          
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => ''
          ) 
        )
      )        
    )
  );

$logo_meta_box = array(
 'id'          => 'logo_meta_box',
  'title'       => 'Logomarca Vida Útil',
  'desc'        => '',
  'pages'       => array('logo' ),
  'context'     => 'normal',
  'priority'    => 'high',
  'fields'      => array(     
  array(
    'id'          => 'theme_logo_meta_box',
    'type'        => 'list-item',
    'desc'        => 'Use esta ferramenta para construir o seu projeto de galeria.',
    'settings'    => array(     
      array(
      'label'       => 'Insira a Logomarca aqui',
      'id'          => 'logo_meta_box_image',
      'type'        => 'upload',
      'desc'        => 'Envie sua imagem usando o builtin de gerenciamento de mídia.',
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => '',
      'section'     => ''
      )
      ) 
    )
  )
);
    

  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
  ot_register_meta_box( $project_meta_box );
   ot_register_meta_box( $logo_meta_box );

}