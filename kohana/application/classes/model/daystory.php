<?php
class Model_daystory extends basemodel {
    protected $_fields = array (
        'day'   =>  array('type'=>'int'),
        'news_count'    => array('type'=>'counter'),
        'stories'      => array('type' => 'has_many'),
        'comments'      => array('type' => 'has_many'),
    );
    protected $_db = "news_dayitems";
}
?>
