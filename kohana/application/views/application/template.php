<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head profile="http://gmpg.org/xfn/11">
        <title><?php echo $title ?></title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <?php foreach ($styles as $file => $type)
            echo HTML::style($file, array('media' => $type)), "\n" ?>
        <?php foreach ($scripts as $file)
                echo HTML::script($file), "\n" ?>
                <script type="text/javascript">        
        
                </script>        
            </head>        
            <body>        
                <div class="site-header">        
                    <div class="site-header-menu">        
                        <ul class="menu-links">        
                    <?php if (Session::instance()->get("user", null) == null) : ?>
                        <li><?php echo HTML::anchor("account/login", "Login"); ?></li>
    
                        <li><?php echo HTML::anchor("account/create", "Create"); ?></li>
                    <?php else: ?>
                            <li><?php echo HTML::anchor("welcome/index", "Home"); ?></li>
                            <li><?php echo HTML::anchor("account/logout", "Logout"); ?></li>
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
                        
                        
                                <script type="text/javascript">                        
<?php echo json_encode($form_errors) ?>
                                </script>                        
                        
        <?php echo $content ?>
    </body>
</html>