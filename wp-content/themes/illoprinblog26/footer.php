<?
get_template_part('/template-parts/toast');
wp_footer()
?>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-inner d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
      <span class="font-alt fs-5">illoprin<span class="text-accent">.</span></span>
      <span class="text-mute small">© 2026 illoprin. Илья — веб-разработчик. От идеи к реализации!</span>
      <div class="d-flex gap-2">
        <a class="soc" href="https://t.me/illoprin" target="_blank" rel="noopener" aria-label="Telegram"><i
            class="bi bi-telegram"></i></a>
        <a class="soc" href="https://github.com/illoprin" target="_blank" rel="noopener" aria-label="GitHub"><i class="bi bi-github"></i></a>
        <button class="soc" href="" aria-label="E-mail" onclick="clipboardCopy('<?= get_option('admin_email') ?>')"><i
            class="bi bi-envelope-fill"></i></button>

        <a class="soc" href="https://kwork.ru/user/illoprin" target="_blank" rel="noopener" aria-label="Kwork">
          <svg width="13" height="13" viewBox="0 0 24 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M7.73753 2.66698L7.77997 5.28525L5.1725 8.41361L2.56503 11.5418L2.52368 7.36918L2.48233 3.19641H1.24116H0V1.68658C0 0.85605 0.0478803 0.129469 0.106332 0.071582C0.164783 0.0138486 1.89626 -0.0148647 3.95388 0.00770665L7.69509 0.0487033L7.73753 2.66698Z" />
            <path
              d="M22.7555 1.00837C22.3397 1.49388 20.3884 3.75685 18.4192 6.03701C13.3299 11.9306 13.4776 11.748 13.6156 11.9767C13.6828 12.0878 15.3129 14.1136 17.2379 16.4782C20.7875 20.8381 23.7211 24.4586 23.9875 24.8081C24.1034 24.9601 23.4405 25 20.7954 25H17.4571L15.6028 22.5816C11.1159 16.7295 9.89744 15.1738 9.80961 15.185C9.75815 15.1916 9.3137 15.6716 8.82215 16.2517L7.92827 17.3066V21.1534V25H5.20779H2.4873V21.4109V17.8217L9.64156 8.97359L16.7958 0.125477H20.1538H23.5117L22.7555 1.00837Z" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</footer>

</body>

</html>