<?

/* =========================================================
   PORTFOLIO
   ========================================================= */

/* ======================= POST TYPE ======================= */

function lp_register_portfolio_post_type() {

  $labels = [
    'name'          => 'Портфолио',
    'singular_name' => 'Проект',
    'add_new'       => 'Добавить проект',
    'add_new_item'  => 'Добавить новый проект',
    'edit_item'     => 'Редактировать проект',
    'view_item'     => 'Просмотреть проект',
    'search_items'  => 'Искать проекты',
    'not_found'     => 'Проекты не найдены',
    'menu_name'     => 'Портфолио',
  ];

  register_post_type('portfolio', [
    'labels'          => $labels,
    'public'          => true,
    'has_archive'     => true, // нужна страница каталога /portfolio/
    'show_in_rest'    => true,
    'menu_icon'       => 'dashicons-portfolio',
    'menu_position'   => 6,
    'supports'        => ['title', 'thumbnail', 'editor'],
    'rewrite'         => ['slug' => 'portfolio'],
  ]);
}
add_action('init', 'lp_register_portfolio_post_type');

/* ======================= TAXONOMIES (category) ======================= */

function lp_register_portfolio_category_taxonomy() {

  $labels = [
    'name'          => 'Категории проектов',
    'singular_name' => 'Категория',
    'menu_name'     => 'Категории',
  ];

  $args = [
    'labels'            => $labels,
    'hierarchical'      => true, // hierarchical = чекбоксы, как у Categories
    'public'            => true,
    'show_in_rest'      => true,
    'show_admin_column' => true,
    // Заменяем стандартный метабокс с чекбоксами на радио-кнопки
    // чтобы можно было выбрать ТОЛЬКО ОДНУ категорию
    'meta_box_cb'       => 'lp_single_term_radio_meta_box',
  ];

  register_taxonomy('portfolio_category', ['portfolio'], $args);
}
add_action('init', 'lp_register_portfolio_category_taxonomy');

function lp_single_term_radio_meta_box($post, $box) {

  $taxonomy = $box['args']['taxonomy'];
  $terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false]);
  $current_terms = wp_get_post_terms($post->ID, $taxonomy, ['fields' => 'ids']);
  $current_term_id = !empty($current_terms) ? $current_terms[0] : 0;

  wp_nonce_field('illoprin_save_' . $taxonomy, $taxonomy . '_nonce');

  echo '<div style="max-height: 200px; overflow-y: auto;">';

  foreach ($terms as $term) {
    printf(
      '<label style="display:block; margin-bottom:6px;">
              <input type="radio" name="%1$s" value="%2$d" %3$s>
              %4$s
          </label>',
      esc_attr($taxonomy),
      $term->term_id,
      checked($current_term_id, $term->term_id, false),
      esc_html($term->name)
    );
  }

  echo '</div>';
}

function lp_save_single_term($post_id, $taxonomy) {

  if (
    !isset($_POST[$taxonomy . '_nonce']) ||
    !wp_verify_nonce($_POST[$taxonomy . '_nonce'], 'illoprin_save_' . $taxonomy)
  ) {
    return;
  }

  if (isset($_POST[$taxonomy]) && !empty($_POST[$taxonomy])) {
    wp_set_post_terms($post_id, [(int) $_POST[$taxonomy]], $taxonomy);
  }
}

function lp_save_portfolio_category($post_id) {
  lp_save_single_term($post_id, 'portfolio_category');
}
add_action('save_post_portfolio', 'lp_save_portfolio_category');

/* ======================= TAXONOMIES (stack) ======================= */

function lp_register_portfolio_stack_taxonomy() {

  $labels = [
    'name'          => 'Технологии (стек)',
    'singular_name' => 'Технология',
    'menu_name'     => 'Стек',
  ];

  $args = [
    'labels'            => $labels,
    'hierarchical'      => false, // false = как Tags, с автодополнением
    'public'            => true,
    'show_in_rest'      => true,
    'show_admin_column' => true,
  ];

  register_taxonomy('portfolio_stack', ['portfolio'], $args);
}
add_action('init', 'lp_register_portfolio_stack_taxonomy');

/* ======================= CARBON FIELDS ======================= */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function lp_register_portfolio_custom_fields() {

  Container::make('post_meta', 'Детали проекта')
    ->where('post_type', '=', 'portfolio')
    ->add_fields([

      Field::make('rich_text', 'task', 'Задача')
        ->set_help_text('Можно использовать **жирный текст** и списки через панель редактора'),

      Field::make('rich_text', 'solution', 'Решение'),

      Field::make('media_gallery', 'media', 'Медиа-галерея')
        ->set_type(['image', 'video'])
        ->set_help_text('Первый элемент используется как обложка проекта'),

      Field::make('complex', 'stats', 'Статистика')
        ->add_fields([
          Field::make('text', 'stat_value', 'Показатель')
            ->set_help_text('Используй **текст** для выделения жирным')

        ])
        ->set_layout('tabbed-horizontal'),

      Field::make('checkbox', 'is_favourite', 'Избранный проект')
        ->set_help_text('Показывать в разделе "Избранное" на главной'),

    ]);
}
add_action('carbon_fields_register_fields','lp_register_portfolio_custom_fields');

function lp_custom_portfolio_archive_query($query) {
  // Проверяем, что это не админка
  // это главный запрос темы, и мы находимся на архиве portfolio
  if (!is_admin() && $query->is_main_query()
    && $query->is_post_type_archive('portfolio')) {
    $query->set('posts_per_page', -1);
  }
}
add_action('pre_get_posts', 'lp_custom_portfolio_archive_query');

// require_once get_template_directory() . '/inc/post-types/create-portfolio.php';