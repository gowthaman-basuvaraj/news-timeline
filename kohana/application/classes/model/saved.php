<?php
class Model_saved extends Mango {
  protected $_fields = array(
      "saved_at"=> array("type"=>"int"),
      "story_urltitle" => array("type"=>"string"),
  );
  protected $_relations = array(
      "user"  => array("type"=>"belongs_to"),
      
  );
  protected $_db = "news_user_saved_items";
}
?>
