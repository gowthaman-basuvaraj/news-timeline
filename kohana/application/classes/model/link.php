<?php
class Model_Link extends basemodel {

    protected $_relations = array(
        'user'              => array('type' => 'belongs_to'),     
        'story'              => array('type' => 'belongs_to'),
        'comment'              => array('type' => 'belongs_to'),

    );
    protected $_fields = array(
        'title'             => array('type' => 'string'),
        'description'       => array('type' => 'string'),
        'url'               => array('type' => 'string'),
        'url_hash'          => array('type' => 'string'), //TODO prevent duplicate url submission
        'created'           => array('type' => 'int'),
        'updated'           => array('type' => 'int'),
        'dead'              => array('type' => 'boolean', 'default'  =>False),
        'reported_deadcount'=> array('type' => 'counter'),
        'readable_text'     =>array('type'=>'string'),
        'favicon'           =>array('type'=>'string'),
    );

    protected $_db = "news_links";

}
?>
