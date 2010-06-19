<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_Item extends Mango {
    protected $_relations = array(
        'news'  => array('type' => 'belongs_to'),
        'user'  => array('type' => 'belongs_to'),
    );

    protected $_fields = array(
        'title'             => array('type' =>  'string', 'required'=>TRUE),
        'content'           => array('type' =>  'string'),
        'in_reply_to'       => array('type' =>  'string'), //item id ...
        'likes'             => array('type' =>  'counter'),
        'dislikes'          => array('type' =>  'counter'),
        'moderated'         => array('type' =>  'boolean', 'default'=>FALSE),
        'removed'           => array('type' =>  'boolean','default'=>FALSE),
        'removed_by'        => array('type' =>  'enum', 'values'   => array('author','moderator')),
        'links'             => array('type' =>  'has_many'),
        'files'             => array('type' =>  'has_many'),
    );

    protected $_db = "news_items";
}
?>
