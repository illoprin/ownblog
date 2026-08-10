<!-- ================= CONTACT ================= -->
<section id="contact" class="section">
  <div class="container">
    <header class="section-head section-center text-center reveal">
      <span class="badge badge-primary section-badge">
        Контакты
      </span>
      <h2 class="section-title font-alt">
        Готов обсудить
        <br>
        <span class="text-grad">ваш проект</span>
      </h2>
      <p class="section-sub">
        Отвечаю в течение дня. Оценка и консультация — бесплатно.
      </p>
    </header>

    <div class="row g-4 align-items-center">

      <!-- left: direct -->

      <div class="col-12 col-lg-5 reveal">
        <div class="glass panel h-100 d-flex flex-column">
          <span class="pill badge-success badge-success mb-3">
            <span class="dot"></span>
            Открыт для новых проектов!
          </span>
          <h3 class="panel-title font-alt fs-1 fw-bold">
            Давайте создадим
            <span class="text-grad">что-то крутое!</span>
          </h3>
          <p class="mb-5 mt-3 text-dim">
            Расскажите о своей задаче — отвечу в течение нескольких часов, предложу решение и примерные сроки.
          </p>

          <a class="contact-link" href="#" target="_blank" rel="noopener">
            <span class="cl-icon cl-icon--tg">
              <i class="bi bi-telegram"></i>
            </span>
            <span class="flex-grow-1">
              <b>Telegram</b>
              <small>@illoprin</small>
            </span>
            <i class="bi bi-arrow-up-right"></i>
          </a>

          <a class="contact-link" href="#" target="_blank" rel="noopener">
            <span class="cl-icon cl-icon--kw">
              <svg width="16" height="16" viewBox="0 0 24 25" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M7.73753 2.66698L7.77997 5.28525L5.1725 8.41361L2.56503 11.5418L2.52368 7.36918L2.48233 3.19641H1.24116H0V1.68658C0 0.85605 0.0478803 0.129469 0.106332 0.071582C0.164783 0.0138486 1.89626 -0.0148647 3.95388 0.00770665L7.69509 0.0487033L7.73753 2.66698Z" />
                <path
                  d="M22.7555 1.00837C22.3397 1.49388 20.3884 3.75685 18.4192 6.03701C13.3299 11.9306 13.4776 11.748 13.6156 11.9767C13.6828 12.0878 15.3129 14.1136 17.2379 16.4782C20.7875 20.8381 23.7211 24.4586 23.9875 24.8081C24.1034 24.9601 23.4405 25 20.7954 25H17.4571L15.6028 22.5816C11.1159 16.7295 9.89744 15.1738 9.80961 15.185C9.75815 15.1916 9.3137 15.6716 8.82215 16.2517L7.92827 17.3066V21.1534V25H5.20779H2.4873V21.4109V17.8217L9.64156 8.97359L16.7958 0.125477H20.1538H23.5117L22.7555 1.00837Z"
                  fill="#EAEAEA" />
              </svg>

            </span>
            <span class="flex-grow-1">
              <b>Kwork</b>
              <small>Заказать через безопасную сделку</small>
            </span>
            <i class="bi bi-arrow-up-right"></i>
          </a>

          <button class="contact-link" onclick="clipboardCopy('illoprin@gmail.com')">
            <span class="cl-icon cl-icon--ml">
              <i class="bi bi-envelope-fill"></i>
            </span>
            <span class="flex-grow-1">
              <b>E-mail</b>
              <small>illoprin@gmail.com</small>
            </span>
            <i class="bi bi-arrow-up-right"></i>
          </button>

          <div class="card-footer mt-5">
            <div class="pill p-0">
              <span class="dot"></span>
              Отвечаю в течение дня
            </div>
          </div>
        </div>
      </div>

      <!-- right: form -->
      <div class="col-12 col-lg-7 reveal">
        <div class="glass panel h-100">
          <h3 class="panel-title font-alt">Оставить заявку</h3>
          <p class="text-dim mb-4">
            Опишите задачу в двух словах — вернусь с планом и стоимостью.
          </p>

          <!-- form input -->
          <form name="lead" class="row g-3" novalidate>

            <!-- honeypot -->
            <div style="position:absolute; left:-9999px; top:-9999px;" aria-hidden="true">
              <label for="fWebsite">Website</label>
              <input type="text" name="website" id="fWebsite" tabindex="-1" autocomplete="off">
            </div>

            <!-- name -->
            <div class="col-12 col-md-6">
              <label class="form-label" for="fName">
                Имя
              </label>
              <input
                type="text"
                class="form-control"
                name="name"
                id="fName"
                placeholder="Как к вам обращаться"
                maxlength="64"
                required />
              <div class="invalid-feedback">Введите имя.</div>
            </div>

            <!-- contact -->
            <div class="col-12 col-md-6">
              <label class="form-label" for="fContact">
                Как с вами связаться?
              </label>
              <input type="text" class="form-control" name="contact" id="fContact"
                maxlength="64"
                placeholder="you@mail.com / +7 ... / @username " required />
              <div class="invalid-feedback">
                Укажите email, телефон или Telegram
              </div>
            </div>

            <!-- task description -->
            <div class="col-12">
              <label class="form-label" for="fTask">
                Описание задачи
              </label>
              <textarea class="form-control" name="task" rows="5" for="fTask"
                placeholder="Например: нужен интернет-магазин на WooCommerce с оплатой и выгрузкой из 1С" maxlength="512"
                required><?= $args['task'] ?? '' ?></textarea>
              <div class="invalid-feedback">
                Пара предложений о задаче — и Я всё пойму
              </div>
            </div>

            <!-- form bottom -->
            <div
              class="border-top mt-3 pt-3 col-12 d-flex flex-wrap align-items-center justify-content-between gap-3">

              <!-- consent -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="consent" id="fConsent">
                <label class="form-check-label" for="fConsent">
                  Согласен(на) с
                  <a href="privacy.html" class="link-primary" target="_blank" rel="noopener">
                    политикой конфиденциальности
                  </a>
                </label>
                <div class="invalid-feedback">Необходимо согласие.</div>
              </div>

              <!-- submit -->
              <button type="submit" class="btn btn-primary font-alt">
                Отправить заявку <i class="bi bi-send ms-1"></i>
              </button>

            </div>
          </form>

          <!-- success -->

          <div class="form-success glass mt-4 d-none" id="lead-success">
            <i class="bi bi-check-circle-fill text-success"></i>
            <span>Спасибо! Заявка отправлена — свяжусь с вами в ближайшее
              время.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  const leadFormData = {
    ajaxUrl: "<?= esc_url(admin_url('admin-ajax.php')) ?>",
    nonce: "<?= esc_attr(wp_create_nonce('lead_form_nonce')) ?>"
  };

  const initForm = () => {
    const form = document.forms.lead;
    if (!form) return;

    const fields = $$("input,textarea", form);
    const success = $("#lead-success");

    fields.forEach((f) =>
      f.addEventListener("input", () => {
        if (f.classList.contains("is-invalid"))
          f.classList.remove("is-invalid");
      })
    );

    // ------------- validate -----------------

    const validate = () => {
      let ok = true;
      if (form.name.value.length < 3) {
        ok = false;
        form.name.classList.add("is-invalid");
      }

      if (form.contact.value.length < 3) {
        ok = false;
        form.contact.classList.add("is-invalid");
      }

      if (form.task.value.length < 10) {
        ok = false;
        form.task.classList.add("is-invalid");
      }

      if (!form.consent.checked) {
        ok = false;
        form.consent.classList.add("is-invalid");
      }

      return ok;
    };

    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      if (!validate()) return;

      // ------------- spinner button -----------------
      const btn = $("button[type=submit]", form);
      const original = btn.innerHTML;
      btn.disabled = true;
      btn.innerHTML =
        '<span class="spinner-border spinner-border-sm me-2"></span>Отправляем…';

      // ------------- try send form -----------------

      try {
        const formData = new FormData(form);
        formData.append("action", "lead_form_submit");
        formData.append("nonce", leadFormData.nonce);

        const res = await fetch(leadFormData.ajaxUrl, {
          method: "POST",
          credentials: "same-origin",
          body: formData,
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
          // highlight fields
          if (data?.data?.errors) {
            data.data.errors.forEach((name) => {
              const el = form[name];
              if (el) el.classList.add("is-invalid");
            });
          } else {
            alert(data?.data?.message || "Ошибка отправки, попробуйте позже");
          }
          return;
        }

        // ------------- success -----------------
        form.reset();
        success.classList.remove("d-none");
        success.scrollIntoView({
          behavior: reduceMotion ? "auto" : "smooth",
          block: "center",
        });

        // success block disappearing
        setTimeout(() => success.classList.add("d-none"), 5000);
      } catch (err) {
        alert("Не удалось отправить форму. Проверьте соединение.");
        console.error(err);
      } finally {
        btn.disabled = false;
        btn.innerHTML = original;
      }
    });
  }
  document.addEventListener('DOMContentLoaded', () => {
    initForm();
  });
</script>