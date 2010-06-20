<form action="<?php echo Kohana::$base_url . "index.php/news/comment/$original_story->url_title" ?>"  method="POST" >
    <div class="form-item">
        <div class="form-label required">Title</div>
        <input placeholder="Title for the comment" class="form-text required" type="text" name="title"  />
    </div>
    <div class="form-item">
        <div class="form-label required">Comment</div>
        <textarea placeholder="Write something Here" class="form-text required" type="text" name="comment_body"></textarea>
    </div>
    <div class="form-item">
        <div class="form-label">Link</div>
        <input  placeholder="News Link" class="form-text" type="url" name="link[]"  />
    </div>
    <div class="form-submit">
        <input type="submit" value="Add Comment" />
    </div>

</form>
