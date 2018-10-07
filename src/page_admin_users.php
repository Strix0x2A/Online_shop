<?PHP
include "header.php";
?>
<div class="cat-container">
<h1 class="tch">Gestion des utilisateurs (<a href='page_admin.php'>Retour</a>)</h1><br />
<table id='articles'>
<?PHP
$users = mysqli_query($sql, "SELECT * FROM users ORDER BY id");
while ($data = mysqli_fetch_array($users)) {
	?>
	<tr class="userList">
		<td>#<?php echo $data['id']; ?></td>
		<td><?php echo $data['email']; ?></td>
		<td><?php echo ($data['admin'] ? "Admin" : "User"); ?></td>
		<td><?php echo ($data['desactivated'] ? "Desactivé" : "Activé"); ?></td>
		<td><a href='page_admin_users.php?modif_id=<?php echo $data['id']; ?>'><?php echo ($data['admin'] ? "- Admin" : "+ Admin"); ?></a></td>
		<td><a onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur? Cette action est irreversible !');" href='page_admin_users.php?del_id=<?php echo $data['id']; ?>'>Supprimer</a></td>
		<td><a href='page_admin_users.php?activ_id=<?php echo $data['id']; ?>'><?php echo ($data['desactivated'] ? "Activer" : "Desactiver"); ?></a></td>
	</tr>
	<?PHP
} ?>
</table>
</div>
<?php
include "footer.php";
?>
