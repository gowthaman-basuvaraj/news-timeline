<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Controller_Account extends Controller_Base {

  public function action_index() {
    if ($this->logged_in) {
      $this->request->redirect("account/home");
    } else {
      $this->request->redirect("account/create");
    }
  }

  public function action_login() {
    if (Request::$method == "POST") {
      if (isset($_POST['tlogin_id'])) {
        $unique_tlogin = Session::instance()->get("unique_tlogin", null);
        if ($unique_tlogin != null && $unique_tlogin == $_POST['tlogin_id']) {
          //create a throwaway account and login
          $taccount = Mango::factory("user")->values(
                          array(
                              "username" => "Guest",
                              "password" => md5(uniqid(date("U") . "", true)), //unique password
                              'throwaway_account' => true
                          )
                  )->create();
          $this->session->set("user", $taccount);
          $this->session->set("authorized", true);
          die("OK");
        } else {
          die("ERROR");
        }
      } else {
        $user = Mango::factory("user")->load(1, NULL, NULL, array(), array("username" => $_POST['username'], "password" => md5($_POST['password'])));
        if ($user->loaded()) {
          $user->is_loggedin = true;
          $user->is_moderator = true;
          $user->update();
          $this->session->set("user", $user);
          $this->session->set("authorized", true);
          $this->request->redirect("welcome/index");
        }
        $this->add_message("Invalid Login Details", "error");
      }
    }
    $this->template->content = View::factory("account/login");
  }

  public function action_logout() {
    $user = $this->session->get("user");
    $user->is_loggedin = false;
    $user->update();
    $this->session->set("user", Mango::factory("user"));
    $this->session->set("authorized", false);
    $this->request->redirect("");
  }

  public function action_moderator() {
    
  }

  public function action_home() {
    
  }

  public function action_list() {
    foreach (Mango::factory("user")->load(NULL) as $u) {
      $delete_link = HTML::anchor("account/delete/$u->_id", "Delete");
      echo "<p>$u->username, $u->is_moderator, $delete_link</p>";
    }
  }

  public function action_delete($uid) {
    $user = Mango::factory("user", array("_id" => $uid))->load(1);
    if ($user->loaded()) {
      $user->delete();
    }
    $this->request->redirect("");
  }

  public function action_create() {
    if ($this->logged_in) {
      $this->request->redirect("account/home");
    }
    $user = Mango::factory("user");
    $errors = array();
    if (Request::$method == "POST") {
      list($errors, $user) = $this->accountutils->create_user($user, $_POST);
      if (is_array($errors) && count($errors) == 0) {
        Session::instance()->set("user", $user);
        $this->session->set("authorized", true);
        $this->request->redirect($_SERVER['HTTP_REFERER']);
      } else {
        $this->add_message($errors, "form-errors");
      }
    }
    $this->template->content = View::factory("account/create", array("user" => $user));
  }

  public function action_adminpasswd() {
    if (Request::$method == "POST") {
      if (isset($_POST['password'])) {
        if (count(Mango::factory("user")->load(NULL)) == 0) {
          $user = Mango::factory("user", array("username" => "admin", "password" => md5($_POST['password']), "is_moderator" => true))->create();
          if ($user->saved()) {
            $this->request->redirect("");
          }
        }
      }
    }
    if (count(Mango::factory("user")->load(NULL)) == 0) {
      echo <<<EOF
   <form method="post">
       <input type="password" name='password'/>
       <input type="submit" />
   </form>
EOF;
      die();
    } else {
      $this->request->redirect("");
    }
  }

}

?>
