<div class="news-followup-item-container <?= Kohana_Text::alternate("followup-item-odd", "followup-item-even") ?>">                    
  <div class="span-1">&nbsp;</div>                                                      
  <div class="span-15 last">                                                      
    <div class="span-15 last">                                 
      <div class="span-15 last">                               
        <h5 title="<?= $item->url_title ?>"><?= $item->title ?></h5>
      </div>                              
      <div class="span-12">                                                
        <div class="news-page-followupitem-content span-12 last">                                                                                                                                                                                                                                                        
          Posted on <?= date("d/m/Y", $item->story_date) ?> by <?= HTML::anchor("user/" . $item->user->username, $item->user->username) ?>
          <div class="news-page-desc followup-item"><?= substr($item->description, 0, 400); ?> </div>                                                                                                                                                               

          <div class="news-page-links-container">                                                                                                                                                                                                         
            <? foreach ($item->links as $link) : ?>
              <div class="news-page-link">                                                                                                                                                                                                                         
                <a class="news-page-original-url" href="<?= $link->url ?>" target="_blank" title="<?= htmlentities($link->title) ?>">
                  <img src="<?= $link->favicon ?>" class="favicon"/>                                       
                <?= $link->title ?>
              </a>                             
            </div>                                         
            <? endforeach; ?>
                <div class="new-page-link">                
                  <a class="news-page-original-url" href="<?= Kohana::$base_url . "index.php/news/view/$item->url_title" ?>" target="_blank" title="<?= newsutils::get_urltitle($item) ?>">More... </a>    
                </div>                
              </div>                      
            </div>                                        
          </div>                                          
          <div class="span-3 last">                                          
            <img class="news-page-followup-image" src="<?= $item->story_image ?>" onerror="<?= $item->local_cache ?>" />
      </div>                    
    </div>       
  </div>         
</div>        