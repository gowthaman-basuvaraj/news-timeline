<?php
class Model_Hashtag extends Mango {
  protected $_fields = array(
      "hashtag" => array("type"=>"string", "unique"=>true),
      "last_id" => array("type"=>"string"),
      "tweets" => array("type"=>"has_many"),
      "stories" => array("type"=>"array"),
  );
  protected $_relations = array(
      
  );
  protected $_db = "news_hashtags";
}
?>
