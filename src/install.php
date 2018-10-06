<?PHP
include "const.php";

$sql = mysqli_connect('192.168.99.100:3306', 'root', 'root'); 
if (!$sql)
    die("Connection Failed:".mysqli_connect_error());
    
mysqli_query($sql, "CREATE DATABASE IF NOT EXISTS $shop_name");
mysqli_query($sql, "USE $shop_name");

mysqli_query($sql, "CREATE TABLE panier
(
    id int(6) NOT NULL AUTO_INCREMENT,
    id_user int(6) NOT NULL,
    content text NOT NULL,
    finished int(6) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


mysqli_query($sql, "CREATE TABLE users
(
    id int(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    password text NOT NULL,
    admin bit NOT NULL,
    desactivated bit NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE categories (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `cat_type` bit NOT NULL,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1");

mysqli_query($sql, "CREATE TABLE articles (
	id int(11) NOT NULL AUTO_INCREMENT,
    gamme int(2) NOT NULL,
    type int(2) NOT NULL,
	name VARCHAR(255) NOT NULL UNIQUE,
	photo text NOT NULL,
	price int(11) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

function get_articles() {
    $content = file_get_contents("../data/obj.json");
    $data = json_decode($content, true);
    $root = dirname($_SERVER['PHP_SELF']);
    $articles = array();
    if ($data === NULL)
        echo("No decoding".PHP_EOL);
    foreach ($data as $info) {
        $articles[] = sprintf("('%s', %d, %d, '%s', %d)", $info["name"], $info["gamme"], $info["type"], $info["photo"], $info["price"]);
    }
    return $articles;
}

/*  INSERT CATEGORIES   */
$query_cat = "INSERT INTO categories (name, cat_type)
                VALUES ('Crayons graphite', 0),
                        ('Crayons de couleur', 0),
                        ('Crayons pastels', 0),
                        ('Feutres', 0),
                        ('Craie', 0),
                        ('Fusains', 0),
                        ('Accessoires dessin', 0),
                        ('Accessoires peinture', 0),
                        ('Albrecht D&uuml;rer', 1),
                        ('Albrecht D&uuml;rer Magnus', 1),
                        ('Pastel PITT', 1),
                        ('Pitt Monochrome', 1),
                        ('Polychromos', 1),
                        ('Castell 9000', 1),
                        ('Pitt Artist Pens', 1),
                        ('Equipement', 1)";
mysqli_query($sql, $query_cat);


/*  INSERT USERS    */
$query_su = "INSERT INTO users VALUES
                        (NULL, '$player1@student.42.fr', '06948D93CD1E0855EA37E75AD516A250D2D0772890B073808D831C438509190162C0D890B17001361820CFFC30D50F010C387E9DF943065AA8F4E92E63FF060C', 1, 0),
                        (NULL, '$player2@student.42.fr', '06948D93CD1E0855EA37E75AD516A250D2D0772890B073808D831C438509190162C0D890B17001361820CFFC30D50F010C387E9DF943065AA8F4E92E63FF060C', 1, 0)";
mysqli_query($sql, $query_su);


/*  INSERT ARTICLES */
$articles = get_articles();
$query_art = "INSERT INTO articles (name, gamme, type, photo, price) VALUES ".implode(", ", $articles);
mysqli_query($sql, $query_art);


echo "database ok";

?>