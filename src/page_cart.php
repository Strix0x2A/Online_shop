<?PHP 
include "header.php";

?>
<div class="cat-container">
	<h1>Panier</h1>
	<div class="card-columns">
	<?PHP
    if (!isset($_SESSION['panier']) || count($_SESSION['panier']) == 0) {
        echo "Votre panier est vide";
    } else {
        $total = 0;
        foreach($_SESSION['panier'] as $id_article => $nb_article) {
            $query = "SELECT * FROM articles WHERE id = ".$id_article." LIMIT 1";
            $return = mysqli_query($sql, $query);
            if (mysqli_num_rows($return) > 0) {
                $article = mysqli_fetch_array($return);
                ?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" 
                        src="<?=$article['photo']?>"
                        alt="<?=$article['name']?>"
                        height=18rem />
                    <div class="card-body">
                        <h5 class="card-title"><?=$article['name']?></h5>
                        <p>Quantité: <?=$nb_article?></p>
                        <a href="page_cart.php?add=<?=$id_article?>">+</a>
                        <a href="page_cart.php?remove=<?=$id_article?>">-</a>
                        <a href="page_cart.php?delete=<?=$id_article?>">x</a>
                        <p class="card-text"><?=$article['price'] * $nb_article?>&euro;</p>
                    </div>
                </div>
                <?PHP
                $total += $article['price'] * $nb_article;
            }
        }
	    if ($total > 0) {
    ?>
    </div>
	<h1>
		<p><?=$total?>&euro;</p>
	</h1>
<?PHP } ?>
	<a href='page_validate.php'>Valider mes achats</a>
<?PHP } ?>
</div>
<?PHP include "footer.php"; ?>