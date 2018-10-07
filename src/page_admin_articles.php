<?PHP
include "header.php";
?>
<div class="container">
<h1>Gestion des articles dans "<?php echo $categorie['name']; ?>" (<a href='page_admin_categories.php'>Retour</a>)</h1><br />
<?PHP
if (isset($msg)) {
	echo "<p>".$msg."</p>";
}
?>
<table>
<?PHP
$articles = mysqli_query($sql, "SELECT * FROM articles WHERE type = ".$id_categorie." ORDER BY id");
while ($data = mysqli_fetch_array($articles)) {
	?>
	<tr>
		<td>#<?php echo $data['id']; ?></td>
		<td><img alt='<?php echo $data['name']; ?>' src='<?php echo $data['photo']; ?>' title='<?php echo $data['name']; ?>' /></td>
		<td>
			<form method="post" action="page_admin_articles.php?id=<?php echo $id_categorie; ?>">
				<input type="text" name="id" value="<?php echo $data['id']; ?>" style="display:none;" />
				Nom: <input type="text" name="name" value="<?php echo $data['name']; ?>" />
				<br />
				URL Photo: <input type="text" name="photo" value="<?php echo $data['photo']; ?>" />
				<br />
				Prix: <input type="text" name="price" value="<?php echo $data['price']; ?>" />
				<br />
				<input type="submit" name="modif" value="Valider les changements" />
			</form>
		</td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cet article? Cette action est irreversible !');" href='page_admin_articles.php?id=<?php echo $id_categorie; ?>&del_id=<?php echo $data['id']; ?>'>Supprimer</a></td>
	</tr>
	<?PHP
}
$articles = mysqli_query($sql, "SELECT * FROM articles WHERE gamme = ".$id_categorie." ORDER BY id");
while ($data = mysqli_fetch_array($articles)) {
	?>
	<tr>
		<td>#<?php echo $data['id']; ?></td>
		<td><img alt='<?php echo $data['name']; ?>' src='<?php echo $data['photo']; ?>' title='<?php echo $data['name']; ?>' /></td>
		<td>
			<form method="post" action="page_admin_articles.php?id=<?php echo $id_categorie; ?>">
				<input type="text" name="id" value="<?php echo $data['id']; ?>" style="display:none;" />
				Nom: <input type="text" name="name" value="<?php echo $data['name']; ?>" />
				<br />
				URL Photo: <input type="text" name="photo" value="<?php echo $data['photo']; ?>" />
				<br />
				Prix: <input type="text" name="price" value="<?php echo $data['price']; ?>" />
				<br />
				<input type="submit" name="modif" value="Valider les changements" />
			</form>
		</td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cet article? Cette action est irreversible !');" href='page_admin_articles.php?id=<?php echo $id_categorie; ?>&del_id=<?php echo $data['id']; ?>'>Supprimer</a></td>
	</tr>
	<?PHP
}
?>
</table>
</div>
<?PHP
include "footer.php";
?>
