<?php

    $userCart = array();
    $userCart = $_SESSION["userCart"];
    session_start();
    // function reply_click($itemID){
    //     array_push($userCart, $itemID);
    //     $_SESSION["userCart"] = $userCart;
    // }
    if(isset($_GET["nameTxt"]))
        $_SESSION["userName"] = $_GET["nameTxt"];
    if(isset($_GET["typeTxt"]))
        $_SESSION["userType"] = $_GET["typeTxt"];
    if(isset($_GET["quantTxt"]))
        $_SESSION["userQuant"] = $_GET["quantTxt"];
    if(isset($_GET["sortTxt"]))
        $_SESSION["userOrder"] = $_GET["sortTxt"];
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
            Item Name: <input type="text" name="nameTxt"> <br />
            Item Type: <select name="typeTxt">
                <option value="">No Type</option>
                <option value="phone">Phones</option>
                <option value="laptop">Laptops</option>
                <option value="computer">Desktops</option>
                <option value="tablet">Tablets</option>
            </select> <br />
            <input type="hidden" name="quantTxt" value="">
            Show only if in stock:<input type="checkbox" name="quantTxt" value="1">
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

        
        $sql = " SELECT * FROM device";
        $AND = 0;
        
        //Prepares the sql statement
        if (($_SESSION["userName"] != null) || ($_SESSION["userType"] != NULL) || ($_SESSION["userQuant"] != NULL)){
            $sql = $sql . " WHERE ";
            //echo "<br />" . $_SESSION["userName"] . ", " . $_SESSION["userType"] . ", " . $_SESSION["userQuant"] . "<br />";
        }
        if ($_SESSION["userName"] != null){
            $sql = $sql . " name = '" . $_SESSION["userName"] ."'";
            $AND = 1;
        }
        if ($_SESSION["userType"] != null){
            if ($AND == 1){
                $sql = $sql . " AND ";
            }
            $sql = $sql . " type = '" . $_SESSION["userType"] ."'";
            $AND = 1;
        }
        if ($_SESSION["userQuant"] != null){
            if ($AND == 1){
                $sql = $sql . " AND ";
            }
            $sql = $sql . " availability = '" . $_SESSION["userQuant"] ."'";
            $AND = 1;
        }
        if ($_SESSION["userOrder"] == null)
            $_SESSION["userOrder"] = "name";
        $sql = $sql . " ORDER BY " . $_SESSION["userOrder"];
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