<? get_header() ?>

<!-- Content section -->
<main>
  <section class="container-lg glass-panel-nohover p-3 without-animation">
    <!-- Tags section -->
    <div class="d-flex gap-3 align-items-center blog-row" id="filter">
      <span class="fs-5 fw-bold">
        Рубрики
      </span>

      <div class="tag-wrapper">
        <label for="" class="tag-label">
          Всё
        </label>
        <input type="radio" name="case-tag" value="wordpress-site" class="tag-radio" data-tags="all">
      </div>

      <?php
      $categories = get_terms(['taxonomy' => 'case_category']);
      foreach ($categories as $cat):
      ?>
      <div class="tag-wrapper">
        <label for=<? echo $cat->slug ?> class="tag-label">
          <? echo $cat->name ?>
        </label>
        <input
          type="radio"
          name="case-tag"
          value=<? echo $cat->slug ?>
          class="tag-radio"
          data-tags=<? echo $cat->slug ?>
        >
      </div>
      <? endforeach; ?>

    </div>
    <!-- Cases -->
    <div class="mt-3 cases-grid" id="cases">

      <!-- Case -->
      <? while(have_posts()):
      the_post(); 
      $categories = get_the_terms(get_the_ID(), "case_category");
      $categories_slugs = $categories ? $categories[0]->slug : "";
      ?>
      <div
        class="glass-panel p-0"
        style="display: flex; flex-flow: column nowrap;"
        id="portfolio-item"
        data-tags=<? echo $categories_slugs ?>
      >
        <img
          class="portfolio-image"
          src="<? echo get_the_post_thumbnail_url() ?>"
          alt="case-image"
        >
        <div class="p-3 service-title">
          <? the_title() ?>
        </div>
        <div class="p-3 mt-auto">
          <button
            class="btn-glass"
            onclick="handleCaseDetailsButton('<? the_permalink() ?>')"
          >
            Подробнее
          </button>
        </div>
      </div>
      <? endwhile ?>



    </div>
  </section>
</main>

<script>
  const filtersRadio = document.querySelectorAll("#filter [data-tags]");
  const filterItems = document.querySelectorAll("#cases [data-tags]");

  // Hash filter
  const hashFilter = window.location.hash.slice(1);
  console.log(hashFilter);
  document.addEventListener("DOMContentLoaded", () => {
    filterItems.forEach(item => {
      const itemTag = item.getAttribute("data-tags");
      const visibility = itemTag === hashFilter || hashFilter === "" || hashFilter === "all"
      if (!visibility) {
        item.style.display = "none";
      }
    })
  })

  // Filter
  filtersRadio.forEach(radio => {
    filterItems.forEach(item => {
      const itemTag = item.getAttribute("data-tags");
      const radioTag = radio.getAttribute("data-tags");
      radio.addEventListener("click", () => {
        window.location.hash = radioTag;
        if (radioTag === itemTag || radioTag === "all") {
          item.style.display = "flex";
        } else {
          item.style.display = "none";
        }
      })
    })
  })

  function handleCaseDetailsButton(permalink) {
    window.location.href = permalink;
  }
</script>

<? get_footer() ?>