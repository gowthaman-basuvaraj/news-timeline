<ul>                                                                                                                
  <li class="menu-links"><?php echo HTML::anchor("", "Home", array("class" => "nav-a")); ?></li>
  <? if($logged_user->is_moderator): ?>
    <li class="menu-links"> <?php echo HTML::anchor("news/newsection", "Add Section", array("class" => "nav-a")); ?>
        <div class="comment-reply-form-container quick-section-add-form hidden quick-form"> <?php echo View::factory("application/newsection"); ?> </div>                           
    </li>
    
  <? endif; ?>
  <? if ($logged_user->is_loggedin) : ?>    
    <li class="menu-links">    <?php echo HTML::anchor("news/add", "Add News", array("class" => "nav-a")); ?>
      <div class="comment-reply-form-container quick-news-add-form hidden quick-form"> <?php echo View::factory("news/add"); ?> </div>                           
    </li>                              
    <li class="menu-links"><?php echo HTML::anchor("account/logout", "Logout"); ?></li>    
  <? else: ?>
      <li class="menu-links"> <?php echo HTML::anchor("account/login", "Login", array("class" => "nav-a login-link")); ?>
        <div class="comment-reply-form-container quick-account-create-form hidden quick-form"> <?php echo View::factory("account/login"); ?> </div>    
      </li>                
      <li class="menu-links"><?php echo HTML::anchor("account/create", "Create Account", array("class" => "nav-a")); ?>
        <div class="comment-reply-form-container quick-account-create-form hidden quick-form"><?php echo View::factory("account/create"); ?> </div>
      </li>        
  <? endif; ?>
</ul>   


