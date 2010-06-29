<?php

class Controller_news extends Controller_Base {

    public function action_index() {
        
    }

    public function action_item() {
        
    }

    public function action_add($story_urltitle=NULL) {
        $news = Mango::factory("story");
        if ($story_urltitle != NULL) {

            $original_story = Mango::factory("story")->load(1, NULL, NULL, array(), array("url_title" => $story_urltitle));
        } else {
            $original_story = NULL;
        }
        if (Request::$method == "POST") {
            $linkObjects = array();
            $twtTags = array();

            try {

                if (isset($_POST['link']) && is_array($_POST['link'])) {
                    foreach ($_POST['link'] as $linkHref) {
                        if (Kohana_Validate::url($linkHref)) {
                            $title_link = "";
                            if (isset($_POST['title'])) {
                                $title_link = $_POST['title'];
                            }
                            $linkObjects[] = Mango::factory("link", array("title" => $title_link, "url" => $linkHref))->create();
                        }
                    }

                    unset($_POST['link']);
                }
                if(isset($_POST['hashtags'])){
                  $tags = preg_split("/[\s,]+/", $_POST['hashtags']);
                  foreach($tags as $tag){
                    $tagE = Mango::factory("hashtag")->load(1, NULL, NULL, array(), array("hashtag"=>new MongoRegex("/$tag/i")));
                    if($tagE->loaded()){
                      $twtTags[] = array("tag"=>$tagE, "new"=>false);
                    }else {
                      $twtTags[] = array("tag" => $tagE->values(array("hashtag"=>$tag)) , "new"=>true);
                    }
                  }
                  unset($_POST['hashtags']);
                }
                $values = $_POST;
                $tdy_news = newsutils::get_next_id();
                $values["humanizeid"] = (int) (date("ymd") . $tdy_news->news_count);

                if(newsutils::is_utf8($values['title'])) {
                  $title_parts = explode(" ", $values['title']);
                  $values['url_title'] = $values["humanizeid"] . "_" . $title_parts[0];
                }else {
                  $values["url_title"] = $values["humanizeid"] . "_" . Kohana_Inflector::underscore(
                                filter_var(preg_replace("/[^a-zA-Z0-9\\s]/", "", $values["title"]),
                                        FILTER_SANITIZE_STRING,
                                        FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK));
                }
                $values["daystory_id"] = $tdy_news->_id . "";
                $values['description'] = nl2br($values['description']);
                if ($original_story != NULL) {
                    $values['story_id'] = $original_story->_id . "";
                    $values['story_depth'] = $original_story->story_depth + 1;
                } else {
                    $values['story_id'] = new MongoId();
                    $values['story_depth'] = 1;
                }
                if (isset($values['story_date'])) {
                    $values['story_date'] = (int) ( $values['story_date'] / 1000);
                }
                
                $values = $news->check($values);
                $news->values($values);
                $news->create();
                $fetcher = new Contentfetcher();
                foreach ($linkObjects as $linkObject) {

                    $news->add($linkObject);
                    $linkObject->values(array("story_id" => $news->_id, "user_id" => $this->logged_user->_id . ""));
                    $linkObject->update();
                    //TODO move it to gearman client, to extract tweets too
                    //todo make url parsing, to default readable content
                    //such as
                    //single page
                    //print view etc...
                    //also get favicon

                    //;
                    
                    $favicon = $fetcher->GetMainBaseFromURL($linkObject->url);
                    
                    $linkObject->values(array( "favicon"=>$favicon."favicon.ico"));

                    $this->logged_user->add($linkObject);
                    $this->logged_user->update();
                }
                $news->update();
                $tdy_news->add($news);
                $tdy_news->update();
                
                $this->logged_user->add($news);
                $this->logged_user->update();
                foreach($twtTags as $tags){
                  $tags["tag"]->values(array("stories"=>array($news->_id) ));
                   
                  if($tags["new"]) {
                    $tags["tag"]->create();                   
                  }else {
                     $tags["tag"]->update();                   
                  }
                  $news->add($tags["tag"]);
                }
                $news->update();
                if ($original_story != NULL) {
                    //$original_story->add($news);
                    //$original_story->update();
                    $this->request->redirect("news/view/$original_story->url_title#$news->url_title");
                } else {
                    $this->request->redirect("news/view/$news->url_title");
                }
            } catch (Validate_Exception $ve) {
                if ($linkObjects != null) {
                    foreach ($linkObjects as $linkObject) {
                        $linkObject->delete();
                    }
                }

                $this->add_message($ve->array->errors(), "form-errors");
            }
        }
        if ($news->story_date == -1) {
            $news->story_date = date("U");
        }

        $this->template->content = View::factory("news/add", array("news" => $news, "original_story" => $original_story));
    }

   

    public function action_view($news_title) {
        $news = Mango::factory("story")->load(1, NULL, NULL, array(), array("url_title" => $news_title));
        if ($news->loaded()) {
          $story_comments = Mango::factory("comment")->load(NULL, array("likes"=>1), NULL, array(), array("story_id"=>$news->_id));
          $followups = Mango::factory("story")->load(NULL, NULL, NULL, array(), array("story_id"=>$news->_id));
            $this->template->content = View::factory("news/view", array("news" => $news, "logged_user"=>$this->logged_user, "story_comments"=>$story_comments, "followups"=>$followups));
        } else {
            //todo related or so and so...
        }
    }
    public function action_comment_delete($story_urltitle, $original_comment_title) {
      //TODO check user permission
      $comment = Mango::factory("comment")->load(1, NULL, NULL, array(),array("url_title"=>$original_comment_title));
      if($comment->loaded()){
        $comment->values(array("title"=>"[deleted]", "comment_body"=>"", "user_id"=>new MongoId(), 'deleted'=>TRUE))->update();
        die("OK");
      }
      die("OK NOT");
      
    }

    public function action_comment($story_urltitle, $original_comment_title=NULL) {


        $original_story = Mango::factory("story")->load(1, NULL, NULL, array(), array("url_title" => $story_urltitle));
        if (!$original_story->loaded()) {
            //todo 404
        }
        $original_comment = NULL;
        if ($original_comment_title != NULL) {
            $original_comment = Mango::factory("comment")->load(1, NULL, NULL, array(), array("url_title" => $original_comment_title));
        }
        $comment = Mango::factory("comment");
        if (Request::$method == "POST") {
            $linkObjects = array();

            try {

                if (isset($_POST['link']) && is_array($_POST)) { //TODO extract links from description
                    foreach ($_POST['link'] as $linkHref) {
                        if (Kohana_Validate::url($linkHref)) {
                            $title_link = "";
                            if (isset($_POST['title'])) {
                                $title_link = $_POST['title'];
                            }
                            $linkObjects[] = Mango::factory("link", array("title" => $title_link, "url" => $linkHref))->create();
                        }
                    }

                    unset($_POST['link']);
                }
                $values = $_POST;
                $tdy_news = newsutils::get_next_id();
                $values["humanizeid"] = (int) (date("ymd") . $tdy_news->news_count);
                $values["url_title"] = $values["humanizeid"] . "_" . Kohana_Inflector::underscore(
                                filter_var(preg_replace("/[^a-zA-Z0-9\\s]/", "", $values["title"]),
                                        FILTER_SANITIZE_STRING,
                                        FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
                $values["daystory_id"] = $tdy_news->_id . "";

                if ($original_comment != NULL) {
                    $values['comment_id'] = $original_comment->_id . "";
                } else {
                    $values['comment_id'] = new MongoId();
                }
                if ($original_story != NULL) {
                    $values['story_id'] = $original_story->_id . "";
                } else {
                    $values['story_id'] = new MongoId();
                }

                $values = $comment->check($values);
                $comment->values($values);
                $comment->create();

                foreach ($linkObjects as $linkObject) {
                    $news->add($linkObject);
                    $linkObject->values(array("story_id" => $original_story->_id . "", "comment_id" => $comment->_id . "", "user_id" => $this->logged_user->_id . ""));
                    $linkObject->update();
                    $this->logged_user->add($linkObject);
                    $this->logged_user->update();
                }
                $comment->update();
                $tdy_news->add($comment);
                $tdy_news->update();
                $this->logged_user->add($comment);
                $this->logged_user->update();
                 if ($original_comment != NULL) {
                    $original_comment->children_comments[] = $comment;
                    $original_comment->update();
                }
                if ($original_story != NULL) {
                    //$original_story->add($comment);
                    //$original_story->update();
                    $this->request->redirect("news/view/$original_story->url_title#$comment->url_title");
                } else {
                    $this->request->redirect("news/view/$original_story->url_title");
                }
            } catch (Validate_Exception $ve) {
                if ($linkObjects != null) {
                    foreach ($linkObjects as $linkObject) {
                        $linkObject->delete();
                    }
                }

                $this->add_message($ve->array->errors(), "form-errors");
            }
        }
        $this->request->redirect("news/view/$original_story->url_title");
        
    }

}

?>
