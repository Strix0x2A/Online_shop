<?PHP
include "header.php";
?>
<div class="cat-container">
<h1>Gestion des categories (<a href='page_admin.php'>Retour</a>)</h1><br />
<?PHP
if (isset($msg)) {
	echo "<p>".$msg."</p>";
}
?>
<table>
<?PHP
$categories = mysqli_query($sql, "SELECT * FROM categories ORDER BY id");
while ($data = mysqli_fetch_array($categories)) {
	?>
	<tr>
		<td>#<?php echo $data['id']; ?></td>
		<td>
			<form method="post" action="page_admin_categories.php">
				<input type="text" name="id" value="<?php echo $data['id']; ?>" style="display:none;" />
				<input type="text" name="name" value="<?php echo $data['name']; ?>" />
				<input type="submit" name="modif" value="OK" />
			</form>
		</td>
		<td><a href='page_admin_articles.php?id=<?php echo $data['id']; ?>'>Gerer les articles</a></td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cette categorie? Cette action est irreversible !');"href='page_admin_categories.php?del_id=<?php echo $data['id']; ?>'>Supprimer</a></td>
	</tr>
	<?PHP
}
?>
</table>
<hr>
<h1>Ajouter une categorie</h1>
<form method="post" action="page_admin_categories.php">
	<table>
		<tr>
			<td>Nom de la categorie:</td>
			<td>
				<input type="text" name="name" />
				est une gamme: <input type="checkbox" name="is_gamme" value="true"/>
				<input type="submit" name="add" value="OK" />
			</td>
		</tr>
	</table>
</form>
<hr>
<h1>Ajouter un article</h1>
<form method="post" action="page_admin_categories.php">
	<table>
		<tr>
			<td>Type:</td>
			<td>
				<select name="cat_type"><?php
				$categories = mysqli_query($sql, "SELECT * FROM categories WHERE cat_type = '0' ORDER BY name");
				while ($data = mysqli_fetch_array($categories)) {
					echo "<option value='".$data['id']."'>".$data['name']."</option>";
				}
				?></select>
			</td>
		</tr>
		<tr>
			<td>Gamme:</td>
			<td>
				<select name="cat_gamme"><?php
				$categories = mysqli_query($sql, "SELECT * FROM categories WHERE cat_type = '1' ORDER BY name");
				while ($data = mysqli_fetch_array($categories)) {
					echo "<option value='".$data['id']."'>".$data['name']."</option>";
				}
				?></select>
			</td>
		</tr>
		<tr>
			<td>Nom:</td>
			<td><input type="text" name="name" /></td>
		</tr>
		<tr>
			<td>URL Photo:</td>
			<td><input type="text" name="photo" /></td>
		</tr>
		<tr>
			<td>Prix:</td>
			<td><input type="text" name="price" /></td>
		</tr>
	</table>
	<input class="center" type="submit" name="add2" value="Ajouter un article" />
</form>
</div>
<?PHP
include "footer.php";
?>
