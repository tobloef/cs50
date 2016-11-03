<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"])) {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"])) {
            apologize("You must confirm your password.");
        }
        if ($_POST["password"] != $_POST["confirmation"]) {
            apologize("Password confirmation did not match.");
        }
        
        if (query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"])) === false) {
            apologize("The username already exists.");
        }
        
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $_SESSION["id"] = $rows[0]["id"];
        redirect("/");
    }

?>
