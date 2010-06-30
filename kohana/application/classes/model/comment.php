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
        'vote_count'        =>array('type'=>'int'), //an algo to decide the vote count
        'moderated'         => array('type' =>  'boolean', 'default'=>FALSE),
        'removed'           => array('type' =>  'boolean','default'=>FALSE),
        'removed_by'        => array('type' =>  'enum', 'values'   => array('author','moderator')),
        'humanizeid'        => array('type' => 'int'),
        'links'             => array('type' =>  'has_many'),//TODO Later
        'files'             => array('type' =>  'has_many'),//TODO later
        'children_comments'             => array('type' =>  'array'),
        'deleted'           => array('type'=> 'boolean', 'default'=>FALSE),
        "reported"          =>array('type'=>'counter'),
        "reported_by"       =>array("type"=>"array"), //user_id of reported, we'll hide the comment 
        //to the reported user, even before we actually delete them
        "username"          =>array("type"=>"string"), //lets hold one copy of it
    );

    public function isReportedBy($user=null){
      if($user==null){
        $user = Session::instance()->get("user") ;
      }
      foreach($this->reported_by as $uid){
        if($user && $user->_id."" == $uid){
          return true;
        }
      }
      return false;
    }
    protected $_db = "news_comments";
}
?>
