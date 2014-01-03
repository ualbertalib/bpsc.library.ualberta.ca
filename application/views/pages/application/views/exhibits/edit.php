
<h2>Update <em><?php echo $exhibit_item['title']; ?></em></h2>
<p class="note">The collection title cannot be edited</p>


<?php echo validation_errors(); ?>
<?php $slug=$exhibit_item['slug'] ?>
<?php echo form_open('/exhibits/edit/'+$slug) ?>
<div class="row-fluid">
    <div class="span7">
      
      
					<input type="hidden" name="title" value="<?php echo $exhibit_item['title']?>"/>
				
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
					<label for="exhibit type">exhibit Type</label> 
				</div>
    			<div class="span9"> 
					<input type="input" name="exhibit_type" value="<?php echo set_value('type', $exhibit_item['exhibit_type'])?>"/>
				</div>
			</div>
			<div class="row-fluid">
    			<div class="span3 labels">
					<label for="subjects">Subjects</label>
				</div>
    			<div class="span9">  
					<input type="input" name="subjects" value="<?php echo set_value('subjects', $exhibit_item['subjects'])?>"/>
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
		<div class="span5">
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
