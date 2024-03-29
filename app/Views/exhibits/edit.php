<?php 
	$session = \Config\Services::session();
?>
<?php echo "<div class='alert-success'>" . $session->getFlashdata('message') ."</div>"; ?>

<h2>Update <em><?php echo $exhibit_item['title']; ?></em></h2>
<p class="note">The exhibit title cannot be edited</p>
<div class="errors">
  <?php if ($upload_error != ''): ?>
    <?php echo $upload_error; ?>
  <?php endif?>
  <?php foreach ($errors as $error){
		echo $error;
	  } ?>
</div>

<?php print_r(validation_list_errors()); ?>

 

<?php $slug=$exhibit_item['slug'] ?>
<?php echo form_open_multipart('/admin/exhibits/edit/' . $slug) ?>
<input type="hidden" name="title" value="<?php echo $exhibit_item['title']?>"/>
<div class="row-fluid top-margin">
  <div class="span6">
    <div class="row-fluid">
      <label class="cr">
        <input type="checkbox" name="on_now" value="1" id="on-now" <?php if(!empty($exhibit_item['on_now'])&&($exhibit_item['on_now']==1)){echo "checked=checked";} ?>>I would like this exhibit to be on the ON NOW exhibit on the home page.
      </label>
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
    <label for="collection_type">Exhibition Type</label> 
     </div>
     <div class="span8 checks">
   <ul class="types">
  
            <?php foreach ($ex_subjects_array as $type): ?>
               <li><input type="checkbox" id="<?php echo $type ?>" value="<?php echo $type ?>" class="sub-checkbox" 
                <?php if  ($exhibit_item['subjects']== $type): ?> 
                  checked="checked"
                <?php endif?> 
                />
               <label for="<?php echo $type ?>"><?php echo ucfirst(str_replace('-', ' ', $type)) ?></label></li>
            <?php endforeach ?>
          
        </ul>
    </div>
        <div class="subjects"></div>
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
     <label for="exhibit_year">Exhibit Year</label>
        <span class="help-block">The year in which the exhibit started</span>
     </div>
    <div class="span8">
     <input type="input" name="exhibit_year" value="<?php echo $exhibit_item['exhibit_year'] ?>" />
    </div>
</div>
 <div class="row-fluid">
    <div class="span12">
      <h3>Update Display Image</h3>
    </div>
    <div class="span4 labels">
      
        <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
          <label for="display">Replace Display Image with a New Image</label><span class="help-block">This image will appear on the exhibit list page.<br/> <strong>130px wide by 160px high</strong></span>
        <?php else: ?>
          <label for="display">Add Display Image</label><span class="help-block">This image will appear on the exhibit list page.<br/> <strong>130px wide by 160px high</strong></span>
        <?php endif?> 
      </div>   
                   
             <div class="span4">
              
                     <input type="file" name="display" size="20" />
               </div>
           
                 <div class="span3">
                 <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
            <img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg"/></br>
            <a href="/admin/exhibits/deleteimage/<?php echo $exhibit_item['slug'] ?>" class="myButton" id="actions" onclick="return confirm('Delete content?');" >Delete Image</a>


           <?php else: ?>
         <p><strong>no display image</strong></p>
           <?php endif?> 
             </div>



</div>
   <div class="row-fluid top-margin">
    <div class="span12 labels">
  <p>All online exhibits <strong>must</strong> have an external URL. Would you like: 
  <label class="cr"><input type="radio" name="exhibit_type" value="0" <?php if($exhibit_item['exhibit_type'] != 1){echo "checked='checked'";} ?>>to link directly to the external exhibit<br/></label>
  
  <label class="cr"><input type="radio" name="exhibit_type" id ="inter" value="1" <?php if($exhibit_item['exhibit_type'] != 0){echo "checked='checked'";} ?>>create an intermediate page with more information about the exhibit</label>
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
        
           <hr/>
        <div class="row-fluid top-margin">
           <h3>Slide Images</h3> 
           
  <?php 
        /*for($i = 0; $i < 6; $i++) {
          $slug = $exhibit_item['slug'];
          $image = $exhibit_item['slug'].$i;
          if (file_exists("assets/uploads/slides/".$image.".jpg")){
            $cap = $i+1;
            $capname = 'caption'.$cap;
            echo ("<div class='row-fluid'><div class='span6'><img src='/assets/uploads/slides/".$image.".jpg' class='slide-edit' /></div><div class='span6'> <a href='/admin/exhibits/deleteslideimage/".$slug."/".$image."' class='myButton' id='actions' onclick='return confirm(\"Delete Image?\");'>Delete Image</a></div></div>");
            echo ("<div class='row-fluid'><div class='span2'><label for='caption' class='caption-label'>Image Caption</label></div><div class='span6'><input type='text' name='".$capname."' id='".$capname."' class='captions' value='".set_value($capname, $exhibit_item[$capname])."'/></div></div> <hr/>");
          }
        }
        if ((file_exists("assets/uploads/slides/".$slug.".jpg"))&&(!file_exists("assets/uploads/slides/".$slug."1.jpg"))){
            $cap = 1;
        }
         if (!file_exists("assets/uploads/slides/".$slug.".jpg")){
          $cap = 0;
         }*/
		 
		 
		 $slideCounter=0;
        for($i = 0; $i <= 6; $i++) {
          $slug = $exhibit_item['slug'];
          $image = $exhibit_item['slug'].$i;
          if (file_exists("assets/uploads/slides/".$image.".jpg")){
            
            $capname = 'caption'.$i;
            echo ("<div class='row-fluid'><div class='span6'><img src='/assets/uploads/slides/".$image.".jpg' class='slide-edit' /></div><div class='span6'> <a href='/admin/exhibits/deleteslideimage/".$slug."/".$image."' class='myButton' id='actions' onclick='return confirm(\"Delete Image?\");'>Delete Image</a></div></div>");
            echo ("<div class='row-fluid'><div class='span2'><label for='caption' class='caption-label'>Image Caption</label></div><div class='span6'><input type='text' name='".$capname."' id='".$capname."' class='captions' value='".set_value($capname, $exhibit_item[$capname])."'/></div></div> <hr/>");
			$slideCounter = $i+1; 
          }
        }
		
		
    ?>
  </div>
        <div class="row-fluid">
            <div class="span6 labels">
                <label for="display">Add Slide Image(s)</label>
                <span class="help-block">add up to 6 images for each exhibit.<br/><strong>570px by 570px</strong></span>
              </div>
 <div class="span6">
    <div id="input1" style="margin-bottom:4px;" class="clonedInput">
        <input type="file" name="slide<?php echo $slideCounter; ?>" id="slide<?php echo $slideCounter; ?>" size="20" class="slides"/>
        <input type="text" name="caption<?php echo $slideCounter; ?>" id="caption<?php echo $slideCounter; ?>" class="span10 captions" />
          <label for="caption" class="span10 caption-label">Image Caption</label>
    </div>
</div>
</div>
<div class="row-fluid more-images-buttons">
<div class="span12 offset3">
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
  <input type="submit" name="submit" value="Update Exhibit" class="myButton" id="submit"/> 
</div>
    </div>

</form>
</div>
<script>
    $(document).ready(function(){ 
         $("div.subjects").html('<input type="hidden" value="<?php echo $exhibit_item['subjects'] ?>" name="subjects"/>');
           $( ".sub-checkbox" ).on( "click", function() {
          var subjects = $('input:checkbox:checked.sub-checkbox').map(function () {
          return this.value;
        }).get().join(',');
        $("div.subjects").html('<input type="hidden" value="'+subjects+'" name="subjects"/>');
      });
          if ($('#on-now').is(":checked")){
            $(".on-now-info").show();
          } 
          if ($("#inter").is(":checked")){
            $("#exhibit-more-info").show();
          }
          $(":radio:eq(1)").click(function(){
            $("#exhibit-more-info").fadeIn(800);
          });

          $(":radio:eq(0)").click(function(){
             $("#exhibit-more-info").fadeOut(800);
          });
         
          $("#on-now").click(function(){
             $(".on-now-info").fadeToggle(400);
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