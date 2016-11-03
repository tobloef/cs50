<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // else render form
        render("quote_form.php", ["title" => "Get Qoute"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["symbol"])) {
            apologize("You must provide a stock symbol.");
        }
    
        $stock = lookup($_POST["symbol"]);
        if ($stock === false) {
            apologize("Stock symbol was invalid.");
        } else {
            render("quote_result.php", ["title" => "Qoute Result", "symbol" => $stock["symbol"], "name" => $stock["name"], "price" => $stock["price"]]);
        }
    }

?>
