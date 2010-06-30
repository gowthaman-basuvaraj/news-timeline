<?php foreach ($messages as $message_type => $message_array) : ?>
  <div class="messages-<?php echo $message_type ?>">  
  <?php foreach ($message_array as $message_value) : ?>
    <div class="message-item"><?php echo $message_value ?></div>
  <?php endforeach ?>
  </div>                                                                                                                                                                                                                              
<?php endforeach; ?>