<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

	public function action_index()
	{
                $user = $this->session->get("user", null);
                if(null != $user){
                    $this->template->content = "hello, $user->username!";
                }else {
                    $this->template->content = 'hello, world!';
                }
                //todo
                //1. show latest news ..
                //2. other trending news ..
                //if logged in user .. then response to his comments and stuff
		
	}

} // End Welcome
