<?PHP include "header.php"; ?>
<div class="cat-container">
<h1>Gestion des commandes (<a href='page_admin.php'>Retour</a>)</h1><br />
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
		<td><a href='page_admin_order_status.php?id=<?php echo $data['id']; ?>'>Voir la commande</a></td>
		<td><a href='page_admin_order_show.php?valid_id=<?php echo $data['id']; ?>'><?php echo ($data['finished'] ? "Invalider" : "Valider"); ?></a></td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cette commande? Cette action est irreversible !');" href='page_admin_order_show.php?del_id=<?php echo $data['id']; ?>'>Supprimer</a></td>
	</tr>
	<?PHP
} ?>
</table>
</div>
<?PHP include "footer.php"; ?>
