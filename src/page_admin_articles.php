<?PHP
include "header.php";
?>
<div class="container">
<h1>Gestion des articles dans "<?PHP echo $_SESSION['category_name']; ?>" (<a href='page_admin_categories.php'>Retour</a>)</h1><br />
<?PHP
if (isset($msg)) {
	echo "<p>".$msg."</p>";
}
?>
<table>
<?PHP
$id_category = $_SESSION['category_id'];
$articles = mysqli_query($sql, "SELECT * FROM articles WHERE type = ".$id_category." ORDER BY id");
while ($data = mysqli_fetch_array($articles)) {
	?>
	<tr>
		<td>#<?PHP echo $data['id']; ?></td>
		<td><img alt='<?PHP echo $data['name']; ?>' src='<?PHP echo $data['photo']; ?>' title='<?PHP echo $data['name']; ?>' /></td>
		<td>
			<form method="post" action="page_admin_articles.php?id=<?PHP echo $id_category; ?>">
				<input type="text" name="id" value="<?PHP echo $data['id']; ?>" style="display:none;" />
				Nom: <input type="text" name="name" value="<?PHP echo $data['name']; ?>" />
				<br />
				URL Photo: <input type="text" name="photo" value="<?PHP echo $data['photo']; ?>" />
				<br />
				Prix: <input type="text" name="price" value="<?PHP echo $data['price']; ?>" />
				<br />
				<input type="submit" name="modif" value="Valider les changements" />
			</form>
		</td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cet article? Cette action est irreversible !');" href='page_admin_articles.php?id=<?PHP echo $id_category; ?>&del_id=<?PHP echo $data['id']; ?>'>Supprimer</a></td>
	</tr>
	<?PHP
}
$articles = mysqli_query($sql, "SELECT * FROM articles WHERE gamme = ".$id_category." ORDER BY id");
while ($data = mysqli_fetch_array($articles)) {
	?>
	<tr>
		<td>#<?PHP echo $data['id']; ?></td>
		<td><img alt='<?PHP echo $data['name']; ?>' src='<?PHP echo $data['photo']; ?>' title='<?PHP echo $data['name']; ?>' /></td>
		<td>
			<form method="post" action="page_admin_articles.php?id=<?PHP echo $id_category; ?>">
				<input type="text" name="id" value="<?PHP echo $data['id']; ?>" style="display:none;" />
				Nom: <input type="text" name="name" value="<?PHP echo $data['name']; ?>" />
				<br />
				URL Photo: <input type="text" name="photo" value="<?PHP echo $data['photo']; ?>" />
				<br />
				Prix: <input type="text" name="price" value="<?PHP echo $data['price']; ?>" />
				<br />
				<input type="submit" name="modif" value="Valider les changements" />
			</form>
		</td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cet article? Cette action est irreversible !');" href='page_admin_articles.php?id=<?PHP echo $id_category; ?>&del_id=<?PHP echo $data['id']; ?>'>Supprimer</a></td>
	</tr>
	<?PHP
}
?>
</table>
</div>
<?PHP
include "footer.php";
?>
