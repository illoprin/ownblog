<?

/* =========================================================
   Обработка заявки
   ========================================================= */

function handle_lead_form_submit() {
  check_ajax_referer('lead_form_nonce', 'nonce');

  // honeypot
  if (!empty($_POST['website'])) {
    wp_send_json_success(['message' => 'ok']);
  }

  // --------------------- validate fields ---------------------

  $name    = sanitize_text_field($_POST['name'] ?? '');
  $contact = sanitize_text_field($_POST['contact'] ?? '');
  $task    = sanitize_textarea_field($_POST['task'] ?? '');
  $consent = !empty($_POST['consent']);

  $errors = [];
  if (mb_strlen($name) < 3)    $errors[] = 'name';
  if (mb_strlen($contact) < 3) $errors[] = 'contact';
  if (mb_strlen($task) < 10)   $errors[] = 'task';
  if (!$consent)                $errors[] = 'consent';

  if (!empty($errors)) {
    wp_send_json_error(['errors' => $errors], 400);
  }

  // --------------------- create post ---------------------

  $post_id = wp_insert_post([
    'post_type'   => 'lead',
    'post_title'  => sprintf('%s — %s', $name, date('d.m.Y H:i')),
    'post_status' => 'publish',
    'post_content' => $task,
  ]);

  if (is_wp_error($post_id) || !$post_id) {
    wp_send_json_error(['message' => 'Ошибка сохранения, попробуйте позже'], 500);
  }

  // save carbon meta fields
  carbon_set_post_meta($post_id, 'contact', $contact);
  carbon_set_post_meta($post_id, 'lead_ip', $_SERVER['REMOTE_ADDR'] ?? '');

  wp_send_json_success(['message' => 'Заявка отправлена']);
}

add_action('wp_ajax_lead_form_submit', 'handle_lead_form_submit');
add_action('wp_ajax_nopriv_lead_form_submit', 'handle_lead_form_submit');
