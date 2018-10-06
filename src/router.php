<?PHP

require_once "init_admin.php";
require_once "init_cart.php";
require_once "init_category.php";
require_once "init_connexion.php";

$page_funcs = array();

$page_funcs['page_cart'] = 'init_cart';
$page_funcs['page_validate'] = 'init_validate';
$page_funcs['page_connexion'] = 'init_conn';
$page_funcs['admin'] = 'init_admin';
$page_funcs['admin_users'] = 'init_admin';
$page_funcs['admin_articles'] = 'init_admin';
$page_funcs['admin_categories'] = 'init_admin';
$page_funcs['admin_order_show'] = 'init_admin';
$page_funcs['admin_order_status'] = 'init_admin';
$page_funcs['category'] = 'init_category';


?>