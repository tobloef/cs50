<?php
    print("<br>");
    print("<p>Cash: " . $user["cash"] . "</p>");
?>
<form action="buy.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="symbol" placeholder="Symbol" type="text"/>
        </div>
        <div class="form-group">
            <input autofocus class="form-control" name="amount" placeholder="Amount" type="number" min="1"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Buy Stock</button>
        </div>
    </fieldset>
</form>
