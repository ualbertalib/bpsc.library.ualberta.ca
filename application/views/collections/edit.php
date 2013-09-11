
<h2>Update <em><?php echo $collection_item['title']; ?></em></h2>
<p class="note">The collection title cannot be edited</p>

<div class="errors">
    <?php if ($upload_error != ''): ?>
        <?php echo $upload_error; ?>
    <?php endif?>
<?php echo validation_errors(); ?>

</div>

<?php $slug=$collection_item['slug'] ?>
<?php echo form_open_multipart('/collections/edit/'+$slug) ?>
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
           
               
	               <?php if (file_exists("assets/uploads/display/".$collection_item['slug'].".jpg")): ?>
            <img src="/assets/uploads/display/<?php echo $collection_item['slug'] ?>.jpg"/>
            <a href="/collections/deleteimage/<?php echo $collection_item['slug'] ?>" class="myButton" id="actions" onclick="return confirm('Delete content?');" >Delete Image</a>


           <?php else: ?>
         <p><strong>no display image</strong></p>
           <?php endif?> 
             

                 <div class="row-fluid">
                <div class="span6 labels">
                     <?php if (file_exists("assets/uploads/display/".$collection_item['slug'].".jpg")): ?>
          <label for="display">Replace Display Image with a New Image</label>
           <?php else: ?>
        <label for="display">Add Display Image</label>
           <?php endif?> 
                     
                    <span class="help-block">This image will appear on the collection list page.<br/> <strong>130px wide by 160px high</strong></span>
                </div>
                <div class="span6">
                     <input type="file" name="display" size="20" />
                </div>
            </div>

         
        <div class="row-fluid">
    <div class="span6 labels">
        <label for="slide">Slide Image(s)</label>
        <span class="help-block">add up to 6 images for each collection.<br/><strong>570px by 570px</strong></span>
    </div>
        <?php for($i = 0; $i < 6; $i++) {
        $image = $collection_item['slug'].$i;
        if (file_exists("assets/uploads/slides/".$image.".jpg")){
            echo ("<img src='/assets/uploads/slides/".$image.".jpg' class='slide-edit' />");
        }
    } 
    ?>
    <div class="span6">
    <div id="input1" style="margin-bottom:4px;" class="clonedInput ">
        <input type="file" name="slide1" id="slide1" size="20" class="slides"/>
        <input type="text" name="caption1" id="caption1" class="span10 captions"  value="<?php if(!empty($_POST['caption1'])){echo ($_POST['caption1']);} ?>"/>
          <label for="caption" class="span10 caption-label">Image Caption</label>
    </div>
</div>
</div>
<div class="row-fluid more-images-buttons">
<div class="span12 offset6">
    <input type="button" id="btnAdd" value="add another slide image" class="span3"/>
    <input type="button" id="btnDel" value="remove image" class="span3" />
</div>
  
    </div>
</div>
</div>
</div>
    
            
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

            $('#btnAdd').click(function() {
                var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.find('.slides').attr('id', 'slide' + newNum).attr('name', 'slide' + newNum);
                newElem.find('.captions').attr('id', 'caption' + newNum).attr('name', 'caption' + newNum);

                // insert the new element after the last "duplicatable" input field
                $('#input' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel').show();
 
                // you can only add 6 slides
                if (newNum == 6)
                    $('#btnAdd').hide();
            });
 
            $('#btnDel').click(function() {
                var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                $('#input' + num).remove();     // remove the last element
 
              
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel').hide();
                 // you can only add 6 slides
                if (num < 7)
                    $('#btnAdd').show();
            });
 
     
          });
    </script>

