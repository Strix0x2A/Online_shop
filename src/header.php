<?PHP
include "init.php";
include "menu.php";
$root = dirname($_SERVER['PHP_SELF']);

function total_cart($sql) {
	$total_art = 0;
	$total_price = 0;
	if (!isset($_SESSION['panier']))
		return "";
	foreach($_SESSION['panier'] as $id_article => $nb_article) {
		$query = "SELECT * FROM articles WHERE id = ".$id_article." LIMIT 1";
		$return = mysqli_query($sql, $query);
		if (mysqli_num_rows($return) > 0) {
			$article = mysqli_fetch_array($return);
			$total_price += $article['price'] * $nb_article;
			$total_art += $nb_article;
		}
	}
	return "($total_art art. $total_price &euro;)";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=$shop_name?></title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/card.css">
	</head>
	<body>
	<header>
        <nav id="left-nav">
            <ul>
                <li class="cat"><a href="index.php"><?=$shop_name?></a>
                </li>
                <li class="cat"><a>Par type:</a>
                    <ul class="submenu">
						<?=get_types($sql)?>
                    </ul>
                </li>
                <li class="cat"><a>Par gamme:</a>
                    <ul class="submenu">
						<?=get_gammes($sql)?>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav id="right-nav">
			<ul>
				<li><a class="cat" href="page_cart.php">Panier<?=total_cart($sql)?></a></li>
				<?PHP if (ft_logged() === false ) { ?>
				<li><a class="cat" href="page_connexion.php">ACCOUNT</a></li>
				<?PHP } else { ?>
				<li class="cat">
				<a>ACCOUNT (<?= $user['email'] ?>)</a>
					<ul class="submenu">
						<?PHP if (ft_admin()) { ?>
						<li><a href="admin.php">ADMIN_PANEL</a></li>
						<?PHP } ?> 
						<li><a onclick="return confirm('Voulez-vous vraiment desactiver votre compte? Cette action est irreversible !');" href="connexion.php?desactivation=1">Desactiver ce compte</a></li>
						<li><a href="page_connexion.php?deconnexion=1">SIGN OUT</a></li>
					</ul>
				</li>
				<?PHP } ?>
			</ul>
        </nav>
    </header>