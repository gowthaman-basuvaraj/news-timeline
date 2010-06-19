<form name="create-account" action="<?php echo Kohana::$base_url."index.php/news/newitem/$story->url_title"?>" method="POST">
    <div class="form-item">
        <div class="form-label required">Title</div>
        <input placeholder="Title of the Story" class="form-text required" type="text" name="title" value="<?php echo $item->title ?>" />
    </div>
    <input type="hidden" name="story_id" value="<?php echo $story->_id?>" />
    

    <div class="form-item">
        <div class="form-label required">Description</div>
        <textarea placeholder="Description of the Update" class="form-textarea required"  name="description"  ><?php echo $item->description ?></textarea>
    </div>

     <div class="form-item">
        <div class="form-label">Link</div>
        <input  placeholder="News Link" class="form-text" type="url" name="link[]"  />
    </div>
    <div class="form-submit">
        <input type="submit" value="Add News Item" />
    </div>

</form>
