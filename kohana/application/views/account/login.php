<form name="create-account" action="<?php echo Kohana::$base_url."index.php/account/login"?>" method="POST">
    <div class="form-item">
        <div class="form-label required">User Name</div>
        <input placeholder="Enter username" class="form-text" type="text" name="username" />
    </div>

    <div class="form-item">
        <div class="form-label required">Password</div>
        <input placeholder="Enter password" class="form-text" type="password" name="password"  />
    </div>
    
    <div class="form-submit">
        <input type="submit" value="Login" />
    </div>

</form>

