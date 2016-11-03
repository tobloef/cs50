<table style="width:500px;margin-left:auto;margin-right:auto;">
    <tr>
        <td>Transaction</td>
        <td>Date/Time</td>
        <td>Symbol</td>
        <td>Shares</td>
        <td>Price</td>
    </tr>
    <?php
        foreach ($entries as $entry) {
            print("<tr>");
            print("<td>" . $entry["type"] . "</td>");
            print("<td>" . $entry["date"] . "</td>");
            print("<td>" . $entry["symbol"] . "</td>");
            print("<td>" . $entry["shares"] . "</td>");
            print("<td>$" . round($entry["price"], 2) . "</td>");
            print("</tr>");
        }
    ?>
</table>
