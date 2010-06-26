<?php
class Model_Hashtag extends Mango {
  protected $_fields = array(
      "hashtag" => array("type"=>"string", "unique"=>true),
      "last_id" => array("type"=>"string"),
      "tweets" => array("type"=>"hasmany"),
  );
  protected $_db = "news_hashtags";
}
?>
