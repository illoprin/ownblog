<?php

// register cases CPT
function register_service_card()
{
  $args = [
    'labels' => array(
      'name' => __( 'Услуги' ),
      'singular_name' => __( 'Услуга' )
    ),
    'public' => true,
    'label'  => "Услуги",
    'supports' => ['title', 'editor'],
    'public' => true,
    'rewrite' => ['slug' => 'service'],
    'menu_icon' => 'dashicons-admin-tools',
  ];
  register_post_type('service', $args);
}
add_action('init', 'register_service_card');