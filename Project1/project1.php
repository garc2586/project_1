<?php

    $userCart = array();
    $userCart = $_SESSION["userCart"];
    session_start();
    // function reply_click($itemID){
    //     array_push($userCart, $itemID);
    //     $_SESSION["userCart"] = $userCart;
    // }
    if(isset($_GET["lookupTxt"]))
        $_SESSION["lookup"] = $_GET["lookupTxt"];
    if(isset($_GET["genreTxt"]))
        $_SESSION["genre"] = $_GET["genreTxt"];
    if(isset($_GET["studioTxt"]))
        $_SESSION["studio"] = $_GET["studioTxt"];
    if(isset($_GET["sortTxt"]))
        $_SESSION["sort"] = $_GET["sortTxt"];
    if($_SESSION["buttClick"] == null)
        $_SESSION["buttClick"] = "none";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Project 1</title>
        <link href="/Project1/css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
            <h1 id="title">Online Movie Store</h1>
            <script type="text/javascript">
                function reply_click(clicked_id)
                {
                    alert(clicked_id);
                }
            </script>
            <form id="forms" method="get">
                Name Lookup: <input type="text" name="lookupTxt"> <br />
                
                Genre: <select name="genreTxt">
                    <option value="">No Type</option>
                    <option value="Animation">Animation</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Horror">Horror</option>
                </select> <br />
                
                Studio: <select name="studioTxt">
                    <option value="">No Type</option>
                    <option value="Disney">Disney</option>
                    <option value="Pixar">Pixar</option>
                    <option value="Dreamworks">Dreamworks</option>
                </select> <br />
    
                Sort By: <select name="sortTxt">
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                </select>
                <br><input type="submit" value="Search">
            </form>
        
        <?php
        echo "<br>".$_SESSION["buttClick"]."<br>";
        //connecting to db
        $dbHost = getenv('IP');
        $dbPort = 3306;
        $dbName = getenv("sqldb");
        $username = getenv("sqluser");
        $password = getenv("sqlpw");
        
        $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        //$sql = " SELECT * FROM movie";
        $sql = "SELECT movie.name AS name, genre.name AS genre, movie.price AS price, studio.name AS studio
                FROM((movie 
                    INNER JOIN genre ON movie.genre_id = genre.id)
                    INNER JOIN studio ON movie.studio_id = studio.id)";
        
        $AND = 0;

        //Prepares the sql statement
        if (($_SESSION["lookup"] != null) || ($_SESSION["genre"] != NULL) || ($_SESSION["studio"] != NULL)){
            $sql = $sql . " WHERE ";
            //echo "<br />" . $_SESSION["lookup"] . ", " . $_SESSION["genre"] . ", " . $_SESSION["studio"] . "<br />";
        }
        if ($_SESSION["lookup"] != null){
            $sql = $sql . " movie.name = '" . $_SESSION["lookup"] ."'";
            $AND = 1;
        }
        if ($_SESSION["genre"] != null){
            if ($AND == 1){
                $sql = $sql . " AND ";
            }
            $sql = $sql . " genre.name = '" . $_SESSION["genre"] ."'";
            $AND = 1;
        }
        if ($_SESSION["studio"] != null){
            if ($AND == 1){
                $sql = $sql . " AND ";
            }
            $sql = $sql . " studio.name = '" . $_SESSION["studio"] ."'";
            $AND = 1;
        }
        if ($_SESSION["sort"] == null)
            $_SESSION["sort"] = "name";
        $sql = $sql . " ORDER BY movie." . $_SESSION["sort"];
        
        //TEMP: used to see what sql statement is
        //echo "<br>".$sql."<br>";
        
        //executes sql statement
        echo "KEY: NAME, TYPE, AVAILABLE, PRICE <br />";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute ();
        
        echo "<form id='list' method='post'>";
        while ($row = $stmt -> fetch())  {
            echo  "<button id='" . $row['name'] . "' onClick='reply_click(this.id'>Info: </button>" . $row['name'] . ", " . $row['genre'] . ", " . $row['studio'] . ", $" . $row['price'] . "<br />";
            
        }
        echo "</form>";
        //session_unset();
        
        echo "<br /> <br />";
        ?>
        
    </body>
</html>