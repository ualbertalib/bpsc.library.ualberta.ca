<h2>Create an Exhibition</h2>

<div class="errors">
<?php 
	
	
	$upload_error = $upload_error ?? '';
  if ($upload_error != ''){ 
     echo $upload_error; 
  }
   
   $errors = $errors ?? array();
   foreach ($errors as $error){
		echo esc($error);
	  } 

?>
</div>
<?php print_r(validation_list_errors()); ?>


<?php echo form_open_multipart('/admin/exhibits/create') ?>

<div class="row-fluid top-margin">
    <div class="span6">
      <div class="row-fluid">
    <label class="cr"><input type="checkbox" name="on_now" value="1" id="on-now">I would like this exhibition to be on the ON NOW exhibit on the home page.</label>
</div>
<div class="row-fluid on-now-info">
  <div class="row-fluid">
    <div class="span4 labels">
     <label for="on-now-info">On Now Details</label> 
     <span class="help-block">Maximum 160 characters</strong></span>
    </div>
    <div class="span8">
     <textarea name="on_now_details" class="description"><?php if(!empty($_POST['on_now_details'])){echo set_value('on_now_details', $_POST['on_now_details']);} ?></textarea>
    </div>
  </div>
    <div class="row-fluid">
       <div class="span4 labels">
     <label for="on-now-info">On Now Dates</label> 
     <span class="help-block">Example: <strong>March 14 to May 31, 2013</strong></span>
    </div>
    <div class="span8">
     <input type="input" name="on_now_dates" value="<?= old('on_now_dates') ?>"/> 
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
     <label for="title" class="required">Exhibition Title</label> 
    </div>
    <div class="span8">
     <input type="input" name="title" value="<?= old('title') ?>"/>
    </div>
</div>
<div class="row-fluid">
    <div class="span4 labels">
     <label for="exhibitor">Exhibitor</label> 
    </div>
    <div class="span8">
      <input type="input" name="exhibitor" value="<?= old('exhibitor') ?>"/>
    </div>
</div>

<div class="row-fluid">
    <div class="span4 labels">
    <label for="collection_type">Exhibition Type</label> 
     </div>
     <div class="span8 checks">
   <ul class="types">
  
            <?php foreach ($ex_subjects_array as $type): ?>
               <li><input type="checkbox" id="<?php echo $type ?>" value="<?php echo $type ?>" class="sub-checkbox"/>
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
     <textarea name="short_description" class="description"><?= old('short_description') ?></textarea>
    </div>
</div>
<div class="row-fluid">
    <div class="span4 labels">
     <label for="exhibit_year">Exhibit Year</label>
        <span class="help-block">The year in which the exhibit started</span>
     </div>
    <div class="span8">
     <input type="input" name="exhibit_year"><?= old('exhibit_year') ?></input>
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
  <p>Would you like: <p>
  <label class="cr"><input type="radio" name="exhibit_type" value="0" <?php if( old('exhibit_type') != 1){echo "checked='checked'";} ?>>to link directly to the external exhibit<br/></label>
  
  <label class="cr"><input type="radio" name="exhibit_type" value="1" <?php if( old('exhibit_type') != 0){echo "checked='checked'";} ?>>create an intermediate page with more information about the exhibit</label>
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
        <textarea name="essay" class="essay" id="essay"><?= old('essay') ?></textarea>
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
        <input type="file" name="slide1" id="slide1" size="20" class="slides"/>
        <input type="text" name="caption1" id="caption1" class="span10 captions"  value="<?= old('caption1') ?>"/>
          <label for="caption" class="span10 caption-label">Image Caption</label>
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
      $( ".sub-checkbox" ).on( "click", function() {
          var subjects = $('input:checkbox:checked.sub-checkbox').map(function () {
          return this.value;
        }).get().join(',');
        $("div.subjects").html('<input type="hidden" value="'+subjects+'" name="subjects"/>');
      });
        
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
