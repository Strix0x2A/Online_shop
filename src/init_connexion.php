<?PHP

function connexion($sql) {
    $email = ft_secure(@$_POST['email']);
    $mdp = ft_secure(@$_POST['mdp']);
    if ($email == "") {
        $msg = "Veuillez indiquer votre email";
    } else if ($mdp == "") {
        $msg = "Veuillez indiquer votre mot de passe";
    } else if (mysqli_num_rows(mysqli_query($sql, "SELECT id FROM users WHERE email = '".$email."' AND password = '".crypt_mdp($mdp)."' LIMIT 1")) < 1) {
        $msg = "Email ou mot de passe incorrect";
    } else if (mysqli_num_rows(mysqli_query($sql, "SELECT desactivated FROM users WHERE email = '".$email."' AND desactivated = 1 LIMIT 1")) > 0) {
        $msg = "Ce compte a ete desactive";
    } else {
        $retour = mysqli_query($sql, "SELECT id FROM users WHERE email = '".$email."' AND password = '".crypt_mdp($mdp)."' LIMIT 1");
        $id = mysqli_fetch_array($retour);
        $_SESSION['id'] = $id['id'];
        header("Location: index.php");
        exit;
    }
    $_SESSION['msg_co'] = $msg;
}

function inscription($sql) {
    $email = ft_secure(@$_POST['email']);
    $mdp = ft_secure(@$_POST['mdp']);
    $mdp_verif = ft_secure(@$_POST['mdp_verif']);
    if ($email == "") {
        $msg = "Veuillez indiquer votre email";
    } else if (strlen($email) > 100) {
        $msg = "Votre email est trop long";
    } else if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,3}$#i', $email)) {
        $msg = "Votre email est incorrect";
    } else if (mysqli_num_rows(mysqli_query($sql, "SELECT email FROM users WHERE email = '".$email."' LIMIT 1")) > 0) {
        $msg = "Cet email est deja utilise";
    } else if ($mdp == "" || $mdp_verif == "") {
        $msg = "Vous n'avez pas rempli les deux mots de passes";
    } else if (strlen($mdp) > 100) {
        $msg = "Votre mot de passe est trop long";
    } else if ($mdp != $mdp_verif) {
        $msg = "Les deux mots de passe ne sont pas identiques";
    } else {
        mysqli_query($sql, "INSERT INTO users VALUES (NULL, '".$email."', '".crypt_mdp($mdp)."', 0, 0)");
        header("Location: page_connexion.php");
        exit;
    }
    $_SESSION['msg_inscr'] = $msg;
}

function init_conn($page, $sql) {
    if (ft_logged()) {
        if (isset($_GET['deconnexion'])) {
            unset($_SESSION['id']);
            unset($_SESSION['panier']);
        } else if (isset($_GET['desactivation'])) {
            mysqli_query($sql, "UPDATE users SET desactivated = 1 WHERE id = ".$_SESSION['id']);
            unset($_SESSION['id']);
        }
        header("Location: index.php");
        exit;
    }
    if (isset($_POST['inscription'])) {
        inscription($sql);
    }
    if (isset($_POST['connexion'])) {
        connexion($sql);
    }
}

?>