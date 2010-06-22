<div class="news-page-comment-item expanded <?php echo Kohana_Text::alternate("followup-item-odd", "followup-item-even") ?>">
  <div class="news-page-comment-item-title ">    
    <?php $children_comments = Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("comment_id"=>$comment->_id)) ?>
    <?php echo HTML::anchor("user/" . $comment->user->username, $comment->user->username) ?>
    <a  id="<?php echo $comment->url_title ?>" class="news-page-comment-title">
      <?php echo $comment->title ?>
    </a>
    <a href="javascript:void(0)" class="comment-toggle open" child-count="<?php echo count($children_comments) ?>">[-]</a>

  </div>                                                                                                                                                                                                                                                                                                                                                                    
  <div class="news-page-comment-item-desc">                                                                                                                                                                                                                                                                                                                                                                    
    <?php echo $comment->comment_body ?>  
    </div>          
    <div class="news-page-comment-item-action">                                                                                                                                                                                                                                                    
      <ul>                                                                                                                                                                                                                                                    
        <li><a class="comment-reply-link" href="javascript:void(0)" comment="<?php echo $comment->url_title ?>" news="<?php echo $news->url_title ?>">Reply</a></li>
      </ul>                                                                                                                                                                                                                                                
    </div>      
    <div class="comment-children">    
     
    <?php foreach ($children_comments as $subcomment): ?>    
    <?php echo View::factory("news/comment", array("comment" => $subcomment, "news" => $news)) ?>
    <?php endforeach; ?>
  </div>
</div>         
