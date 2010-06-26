


<div class="news-list-container">
  <?php foreach ($stories as $news): ?>
  
    <div class="news-list-item <?php echo Kohana_Text::alternate("item-odd", "item-even") ?>">    
      <h2 class="news-list-title">          
      <?php $link = $news->links[0]; ?>
      <a href="<?php echo $link->url ?>"><img src="<?php echo $link->favicon ?>" class="favicon" alt=""/><?php echo $news->title ?></a>
    </h2>
    <div class="news-list-desc">
      <?php echo $news->description ?>

    </div>
    <div class="news-list-others">
      <?php $comments = Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("story_id" => $news->_id)); ?>
      <h3 class="home-page-latest-comment-title">    
        <?php if (count($comments) > 0): ?>     
          Latest Comment          
        <?php endif; ?>
        </h3>        
        <div class="news-list-actions">
          <?php if(in_array($news->url_title, $user_saved)): ?>
          <div class="vote no-img" style="display:inline">Saved</div>
          <?php else: ?>
          <a href="javascript:void(0)" class="vote no-img" onclick="save_item(this, '<?php echo htmlentities(Kohana::$base_url."index.php/user/saveitem/$news->_id");?>')">Save It!</a>
          <?php endif; ?>
          <a href="#" class="vote no-img">Share It!</a>
        <?php echo HTML::anchor("news/view/$news->url_title", count($comments) . " Comment(s) /".count(Mango::factory("story")->load(NULL, NULL, NULL, array(), array("story_id" => $news->_id))) . " Followup(s)", array("class" => "vote no-img")) ?>
        <?php $latest_comment = Mango::factory("comment")->load(1, array("humanizeid" => -1), NULL, array(), array("story_id" => $news->_id)); ?>
        </div>                 
      <?php if ($latest_comment->loaded()) : ?>      
            <div class="home-page-latest-comment">      
        <?php echo substr($latest_comment->comment_body,0, 150); ?>
          </div>                
      <?php endif; ?>
          </div>                        
      
        </div>                        
  <?php endforeach; ?>
</div>