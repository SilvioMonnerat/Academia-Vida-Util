<?php
 
	// Vamos garantir que é o WordPress que chama este ficheiro
	// e que realmente está a desistalar o plugin.
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	  die();
	 
	// Vamos remover as opções que criámos na instalação
	delete_option( 'ewp_opcao' );
 
?>