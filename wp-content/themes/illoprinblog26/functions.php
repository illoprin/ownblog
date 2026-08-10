<?

require_once get_template_directory() . '/inc/vendor.php';
require_once get_template_directory() . '/inc/helper.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/meta.php';
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/ajax-handlers.php';

if (getenv('ENV') === 'prod') {
  require_once get_template_directory() . '/inc/prod-defs.php';
}