<?PHP
include "const.php";
require_once "router.php";

session_start();
$sql = mysqli_connect($ip_addr.":".$port, 'root', 'root', $shop_name);
if (!$sql) {
	echo "Error : Unable to connect to MySQL." . PHP_EOL;
	exit ;
}

function get_page() {
	$page = explode("/", $_SERVER['PHP_SELF']);
	$page = explode(".php", $page[count($page) - 1]);
	return $page[0];
}

if (ft_logged()) {
	$user = mysqli_query($sql, "SELECT * FROM users WHERE id = ".$_SESSION['id']." LIMIT 1");
	if (mysqli_num_rows($user) == 0) {
		unset($_SESSION['id']);
		header("Location: index.php");
		exit;
	}
	$user = mysqli_fetch_array($user);
	if ($user['desactivated']) {
		unset($_SESSION['id']);
		header("Location: index.php");
		exit;
	}
	$user_id = ceil($user['id']);
}

$page = get_page();
if (array_key_exists($page, $page_funcs)) {
	$page_funcs[$page]($page, $sql);
}

function ft_logged() {
	return isset($_SESSION['id']);
}

function ft_admin() {
	global $user;
	return (ft_logged() && $user['admin'] == 1);
}

function crypt_mdp($mdp) {
	return hash("whirlpool", $mdp);
}

function ft_secure($str) {
	return str_replace('\\', '/', htmlentities(htmlspecialchars(trim($str)), ENT_QUOTES));
}
?>
