<?
/* =========================================================
   SERVICES
   ========================================================= */


/* ======================= POST TYPE ======================= */
function lp_register_service_post_type() {

  $labels = [
    'name'                  => 'Услуги',
    'singular_name'         => 'Услуга',
    'add_new'               => 'Добавить услугу',
    'add_new_item'          => 'Добавить новую услугу',
    'edit_item'             => 'Редактировать услугу',
    'new_item'              => 'Новая услуга',
    'view_item'             => 'Просмотреть услугу',
    'search_items'          => 'Искать услуги',
    'not_found'             => 'Услуги не найдены',
    'menu_name'             => 'Услуги',
  ];

  $args = [
    'labels'             => $labels,
    'supports'           => ['title', 'editor', 'page-attributes'], // возможность сортировки
    'public'             => true,
    'has_archive'        => false, // отдельной страницы архива не нужно — выводим на лендинге
    'show_in_rest'       => true,  // включаем поддержку Gutenberg / REST API
    'menu_icon'          => 'dashicons-hammer', // иконка в админ-панели
    'menu_position'      => 5,
    'rewrite'            => ['slug' => 'service'],
    'capability_type'    => 'post',
  ];

  register_post_type('service', $args);
}
add_action('init', 'lp_register_service_post_type');

/* ======================= TAXONOMIES ======================= */

function lp_register_service_tag_taxonomy() {
  $labels = [
    'name'          => 'Теги услуг',
    'singular_name' => 'Тег',
    'search_items'  => 'Искать теги',
    'add_new_item'  => 'Добавить новый тег',
    'menu_name'     => 'Теги',
  ];

  $args = [
    'labels'            => $labels,
    'hierarchical'      => false, // false = как Tags, true = как Categories
    'public'            => true,
    'show_in_rest'      => true,
    'show_admin_column' => true, // показывать колонку тегов в списке услуг
  ];

  register_taxonomy('service_tag', ['service'], $args);
}
add_action('init', 'lp_register_service_tag_taxonomy');

/* ======================= META ======================= */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {

  Container::make('post_meta', 'Настройки услуги')
    ->where('post_type', '=', 'service')
    ->add_fields([

      Field::make('text', 'service_icon', 'Класс иконки')
        ->set_help_text('Например: bi bi-speedometer2 (Bootstrap Icons)'),

    ]);
});
