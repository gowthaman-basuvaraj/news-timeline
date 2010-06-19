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
            $user = Mango::factory("user")->load(1, NULL, NULL, array(), array("username" => $_POST['username'], "password" => $_POST['password']));
            if ($user->loaded()) {
                $this->session->set("user", $user);
                $this->request->redirect("welcome/index");
            }
            $this->add_message("Invalid Login Details", "error");
        }
        $this->template->content = View::factory("account/login");
    }

    public function action_logout() {
        $this->session->set("user",null);
        $this->request->redirect("");
    }

    public function action_moderator() {

    }

    public function action_home() {
        
    }

    public function action_list() {
        foreach (Mango::factory("user")->load(NULL) as $u) {
            echo "<p>$u->username, $u->password</p>";
        }
    }

    public function action_create() {
        if ($this->logged_in) {
            $this->request->redirect("account/home");
        }
        $user = Mango::factory("user");
        $errors = array();
        if (Request::$method == "POST") {
            $errors = $this->accountutils->create_user($user, $_POST);
            if (is_array($errors) && count($errors) == 0) {
                $this->request->redirect("account/login");
            } else {
                $this->add_message($errors, "form-errors");
            }
        }
        $this->template->content = View::factory("account/create", array("user" => $user));
    }

}
?>
