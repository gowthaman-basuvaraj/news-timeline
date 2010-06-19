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
class Model_User extends Mango {

    //put your code here
    protected $_fields = array(
        'username'              => array('type' => 'string', 'required' => TRUE, 'unique' => TRUE, 'min_length'=>3, "rules"=>array("not_empty"=>NULL)),
        'email'                 => array('type' => 'string', 'unique' => TRUE,),
        'password'              => array('type' => 'string', 'required' => TRUE,'min_length'=>8, "rules"=>array("not_empty"=>NULL)),
        'repassword'              => array('type' => 'string', 'required' => TRUE, 'local'=>TRUE),
        'email_verified'        => array('type' => 'boolean', 'default' => FALSE),

        'display_name'          => array('type' => 'string'),
        'open_ids'              => array('type' => 'array'),

        'is_moderator'          => array('type' => 'boolean', 'default'=>FALSE),
        
        'moderated_items_count' => array('type'=>'counter'),
        'likes'                 => array('type'=>'counter'),
        'dislikes'              => array('type'=>'counter'),
    );
    protected $_db = 'news_user';

}
?>
