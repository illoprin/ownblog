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
              <img src="<? the_post_thumbnail_url() ?>" class="d-block w-100" alt=".case-media">
            </div>
            <!-- Other media -->
            <div class="carousel-item">
              <img src="https://placehold.co/600x400" class="d-block w-100" alt="case-media">
            </div>
            <div class="carousel-item">
              <img src="https://placehold.co/600x400" class="d-block w-100" alt="case-media">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#case_carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#case_carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
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
            <? foreach($tech_stack as $tech): ?>
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