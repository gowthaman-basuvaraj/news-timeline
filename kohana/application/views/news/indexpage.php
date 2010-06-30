


<div class="news-list-container">
  <? foreach ($stories as $news): $link = $news->links[0]; ?>
  
    <div class="news-list-item <?= Kohana_Text::alternate("item-odd", "item-even") ?> span-16 last">
      <div class=" span-16 last">                    
        <div class="span-10">    
          <h4 class="news-list-title">                      
            <a href="<?= $link->url ?>"><img src="<?= $link->favicon ?>" class="favicon" alt=""/><?= $news->title ?></a>
          </h4>     
        </div>    
        <div class="span-6 last">    
          Posted By <a href="<?= Kohana::$base_url ?>index.php/user/details/<?= $news->username ?>"><?= $news->username ?></a> on <?= date("Y-m-d", $news->story_date) ?>
        </div>    
      </div>                  
      <div class="span-4">                  
        <a href="<?= Kohana::$base_url . "index.php/news/view/$news->url_title?ref=hi" ?>">
          <img src='<?= $news->story_image ?>' onerror='<?= $news->local_cache ?>' class='home-page-image'/>
        </a>                  
  
      </div>                  
      <div class="span-12 last">                  
        <div class="news-list-desc span-12 last">                    
        <?= substr($news->description, 0, newsutils::getReqChars($news->description, 230)); ?>

      </div>
      <div class="news-list-others span-12 last">
        <!-- no latest comment
        <div class="span-12 last">
        <? if (count($news->comments_count) > 0) : ?>
              <div class="span-2 ">      
                &nbsp;             
              </div>                
        <? $latest_comment = Mango::factory("comment")->load(1, array("humanizeid" => -1), NULL, array(), array("story_id" => $news->_id)); ?>
      
              <div class="span-10 last ">          
        <? if ($latest_comment->loaded()) : ?>      
                  <div class="home-page-latest-comment">                                                                                
        <?= substr($latest_comment->comment_body, 0, newsutils::getReqChars($latest_comment->comment_body, 100)); ?>
                </div>                                                                  
        <? endif; ?>
                </div>                    
        <? endif; ?>     
                </div>       
            -->    
            <div class="news-list-actions span-12 last">                                  
          <? if (isset($user_saved) && in_array($news->url_title, $user_saved)): ?>
              <div class="vote no-img" style="display:inline">Saved</div>                                                              
          <? elseif (!$user->is_loggedin): ?>
                <a href="javascript:void(0)" class="vote no-img" onclick="save_item(this, '<?= htmlentities(Kohana::$base_url . "index.php/user/saveitem/$news->_id"); ?>', false)">Save It!</a>
          <? elseif ($user->is_loggedin): ?>
                  <a href="javascript:void(0)" class="vote no-img" onclick="save_item(this, '<?= htmlentities(Kohana::$base_url . "index.php/user/saveitem/$news->_id"); ?>', true)">Save It!</a>
          <? endif; ?>
        
                  <a href="#" class="vote no-img">Share It!</a>                                                               
                  <a href="<?= Kohana::$base_url . "index.php/news/view/$news->url_title?ref=cf" ?>" class="vote no-img"><?= $news->comments_count . " Comment(s) /" . $news->followups_count . " Followup(s)" ?></a>           
                </div>                                                                                 
        
              </div>                                                                                         
            </div>                                                                                        
        
          </div>                                                                                                                                                            
  <? endforeach; ?>
</div>