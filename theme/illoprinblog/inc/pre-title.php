<?php

add_filter('pre_get_document_title', function ($title) {
  if (is_front_page()) {
    return "Илья — веб-разработчик | Создание сайтов и веб-приложений";
  }
  if (is_post_type_archive('portfolio_case')) {
    return "Портфолио веб-разработчика — Илья | React, Go, Node.js, WordPress";
  }
  if (is_singular('portfolio_case')) {
    return "Кейс: " . get_the_title() . " — Портфолио Ильи, веб-разработчика";
  }
  return $title;
});
