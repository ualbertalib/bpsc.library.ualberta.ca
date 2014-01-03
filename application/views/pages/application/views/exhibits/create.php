<h2>Create a Link to an Online Exhibit</h2>

<div class="errors">
	<?php if ($upload_error != ''): ?>
		<?php echo $upload_error; ?>
	<?php endif?>

<?php echo validation_errors(); ?>
</div>

<?php echo form_open_multipart('exhibits/create') ?>

<div class="row-fluid top-margin">
    <div class="span6">
<div class="row-fluid">
    <div class="span4 labels">
	   <label for="title" class="required">Exhibit Title</label> 
    </div>
    <div class="span8">
	   <input type="input" name="title" value="<?php if(!empty($_POST['title'])){echo set_value('title', $_POST['title']);} ?>"/>
    </div>
</div>
<div class="row-fluid">
    <div class="span4 labels">
	   <label for="exhibitor">Exhibitor</label> 
    </div>
    <div class="span8">
	   	<input type="input" name="exhibitor" value="<?php if(!empty($_POST['exhibitor'])){echo set_value('exhibitor', $_POST['exhibitor']);} ?>"/>
    </div>
</div>


<div class="row-fluid">
    <div class="span4 labels">
	   <label for="short_description">Short Description</label>
        <span class="help-block">a short teaser about this exhibit (appears on rollover)<br/><strong>80 characters max</strong></span>
     </div>
    <div class="span8">
	   <textarea name="short_description" class="description"><?php if(!empty($_POST['short_description'])){echo set_value('short_description', $_POST['short_description']);} ?></textarea>
    </div>
</div>

 <div class="row-fluid">
    <div class="span4 labels">
	     <label for="display">Display Image</label>
      <span class="help-block">This image will appear on the exhibit list page.<br/> <strong>130px wide by 160px high</strong></span>
    </div>
    <div class="span8">
	     <input type="file" name="exdisplay" size="20" />
    </div>
  </div>
   <div class="row-fluid">
    <div class="span12 labels">
  <p>All online exhibits <strong>must</strong> have an external URL. Would you like: <p>
  <input type="radio" name="exhibit_type" value="0" <?php if(!empty($_POST['exhibit_type']) && ($_POST['exhibit_type']) != 1){echo "checked='checked'";} ?>>to link directly to the external exhibit<br/>
  
  <input type="radio" name="exhibit_type" value="1" <?php if(!empty($_POST['exhibit_type']) && ($_POST['exhibit_type']) != 0){echo "checked='checked'";} ?>>create an intermediate page with more information about the exhibit
  </div>
</div>


<div class="row-fluid">
    <div class="span4 labels">
  <label for="external_url" class="required">External URL</label> 
     </div>
    <div class="span8">
  <input type="input" name="external_url" />
   </div>
</div>

</div>
<div class="span6" id="exhibit-more-info">
   <div class="row-fluid">
    <div class="span12 labels">
        <label for="essay" class="essay-label">More Information About This Exhibit</label>
      
    </div>
    <div class="span12 top-margin">
        <textarea name="essay" class="essay" id="essay"><?php if(!empty($_POST['essay'])){echo set_value('essay', $_POST['essay']);} ?></textarea>
        <?php echo display_ckeditor($ckeditor); ?>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span6 labels">
        <label for="slide">Slide Image(s)</label>
        <span class="help-block">add up to 6 images for each collection.<br/><strong>570px by 570px</span>
    </div>
    <div class="span6">
    <div id="input1" style="margin-bottom:4px;" class="clonedInput ">
        <input type="file" name="slide1" id="slide" size="20"/>
    </div>
</div>
</div>
<div class="row-fluid">
<div class="span12 offset6">
    <input type="button" id="btnAdd" value="add another slide image" class="span3"/>
    <input type="button" id="btnDel" value="remove image" class="span3" />
</div>
  
    </div>
</div>
</div>
</div>


<div class="row-fluid top-margin">

    
<div class="span12">
	<input type="submit" name="submit" value="Create Exhibit" class="myButton" id="submit"/> 
</div>
    </div>

</form>
</div>
<script>
$(document).ready(function(){ 
      $(":radio:eq(1)").click(function(){
             $("#exhibit-more-info").fadeIn(800);
          });

          $(":radio:eq(0)").click(function(){
             $("#exhibit-more-info").fadeOut(800);
          });
});
</script>
