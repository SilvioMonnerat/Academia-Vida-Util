<?php
	/*
		Plugin Name: Framework Cabanudo
		Plugin URI: http://www.cabanacriacao.com
		Description: Frameworks para wordpress com metadadas, custom post, lauers Slider e entre outras funções
		Version: 1.0
		Author: Silvio Monnerat
		Author URI: http://facebook.com/silvio.monnerat
		License: GPLv2
	*/
	/*
	 *      Copyright 2013 Cabana Criação <contato@cabanacriacao.com>
	 *
	 *      This program is free software; you can redistribute it and/or modify
	 *      it under the terms of the GNU General Public License as published by
	 *      the Free Software Foundation; either version 3 of the License, or
	 *      (at your option) any later version.
	 *
	 *      This program is distributed in the hope that it will be useful,
	 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *      GNU General Public License for more details.
	 *
	 *      You should have received a copy of the GNU General Public License
	 *      along with this program; if not, write to the Free Software
	 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
	 *      MA 02110-1301, USA.
 */
?>
<?php

	add_action( 'admin_menu', 'cabanudo_admin_menu_page' );

	function cabanudo_admin_menu_page(){
	    add_menu_page( 'Framework Cabanudo Option', 'Cabanudo', 'manage_options', 'custompage', 'my_custom_menu_page',  /*plugins_url(),*/ NULL ); 
	}

	function my_custom_menu_page(){
	    $menuOutput = '
	    	<form method="POST" action="">
			    <input type="text" name="nome" value=" Nome" />
			    <input type="text" name="email" value=" Email" />
			    <input type="text" name="telefone" value=" Telefone" />
			    <textarea></textarea>
			    <input type="submit" value="Update" />
			</form>
	    ';
	    print $menuOutput;
	}
 