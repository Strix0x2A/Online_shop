<?PHP
include "header.php";
?>
<div class="cat-container">
<h1>Commande #<?php echo $id_commande; ?> (<a href='admin_orders.php'>Retour</a>)</h1><br />
<div class="card-columns">
<?PHP
echo "<table>";
$total = 0;
foreach($content as $id_article => $nb_article) {
	$retour = mysqli_query($sql, "SELECT * FROM articles WHERE id = ".$id_article." LIMIT 1");
	if (mysqli_num_rows($retour) > 0) {
		$article = mysqli_fetch_array($retour);
		?>
		<div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= $article['photo']?>" alt="<?= $article['name']?>" height=18rem>
            <div class="card-body">
				<h5 class="card-title"><?= $article['name'] ?></h5>
				<p>Quantité: <?PHP echo $nb_article; ?></p>
                <p class="card-text"><?php echo $article['price'] * $nb_article; ?>&euro;</p>
            </div>
        </div>
		<?PHP
		$total += $article['price'] * $nb_article;
	}
}
?>
</div>
<h3>Total: <?PHP echo $total; ?>&euro;</h3>
</div>
<?PHP
include "footer.php";
?>