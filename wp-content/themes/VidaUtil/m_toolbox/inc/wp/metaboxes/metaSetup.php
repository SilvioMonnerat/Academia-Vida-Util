<?php

require_once('MetaBox.php');
require_once('MediaAccess.php');

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

// global styles for the meta boxes
if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/library/css/metaboxes.css');


$mb_curso = new WPAlchemy_MetaBox(array
(
	'id' => 'curso-customMeta',
	'title' => 'Curso',
	'types' => array('curso'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => METAPATH . 'meta/curso-meta.php'
));

$mb_galeria = new WPAlchemy_MetaBox(array
(
	'id' => 'galeria-customMeta',
	'title' => 'Album',
	'types' => array('galeria'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => METAPATH . 'meta/album-meta.php'
));

/* eof */