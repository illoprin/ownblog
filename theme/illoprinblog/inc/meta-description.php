<?php

function my_meta_description()
{
  if (is_front_page()) {
    $desc = "Илья — веб-разработчик. Создаю сайты и приложения на React, Node.js, WordPress и Go. Портфолио и контакты.";
  } elseif (is_post_type_archive('portfolio_case')) {
    $desc = "Портфолио веб-разработчика Ильи. Кейсы по React, Node.js, WordPress, Go и UI-дизайн. Реализованные проекты с фото и видео.";
  } elseif (is_singular('portfolio_case')) {
    global $post;
    $tech_stack = carbon_get_post_meta(get_the_ID($post), 'case_tech_stack');

    $tech_stack_str = "";
    foreach ($tech_stack as $tech) {
      $tech_stack_str .= " " . $tech["tech_name"];
    }

    $desc = "Кейс " . get_the_title($post) . " — проект, реализованный Ильёй, веб-разработчиком. Технологии:" . $tech_stack_str . ".";
  } else {
    $desc = get_bloginfo('description');
  }
  echo '<meta name="description" content="' . esc_attr($desc) . '">' . PHP_EOL;
}
add_action('wp_head', 'my_meta_description');
