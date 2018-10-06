<?PHP
function init_category($page, $sql) {
    if (isset($_GET['add'])) {
        $id_add = ceil($_GET['add']);
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
        if (isset($_SESSION['panier'][$id_add])) {
            $_SESSION['panier'][$id_add]++;
        } else {
            $_SESSION['panier'][$id_add] = 1;
        }
    }
}
?>