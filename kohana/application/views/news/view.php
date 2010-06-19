<h2><?php echo $news->title?></h2>
<p>
    <?php echo $news->description?>
</p>

<ul>
    <?php foreach($news->links as $link) :?>
    <li>
       
        <a href="<?php echo $link->url?>" target="_blank"><?php echo $link->title?></a>
    </li>
    <?php    endforeach; ?>
</ul>

<ul>
    <?php foreach($news->items as $item) :?>
    <li>
    <?php echo View::factory("news/item", array("item"=>$item))?>
        
    </li>
    <?php    endforeach; ?>
</ul>
<div class="new-page-actions">
    <ul>
        <li>
            <?php echo HTML::anchor("news/newitem/$news->url_title","Add Update/Followup")?>
        </li>
    </ul>
</div>