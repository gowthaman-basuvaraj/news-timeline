<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Story extends basemodel {

    protected $_relations = array(
        'user' => array('type' => 'belongs_to'),
        'daystory' => array('type' => 'belongs_to'),
    );
    protected $_fields = array(
        'title' => array('type' => 'string'),
        'items' => array('type' => 'has_many'),
        'comments' => array('type' => 'has_many'),
        'description' => array('type' => 'string'),
        'created' => array('type' => 'int'),
        'updated' => array('type' => 'int'),
        'items_count' => array('type' => 'counter'),
        'categories' => array('type' => 'set'),
        'items' => array('type' => 'has_many'),
        'links' => array('type' => 'has_many'),
        'humanizeid' => array('type' => 'int'),
        'url_title' => array('type' => 'string'),
    );
    protected $_db = "news_news";

    public function check(array $data = NULL, $subject = 0) {
        
       
        return parent::check($data, $subject);
    }

}
?>
