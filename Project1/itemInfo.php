<?php
    $itemName = $_GET["itemName"];
    
    if(isset($_GET["userCart"]))
        $_SESSION["myCart"] = $_GET["userCart"];
        
    if(isset($_GET["nametest"]))
        $_SESSION["testnames"] = $_GET["nametest"];
    
    $dbHost = getenv('IP');
    $dbPort = 3306;
    $dbName = getenv("sqldb");
    $username = getenv("sqluser");
    $password = getenv("sqlpw");
    
    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $x = 0;
    $cartArrange = "";
    while ($x < count($_SESSION["myCart"])){
        $cartArrange = $cartArrange . "userCart[]=" . $_SESSION["myCart"][$x] . "&";
        ++$x;
    }





// begin the session
session_start();



?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $itemName; ?></title>
        <link href="/Project1/css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <div id='descTitle'>
            <?php echo $itemName . "<br>"; ?>
        </div>
        
        <?php
        // begin the session
        session_start();
        $sql = "SELECT movie.name AS name, genre.name AS genre, movie.price AS price, studio.name AS studio, movie.movie_desc AS description
        FROM((movie 
            INNER JOIN genre ON movie.genre_id = genre.id)
            INNER JOIN studio ON movie.studio_id = studio.id)
            WHERE movie.name = '" . $itemName . "'";
             
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute ();
        $row = $stmt -> fetch();
        
        echo "<div id='movieInfo'>Genre: " . $row['genre'] . "<br>Studio: " . $row['studio'] . "<br>Price: $" . $row['price'] . "<br><br>" . $row['description'];
                    
        
        echo  "</div><div id='links'><br><a href='./project1.php?" . $cartArrange . "userCart[]=" . $itemName . "'>ADD ITEM </a>";
        echo str_repeat('&nbsp;', 5);
        echo  "<a href='./project1.php?" . $cartArrange . "'> CANCEL</a><div>";
        ?>
        
    </body>
</html>