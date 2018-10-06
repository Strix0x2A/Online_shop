<?PHP
include "header.php";
if (!isset($_GET['id'])) {
    header("Location: page_products.php");
    exit;
}
$id = ceil($_GET['id']);
$query = "SELECT name FROM categories WHERE id = ".$id." LIMIT 1";
$category = mysqli_query($sql, $query);
if (mysqli_num_rows($category) == 1) {
    $name = mysqli_fetch_array($category);
    $name = $name['name'];
    $content = page_cat($sql, 'gamme', $id).page_cat($sql, 'type', $id);
} else {
    $content = "<p style=\"text-transform: uppercase;\">Cette categorie est introuvable.</p>";
}

function name($name) {
    if ($name)
        return "<h1>$name</h1>";
}

function page_cat($sql, $cat, $id) {
    $query = "SELECT * FROM articles WHERE ".$cat." = ".$id." ORDER BY id";
    $articles = mysqli_query($sql, $query);
    $return = "";
	while ($article = mysqli_fetch_array($articles)) {
        $return .= "<div class=\"card\" style=\"width: 18rem;\">
            <img class=\"card-img-top\" src=\"".$article['photo']."\" alt=\"".$article['name']."\" height=18rem>
            <div class=\"card-body\">
                <h5 class=\"card-title\">".$article['name']."</h5>
                <p class=\"card-text\">".$article['price']."&euro;</p>
                <a href=\"page_cart.php?add=".$article['id']."\">+</a>
            </div>
        </div>";
    }
    return $return;
}
?>
<div class="cat-container">
    <?=name($name)?>
    <div class="card-columns">
        <?=$content?>
    </div>
</div>
<?PHP include "footer.php"; ?>
