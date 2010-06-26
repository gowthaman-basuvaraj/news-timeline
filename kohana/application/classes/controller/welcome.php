<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

	public function action_index()
	{
                $user = $this->session->get("user", null);
                $tdy_news = newsutils::get_todaynews();
                
                $data = array("user"=>$user, "today_news"=>$tdy_news);
                $data['stories'] = Mango::factory("story")->load(10, array("humanizeid"=>1), NULL, array(), array());
                if(null != $user){
                  $data['user_saved'] = $this->mongoId2Array(
                    Mango::factory("saved")->load(50, array("saved_at"=>1), NULL, array(), array("user_id"=>$user->_id)), "story_urltitle");
                  $this->template->user_saved = $data['user_saved']  ;
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
