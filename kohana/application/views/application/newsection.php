<form action="<?= Kohana::$base_url."index.php/news/newsection"?>" method="POST">
    <div class="form-item">
         <div class="form-label required">Title</div>
        <input placeholder="Title of the Section" class="form-text required" type="text" name="section_title" />
    </div>
    <div class="form-item">
         <div class="form-label required">Name</div>
        <input placeholder="Name Of the Section" class="form-text required" type="text" name="section_name" />
    </div>
    <div class="form-item">
        <div class="form-label">Description</div>
        <textarea placeholder="Description of the Section" name="section_desc"></textarea>
    </div>
     <div class="form-submit">
        <input type="submit" value="Add News" class="submit_button" />
        <?php if(isset($subitem)): ?>
         <input type="reset" value="Cancel" class="reset_button" onclick="$('<?php echo $subitem?>').toggle()"/>
        <?php endif; ?>
    </div>
</form>