
<h2>Update <em><?php echo $collection_item['title']; ?></em></h2>
<p class="note">The collection title cannot be edited</p>

<?php echo validation_errors(); ?>
<?php $slug=$collection_item['slug'] ?>
<?php echo form_open('/collections/edit/'+$slug) ?>
<div class="row-fluid">
    <div class="span7">

				<input type="hidden" name="title" value="<?php echo $collection_item['title']?>"/>

<div class="row-fluid">
    <div class="span3 labels">
	<label for="collector">Collector</label> 
		 </div>
    <div class="span9">
	<input type="input" name="collector" value="<?php echo set_value('collector', $collection_item['collector'])?>"/>
</div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
	  <label for="catalogue_id">Search Modifier String</label> 
        <span class="help-block">allows the user to search within this collection</span>
		 </div>
    <div class="span9">
	<input type="input" name="catalogue_id" value="<?php echo set_value('catalogue_id', $collection_item['catalogue_id'])?>"/>
</div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
	<label for="external url">External URL</label> 
		 </div>
    <div class="span9">
	<input type="input" name="external_url" value="<?php echo set_value('url', $collection_item['external_url'])?>"/>
</div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
	<label for="collection_type">Collection Type</label> 
    </div>
       <div class="span9 checks">
   <ul class="types">
  
            <?php foreach ($types_array as $type): ?>
               <li><input type="checkbox" id="<?php echo $type ?>" value="<?php echo $type ?>" class="type-checkbox" <?php if(!empty($collection_item['collection_type']) && (strpos($collection_item['collection_type'], $type) !== false)){echo "checked=checked";} ?>/>
               <label for="<?php echo $type ?>"><?php echo ucfirst(str_replace('-', ' ', $type)) ?></label></li>
            <?php endforeach ?>
            
        </ul>
    </div>
        <div class="types"></div>
</div>
	
<div class="row-fluid">
      <div class="span3 labels">
     <h3>Subjects</h3>
       <span class="help-block">subjects that describe this collection</span>
    </div>
       <div class="span9 checks">
        <ul class="subs">
            <?php foreach ($subjects_array as $sub): ?>
               <li><input type="checkbox" id="<?php echo $sub ?>" value="<?php echo $sub ?>" class="sub-checkbox" <?php if(!empty($collection_item['subjects']) && (strpos($collection_item['subjects'], $sub) !== false)){echo "checked=checked";} ?>/>
               <label for="<?php echo $sub ?>"><?php echo ucfirst(str_replace('-', ' ', $sub)) ?></label></li>
            <?php endforeach ?>
            
        </ul>
        <div class="subjects"></div>
    </div>
 

</div>
<div class="row-fluid">
    <div class="span3 labels">
	<label for="short_description">Short Description</label>
		 </div>
    <div class="span9">
	  <textarea name="short_description" class="description">
		<?php echo set_value('short_description', $collection_item['short_description'])?>
	</textarea><br />
</div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
	<label for="essay">Essay</label>
		 </div>
    <div class="span9">
	    <textarea name="essay" class="essay" id="essay"><?php echo $collection_item['essay']?></textarea>
<?php echo display_ckeditor($ckeditor); ?>
	</div>
</div>
</div>
<div class="span5">
    <div class="row-fluid">
        <h3>Display Image</h3>
           
               
	              
                <img src="/assets/uploads/display/<?php echo $collection_item['slug'] ?>.jpg"/>
         
        <div class="row-fluid top-margin">
    <div class="span12">
        <h3>Slide Image(s)</h3>

    
                <?php for($i = 0; $i < 6; $i++) {
        $image = $collection_item['slug'].$i;
        if (file_exists("assets/uploads/slides/".$image.".jpg")){
            echo ("<img src='/assets/uploads/slides/".$image.".jpg' class='slide-edit' />");
        }
    } 
    ?>
</div>
</div>

</div>
</div>
</div>

<div class="row-fluid top-margin">
    
<div class="span12">
	<input type="submit" name="submit" value="Update Collection" class="myButton" id="submit"/> 
</div>
    </div>

</form>
 <script type="text/javascript">
        $(document).ready(function() {
          $( ".sub-checkbox, .type-checkbox" ).on( "click", function() {
                var subjectlist = $('input:checkbox:checked.sub-checkbox').map(function () {
                    return this.value;
                }).get().join(',');
                 var types = $('input:checkbox:checked.type-checkbox').map(function () {
                    return this.value;
                }).get().join(',');
            $("div.subjects").html('<input type="hidden" value="'+subjectlist+'" name="subjects"/>');
            $("div.types").html('<input type="hidden" value="'+types+'" name="collection_type"/>');
            
             });
          });
    </script>

