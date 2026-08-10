<?

$favourite_portfolio = new WP_Query([
  'post_type'      => 'portfolio',
  'post_status'    => 'publish',
  'posts_per_page' => 3,
  'meta_query' => [
    [
      'key'     => 'is_favourite',
      'value'   => 'yes',
    ],
  ],
  'orderby' => 'date',
  'order'   => 'DESC',
]);


if ($favourite_portfolio->have_posts()) {
  while ($favourite_portfolio->have_posts()) {
    $favourite_portfolio->the_post();

    $post_id = get_the_ID();

    // category
    $categories = get_the_terms( $post_id, 'portfolio_category');
    $category_name = '';
    $category_slug = '';
    if (!empty($categories) && !is_wp_error($categories)) {
      $category_name = $categories[0]->name;
      $category_slug = $categories[0]->slug;
    }

    // stack
    $stack = get_the_terms( $post_id, 'portfolio_stack');

    // media 
    $media = carbon_get_post_meta(
      $post_id,
      'media'
    );
    $image_url = '';
    $image_alt = get_the_title($post_id);
    if (!empty($media) && is_array($media)) {
      $image_id = (int) $media[0];
      $image_url = wp_get_attachment_image_url( $image_id, 'large');
      $attachment_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
      if (!empty($attachment_alt)) {
        $image_alt = $attachment_alt;
      }
    }

    // stats
    $stats = carbon_get_post_meta( $post_id, 'stats');

    get_template_part( 'template-parts/portfolio/portfolio-item', null,
      [
        'tilt'           => true,
        'post_id'        => $post_id,
        'category_name'  => $category_name,
        'category_slug'  => $category_slug,
        'title'          => get_the_title($post_id),
        'desc'           => get_post_field('post_content', $post_id),
        'image_url'      => $image_url,
        'image_alt'      => $image_alt,
        'stack'          => $stack,
        'stats'          => $stats,
      ]
    );
  }
  wp_reset_postdata();
}
