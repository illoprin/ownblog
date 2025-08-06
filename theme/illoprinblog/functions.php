<?php

use Carbon_Fields\Carbon_Fields;

add_theme_support('post-thumbnails');

require_once __DIR__ . "/inc/template-enqueue.php";

function illoprinblog_load() {
	// add custom post types
	require_once __DIR__ . "/inc/case-cpt.php";
	
	// load plugins
	require_once __DIR__ . "/vendor/autoload.php";
	
	// load carbon fields
	Carbon_Fields::boot();
}
add_action("after_setup_theme", "illoprinblog_load");