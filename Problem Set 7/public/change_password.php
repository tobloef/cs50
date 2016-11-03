<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("change_password_form.php", ["title" => "Change Password"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["old_password"])) {
            apologize("You must provide your old password.");
        }
        
        if (empty($_POST["new_password"])) {
            apologize("You must provide a new password.");
        }
        
        if (empty($_POST["confirm_password"])) {
            apologize("You must must confirm your new password.");
        }
        
        if ($_POST["new_password"] != $_POST["confirm_password"]) {
            apologize("Password confirmation did not match.");
        }

        // query database for user
        $row = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"])[0];

        // compare hash of user's input against hash that's in database
        if (crypt($_POST["old_password"], $row["hash"]) == $row["hash"]) {
            $query = query("UPDATE users SET hash = ? WHERE id = ?", crypt($_POST["new_password"]), $_SESSION["id"]);

            // redirect to portfolio
            redirect("/change_password.php");
        } else {
            apologize("Your old password was incorrect.");
        }
    }

?>
