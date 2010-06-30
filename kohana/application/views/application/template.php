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
        <div class="container">                                                                                                
          <div class="span-24 last site-header">                          
            <div class="span-16">                        
              <h1>News</h1>                        
            </div>                        
            <div class="span-8 last"> <?= View::factory("application/links", array("logged_user" => $logged_user)); ?>        </div>                      
          </div>         
    
          <div class="site-content span-24">          
            <div class="site-messages span-16"><?php echo View::factory("application/messages", array("messages" => $messages)) ?></div>                                                                                                                                                                                                                                                                              
            <div class="left-content span-16"><?php echo $content ?></div>                                                                                                                                                                                                        
            <div class="right-content span-8 last">                                                                                                                                                                                                                       
              <h2>Welcome <?php echo $user->username ?></h2>
            </div>                                                                      
          </div>                                                                                                                                                                                                                                                                                                                                        
    
    
        </div>                                                                                                                                                                                                                                                                                                          
        <script type="text/javascript"><?php echo json_encode($form_errors) ?></script>                                              
       
  </body>
</html>