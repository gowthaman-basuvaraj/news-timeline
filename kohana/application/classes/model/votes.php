<?php

class Model_Vote extends basemodel {

    protected $_fields = array(
        'type' => array('type' => 'enum', 'values' => array( "Like",  "Dislike")),
    );
    protected $_relations = array(
        'user' => array('type' => 'belongs_to'),
        'item' => array('type' => 'belongs_to'),
        'comment' => array('type' => 'belongs_to'),
        'story' => array('type' => 'belongs_to'),
    );
    protected $_db = "news_votes";

}
?>
