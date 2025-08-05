<?php

// preconnect for google fonts
function add_google_fonts_preconnect()
{
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'add_google_fonts_preconnect', 1);

// Enqueue Google Fonts
function enqueue_google_fonts()
{
	wp_enqueue_style(
		'google-fonts-onest',
		'https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap',
		array(), // нет зависимостей
		null // версия не нужна (Google Fonts сам управляет кешированием)
	);
}

// Enqueue scripts and styles.
function illoprinblog_scripts()
{

	// Enqueue Bootstrap
	wp_enqueue_style('bootstrap', get_template_directory_uri() . "/vendor/bootstrap/bootstrap.min.css");
	wp_enqueue_script('bootstrap', get_template_directory_uri() . "/vendor/bootstrap/bootstrap.min.js", array(), "5.3", true);

	// Enqueue Google Fonts
	enqueue_google_fonts();

	// Enqueue Illoprin CSS
	wp_enqueue_style('variables', get_template_directory_uri() . "/style/variables.css");
	wp_enqueue_style('illoprin', get_template_directory_uri() . "/style/main.css");
	wp_enqueue_style('landing', get_template_directory_uri() . "/style/landing.css");
	wp_enqueue_style('not-found', get_template_directory_uri() . "/style/not-found.css");

	// Enqueue Illoprin JS
	wp_enqueue_script("header", get_template_directory_uri() . "/js/header.js", array(), "5.3", true);
}
add_action('wp_enqueue_scripts', 'illoprinblog_scripts');