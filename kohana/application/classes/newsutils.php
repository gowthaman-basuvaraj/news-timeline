<?php

define('_is_utf8_split', 5000);

class newsutils {

  public static function get_next_id() {
    $tdy_news = newsutils::get_todaynews();
    $tdy_news->news_count->increment();
    $tdy_news->update();
    return $tdy_news;
  }

  public static function get_todaynews() {
    $tdy = mktime(null, null, NULL, date("n"), date("j"), date("y"));
    $tdy_news = Mango::factory("daystory")->load(1, NULL, NULL, array(), array("day" => $tdy));
    if (!$tdy_news->loaded()) {
      $tdy_news->values(array("day" => $tdy, "news_count" => 0))->create();
    }
    return $tdy_news;
  }

  public static function getReqChars($str, $num) {
    $len = strlen($str);
    if ($len <= $num)
      return $num;
    $space_pos = stripos($str, " ", $num);
    if ($space_pos) {
      return $space_pos;
    }
    return -1;
  }

  public static function is_utf8($string) { // v1.01
    if (strlen($string) > _is_utf8_split) {
      // Based on: http://mobile-website.mobi/php-utf8-vs-iso-8859-1-59
      for ($i = 0, $s = _is_utf8_split, $j = ceil(strlen($string) / _is_utf8_split); $i < $j; $i++, $s+=_is_utf8_split) {
        if (is_utf8(substr($string, $s, _is_utf8_split)))
          return true;
      }
      return false;
    } else {
      // From http://w3.org/International/questions/qa-forms-utf-8.html
      return preg_match('%^(?:
                [\x09\x0A\x0D\x20-\x7E]            # ASCII
            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
        )*$%xs', $string);
    }
  }

  public static function get_urltitle($link) {
    if (newsutils::is_utf8($link->title))
      return $link->title;
    else
      return htmlentities($link->title);
  }

  public static function get_newstitle($news) {
    if ($news->story->_id . "" == "") :
      return $news->title;
    else:
      $news_sel = $news;
      $html_str = "";
      while ($news_sel->story->_id . "" != "") {
        $html_str = HTML::anchor("news/view/" . $news_sel->story->url_title, $news_sel->story->title) . "<div class='new-page-title-sep'>></div>" . $html_str;
        $news_sel = $news_sel->story;
      }
      return $html_str . $news->title;
    endif;
  }

  public static function get_partialnews($news) {
    $pos = newsutils::getReqChars($news->description, 600);
    $htm = substr($news->description, 0, $pos);
    if (strlen($news->description) > 600) {
      $sub = substr($news->description, $pos);
      $htm .= <<<HTML
      <div style="display:none" id="partial-news">$sub</div>              
      <a href="javascript:void(0)" class="more-link-toggle expand  vote no-img"> Show All</a>              
HTML;
    }
    return $htm;
  }

}

?>
