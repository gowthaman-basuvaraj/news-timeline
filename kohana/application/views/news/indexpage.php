

<h2>Welcome <?php echo $user->username ?></h2>
<div class="news-list-container">
  <?php foreach ($stories as $news): ?>
  
  <div class="news-list-item <?php echo Kohana_Text::alternate("item-odd","item-even")?>">    
      <div class="news-list-title">    
      <?php $link = $news->links[0]; ?>
      <a href="<?php echo $link->url ?>"><?php echo $news->title ?></a>
    </div>
    <div class="news-list-desc">
      <?php echo $news->description ?>

    </div>
    <div class="news-list-others">
       <div class="home-page-latest-comment-title">    
              Latest Comment    
            </div>  
      <div class="news-list-actions">
        <a class="vote no-img">
          <?php echo count(Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("story_id" => $news->_id))) . " Comment(s) " ?>
        </a>
        <a class="vote no-img">
          <?php echo count(Mango::factory("story")->load(NULL, NULL, NULL, array(), array("story_id" => $news->_id))) . " Followup(s)" ?>
        </a>
        <?php echo HTML::anchor("news/view/$news->url_title", "More...", array("class" => "vote no-img")) ?>
        <?php $latest_comment = Mango::factory("comment")->load(1, array("humanizeid" => -1), NULL, array(), array("story_id" => $news->_id)); ?>
        <?php if ($latest_comment->loaded()) : ?>
          </div>    
          <div class="home-page-latest-comment">    
             
        <?php echo $latest_comment->comment_body ?>
          </div>    
      <?php endif; ?>
          </div>      
      
        </div>      
  <?php endforeach; ?>
</div>