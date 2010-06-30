<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Story extends basemodel {

    protected $_relations = array(
        'user' => array('type' => 'belongs_to'),
        'daystory' => array('type' => 'belongs_to'),
        'story' => array('type' => 'belongs_to'),
    );
    protected $_fields = array(
        'title' => array('type' => 'string','required'=>TRUE),
        'items' => array('type' => 'has_many'),
        'comments' => array('type' => 'has_many'),
        'description' => array('type' => 'string'),
        'created' => array('type' => 'int'),
        'updated' => array('type' => 'int'),
        'items_count' => array('type' => 'counter'),
        'categories' => array('type' => 'set'),       
        'links' => array('type' => 'has_many'),
        'humanizeid' => array('type' => 'int'),
        'url_title' => array('type' => 'string'),
        'story_depth'     => array('type'=>'int', 'default'=>1),//allow only some levels
        'story_date'    => array('type'=>'int','required'=>TRUE, "default"=>-1), //date of the story 
        "hashtags" => array("type"=>"has_many"), //TODO:: 
        "story_image" => array("type"=>"string"),
        "local_cache" => array("type"=>"string"),
        
        "comments_count"  => array("type"=>"counter"),
         "followups_count"  => array("type"=>"counter"),
         "username"          =>array("type"=>"string"), //lets hold one copy of it
    );
    protected $_db = "news_news";

}
?>
