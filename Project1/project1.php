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
    </head>
    <body>
        <script type="text/javascript">
            function reply_click(clicked_id)
            {
                alert(clicked_id);
            }
        </script>
        <form method="get">
            Name Lookup: <input type="text" name="lookupTxt"> <br />
            
            Genre: <select name="genreTxt">
                <option value="">No Type</option>
                <option value="animation">Animation</option>
                <option value="fantasy">Fantasy</option>
                <option value="adventure">Adventure</option>
                <option value="horror">Horror</option>
            </select> <br />
            
            Studio: <select name="studioTxt">
                <option value="">No Type</option>
                <option value="Disney">Disney</option>
                <option value="Pixar">Pixar</option>
                <option value="Dreamworks">Dreamworks</option>
            </select> <br />
            <input type="hidden" name="studioTxt" value="">
            Show only if in stock:<input type="checkbox" name="studioTxt" value="1">
            <br />
            Sort By: <select name="sortTxt">
                <option value="name">Name</option>
                <option value="price">Price</option>
            </select>
            <br><input type="submit" value="Search">
        </form>
        
        <?php
        echo $_SESSION["buttClick"];
        //connecting to db
        $dbHost = getenv('IP');
        $dbPort = 3306;
        $dbName = getenv("sqldb");
        $username = getenv("sqluser");
        $password = getenv("sqlpw");
        
        $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        //$sql = " SELECT * FROM movie";
        $sql = "SELECT movie.name, movie.price, genre.name
                FROM ((movie_genre
                    INNER JOIN movie ON movie_genre.movie_id = movie.id) 
                    INNER JOIN genre ON movie_genre.genre_id = genre.id)";
        $AND = 0;
        
        //Prepares the sql statement
        if (($_SESSION["lookup"] != null) || ($_SESSION["genre"] != NULL) || ($_SESSION["studio"] != NULL)){
            $sql = $sql . " WHERE ";
            //echo "<br />" . $_SESSION["lookup"] . ", " . $_SESSION["genre"] . ", " . $_SESSION["studio"] . "<br />";
        }
        if ($_SESSION["lookup"] != null){
            $sql = $sql . " name = '" . $_SESSION["lookup"] ."'";
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
        echo "<br>".$sql."<br>";
        
        //executes sql statement
        echo "KEY: NAME, TYPE, AVAILABLE, PRICE <br />";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute ();
        
        echo "<form method='post'>";
        while ($row = $stmt -> fetch())  {
            echo  "<button id='" . $row['name'] . "' onClick='reply_click(this.id)'>Add: </button>" . $row['name'] . ", " . $row['type'] . ", " . $row['availability'] . ", $" . $row['price'] . "<br />";
            
        }
        echo "</form>";
        //session_unset();
        
        echo "<br /> <br />";
        ?>
        
    </body>
</html>