<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
  <head profile="http://gmpg.org/xfn/11">
    <title><?php echo $title ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <?php foreach ($styles as $file => $type)
      echo HTML::style($file, array('media' => $type)), "\n" ?>
    <?php foreach ($scripts as $file)
        echo HTML::script($file), "\n" ?>
        <script type="text/javascript">                        
          $(document).ready(function(){                
            $.each($(".date-picker"), function(i,v){                
              $(v).datepicker({                
                dateFormat : "dd-mm-yy",                
                changeYear : true,                
                altField : "#"+$(v).attr("id").split("-")[0],        
                altFormat : "@"        
              });                 
            });                
          });          
          var base_url = "<?php echo Kohana::$base_url ?>";
        </script>                        
      </head>                        
      <body>                        
        <div class="site-header">                        
          <div class="site-header-menu">                        
            <ul class="menu-links">                        
              <li><?php echo HTML::anchor("welcome/index", "Home", array("class"=>"nav-a")); ?></li>
          <?php if (!$logged_user->is_loggedin) : ?>
            <li>
                <?php echo HTML::anchor("account/login", "Login", array("class"=>"nav-a")); ?>
               <div class="comment-reply-form-container quick-account-create-form hidden quick-form"> 
                      <?php echo View::factory("account/login");?> 
                  </div>
            </li>
  
            <li>
              <?php echo HTML::anchor("account/create", "Create", array("class"=>"nav-a")); ?>
              <div class="comment-reply-form-container quick-account-create-form hidden quick-form">  
              <?php echo View::factory("account/create");?> 
            </div>  
            </li>
            
            
          <?php else: ?>     
            <?php if($logged_user->is_moderator): ?>
             <li>
              <?php echo HTML::anchor("news/add", "Add News", array("class"=>"nav-a")); ?>
              <div class="comment-reply-form-container quick-news-add-form hidden quick-form">  
              <?php echo View::factory("news/add");?> 
            </div>  
            </li>
            <?php endif; ?>
              <li>
                  <?php echo HTML::anchor("account/logout", "Logout"); ?>
                 
              </li>
          <?php endif; ?>
            </ul>                        
          </div>                        
          <div class="site-messages">                        
        <?php if (is_array($messages)) : ?>
        <?php foreach ($messages as $message_type => $message_array) : ?>
                  <div class="messages-<?php echo $message_type ?>">
          
          <?php foreach ($message_array as $message_value) : ?>
                    <div class="message-item"><?php echo $message_value ?></div>
          <?php endforeach ?>
                  </div>                                                            
        <?php endforeach; ?>
            
        <?php endif; ?>
                  </div>                                                                        
                </div>                                                                        
            
            
            
                <div class="site-content">                        
                  <div class="left-content"> 
                    <div>
                      
                    </div>
        <?php echo $content ?>
                  </div>                        
                  <div class="right-content"> 
        <h2>Welcome <?php if($user) echo $user->username ?></h2>
        <ul>
        <?php if ($user && $user->is_moderator): ?>
                      <li><?php echo HTML::anchor("news/add", "Add News") ?></li>
        <?php endif; ?>
        </ul>
        <!--
        <?php foreach($user_saved as $si):?>
        <a href="<?php echo kohana::$base_url."index.php/news/view/$si"?>"><?php echo $si ?></a>
        <?php endforeach; ?>
        -->
                    </div>                            
              
                  </div>                              
              
              
              
                  <script type="text/javascript">                                                                              
<?php echo json_encode($form_errors) ?>
    </script>  
  </body>
</html>