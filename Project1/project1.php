<?php

    // $userCart = array();
    // $userCart = $_SESSION["userCart"];
    session_start();
    
    if(isset($_GET["userCart"]))
        $_SESSION["myCart"] = $_GET["userCart"];
    
    if(isset($_GET["lookupTxt"]))
        $_SESSION["lookup"] = $_GET["lookupTxt"];
    if(isset($_GET["genreTxt"]))
        $_SESSION["genre"] = $_GET["genreTxt"];
    if(isset($_GET["studioTxt"]))
        $_SESSION["studio"] = $_GET["studioTxt"];
    if(isset($_GET["sortTxt"]))
        $_SESSION["sort"] = $_GET["sortTxt"];
    if(isset($_GET["priceTxt"]))
        $_SESSION["price"] = $_GET["priceTxt"];
        
    if($_GET["reset"]==1)
            unset($_SESSION["myCart"]);
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
                Name Lookup: <input type="text" list="options" name="lookupTxt" autocomplete="off"> <br />
                
                <datalist id="options">
                    <?php
                    $dbHost = getenv("db_host");
                    $dbPort = 3306;
                    $dbName = getenv("database");
                    $username = getenv("db_name");
                    $password = getenv("db_password");
                    
                    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
                    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql = "SELECT movie.name AS movie FROM movie";
                    $stmt = $dbConn -> prepare($sql);
                    $stmt -> execute ();
                    
                    while ($row = $stmt -> fetch())
                        echo "<option value='". $row['movie']."'>";
                    ?>
                </datalist>
                
                Genre: <select name="genreTxt">
                    <option value="">Any Genre</option>
                    <option value="animation">Animation</option>
                    <option value="adventure">Adventure</option>
                    <option value="sci-fi">Sci-Fi</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="mystery">Mystery</option>
                    <option value="action">Action</option>
                    <option value="romance">Romance</option>
                    <option value="drama">Drama</option>
                    <option value="thriller">Thriller</option>
                    <option value="comedy">Comedy</option>
                </select> <br />
                
                Studio: <select name="studioTxt">
                    <option value="">Any Studio</option>
                    <option value="Disney">Disney</option>
                    <option value="Pixar">Pixar</option>
                    <option value="Dreamworks">Dreamworks</option>
                    <option value="Studio Ghibli">Studio Ghibli</option>
                    <option value="Warner Brothers">Warner Brothers</option>
                </select> <br />
                
                Price: <select name="priceTxt">
                    <option value="">Any Price</option>
                    <option value="20">$20 or less</option>
                    <option value="15">$15 or less</option>
                    <option value="10">$10 or less</option>
                    <option value="5">$5 or less</option>
                </select> <br>
    
                Sort By: <select name="sortTxt">
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                </select>
                <br><input type="submit" value="Search" >
            </form>
        
        <?php
        //connecting to db
        $dbHost = getenv("db_host");
        $dbPort = 3306;
        $dbName = getenv("database");
        $username = getenv("db_name");
        $password = getenv("db_password");
        
        $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        //$sql = " SELECT * FROM movie";
        $sql = "SELECT movie.name AS name, genre.name AS genre, movie.price AS price, studio.name AS studio
                FROM((movie 
                    INNER JOIN genre ON movie.genre_id = genre.id)
                    INNER JOIN studio ON movie.studio_id = studio.id)";
        
        $AND = 0;

        //Prepares the sql statement
        if (($_SESSION["lookup"] != null) || ($_SESSION["genre"] != null) || ($_SESSION["studio"] != null) || ($_SESSION["price"] != null)){
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
        if ($_SESSION["price"] != null){
            if ($AND == 1){
                $sql = $sql . " AND ";
            }
            $sql = $sql . " movie.price <= '" . $_SESSION["price"] ."'";
            $AND = 1;
        }
        
        if ($_SESSION["sort"] == null){
            $_SESSION["sort"] = "name";
        }
            
        $sql = $sql . " ORDER BY movie." . $_SESSION["sort"];
        
        //TEMP: used to see what sql statement is
        //echo "<br>".$sql."<br>";
        
        //executes sql statement
        echo "<br />";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute ();
        
        $x = 0;
        $cartArrange = "";
        
        //print out shopping cart list
        echo "<br><div id='cartList'>";
        echo "<a>Shopping cart<br></a><br>";
            for($i=0; $i < sizeof($_SESSION['myCart']); $i++)
            {
                // print out the values in cart list
                echo "-".$_SESSION['myCart'][$i]."<br />";
            }  
        echo "<br>";
        
        echo "<a href='./project1.php?reset=1' style='color:red' > Delete Shopping List </a>";
        echo "</div><br><br>";
        
        //print out list of available movies based on sql select
        echo "<form id='list'>";
            while ($x < count($_SESSION["myCart"])){
                $cartArrange = $cartArrange . "&userCart[]=" . $_SESSION["myCart"][$x];
                ++$x;
            }
            
            while ($row = $stmt -> fetch())  {
                echo  "<a href='./itemInfo.php?itemName=" . $row['name'] . $cartArrange . "'>Info: </a>" . $row['name'] . ", " . $row['genre'] . ", " . $row['studio'] . ", $" . $row['price'] . "<br />";
                
            }
        echo "</form>";
        
        //session_unset();
        

        ?>
        
    </body>
</html>