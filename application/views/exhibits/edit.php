
<h2>Update <em><?php echo $exhibit_item['title']; ?></em></h2>
<p class="note">The exhibit title cannot be edited</p>


<?php echo validation_errors(); ?>
<?php $slug=$exhibit_item['slug'] ?>
<?php echo form_open('/exhibits/edit/'+$slug) ?>

      
      
	<input type="hidden" name="title" value="<?php echo $exhibit_item['title']?>"/>
	<div class="row-fluid top-margin">
    <div class="span6">
      <div class="row-fluid">
    <label class="cr"><input type="checkbox" name="on_now" value="1" id="on-now">I would like this exhibit to be on the ON NOW exhibit on the home page.</label>
</div>
<div class="row-fluid on-now-info">
  <div class="row-fluid">
    <div class="span4 labels">
     <label for="on-now-info">On Now Details</label> 
     <span class="help-block">Maximum 160 characters</strong></span>
    </div>
    <div class="span8">
     <textarea name="on_now_details" class="description"><?php echo set_value('on_now_details', $exhibit_item['on_now_details'])?></textarea>
    </div>
  </div>
    <div class="row-fluid">
       <div class="span4 labels">
     <label for="on-now-info">On Now Dates</label> 
     <span class="help-block">Example: <strong>March 14 to May 31, 2013</strong></span>
    </div>
    <div class="span8">
     <input type="input" name="on_now_dates" value="<?php echo set_value('on_now_dates', $exhibit_item['on_now_dates'])?>"/> 
    </div>
  </div>
  <div class="row-fluid">
    <div class="span4 labels">
       <label for="display">On Now Display Image</label>
      <span class="help-block">This image will appear on the home page.<br/> <strong>270px wide by 192px high</strong></span>
    </div>
    <div class="span8">
       <input type="file" name="on_now_display" size="20" />
    </div>
  </div>
  
</div>

<div class="row-fluid">
    <div class="span4 labels">
     <label for="exhibitor">Exhibitor</label> 
    </div>
    <div class="span8">
      <input type="input" name="exhibitor" value="<?php echo set_value('exhibitor', $exhibit_item['exhibitor'])?>"/>
    </div>
</div>


<div class="row-fluid">
    <div class="span4 labels">
     <label for="short_description">Short Description</label>
        <span class="help-block">a short teaser about this exhibit (appears on rollover)<br/><strong>80 characters max</strong></span>
     </div>
    <div class="span8">
     <textarea name="short_description" class="description"><?php echo set_value('short_description', $exhibit_item['short_description'])?></textarea>
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
  <label class="cr"><input type="radio" name="exhibit_type" value="0" <?php if(!empty($exhibit_item['exhibit_type']) && ($exhibit_item['exhibit_type']) != 1){echo "checked='checked'";} ?>>to link directly to the external exhibit<br/></label>
  
  <label class="cr"><input type="radio" name="exhibit_type" value="1" <?php if(!empty($exhibit_item['exhibit_type']) && ($exhibit_item['exhibit_type']) != 0){echo "checked='checked'";} ?>>create an intermediate page with more information about the exhibit</label>
  </div>
</div>


<div class="row-fluid">
    <div class="span4 labels">
  <label for="external_url" class="required">External URL</label> 
     </div>
    <div class="span8">
  <input type="input" name="external_url" value="<?php echo set_value('external_url', $exhibit_item['external_url'])?>"/>
   </div>
</div>

</div>
<div class="span6" id="exhibit-more-info">
   <div class="row-fluid">
    <div class="span12 labels">
        <label for="essay" class="essay-label">More Information About This Exhibit</label>
      
    </div>
    <div class="span12 top-margin">
        <textarea name="essay" class="essay" id="essay"><?php echo set_value('essay', $exhibit_item['essay'])?></textarea>
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
<div class="row-fluid">s
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
  <input type="submit" name="submit" value="Update Exhibit" class="myButton" id="submit"/> 
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
          $("#on-now").click(function(){
            
             $(".on-now-info").fadeToggle(400);
       
        
          });

});
</script>
