<?php

    // configuration
    require("../includes/config.php"); 

    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);

    $entries = [];
    foreach ($rows as $row){
        $stock = lookup($row["symbol"]);
        if ($stock !== false) {
            $entries[] = [
                "type" => $row["type"],
                "date" => $row["date"],
                "symbol" => $stock["symbol"],
                "shares" => $row["shares"],
                "price" => $stock["price"]
            ];
        }
    }
    
    render("history_results.php", ["entries" => $entries, "title" => "History"]);

?>
