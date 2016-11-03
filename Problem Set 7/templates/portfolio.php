<table style="width:500px;margin-left:auto;margin-right:auto;">
    <tr>
        <td>Symbol</td>
        <td>Shares Owned</td>
        <td>Price per share</td>
        <td>Total value</td>
    </tr>
    <?php
        foreach ($positions as $position) {
            print("<tr>");
            print("<td>" . $position["symbol"] . "</td>");
            print("<td>" . $position["shares"] . "</td>");
            print("<td>$" . round($position["price"], 2) . "</td>");
            print("<td>$" . round($position["price"] * $position["shares"], 2) . "</td>");
            print("</tr>");
        }
        
        print("<br>");
        print("<p>Cash: $" . round($user["cash"], 2) . "</p>");
    ?>
</table>
<br><br>
<div>
    <a href="logout.php">Log Out</a>
</div>
