<?php

class Controller_User extends Controller_Base {
  public function action_details($username){
    echo Kohana::debug(Mango::factory("user", array("username"=>$username))->load(1));
  }
}
?>
