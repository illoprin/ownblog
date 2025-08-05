<?php

use Carbon_Fields\Field;
use Carbon_Fields\Container;

// register cases CPT
function register_portfolio_case()
{
  $args = [
    'public' => true,
    'labels'  => [
      'name' => "Кейсы",
      'singular_name' => "Кейс",
      'archives' => "Портфолио"
    ],
    'supports' => ['title', 'editor', 'thumbnail'],
    'has_archive' => true,
    'public' => true,
    'rewrite' => ['slug' => 'portfolio'],
    'menu_icon' => 'dashicons-portfolio',
  ];
  register_post_type('portfolio_case', $args);
}
add_action('init', 'register_portfolio_case');

// add fields for cases
function register_case_fields()
{
  Container::make('post_meta', 'Данные кейса')
    ->where('post_type', '=', 'portfolio_case')
    ->add_fields([
      Field::make('complex', 'case_tech_stack', 'Стек технологий')
        ->add_fields([
          Field::make('text', 'tech_name', 'Технология'),
        ]),
      Field::make('media_gallery', 'case_gallery', 'Галерея'),
    ]);
}
add_action('carbon_fields_register_fields', 'register_case_fields');

// register cases rubric taxonomy
function register_case_category()
{
  $args = [
    'hierarchical' => true,
    'label' => 'Категории кейсов',
    'rewrite' => ['slug' => 'case-category'],
  ];
  register_taxonomy('case_category', 'portfolio_case', $args);
}
add_action('init', 'register_case_category');
