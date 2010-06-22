<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Comment extends basemodel {
    protected $_relations = array(
        'story'             => array('type' => 'belongs_to'),
        'user'              => array('type' => 'belongs_to'),
        'comment'           => array('type' =>  'belongs_to'), //reply_to
        'daystory'          => array('type' => 'belongs_to'),
    );

    protected $_fields = array(
        'title'             => array('type' =>  'string', 'required'=>TRUE),
        'url_title'         => array('type' =>  'string', 'required'=>TRUE),
        'comment_body'      => array('type' =>  'string'),        
        'likes'             => array('type' =>  'counter'),
        'dislikes'          => array('type' =>  'counter'),
        'moderated'         => array('type' =>  'boolean', 'default'=>FALSE),
        'removed'           => array('type' =>  'boolean','default'=>FALSE),
        'removed_by'        => array('type' =>  'enum', 'values'   => array('author','moderator')),
        'humanizeid'        => array('type' => 'int'),
        'links'             => array('type' =>  'has_many'),//TODO Later
        'files'             => array('type' =>  'has_many'),//TODO later
        'children_comments'             => array('type' =>  'array'),
    );

    protected $_db = "news_comments";
}
?>
