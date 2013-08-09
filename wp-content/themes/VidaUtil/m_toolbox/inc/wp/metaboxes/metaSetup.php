<?php

require_once('MetaBox.php');
require_once('MediaAccess.php');

// global styles for the meta boxes
if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/css/metaboxes.css');

$mb_agenda = new WPAlchemy_MetaBox(array(
	'id'       => 'agenda-customMeta',
	'title'    => 'Agenda',
	'types'    => array('agenda'), // added only for pages and to custom post type "events"
	'context'  => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => METAPATH . 'meta/agenda-meta.php'
));

/* eof */