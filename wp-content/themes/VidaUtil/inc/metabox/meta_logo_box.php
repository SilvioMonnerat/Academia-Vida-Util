<?php
 
    /* Adiciona a meta box para upload do arquivo */
    add_action( 'add_meta_boxes', 'meta_box_logo' );
     
    function meta_box_logo() {
        add_meta_box( 'my_meta_uploader', 'Upload de arquivo', 'meta_uploader_setup_logo', 'logo', 'normal', 'high' );
    }
     
    /* Adiciona os campos para a meta box de upload */
    function meta_uploader_setup_logo() {
        global $post;
     
        // Procura o valor da chave 'upload_file'
        $meta = get_post_meta( $post->ID, 'upload_file', true );
?> 
    <p> Logo tipo do Header. </p>
 
    <p>
        <input id="upload_file" type="text" size="80" name="upload_file" style="width: 50%;" value="<?php if( ! empty( $meta ) ) echo $meta; ?>" />
        <input id="upload_file_button" type="button" class="button" value="Fazer upload" />
    </p>

<?php } 

    /* Salva os dados da nossa custom meta box */
    add_action( 'save_post', 'meta_uploader_save_logo' );
     
    function meta_uploader_save_logo( $post_id ) {
     
        if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
     
        // Recebe o valor que foi enviado pelo media uploader
        $arquivo = $_POST['upload_file'];
     
        // Adiciona a chave upload_file ou atualiza seu valor
        add_post_meta( $post_id, 'upload_file', $arquivo, true ) or update_post_meta( $post_id, 'upload_file', $arquivo );
     
        return $post_id;
    }

    /* Adiciona o script que replica o uploader padrão do WordPress */
    add_action( 'admin_head', 'meta_uploader_script_logo' );
     
    function meta_uploader_script_logo() { 
?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
 
            var formfield;
            var header_clicked = false;
 
            jQuery( '#upload_file_button' ).click( function() {
                formfield = jQuery( '#upload_file' ).attr( 'name' );
                tb_show( '', 'media-upload.php?TB_iframe=true' );
                header_clicked = true;
 
                return false;
            });
 
            // Guarda o uploader original
            window.original_send_to_editor = window.send_to_editor;
 
            // Sobrescreve a função nativa e preenche o campo com a URL
            window.send_to_editor = function( html ) {
                if ( header_clicked ) {
                    fileurl = jQuery( html ).attr( 'href' );
                    jQuery( '#upload_file' ).val( fileurl );
                    header_clicked = false;
                    tb_remove();
                }
                else
                {
                    window.original_send_to_editor( html );
                }
            }
 
        });
    </script>

<?php } ?>