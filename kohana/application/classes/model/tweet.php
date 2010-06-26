<?php
class Model_tweet extends Mango {
  protected $_fields = array(
      "id"  => array("type"=>"string"),
      "profile_image_url" => array("type"=>"string"),
      "created_at" => array("type"=>"string"),
      "from_user" => array("type"=>"string"),
      "to_user_id" => array("type"=>"string"),
      "text" => array("type"=>"string"),
      "from_user_id" => array("type"=>"string"),
      "source" => array("type"=>"string"),
  );
  protected $_relations = array(
      "hashtag" =>"belongs_to",
  );
  
  protected $_db = "news_tweets";
}
?>
