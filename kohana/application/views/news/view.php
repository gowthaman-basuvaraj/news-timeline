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
            <p class="news-page-desc">                                                
        <?php echo $news->description ?>
            </p>                                                
        
            <ul class="news-page-items">                                                
        <?php foreach ($news->links as $link) : ?>
                    <li>                                                                                
            
                        <a href="<?php echo $link->url ?>" target="_blank"><?php echo $link->title ?></a>
                    </li>                                                                                
        <?php endforeach; ?>
        <?php if ($news->story->story_depth <= 2): ?> <!-- can add more only when it it top level story -->
                        <li>                                                                                                            
            <?php echo HTML::anchor("news/add/$news->url_title", "Add Update/Followup") ?>
                    </li>                                                                                    
        <?php endif; ?>
                        <li>                                                                                            
            <?php echo HTML::anchor("news/comment/$news->url_title", "Add Comment") ?>
                    </li>                                                                        
                </ul>                                                                                
                <div class="clear-line"></div>                                                                                
                <div class="news-followup-items">                                                                                
        <?php foreach ($news->stories as $item) : ?>
                            <div class="news-followup-item-container <?php echo Kohana_Text::alternate("followup-item-odd", "followup-item-even") ?>">                    
                                <div class="news-page-followupitem">                                                            
                                    <h2 title="<?php echo $item->url_title ?>"><?php echo $item->title ?></h2>
                                    <div class="news-page-followupitem-content">                                                            
                                        <p class="news-page-desc followup-item">                                                            
                        <?php echo $item->description ?>
                        </p>            
    
                        <ul  class="news-page-items followup-item">            
                        <?php foreach ($item->links as $link) : ?>
                                <li>                            
        
                                    <a href="<?php echo $link->url ?>" target="_blank"><?php echo $link->title ?></a>
                                </li>                            
                                <li><?php echo HTML::anchor("news/view/$item->url_title", "More...") ?></li>
                        <?php endforeach; ?>
                            </ul>                            
                            <div class="clear-line"></div>                            
                            <ul>                            
                        <?php foreach ($item->items as $item) : ?>
                                    <li>                                            
                            <?php echo View::factory("news/item", array("item" => $item)) ?>
        
                                </li>                            
                        <?php endforeach; ?>
                                </ul>                                    
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
        <?php foreach ($news->comments as $comment): ?>
                                   
                                        <div class="news-page-comment-item <?php echo Kohana_Text::alternate("followup-item-odd", "followup-item-even") ?>">
                                            <div class="new-page-comment-item-title ">                                                                                                                                                                
                <?php echo $comment->title ?>  <div class="news-page-comments-postedby"> Posted By <?php echo HTML::anchor("user/".$comment->user->username, $comment->user->username)?></div>
                                    </div>                                                                                                                        
                                    <div class="news-page-comment-item-desc">                                                                                                                        
                <?php echo $comment->comment_body ?>
                                        <div class="news-page-comment-item-action">
                                            <ul>
                                                <li><?php echo HTML::anchor("news/comment/$news->url_title/$comment->url_title","Reply");?></li>
                                            </ul>
                                        </div>
                                    </div>                                                                                                                        
                                </div>                                                                                                                        
        <?php endforeach; ?>
    </div>

</div>
