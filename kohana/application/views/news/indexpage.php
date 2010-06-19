<ul>
    <?php if ($user->is_moderator): ?>
        <li><?php echo HTML::anchor("news/add", "Add News") ?></li>
    <?php endif; ?>
    </ul>
    <p>Welcome <?php echo $user->username ?></p>

<?php foreach($today_news->stories as $news): ?>
   
    <div class="news-list-item">
                <div class="news-list-title">
        <?php $link  = $news->links[0];?>
        <a href="<?php echo $link->url?>"><?php echo $news->title ?></a>
        </div>
        <div class="news-list-desc">
        <?php echo $news->description ?>
        </div>
        <div class="news-list-actions">
            <ul>
                <li><?php echo HTML::anchor("news/view/$news->url_title","More...")?></li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>