<?php
get_header();

// get category
$categories = get_the_terms(get_the_ID(), "case_category");
$category = $categories ? $categories[0] : "";

// get tech stack
$tech_stack = carbon_get_post_meta(get_the_ID(), 'case_tech_stack');

// get gallery (image ids)
$case_gallery = carbon_get_post_meta(get_the_ID(), 'case_gallery');
?>

<!-- Content section -->
<main>
  <section class="container-lg glass-panel-nohover without-animation p-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<? echo get_post_type_archive_link("portfolio_case") ?>">Портфолио</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<? echo get_post_type_archive_link("portfolio_case") . "#" . $category->slug ?>"><? echo $category->name ?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <? the_title(); ?>
        </li>
      </ol>
    </nav>

    <div class="row">
      <div class="col-lg-7">
        <div id="case_carousel" class="carousel slide">
          <div class="carousel-inner">
            <!-- Post Thumbnail -->
            <div class="carousel-item active">
              <img src="<? the_post_thumbnail_url() ?>" class="d-block w-100" alt="case-media">
            </div>

            <!-- Other media -->
            <? foreach ($case_gallery as $media_id):
              $file_url = wp_get_attachment_url((int)$media_id);
              $mime_type = get_post_mime_type((int)$media_id);
            ?>
              <div class="carousel-item">
                <? if (strpos($mime_type, "image/") === 0): ?>
                  <img src="<? echo $file_url ?>" class="d-block w-100" alt="case-media">
                <? elseif (strpos($mime_type, "video/") === 0): ?>
                  <video controls class="case-media w-100">
                    <source src="<?php echo esc_url($file_url); ?>" type="<?php echo esc_attr($mime_type); ?>">
                  </video>
                <? endif ?>
              </div>
            <? endforeach ?>

          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#case_carousel" data-bs-slide="prev">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 8-4 4 4 4" />
            </svg>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#case_carousel" data-bs-slide="next">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4" />
            </svg>
          </button>
        </div>
      </div>
      <div class="col-lg-5">
        <article class="mt-3">
          <h2>
            <? the_title() ?>
          </h2>
          <p class="lh-lg m-0">
            <? the_content() ?>
          </p>
          <div class="d-flex gap-2 align-items-center mt-3 flex-wrap">
            <span class="fs-5 fw-bold">
              Стек:
            </span>
            <? foreach ($tech_stack as $tech): ?>
              <div class="case-badge rounded-5">
                <? echo $tech["tech_name"] ?>
              </div>
            <? endforeach ?>
          </div>
        </article>
      </div>

    </div>
  </section>
</main>



<?php get_footer(); ?>