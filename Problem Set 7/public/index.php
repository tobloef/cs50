<?php

    // configuration
    require("../includes/config.php"); 

    $rows = query("SELECT * FROM shares WHERE id = ?", $_SESSION["id"]);

    $positions = [];
    foreach ($rows as $row){
        $stock = lookup($row["symbol"]);
        if ($stock !== false) {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
        }
    }
    
    $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "user" => $rows[0]]);

?>
