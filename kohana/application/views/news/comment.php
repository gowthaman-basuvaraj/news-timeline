<div class="news-page-comment-item expanded <?php echo Kohana_Text::alternate("followup-item-odd", "followup-item-even") ?>" id="comment-<?php echo $comment->humanizeid ?>">

  <?php $children_comments = Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("comment_id" => $comment->_id)) ?>
<?php  $reported = $comment->isReportedBy() ? " reported ": ""?>
  <div class="comment-item-panel">    
    <div class="news-page-comment-item-title <?php echo $reported ?>">      
      <?php echo HTML::anchor("user/details/" . $comment->user->username, $comment->user->username, array("class" => "vote no-img")) ?>
    </div> 
    <a  id="<?php echo $comment->url_title ?>" class="news-page-comment-title no-href <?php echo $reported ?>">
      <?php echo $comment->title ?>
      <div class="comment-list-votes">
        <?php echo count(Mango::factory("vote")->load(NULL, NULL, NULL, array(), array("type" => 1, "comment_id" => $comment->_id))) . " Agrees " . " " .
        count(Mango::factory("vote")->load(NULL, NULL, NULL, array(), array("type" => -1, "comment_id" => $comment->_id))) . " Disagrees " ?> 
      </div>
    </a>
    <a href="javascript:void(0)" class="comment-toggle open" child-count="<?php echo count($children_comments) ?>" name="<?php echo $comment->humanizeid ?>">[-]</a>

    <div class="comment-item-content">
      <div class="news-page-comment-item-desc <?php echo $reported ?>">                                                                                                                                                                                                                                                                                                                                                                    
        <?php echo $comment->comment_body ?>  
      </div>            
      <div class="news-page-comment-item-action <?php echo $reported ?>">                                                                                                                                                                                                                                                      
        <ul>  
          <?php if ($logged_user->is_loggedin && $comment->user_id . "" == $logged_user->_id . ""): ?>
            <li><a class="comment-delete-link vote no-img" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" news="<?php echo $news->url_title ?>">Delete</a></li>
          <?php endif; ?>
          <?php if (!$comment->deleted && $logged_user->is_loggedin): ?>
              <li><a class="comment-reply-link vote no-img" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" news="<?php echo $news->url_title ?>">Reply</a></li>
              <!-- User liked or disliked this post .. or no action was performed, -->    
          <?php $user_has_voted = Mango::factory("vote")->load(1, NULL, NULL, array(), array("user_id" => $logged_user->_id, "comment_id" => $comment->_id)); ?>
    
          <?php if (!$user_has_voted->loaded()): ?>
                <li><a class="vote no-img not-decided agree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, 1, 0);return false">Agree</a></li>
                <li><a class="vote no-img  not-decided disagree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, -1, 0);return false">Disagree</a></li>
          <?php else: ?>
          <?php if ($user_has_voted->type == 1): ?>
                    <!-- user agreed -->          
                    <li><a class="vote no-img  decided agree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>">You Agreed</a></li>
                    <li><a class="vote no-img  not-decided disagree" href="javascript:void(0)"  comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, -1, 1);return false">Disagree</a></li>
          <?php else: ?>
                      <!-- user disagreed -->            
                      <li><a class="vote no-img  not-decided agree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, 1, -1);return false">Agree</a></li>
                      <li><a class="vote no-img  decided disagree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>">You Disagreed</a></li>
          <?php endif; ?>
          <?php endif; ?>
          <?php endif; ?>
                      <?php if($reported == "" && $logged_user->is_loggedin) : ?>
                      <li><li><a class="vote no-img  not-decided report" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, -1, -1);return false">Report SPAM/Offensive</a></li>
                      <?php endif; ?>
                    </ul>                                                                                                                                                                                                                                                                        
                  </div>                              
                  <div class="comment-children">                            
        <?php if (!isset($singlecomment)): ?>
        <?php foreach ($children_comments as $subcomment): ?>    
        <?php echo View::factory("news/comment", array("comment" => $subcomment, "news" => $news, "logged_user" => $logged_user)) ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>         
