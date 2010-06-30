<? if ($shift != 0)
  echo "<div class='span-1'>&nbsp;</div>" ?>
<? $reported = $comment->isReportedBy() ? " reported " : "" ?>
  <div class="news-page-comment-item expanded  span-<?= 16 - $shift ?> last <?= Kohana_Text::alternate("followup-item-odd", "followup-item-even") ?>" id="comment-<?= $comment->humanizeid ?>">
  
  <? $children_comments = Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("comment_id" => $comment->_id)) ?>

  <div class="comment-item-panel span-16 last">    

    <div class="span-<?= 16 - $shift ?> last <?= $reported ?>">

      <div class="span-<?= 16 - $shift ?> last">
        <div class="span-<?= 6 - $shift ?>">
          <a  id="<?= $comment->url_title ?>" class="news-page-comment-title no-href "><?= $comment->title ?></a>
        </div>
        <div class="news-page-comment-item-title  span-3">      
          <a href="<?= Kohana::$base_url . "user/details/" . $comment->user->username ?>"><?= $comment->user->username ?></a>
        </div> 
        <div class="comment-list-votes span-4">
          <?= count(Mango::factory("vote")->load(NULL, NULL, NULL, array(), array("type" => 1, "comment_id" => $comment->_id))) . " Agrees " . " " .
                  count(Mango::factory("vote")->load(NULL, NULL, NULL, array(), array("type" => -1, "comment_id" => $comment->_id))) . " Disagrees " ?> 
        </div>  
        <div class="span-3 last">  
          <a href="javascript:void(0)" class="comment-toggle open" child-count="<?= count($children_comments) ?>" name="<?= $comment->humanizeid ?>">[-]</a>
        </div>  
      </div>  
      <div class="news-page-comment-item-desc  span-<?= 16 - $shift ?> last"><?= $comment->comment_body ?></div>     
      <div class="news-page-comment-item-action  span-<?= 16 - $shift ?> last">                                                                                                                                                                                                                                                      
        <?= View::factory("news/usercommentaction", array("reported" => $reported, "comment" => $comment, "logged_user" => $logged_user, "news" => $news)) ?>
        </div>                  
  
      </div>                      
      <div class="comment-item-content span-<?= 16 - $shift ?> last">
  
  
        <div class="comment-children">                                                                                                                        
        <? if (!isset($singlecomment)): ?>
        <? foreach ($children_comments as $subcomment): ?>    
        <?= View::factory("news/comment", array("comment" => $subcomment, "news" => $news, "logged_user" => $logged_user, "shift" => $shift + 1)) ?>
        <? endforeach; ?>
        <? endif; ?>
      </div>
    </div>
  </div>
</div>         
