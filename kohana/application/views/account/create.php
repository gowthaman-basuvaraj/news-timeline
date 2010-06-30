<form name="create-account" action="<?php echo Kohana::$base_url."index.php/account/create"?>" method="POST">
    <div class="form-item">
        <div class="form-label required">User Name</div>
        <input placeholder="Desired username" class="form-text required" type="text" name="username" value="" />
    </div>

    <div class="form-item">
        <div class="form-label required">Password</div>
        <input placeholder="Desired password" class="form-text required" type="password" name="password"  />
    </div>
    <div class="form-item">
        <div class="form-label required">Verify Password</div>
        <input placeholder="Verify password" class="form-text required" type="password" name="repassword"  />
    </div>

     <div class="form-item">
        <div class="form-label">Email</div>
        <input  placeholder="EMail" class="form-text" type="email" name="email"  />
    </div>
    <div class="form-submit">
        <input type="submit" value="Create Account" class="submit_button"/>
    </div>
    
</form>
