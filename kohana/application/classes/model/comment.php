<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Comment extends basemodel {
    protected $_relations = array(
        'story'  => array('type' => 'belongs_to'),
        'item'  => array('type' => 'belongs_to'),
        'user'  => array('type' => 'belongs_to'),
    );

    protected $_fields = array(
        'title'             => array('type' =>  'string', 'required'=>TRUE),
        'content'           => array('type' =>  'string'),
        'item'              => array('type' =>  'has_one'), //reply_to
        'likes'             => array('type' =>  'counter'),
        'dislikes'          => array('type' =>  'counter'),
        'moderated'         => array('type' =>  'boolean', 'default'=>FALSE),
        'removed'           => array('type' =>  'boolean','default'=>FALSE),
        'removed_by'        => array('type' =>  'enum', 'values'   => array('author','moderator')),
        'links'             => array('type' =>  'has_many'),
        'files'             => array('type' =>  'has_many'),
    );

    protected $_db = "news_comments";
}
?>
