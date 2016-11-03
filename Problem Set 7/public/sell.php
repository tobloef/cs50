<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
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
        
        render("sell_form.php", ["positions" => $positions, "title" => "Sell", "user" => $rows[0]]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["symbol"])) {
            apologize("You must provide a stock symbol.");
        } else if (empty($_POST["amount"])) {
            apologize("You must an amount to sell.");
        }
        
        $stock = lookup($_POST["symbol"]);
        
        if ($stock === false) {
            apologize("Stock symbol was invalid.");
        }
        
        $rows = query("SELECT shares FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], strtoupper($_POST["symbol"]));
        
        if (count($rows) > 0) {
            $shares = $rows[0]["shares"];
        } else {
            apologize("You do not have any shares with the symbol " .  strtoupper($_POST["symbol"]) . ".");
        }
        
        if ($shares < $_POST["amount"]) {
            apologize("You're trying to sell " . $_POST["amount"] . " shares of " . strtoupper($_POST["symbol"]) . ", but you only have " . $shares . ".");
        }
        
        if ($shares === $_POST["amount"]) {
            $query = query("DELETE FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], strtoupper($_POST["symbol"]));
        } else {
            $query = query("UPDATE shares SET shares = shares - ? WHERE id = ? AND symbol = ?", $_POST["amount"], $_SESSION["id"], strtoupper($_POST["symbol"]));
        }
        
        if ($query === false) {
            apologize("Error while updating shares.");
        }
        
        
        $value = $_POST["amount"] * $stock["price"];
        $query = query("UPDATE users SET cash = cash + ? WHERE id = ?", $value, $_SESSION["id"]);
        if ($query === false) {
            apologize("Error while updating cash.");
        }
        
        $query = query("INSERT INTO history (id, type, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], "SELL", strtoupper($stock["symbol"]), $_POST["amount"], $stock["price"]);   
        if ($query === false) {
            apologize("Error while adding transaction to history.");
        }
        
        redirect("/sell.php");
    }

?>
