
<h2>Update <em><?php echo $exhibit_item['title']; ?></em></h2>
<p class="note">The exhibit title cannot be edited</p>


<?php echo validation_errors(); ?>
<?php $slug=$exhibit_item['slug'] ?>
<?php echo form_open('/exhibits/edit/'+$slug) ?>

      
      
	<input type="hidden" name="title" value="<?php echo $exhibit_item['title']?>"/>
		<div class="row-fluid top-margin">
    <div class="span8">
      <div class="row-fluid">
    <label class="cr"><input type="checkbox" name="on_now" value="1" id="on-now">I would like this exhibit to be the ON NOW exhibit on the home page.</label>
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
    			<div class="span3 labels">
	  				<label for="exhibitor">Exhibitor</label>
	  			</div>
    			<div class="span9"> 
					<input type="input" name="exhibitor" value="<?php echo set_value('exhibitor', $exhibit_item['exhibitor'])?>"/>
				</div>
			</div>
			<div class="row-fluid">
    			<div class="span3 labels">
					<label for="external url">External URL</label> 
				</div>
    			<div class="span9"> 
					<input type="input" name="external_url" value="<?php echo set_value('url', $exhibit_item['external_url'])?>"/>
				</div>
			</div>
			
			<div class="row-fluid">
    			<div class="span3 labels">
					<label for="short_description">Short Description</label>
				</div>
    			<div class="span9"> 
					  <textarea name="short_description" class="description">
						<?php echo set_value('short_description', $exhibit_item['short_description'])?>
					</textarea>
				</div>
			</div>
		</div>

		<div class="span4">
    		<div class="row-fluid">
        		<h3>Display Image</h3>
            	<div class="row-fluid">
               		<img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg"/>
               		
            	</div>
       		</div>
       	</div>
	</div>
	<div class="row-fluid top-margin">
    	<div class="span12">
			<input type="submit" name="submit" value="Update exhibit" class="myButton"/> 
		</div>
	</div>
</form>
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
