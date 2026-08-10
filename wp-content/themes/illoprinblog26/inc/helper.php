<?

// --------------------- delete default themes ----------------------
function remove_default_twenty_themes() {
  $themes = ['twentytwentyfour', 'twentytwentythree', 'twentytwentyfive']; // Укажите папки тем
  foreach ($themes as $theme) {
    if (wp_get_theme($theme)->exists()) {
      delete_theme($theme);
    }
  }
}
add_action('admin_init', 'remove_default_twenty_themes');

// --------------------- split **strong** text ----------------------

/**
 * Разбивает строку вида "**+45%** конверсия в заявку" на части
 * @param string $text
 * @return array [строка_bold, остаток] или [весь_текст] если ** не найдено
 */
function lp_parse_case_stat(string $text): array {

  $text = trim($text);

  if (preg_match('/\*\*(.+?)\*\*/u', $text, $matches)) {
      $strong = trim($matches[1]);
      $rest   = trim(str_replace($matches[0], '', $text));

      return $rest !== '' ? [$strong, $rest] : [$strong];
  }

  return [$text];
}

