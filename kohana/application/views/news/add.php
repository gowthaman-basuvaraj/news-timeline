<form name="create-account" action="<?php echo Kohana::$base_url."index.php/news/add"?>" method="POST">
    <div class="form-item">
        <div class="form-label required">Title</div>
        <input placeholder="Title of the News" class="form-text required" type="text" name="title" value="<?php echo $news->title ?>" />
    </div>

    <div class="form-item">
        <div class="form-label required">Description</div>
        <textarea placeholder="Description of the news" class="form-textarea required"  name="description"  ><?php echo $news->description ?></textarea>
    </div>   

     <div class="form-item">
        <div class="form-label">Link</div>
        <input  placeholder="News Link" class="form-text" type="url" name="link[]"  />
    </div>
    <div class="form-submit">
        <input type="submit" value="Add News" />
    </div>

</form>
