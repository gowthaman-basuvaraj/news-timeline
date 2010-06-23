<?php
class Controller_Vote extends Controller_Base {
  public function action_voteup($comment_urltitle){
    return $this->vote($comment_urltitle, 1, true);
  }
  
  public function action_votedown($comment_urltitle){
     return $this->vote($comment_urltitle, -1, true);
  }
  
  public function action_votechangeup($comment_urltitle){
     return $this->vote($comment_urltitle, 1, false);
  }
  
  public function action_votechangedown($comment_urltitle){
     return $this->vote($comment_urltitle, -1, false);
  }
  private function vote($comment_urltitle, $num, $new){
    $comment = Mango::factory("comment")->load(1, NULL, NULL, array(), array("url_title"=>$comment_urltitle));
    $vote = Mango::factory("vote")->load(1, NULL ,NULL, array(), array("user_id"=>$this->logged_user->_id, "comment_id"=>$comment->_id));
    if(!$comment->loaded()) die("C NOT FOUND");
    if(!$vote->loaded() && $new){
      //new vote
      $vote->values(array(
         "user_id" => $this->logged_user->_id."",
          "comment_id"=>$comment->_id."",
          "type"=>$num,
      ))->create();
      
    }else if($vote->loaded()) {
       $vote->values(array(
         "user_id" => $this->logged_user->_id."",
          "comment_id"=>$comment->_id."",
          "type"=>$num,
      ))->update();
    }
    if($num==1)
      $comment->likes->increment();
    else
      $comment->likes->decrement();
    $comment->update();
    die("ok");
  }
  
}
?>
