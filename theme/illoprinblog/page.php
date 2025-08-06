<?php get_header(); ?>

<main>
  <section class="container-lg">
    <?php
      // static wordpress content
      while (have_posts()) : the_post();
          the_content();
      endwhile;
    ?>
  </section>
</main>

<?php get_footer(); ?>