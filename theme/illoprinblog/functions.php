<?php

use Carbon_Fields\Carbon_Fields;

add_theme_support('post-thumbnails');
add_theme_support('title-tag');

require_once __DIR__ . "/inc/template-enqueue.php";

require_once __DIR__ . "/inc/pre-title.php";

require_once __DIR__ . "/inc/open-graph.php";

require_once __DIR__ . "/inc/meta-description.php";

function illoprinblog_load() {
	// Add portfolio case port type
	require_once __DIR__ . "/inc/case-cpt.php";

	// Add service port type
	require_once __DIR__ . "/inc/service-cpt.php";
	
	// load plugins
	require_once __DIR__ . "/vendor/autoload.php";
	
	// load carbon fields
	Carbon_Fields::boot();
}
add_action("after_setup_theme", "illoprinblog_load");