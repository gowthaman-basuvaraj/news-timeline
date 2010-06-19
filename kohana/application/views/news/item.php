<h2><?php echo $item->title?></h2>
<p>
    <?php echo $item->description?>
</p>

<ul>
    <?php foreach($item->links as $link) :?>
    <li>

        <a href="<?php echo $link->url?>" target="_blank"><?php echo $link->title?></a>
    </li>
    <?php    endforeach; ?>
</ul>

<ul>
    <?php foreach($item->items as $item) :?>
    <li>
    <?php echo View::factory("news/item", array("item"=>$item))?>

    </li>
    <?php    endforeach; ?>
</ul>
