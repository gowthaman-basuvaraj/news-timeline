<?php

class Controller_User extends Controller_Base {
  public function action_details($username){
    $user = Mango::factory("user", array("username"=>$username))->load(1);
    if($this->logged_user->username == $user->username){
      //full list of submissions and comments
    }else {
      //todo
    }
    
    $comments = Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("user_id"=>$user->_id));
    $votes = Mango::factory("vote")->load(NULL, NULL, NULL, array(), array("user_id"=>$user->_id));
    $this->template->content = View::factory("user/details", array("user"=>$user, "votes"=>$votes, "comments"=>$comments ,"logged_user"=>$this->logged_user));
  }
    public function action_saveitem($story_id){
      $story = Mango::factory("story", array("_id"=>$story_id))->load(1);
      Mango::factory("saved")->values(array("user_id"=>$this->logged_user->_id, "story_urltitle"=>$story->url_title, "saved_at"=>date("U")))->create();
      die("ok");
    }
}
?>
