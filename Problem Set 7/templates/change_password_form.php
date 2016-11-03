<form action="change_password.php" method="post">
    <fieldset>
        <div class="form-group">
            <input class="form-control" name="old_password" placeholder="Old password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="new_password" placeholder="New password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="confirm_password" placeholder="New password (again)" type="password"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Change Password</button>
        </div>
    </fieldset>
</form>
