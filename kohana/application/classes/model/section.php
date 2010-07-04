<?php
class Model_section extends basemodel {
    protected $_fields = array(
        'title' => array('type'=>'string','unique'=>TRUE,'required'=>TRUE),
        'name'  => array('type'=>'string'),
        'description'=>array('type'=>'string'),
        'created'=>array('type'=>'int')
    );
    protected  $_relations = array(
        'user'  => array('type'=> 'belongs_to'),
    );
    protected $_db = "news_sections";
}
?>
