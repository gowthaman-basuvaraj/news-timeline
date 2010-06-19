<?php
class newsutils {
    public static function  get_next_id(){
        $tdy_news = newsutils::get_todaynews();
        $tdy_news->news_count->increment();
        $tdy_news->update();
        return $tdy_news;

    }
    public static function get_todaynews(){
        $tdy  =  mktime(null, null, NULL, date("n"), date("j"), date("y"));
        $tdy_news = Mango::factory("daystory")->load(1, NULL, NULL, array(), array("day"=>$tdy));
        if(!$tdy_news->loaded()){
            $tdy_news->values(array("day"=>$tdy,"news_count"=>0))->create();
        }
        return $tdy_news;
    }
    
}

?>
