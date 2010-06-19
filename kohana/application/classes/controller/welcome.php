<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

	public function action_index()
	{
                $user = $this->session->get("user", null);
                $tdy_news = newsutils::get_todaynews();
                $data = array("user"=>$user, "today_news"=>$tdy_news);
                if(null != $user){
                    $this->template->content = View::factory("news/indexpage", $data);
                }else {
                    $data['user'] = Mango::factory("user");
                    $this->template->content = View::factory("news/indexpage", $data);
                }
                //todo
                //1. show latest news ..
                //2. other trending news ..
                //if logged in user .. then response to his comments and stuff
		
	}

} // End Welcome
