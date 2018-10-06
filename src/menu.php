<?PHP 
function get_types($sql) {
	$type = 0;
	$categories = mysqli_query($sql, "SELECT id, name FROM categories WHERE cat_type = '$type' ORDER BY id");
	$types = array();
	if ($categories !== false) {
		while ($category = mysqli_fetch_array($categories)) {
			$types[] = "<li><a href='page_category.php?id=".$category['id']."'>".$category['name']."</a></li>";
		}
	}
	return implode("\n", $types);
}

function get_gammes($sql) {
	$gamme = 1;
	$categories = mysqli_query($sql, "SELECT id, name FROM categories WHERE cat_type = '$gamme' ORDER BY id");
	$gammes = array();
	if ($categories !== false) {
		while ($category = mysqli_fetch_array($categories)) {
			$gammes[] = "<li><a href='page_category.php?id=".$category['id']."'>".$category['name']."</a></li>";
		}
	}
	return implode("\n", $gammes);
}
?>