<?php 
$form_url = Kohana::$base_url."index.php/news/add";
if($original_story!=null && $original_story->loaded()){
    $form_url .="/$original_story->url_title";
}
?>
<form name="create-account" action="<?php echo $form_url?>" method="POST">
    <div class="form-item">
        <div class="form-label required">Title</div>
        <input placeholder="Title of the News" class="form-text required" type="text" name="title" value="<?php echo $news->title ?>" />
    </div>

    <div class="form-item">
        <div class="form-label required">Description</div>
        <textarea placeholder="Description of the news" class="form-textarea required"  name="description"  ><?php echo $news->description ?></textarea>
    </div>  
    
    <div class="form-item">
        <div class="form-label required">Date Of the News</div>
        <input placeholder="Date of the News" id="story_date-date" class="date-picker form-text required" type="text" value="<?php echo date("d-m-Y",$news->story_date) ?>" />
        <input type="hidden" name="story_date"  id="story_date" value="<?php echo $news->story_date ?>"/>
    </div>  

     <div class="form-item">
        <div class="form-label">Link</div>
        <input  placeholder="News Link" class="form-text" type="url" name="link[]"  />
    </div>
    <div class="form-submit">
        <input type="submit" value="Add News" />
        <?php if(isset($subitem)): ?>
         <input type="reset" value="Cancel" onclick="$('<?php echo $subitem?>').toggle()"/>
        <?php endif; ?>
    </div>

</form>
