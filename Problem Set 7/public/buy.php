<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        
        render("buy_form.php", ["title" => "Buy", "user" => $rows[0]]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["symbol"])) {
            apologize("You must provide a stock symbol.");
        }
        
        if (empty($_POST["amount"])) {
            apologize("You must an amount to buy.");
        }
        
        if (preg_match("/^\d+$/", $_POST["amount"]) === false) {
            apologize("The amount must be a positive integer.");
        }
        
        $stock = lookup($_POST["symbol"]);
        
        if ($stock === false) {
            apologize("Stock symbol was invalid.");
        }
        
        $price = $_POST["amount"] * $stock["price"];
        
        $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"])[0]["cash"];
        
        if ($cash < $price) {
            apologize("You cannot afford that.");
        }
        
        $query = query("UPDATE users SET cash = cash - ? WHERE id = ?", $price, $_SESSION["id"]);
        if ($query === false) {
            apologize("Error while updating cash.");
        }
        
        $update_shares = query("INSERT INTO shares (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], strtoupper($stock["symbol"]), ($_POST["amount"]));
        
        if ($update_shares === false) {
            apologize("Error while updating shares.");
        }
        
        $query = query("INSERT INTO history (id, type, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], "BUY", strtoupper($stock["symbol"]), $_POST["amount"], $stock["price"]);   
        if ($query === false) {
            apologize("Error while adding transaction to history.");
        }
        
        redirect("/buy.php");
    }

?>
