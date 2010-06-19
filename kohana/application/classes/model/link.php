<?php
class Model_Link extends Mango {

    protected $_relations = array(
        'user'              => array('type' => 'belongs_to'),
        'item'              => array('type' => 'belongs_to'),
        'news'              => array('type' => 'belongs_to'),

    );
    protected $_fields = array(
        'title'             => array('type' => 'string'),
        'description'       => array('type' => 'string'),
        'created'           => array('type' => 'int'),
        'updated'           => array('type' => 'int'),
        'dead'              => array('type' => 'boolean', 'default'  =>False),
        'reported_deadcount'=> array('type' => 'counter'),
    );

    protected $_db = "news_links";

}
?>
