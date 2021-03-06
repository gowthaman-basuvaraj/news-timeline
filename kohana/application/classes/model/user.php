<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_User
 *
 * @author techie2go
 */
class Model_User extends basemodel {

    //put your code here
    protected $_fields = array(
        'username' => array('type' => 'string', 'required' => TRUE, 'unique' => TRUE, 'min_length' => 3, "rules" => array("not_empty" => NULL), "default"=>"Guest"),
        'email' => array('type' => 'string', 'unique' => TRUE,),
        'password' => array('type' => 'string', 'required' => TRUE, 'min_length' => 5, "rules" => array("not_empty" => NULL),  ),
        'repassword' => array('type' => 'string', 'required' => TRUE, 'local' => TRUE, 'min_length' => 5, "rules" => array("not_empty" => NULL)),
        'email_verified' => array('type' => 'boolean', 'default' => FALSE),
        'display_name' => array('type' => 'string'),
        'open_ids' => array('type' => 'array'),
        'is_moderator' => array('type' => 'boolean', 'default' => FALSE),
        'moderated_comments_count' => array('type' => 'counter'),
        'likes' => array('type' => 'counter'),
        'dislikes' => array('type' => 'counter'),
        'stories' => array('type'=>'has_many'),
        'comments' => array('type'=>'has_many'),
        'links' => array('type'=>'has_many'),
        'throwaway_account'=>array("type"=>'boolean', 'default'=>FALSE),
        "is_loggedin"=>array("type"=>"boolean", "default"=>false),
       
    );
    protected $_db = 'news_users';

   
}
?>
