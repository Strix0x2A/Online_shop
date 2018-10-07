<?PHP

function page_admin_users($sql){
    if (isset($_GET['del_id'])) {
        $del_id = ceil($_GET['del_id']);
        mysqli_query($sql, "DELETE FROM users WHERE id = ".$del_id);
    }
    if (isset($_GET['modif_id'])) {
        $modif_id = ceil($_GET['modif_id']);
        $rights = mysqli_fetch_array(mysqli_query($sql, "SELECT admin FROM users WHERE id = ".$modif_id));
        if ($rights['admin'] == 0)
            $action = 1;
        else
            $action = 0;
        mysqli_query($sql, "UPDATE users SET admin = ".$action." WHERE id = ".$modif_id);
    }
    if (isset($_GET['activ_id'])) {
        $activ_id = ceil($_GET['activ_id']);
        $actif = mysqli_fetch_array(mysqli_query($sql, "SELECT desactivated FROM users WHERE id = ".$activ_id));
        if ($actif['desactivated'] == 0)
            $action = 1;
        else
            $action = 0;
        mysqli_query($sql, "UPDATE users SET desactivated = ".$action." WHERE id = ".$activ_id);
    }
}

function page_admin_articles($sql) {
    $id_category = ceil(@$_GET['id']);
    $return = mysqli_query($sql, "SELECT name FROM categories WHERE id = ".$id_category);
    if (mysqli_num_rows($return) == 0) {
        header("Location: page_admin_categories.php");
        exit;
    }
    $category = mysqli_fetch_assoc($return);
    if (isset($_GET['del_id'])) {
        $del_id = ceil($_GET['del_id']);
        mysqli_query($sql, "DELETE FROM articles WHERE id = ".$del_id);
    }
    if (isset($_POST['modif'])) {
        $modif_id = ceil(@$_POST['id']);
        $name = ft_secure(@$_POST['name']);
        $photo = ft_secure(@$_POST['photo']);
        $price = ceil(@$_POST['price']);
        if ($name == "") {
            $msg = "Le nom de l'article est vide";
        } else if ($photo == "") {
            $msg = "L'url de la photo est vide";
        } else if ($price < 1) {
            $msg = "Le prix ne peut pas etre inferieur a 1 euro.";
        } else {
            $return = mysqli_query($sql, "UPDATE articles SET name = '".$name."', photo = '".$photo."', price = ".$price." WHERE id = ".$modif_id);
        }
    }
    $_SESSION['category_id'] = $id_category;
    $_SESSION['category_name'] = $category['name'];
}

function page_admin_categories($sql) {
    if (isset($_GET['del_id'])) {
		$del_id = ceil($_GET['del_id']);
		if (!$articles = mysqli_query($sql, "SELECT * FROM articles WHERE gamme = ".$del_id))
			$articles = mysqli_query($sql, "SELECT * FROM articles WHERE type = ".$del_id);
		if (mysqli_num_rows($articles) > 0) {
            $msg = "Il y a encore des articles dans cette categorie, vous ne pouvez donc pas la supprimer";
		} else {
			mysqli_query($sql, "DELETE FROM categories WHERE id = ".$del_id);
		}
	}
	if (isset($_POST['modif'])) {
		$modif_id = ceil(@$_POST['id']);
		$name = ft_secure(@$_POST['name']);
		if ($name == "") {
			$msg = "Le nom de la categorie est vide";
		} else {
			$return = mysqli_query($sql, "UPDATE categories SET name = '".$name."' WHERE id = ".$modif_id);
		}
	}
	if (isset($_POST['add_cat'])) {
		$name = ft_secure(@$_POST['name']);
		if ($name == "") {
			$msg = "Le nom de la categorie est vide";
		} else {
			$cat = ($_POST['is_gamme'] == 'true') ? '1' : '0';
			$msg = "La categorie '".$name."' a bien ete ajoutee";
			$query = "INSERT INTO categories (name, cat_type)
						VALUES ('$name', ".$cat.")";
			mysqli_query($sql, $query);
		}
	}
	if (isset($_POST['add_prod'])) {
		$type = ceil (@$_POST['cat_type']);
		$gamme = ceil (@$_POST['cat_gamme']);
		$name = ft_secure(@$_POST['name']);
		$photo = ft_secure(@$_POST['photo']);
		$price = ceil(@$_POST['price']);
		if (mysqli_num_rows(mysqli_query($sql, "SELECT id FROM categories WHERE id = ".$type)) == 0) {
			$msg = "Ce type n'existe pas";
		} else if (mysqli_num_rows(mysqli_query($sql, "SELECT id FROM categories WHERE id = ".$gamme)) == 0) {
			$msg = "Cette gamme n'existe pas";
		} else if ($name == "") {
			$msg = "Le nom de l'article est vide";
		} else if ($photo == "") {
			$msg = "L'url de la photo est vide";
		} else if ($price < 1) {
			$msg = "Le prix ne peut pas etre inferieur a 1 euro.";
		} else {
			$query = "INSERT INTO articles (name, gamme, type, photo, price) VALUES ('$name', $gamme, $type, '$photo', $price)";
			$msg = "L'article '".$name."' a bien ete ajoutee dans $type/$gamme";
			mysqli_query($sql, $query);
        }
    }
    $_SESSION['msg_admin'] = $msg;
}

function page_admin_order_status($sql) {
    $id_commande = ceil(@$_GET['id']);
    $return = mysqli_query($sql, "SELECT * FROM panier WHERE id = ".$id_commande);
    if (mysqli_num_rows($return) == 0) {
        header("Location: page_admin_order_status.php");
        exit;
    }
    $commande = mysqli_fetch_assoc($return);
    $_SESSION['command_id'] = $id_commande;
    $_SESSION['content'] = unserialize($commande['content']);

}

function page_admin_order_show($sql) {
    if (isset($_GET['valid_id'])) {
        $valid_id = ceil($_GET['valid_id']);
        $var = mysqli_query($sql, "SELECT finished FROM panier WHERE id = ".$valid_id);
        $var = mysqli_fetch_array($var);
        if ($var['finished'] == 0) {
            $value = 1;
        } else {
            $value = 0;
        }
        mysqli_query($sql, "UPDATE panier SET finished = ".$value." WHERE id = ".$valid_id);

    }
    if (isset($_GET['del_id'])) {
        $del_id = ceil($_GET['del_id']);
        mysqli_query($sql, "DELETE FROM panier WHERE id = ".$del_id);
    }
}

function init_admin($page, $sql) {
    if (!ft_admin()) {
        header("Location: index.php");
        exit;
    }
    if ($page == "page_admin_users") {
        page_admin_users($sql);
    }
    if ($page == "page_admin_articles") {
        page_admin_articles($sql);
    }
    if ($page == "page_admin_categories") {
        page_admin_categories($sql);
    }
    if ($page == "page_admin_order_status") {
        page_admin_order_status($sql);
    }
    if ($page == "page_admin_order_show") {
        page_admin_order_show($sql);
    }
}
?>