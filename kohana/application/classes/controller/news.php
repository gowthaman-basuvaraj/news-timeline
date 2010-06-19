<?php

class Controller_news extends Controller_Base {

    public function action_index() {

    }

    public function action_item() {
        
    }

    public function action_newitem($story_urltitle) {
        $story = Mango::factory("story")->load(1, NULL, NULL, array(), array("url_title" => $story_urltitle));
        if ($story->loaded()) {
            $item = Mango::factory("item");
            if (Request::$method == "POST") {
                $linkObjects = null;

                try {

                    if (isset($_POST['link']) && is_array($_POST)) {
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


                    $values = $item->check($values);
                    $item->values($values);
                    $item->create();
                    foreach ($linkObjects as $linkObject) {
                        $item->add($linkObject);
                        $linkObject->values(array("story_id" => $story->_id, "item_id" => $item->_id));
                        $linkObject->update();
                    }
                    $item->update();
                    $story->add($item);
                    $story->update();
                    $this->logged_user->add($item);
                    $this->logged_user->update();
                    $this->request->redirect("news/view/$story->url_title");
                } catch (Validate_Exception $ve) {
                    if ($linkObjects != null) {
                        foreach ($linkObjects as $linkObject) {
                            $linkObject->delete();
                        }
                    }

                    $this->add_message($ve->array->errors(), "form-errors");
                }
            }
            $this->template->content = View::factory("news/newitem", array("story" => $story, "item" => $item));
        } else {
            Request::instance()->status = 503;
            Request::instance()->headers['Location'] = Kohana::$base_url;
            Request::instance()->send_headers();
            die();
        }
    }

    public function action_add() {
        $news = Mango::factory("story");
        if (Request::$method == "POST") {
            $linkObjects = null;

            try {

                if (isset($_POST['link']) && is_array($_POST)) {
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
                                filter_var($values["title"],
                                        FILTER_SANITIZE_STRING,
                                        FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
                $values["daystory_id"] = $tdy_news->_id . "";

                $values = $news->check($values);
                $news->values($values);
                $news->create();
                foreach ($linkObjects as $linkObject) {
                    $news->add($linkObject);
                    $linkObject->values(array("story_id" => $news->_id));
                    $linkObject->update();
                }
                $news->update();
                $tdy_news->add($news);
                $tdy_news->update();
                $this->logged_user->add($news);
                $this->logged_user->update();
                $this->request->redirect("news/view/$news->url_title");
            } catch (Validate_Exception $ve) {
                if ($linkObjects != null) {
                    foreach ($linkObjects as $linkObject) {
                        $linkObject->delete();
                    }
                }

                $this->add_message($ve->array->errors(), "form-errors");
            }
        }
        $this->template->content = View::factory("news/add", array("news" => $news));
    }

    public function action_view($news_title) {
        $news = Mango::factory("story")->load(1, NULL, NULL, array(), array("url_title" => $news_title));
        if ($news->loaded()) {
            $this->template->content = View::factory("news/view", array("news" => $news));
        } else {
            //todo related or so and so...
        }
    }

}
?>
