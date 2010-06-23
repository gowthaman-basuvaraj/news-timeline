<ul>
    <?php if ($user->is_moderator): ?>
        <li><?php echo HTML::anchor("news/add", "Add News") ?></li>
    <?php endif; ?>
    </ul>
    <p>Welcome <?php echo $user->username ?></p>
    <div class="news-list-container">
<?php foreach($stories as $news): ?>
   
    <div class="news-list-item">
                <div class="news-list-title">
        <?php $link  = $news->links[0];?>
        <a href="<?php echo $link->url?>"><?php echo $news->title ?></a>
        </div>
        <div class="news-list-desc">
        <?php echo $news->description ?>
            
        </div>
        <div class="news-list-actions">
           
                  <?php echo count(Mango::factory("comment")->load(NULL, NULL, NULL, array(), array("story_id"=>$news->_id)) ) . " Comment(s) | "?>
                  <?php echo count(Mango::factory("story")->load(NULL, NULL, NULL, array(), array("story_id"=>$news->_id)) ) . " Followup(s) | "?>
                  <?php echo HTML::anchor("news/view/$news->url_title","More...")?>
          <?php $latest_comment = Mango::factory("comment")->load(1,  array("humanizeid"=>-1), NULL, array(), array("story_id"=>$news->_id)); ?>
          <?php if($latest_comment->loaded()) : ?>
          <div class="home-page-latest-comment">
            <div class="home-page-latest-comment-title">
              Latest Comment
            </div>
                  <?php echo $latest_comment->comment_body ?>
          </div>
          <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
    </div>