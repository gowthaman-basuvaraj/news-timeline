<ul>            
  <? if ($logged_user->is_loggedin && $comment->user_id . "" == $logged_user->_id . ""): ?>
    <li class="comment-action"><a class="comment-delete-link vote no-img" href="javascript:void(0)" comment="<?= $comment->url_title ?>" news="<?= $news->url_title ?>">Delete</a></li>
  <? endif; ?>
  <? if (!$comment->deleted && $logged_user->is_loggedin): ?>
      <li class="comment-action"><a class="comment-reply-link vote no-img" href="javascript:void(0)" comment="<?= $comment->url_title ?>" news="<?= $news->url_title ?>">Reply</a></li>
      <!-- User liked or disliked this post .. or no action was performed, -->                                        
  <? $user_has_voted = Mango::factory("vote")->load(1, NULL, NULL, array(), array("user_id" => $logged_user->_id, "comment_id" => $comment->_id)); ?>
    
  <? if (!$user_has_voted->loaded()): ?>
        <li class="comment-action"><a class="vote no-img not-decided agree" href="javascript:void(0)" comment="<?= $comment->url_title ?>" onclick="vote_comment(this, 1, 0);return false">Agree</a></li>
        <li class="comment-action"><a class="vote no-img  not-decided disagree" href="javascript:void(0)" comment="<?= $comment->url_title ?>" onclick="vote_comment(this, -1, 0);return false">Disagree</a></li>
  <? else: ?>
  <? if ($user_has_voted->type == 1): ?>
            <!-- user agreed -->                                                                                              
            <li class="comment-action"><a class="vote no-img  decided agree" href="javascript:void(0)" comment="<?= $comment->url_title ?>">You Agreed</a></li>
            <li class="comment-action"><a class="vote no-img  not-decided disagree" href="javascript:void(0)"  comment="<?= $comment->url_title ?>" onclick="vote_comment(this, -1, 1);return false">Disagree</a></li>
  <? else: ?>
              <!-- user disagreed -->                                                                                                                
              <li class="comment-action"><a class="vote no-img  not-decided agree" href="javascript:void(0)" comment="<?= $comment->url_title ?>" onclick="vote_comment(this, 1, -1);return false">Agree</a></li>
              <li class="comment-action"><a class="vote no-img  decided disagree" href="javascript:void(0)" comment="<?= $comment->url_title ?>">You Disagreed</a></li>
  <? endif; ?>
  <? endif; ?>
  <? endif; ?>
  <? if ($reported == "" && $logged_user->is_loggedin) : ?>
                <li class="comment-action"><a class="vote no-img  not-decided report" href="javascript:void(0)" comment="<?= $comment->url_title ?>" onclick="vote_comment(this, -1, -1);return false">Report SPAM/Offensive</a></li>
  <? endif; ?>
</ul>