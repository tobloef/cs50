<?php

    require(__DIR__ . "/../includes/config.php");

    //Get parameters from the query string and trim whitespaces
    $parameters = array_map('trim', explode(",", urldecode($_GET["geo"])));

    //Remove the "US" parameter, since in this case all adresses are in the US
    if (($position = array_search("US", $parameters)) !== false) {
        unset($parameters[$position]);
    }
    
    //Make the SQL query
    $query = "SELECT * FROM places WHERE ";
    for ($i = 0, $parameterCount = count($parameters); $i < $parameterCount; $i++) {
        if (is_numeric($parameters[$i])) {
            $query = $query . "postal_code LIKE \"" . htmlspecialchars($parameters[$i], ENT_QUOTES) . "%\"";
        } else {
            $query = $query . "(place_name  LIKE \"" . htmlspecialchars($parameters[$i], ENT_QUOTES) . "%\" OR " . (strlen($parameters[$i]) <= 2 ? "admin_code1 LIKE \"" . htmlspecialchars($parameters[$i], ENT_QUOTES) . "%\" OR " : "") . "admin_name1 LIKE \"" . htmlspecialchars($parameters[$i], ENT_QUOTES) . "%\")";
        }
        if ($i < ($parameterCount - 1)) {
            $query = $query . " AND ";
        }
    }
    
    $places = query($query);
    
    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));
    
?>
