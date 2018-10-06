<?PHP
include "header.php";
?>
<div class="cat-container">
<h1>Gestion des commandes (<a href='admin.php'>Retour</a>)</h1><br />
<?PHP
if (isset($msg)) {
	echo "<p>".$msg."</p>";
}
?>
<table>
<?PHP
$orders = mysqli_query($sql, "SELECT panier.id, panier.finished, users.email FROM panier LEFT JOIN users ON users.id = panier.id_user ORDER BY panier.finished, panier.id");
while ($data = mysqli_fetch_array($orders)) {
	?>
	<tr>
		<td>#<?php echo $data['id']; ?></td>
		<td><?php echo $data['email']; ?></td>
		<td><?php echo ($data['finished'] ? "Fini" : "En cours"); ?></td>
		<td><a href='admin_order.php?id=<?php echo $data['id']; ?>'>Voir la commande</a></td>
		<td><a href='admin_orders.php?valid_id=<?php echo $data['id']; ?>'><?php echo ($data['finished'] ? "Devalider" : "Valider"); ?></a></td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cette commande? Cette action est irreversible !');" href='admin_orders.php?del_id=<?php echo $data['id']; ?>'>Supprimer</a></td>
	</tr>
	<?PHP
} ?>
</table>
</div>
<?php
include "footer.php";
?>
