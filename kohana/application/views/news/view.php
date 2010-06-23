<div class="news-page-container">
  <div class="news-page-title"> 
    <?php if ($news->story->_id . "" == "") : ?>
    <?php echo $news->title ?>
    <?php else: ?>
    
    <?php $news_sel = $news;
        $html_str = ""; ?>
    <?php while ($news_sel->story->_id . "" != "") {
    ?>
    <?php $html_str = HTML::anchor("news/view/" . $news_sel->story->url_title, $news_sel->story->title) . "<div class='new-page-title-sep'>></div>" . $html_str; ?> 
    <?php $news_sel = $news_sel->story; ?>
    <?php } ?>
    <?php echo $html_str . $news->title ?>
    
    <?php endif; ?>
      </div>        
   Posted on <?php echo date("d/m/Y", $news->story_date)?> by <?php echo HTML::anchor("user/".$news->user->username, $news->user->username)?>
      <div class="news-page-content">                                                                                
        <div class="news-page-desc">                                                                                                                                                                        
      <?php echo $news->description ?>
      </div>                                                                                                                                
      <div class="news-page-links-container">                                                                
  
      <?php foreach ($news->links as $link) : ?>
    
          <div class="news-page-link">                                                                                            
            <a class="news-page-original-url" href="<?php echo $link->url ?>" target="_blank" title="<?php echo htmlentities($link->title) ?>">
              <div class="news-title-link" style="background-image: url('<?php echo $link->favicon ?>')">                                        
            <?php echo $link->title ?>
          </div>                                        
        </a>    
      </div>

      <?php endforeach; ?>
      <?php if ($news->story->story_depth <= 2): ?> <!-- can add more only when it it top level story -->
              <!-- <div class="news-page-link">                                                                                                                                                                                
                <a href="#" onclick="javascript:$('.news-page-full-story-overlay').show()">Read Full Story</a>                                                        
              </div> -->                                                         
              <div class="news-page-link">                                                                                                                                                                                
        <?php echo HTML::anchor("news/add/$news->url_title", "Add Update/Followup") ?>
            </div>                                                                                                                                    
      <?php endif; ?>
        
            </div>                                                                                                                                                         
          </div>                                                                                                                                                        
          <div class="clear-line"></div>                                                                                                                                                                                                                                                                                                        
          <div class="news-followup-items">                                                                                                                                                                                                                                                                                                        
    <?php foreach ($news->stories as $item) : ?>
                <div class="news-followup-item-container <?php echo Kohana_Text::alternate("followup-item-odd", "followup-item-even") ?>">                    
                  <div class="news-page-followupitem">                                                                                                                                                                                                                                                                                                                                                                                                                    
                    <h2 title="<?php echo $item->url_title ?>"><?php echo $item->title ?></h2>
                    <div class="news-page-followupitem-content">   
                      Posted on <?php echo date("d/m/Y", $item->story_date)?> by <?php echo HTML::anchor("user/".$item->user->username, $item->user->username)?>
                      <div class="news-page-desc followup-item">                                                                                                                                                                                                                                                                                                                                                                                                                    
            <?php echo $item->description ?>
              </div>                                                                                                                    
    
              <div class="news-page-links-container">                                                                                                                          
            <?php foreach ($item->links as $link) : ?>
                  <div class="news-page-link">                                                                                                            
                    <a class="news-page-original-url" href="<?php echo $link->url ?>" target="_blank" title="<?php echo htmlentities($link->title) ?>">
                      <div class="news-title-link" style="background-image: url('<?php echo $link->favicon ?>')">                                        
                  <?php echo $link->title ?>
                </div>                                        
              </a>    
            </div>                
            <?php endforeach; ?>
                  <div class="news-page-link">                                                                                                                                                                  
              <?php echo HTML::anchor("news/view/$item->url_title", "Story Text & Discussion") ?>
                </div>                             
              </div>                                     
          <?php foreach ($item->items as $item) : ?>        
          <?php echo View::factory("news/item", array("item" => $item)) ?>    
          <?php endforeach; ?>
          
          
                  </div>                                                                                                                                                                                                                                                                                  
          
                </div>                                                                                                                                                                                                                                                                                  
          
              </div>                                                                                                                                                                                                                                                                                                                                              
    <?php endforeach; ?>
                  </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                
                  <div class="clear-line"></div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                
                  <div class="news-page-comments-container">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                    <div class="news-page-comments-title">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                      Comments                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                    </div>                                                                                                                                                                                                                                                                        
                    <div class="comment-form-container">    
                      <p class="container-title">New Comment</p>
                      <?php if($logged_user): ?>
                      <form action="<?php echo Kohana::$base_url ?>index.php/news/comment/<?php echo $news->url_title ?>" method="POST">
                        <div class="form-item">                                                                                                                                                                                                                
                          <div class="form-label required">Title</div>                                                                                                                                                                                                                                                                
                          <input placeholder="Comment Title" class="form-text required" type="text" name="title"  />                                                                                                                                                                                                                
                        </div>                                                                                                                                                                                                                
                        <div class="form-item">                                                                                                                                                                                                                
                          <div class="form-label required">Comment</div>                                                                                                                                                                                                                          
                          <textarea name="comment_body" placeholder="Say something"></textarea>                                                                                                                                                                                                                  
                        </div>                                                                                                                                                                                                                
                        <div class="form-submit">                                                                                                                                                                                                                
                          <input type="submit" value="Say it" />                                                                                                                                                                                                                                        
                        </div>                                                                                                                                                                                                                
                
                      </form>  
                      <?php else: ?>
                      <p><?php echo HTML::anchor("account/login", "Login to comment")?></p>
                      <?php endif; ?>
                    </div>                                                                                                                                                                                     
                
    <?php foreach ($story_comments as $comment): ?>
                  
    <?php if ($comment->comment->_id . "" != "")
                        continue; ?>
    <?php echo View::factory("news/comment", array("comment" => $comment, "news" => $news, "logged_user"=>$logged_user)) ?>
    <?php endforeach; ?>
    <?php if (count($story_comments) == 0) : ?>
                        <div class="news-page-comment-item followup-item-odd">                                                                                                                                                                                                                                                                                                                                
                          Be the First to say something                                                                                                                                                                                                                                                                                                                             
                        </div>                                                                                                                                                                                                                                                                                                                                
    <?php endif; ?>
                      </div>                                                                                                                                            
                    
                    </div>                    
                    <div class="comment-reply-form-container hidden">                                                                                                                                            
                     <?php if($logged_user): ?>
                      <form action="<?php echo Kohana::$base_url ?>index.php/news/comment/<?php echo $news->url_title ?>" method="POST">
                        <div class="form-item">                                                                                                                                                                                                                
                          <div class="form-label required">Title</div>                                                                                                                                                                                                                                                                
                          <input placeholder="Comment Title" class="form-text required" type="text" name="title"  />                                                                                                                                                                                                                
                        </div>                                                                                                                                                                                                                
                        <div class="form-item">                                                                                                                                                                                                                
                          <div class="form-label required">Comment</div>                                                                                                                                                                                                                          
                          <textarea name="comment_body" placeholder="Say something"></textarea>                                                                                                                                                                                                                  
                        </div>                                                                                                                                                                                                                
                        <div class="form-submit">                                                                                                                                                                                                                
                          <input type="submit" value="Say it" />                                                                                                                                                                                                                                        
                        </div>                                                                                                                                                                                                                
                
                      </form>  
                      <?php else: ?>
                      <p><?php echo HTML::anchor("account/login", "Login to comment")?></p>
                      <?php endif; ?>                                                                                                                                  
                    </div>                                        
                    
                    <div class="news-page-full-story-overlay hidden">  
                      <?php $link = $news->links->shift() ?>
                      <h2><a href="<?php echo $link->url?>" style="width:800px;margin-left:200px">Read Story at website</a></h2>
                      <div class="news-page-full-story-controls">                                                                                                                                                              
                        <div class="story-control close-control" onclick="$('.news-page-full-story-overlay').hide()">
                          <img src="<?php echo Kohana::$base_url?>media/img/close-icon.png" alt="Close This" />
                        </div>                                                                                                                                                              
                        <div class="story-control pdf-control" onclick="$('.news-page-full-story-overlay').hide()" >
                          <img src="<?php echo Kohana::$base_url?>media/img/PDFicon.png" alt="Download as PDF"/>
                        </div>                                                                                                                                                              
                        <div class="story-control print-control" onclick="$('.news-page-full-story-overlay').hide()">
                          <img src="<?php echo Kohana::$base_url?>media/img/print_icon.gif" alt="Print this Page"/>
                        </div>                                                                                  
                      </div>                                                                                
                      <div class="news-page-full-story"><?php echo $link->readable_text ?></div>
</div>
