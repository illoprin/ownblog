<?

add_action('admin_init', 'remove_default_twenty_themes');
function remove_default_twenty_themes() {
  $themes = ['twentytwentyfour', 'twentytwentythree', 'twentytwentyfive']; // Укажите папки тем
  foreach ($themes as $theme) {
    if (wp_get_theme($theme)->exists()) {
      delete_theme($theme);
    }
  }
}
