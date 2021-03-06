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
        <input type="submit" value="Login" class="submit_button"/>
    </div>
    <hr />
    <div class="form-submit">
      <?php 
        $unique_tlogin = md5(uniqid(date("U")."", true));
        Session::instance()->set("unique_tlogin", $unique_tlogin);
      ?>
        <input type="submit" value="Throwaway Account" class="unimpressive submit_button mild modal-dialog" dialog="throwaway-confirm" type="link" 
               action="<?php echo Kohana::$base_url."index.php/account/login"?>"
               method="POST"
               data="tlogin_id=<?php echo $unique_tlogin?>" />
    </div>
    
</form>

<div id="throwaway-confirm" class="hidden" title="Important Information">
  <h4>By Creating a Throwaway Account, you Understand and Agree, 
    that any contribution you make will not be accounted for your activity</h4>
  <p>You'll be restricted to 3 Comments/Hr</p>
  <p>You'll be restricted to 1 Story post per day</p>
  <p>You Wont be able to share with your friends or Networks</p>
  <p>Also this Temporary Account will be deleted if <strong>Inactive</strong> for 1 Day</p>
  <p>The validity of this account is till the cookie expires or 1 Week which ever occurs first</p>
</div>