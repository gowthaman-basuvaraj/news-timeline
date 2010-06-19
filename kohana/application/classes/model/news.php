<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_News extends Mango {

    protected $_relations = array(
        'user'              => array('type' => 'belongs_to'),
        
    );
    protected $_fields = array(
        'title'             => array('type' => 'string'),
        'items'             => array('type' => 'has_many'),
        'description'       => array('type' => 'string'),
        'created'           => array('type' =>'int'),
        'updated'           => array('type' => 'int'),
        'items_count'       => array('type' => 'counter'),
        'categories'        => array('type' => 'set'),
        'items'             => array('type' =>'has_many'),
    );

    protected $_db = "news_news";

}
?>
