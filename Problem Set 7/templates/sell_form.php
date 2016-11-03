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
        print("<p>Cash: " . $user["cash"] . "</p>");
    ?>
</table>
<br><br>
<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="symbol" placeholder="Symbol" type="text"/>
        </div>
        <div class="form-group">
            <input autofocus class="form-control" name="amount" placeholder="Amount" type="number" min="1"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell Stock</button>
        </div>
    </fieldset>
</form>
