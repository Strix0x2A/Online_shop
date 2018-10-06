<?PHP
include "header.php";

function test($value) {
    if (isset($value))
        return "value='".$value. "'";
    return "";
}
?>

<div class="container">
    <form method="post" action="page_connexion.php" class="left-part">
        <table>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" placeholder="Email" <?=test($email)?> /></td>
            </tr>
            <tr>
                <td>Mot de passe</td>
                <td><input type="password" name="mdp" placeholder="****" /></td>
            </tr>
        </table>
        <input class="center" type="submit" name="connexion" value="Connexion" />
	</form>
	<form method="post" action="page_connexion.php" class="right-part">
		<table>
			<tr>
				<td>Email</td>
				<td><input type="text" name="email" placeholder="Email" <?=test($email)?> /></td>
			</tr>
			<tr>
				<td>Mot de passe</td>
				<td><input type="password" name="mdp" placeholder="****" <?=test($mdp)?> /></td>
			</tr>
			<tr>
				<td>Mot de passe</td>
				<td><input type="password" name="mdp_verif" placeholder="****" <?=test($mdp_verif)?> /></td>
			</tr>
		</table>
		<p><input class="center" type="submit" name="inscription" value="Inscription" /></p>
	</form>
</div>

<?PHP
if (isset($msg))
	echo "<p>".$msg ."</p>";
include "footer.php" 
?>