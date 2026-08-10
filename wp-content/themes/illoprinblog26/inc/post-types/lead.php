<?

/* =========================================================
   LEAD (заявки из формы для связи)
   ========================================================= */

/* ======================= POST TYPE ======================= */

function lp_register_lead_post_type() {
  $labels = [
    'name'          => 'Заявки',
    'singular_name' => 'Заявка',
    'add_new_item'  => 'Добавить заявку',
    'edit_item'     => 'Просмотр заявки',
    'search_items'  => 'Искать заявки',
    'not_found'     => 'Заявок пока нет',
  ];

  register_post_type('lead', [
    'labels'              => $labels,
    'public'              => false,       // не показываем на сайте
    'show_ui'             => true,        // но показываем в админке
    'show_in_menu'        => true,
    'menu_icon'           => 'dashicons-email-alt',
    'menu_position'       => 25,
    'capability_type'     => 'post',
    'supports'            => ['title', 'editor'],   // заголовком сделаем имя+дату
    'has_archive'         => false,
    'exclude_from_search' => true,
    'show_in_rest'        => false,
  ]);
}
add_action('init', 'lp_register_lead_post_type');

/* ======================= CARBON FIELD  ======================= */

use Carbon_Fields\Container;
use Carbon_fields\Field;

function lp_lead_custom_fields() {
  Container::make('post_meta', 'Детали заявки')
    ->where('post_type', '=', 'lead')
      ->add_fields([
        Field::make( 'text', 'contact', 'Способ связи' ),
        Field::make( 'text', 'ip',      'IP пользователя' ),
      ]);
}

add_action('carbon_fields_register_fields', 'lp_lead_custom_fields');