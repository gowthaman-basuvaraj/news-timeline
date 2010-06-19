<?php
class Model_Vote extends Mango {
    protected $_fields = array(
        'type'              => array('type'=>'enum', 'values'=>array("1"=>"Like", "2"=>"dislike")),
    );
    protected $_relations = array(
        'user'              => array('type' => 'belongs_to'),
        'item'              => array('type' => 'belongs_to'),
        'news'              => array('type' => 'belongs_to'),
    );
    protected $_db  = "news_votes";
}
?>
