<div class="news-page-container">
  <div class="span-16 last">
    <h5 class="news-page-title"> <?= newsutils::get_newstitle($news) ?></h5>
  </div>      
  <div class="span-16 last">
    Posted on <?= date("d/m/Y", $news->story_date) ?> by <?= HTML::anchor("user/" . $news->user->username, $news->user->username) ?>
  </div>

  <div class="news-page-content span-16 last">    

    <div class="news-page-desc span-11 "><?= $news->description ?></div>   
    <div class="span-5 last">
      <img class="news-page-image" src="<?= $news->story_image ?>" onerror="<?= $news->local_cache ?>" alt="story image"/>
    </div>
    <div class="news-page-links-container span-15 ">                                                                                                                  
      <? foreach ($news->links as $link) : ?>      
        <div class="news-page-link">                                                                                                                                                                                                                        
          <a class="news-page-original-url" href="<?= $link->url ?>" target="_blank" title="<?= newsutils::get_urltitle($link) ?>">                
            <img src="<?= $link->favicon; ?>" class="favicon"/> <?= $link->title ?>
          </a>                                                                                  
        </div>                                                        
      <? endforeach; ?>  
        <div class="news-page-link">                                                                                                   
          <a class="add-followup-link vote no-img" href="javascript:void(0)" > Add Update/Followup </a>                                                                                                                                                 
        </div>                                                                                                                                                  
      </div>                                                                                                                                                                                                                                                                                                                          
    </div>                                                                                                                                                                                                                                                                                                                         
  
    <div class="news-followup-items span-16 last"> <? foreach ($followups as $item)
          echo View::factory("news/item", array("item" => $item)); ?> </div> 
    
      <div class="news-page-comments-container">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        <div class="news-page-comments-title span-16 last">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
          Comments                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
        <div class="comment-form-container span-16 last">                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
          <p class="container-title">New Comment</p>                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
          <div class="comment-container <?= $logged_user ? "" : "hidden" ?>">    
            <form action="<?= Kohana::$base_url ?>index.php/news/comment/<?= $news->url_title ?>" method="POST">
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
          </div>                            
        </div>                   
    <?
        foreach ($story_comments as $comment) {
         
          echo View::factory("news/comment", array("comment" => $comment, "news" => $news, "logged_user" => $logged_user, "shift"=>0));
        }
    ?>
        <div class="news-page-comment-item followup-item-odd <?= count($story_comments) == 0 ? "" : "hidden" ?>">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
          Be the First to say something                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        </div>          
      </div>         
    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
    <div class="comment-reply-form-container comment hidden">      
      <form action="<?= Kohana::$base_url ?>index.php/news/comment/<?= $news->url_title ?>" method="POST">
    <div class="form-item">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
      <div class="form-label required">Title</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
      <input placeholder="Comment Title" class="form-text required long-text" type="text" name="title"  />                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
    <div class="form-item">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
      <div class="form-label required">Comment</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
      <textarea name="comment_body" placeholder="Say something"></textarea>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
    <div class="form-submit">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
      <input type="submit" value="Say it" />                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     

  </form>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       

</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         

