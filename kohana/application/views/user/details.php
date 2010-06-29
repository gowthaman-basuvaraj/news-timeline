<div class="user-details-container">

  <div class="user-details-comments-list">
    <?php foreach ($comments as $comment): ?>
      <div class="user-details-comment">          
      <?php $children_comments = Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("comment_id" => $comment->_id)) ?>

      <div class="comment-item-panel">    

        <a  id="<?php echo $comment->url_title ?>" class="news-page-comment-title">
          <?php echo $comment->title ?>
          <div class="comment-list-votes">
            <?php echo count(Mango::factory("vote")->load(NULL, NULL, NULL, array(), array("type" => 1, "comment_id" => $comment->_id))) . " Agrees " . " " .
            count(Mango::factory("vote")->load(NULL, NULL, NULL, array(), array("type" => -1, "comment_id" => $comment->_id))) . " Disagrees " ?> 
          </div>
        </a>

        <div class="comment-item-content">
          <div class="news-page-comment-item-desc">                                                                                                                                                                                                                                                                                                                                                                    
            <?php echo $comment->comment_body ?>  
          </div>            
          <div class="news-page-comment-item-action">                                                                                                                                                                                                                                                      
            <ul> 
              
              <?php if ($logged_user->is_loggedin && $comment->user_id . "" == $logged_user->_id . ""): ?>
                <li><a class="comment-delete-link vote no-img" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" news="<?php echo $comment->story->url_title ?>">Delete</a></li>
              <?php endif; ?>
              <?php if (!$comment->deleted && $logged_user->is_loggedin): ?>
                  <!-- User liked or disliked this post .. or no action was performed, -->                    
              <?php $user_has_voted = Mango::factory("vote")->load(1, NULL, NULL, array(), array("user_id" => $logged_user->_id, "comment_id" => $comment->_id)); ?>
    
              <?php if (!$user_has_voted->loaded()): ?>
                    <li><a class="vote not-decided agree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, 1, 0);return false">Agree</a></li>
                    <li><a class="vote not-decided disagree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, -1, 0);return false">Disagree</a></li>
              <?php else: ?>
              <?php if ($user_has_voted->type == 1): ?>
                        <!-- user agreed -->                                                  
                        <li><a class="vote decided agree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>">You Agreed</a></li>
                        <li><a class="vote disagree" href="javascript:void(0)"  comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, -1, 1);return false">Disagree</a></li>
              <?php else: ?>
                          <!-- user disagreed -->                                                            
                          <li><a class="vote agree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" onclick="vote_comment(this, 1, -1);return false">Agree</a></li>
                          <li><a class="vote decided disagree" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>">You Disagreed</a></li>
              <?php endif; ?>
              <?php endif; ?>
              <?php endif; ?>
                        </ul>                                                                                                                                                                                                                                                                                                                        
                      </div>                                                                 
                    </div>                                                   
                  </div>                                                
                </div>                                                
    <?php endforeach; ?>
  </div>
</div>