
<h2>Create a collection</h2>

<div class="errors">
    <?php if ($upload_error != ''): ?>
        <?php echo $upload_error; ?>
    <?php endif?>

<?php echo(validation_list_errors()); ?>

</div>

<?php echo form_open_multipart('admin/collections/create') ?>
<div class="row-fluid">
    <div class="span7">
<div class="row-fluid">
    <div class="span3 labels">
       <label for="title">Title</label> 
    </div>
    <div class="span9">
       <input type="input" name="title" value="<?php if(!empty($_POST['title'])){echo set_value('title', $_POST['title']);} ?>"/>
    </div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
       <label for="collector">Collector</label> 
    </div>
    <div class="span9">
       <input type="input" name="collector" value="<?php if(!empty($_POST['collector'])){echo set_value('collector', $_POST['collector']);} ?>"/>
    </div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
        <label for="catalogue_id">Search Modifier String</label> 
        <span class="help-block">allows the user to search within this collection</span>
    </div>
    <div class="span9">
       <input type="input" name="catalogue_id" value="<?php if(!empty($_POST['catalogue_id'])){echo set_value('catalogue_id', $_POST['catalogue_id']);} ?>"/>
    </div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
    <label for="external_url">External URL</label> 
     </div>
    <div class="span9">
    <input type="input" name="external_url" value="<?php if(!empty($_POST['external_url'])){echo set_value('external_url', $_POST['external_url']);} ?>" />
   </div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
    <label for="collection_type">Collection Formats</label> 
     </div>
     <div class="span9 checks">
   <ul class="types">
  
            <?php foreach ($types_array as $type): ?>
               <li><input type="checkbox" id="<?php echo $type ?>" value="<?php echo $type ?>" class="type-checkbox" <?php if(!empty($_POST['collection_type']) && (strpos($_POST['collection_type'], $type) !== false)){echo "checked=checked";} ?>/>
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
               <li><input type="checkbox" id="<?php echo $sub ?>" value="<?php echo $sub ?>" class="sub-checkbox" <?php if(!empty($_POST['subjects']) && (strpos($_POST['subjects'], $sub) !== false)){echo "checked=checked";} ?>/>
               <label for="<?php echo $sub ?>"><?php echo ucfirst(str_replace('-', ' ', $sub)) ?></label></li>
            <?php endforeach ?>
            
        </ul>
        <div class="subjects"></div>
    </div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
       <label for="short_description">Short Description</label>
        <span class="help-block">a short teaser about this collection<br/><strong>80 characters max</strong></span>
     </div>
    <div class="span9">
       <textarea name="short_description" class="description"><?php if(!empty($_POST['short_description'])){echo set_value('short_description', $_POST['short_description']);} ?></textarea>
    </div>
</div>
<div class="row-fluid">
    <div class="span3 labels">
        <label for="essay">Essay</label>
        <span class="help-block">The main information about this collection. This will work with the slide images to really describe the holding.</span>
    </div>
    <div class="span9">
        <textarea name="essay" class="essay" id="essay"><?php if(!empty($_POST['essay'])){echo set_value('essay', $_POST['essay']);} ?></textarea>
        <?php echo display_ckeditor($ckeditor); ?>
    </div>
</div>
</div>
<div class="span5">
    <div class="row-fluid">
        <h3>Add Images</h3>
            <div class="row-fluid">
                <div class="span6 labels">
                     <label for="display">Display Image</label>
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
    <div class="span6">
    <div id="input0" style="margin-bottom:4px;" class="clonedInput">
        <input type="file" name="slide0" id="slide0" size="20" class="slides"/>
        <input type="text" name="caption0" id="caption0" class="span10 captions"  value="<?php if(!empty($_POST['caption0'])){echo ($_POST['caption0']);} ?>"/>
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

<div class="row-fluid top-margin">
    
<div class="span12">
    <input type="submit" name="submit" value="Create Collection" class="myButton" id="submit"/> 
</div>
    </div>

</form>

 <script type="text/javascript">
        $(document).ready(function() {
            $( ".sub-checkbox, .type-checkbox" ).on( "click", function() {
                var subjects = $('input:checkbox:checked.sub-checkbox').map(function () {
                    return this.value;
                }).get().join(',');
                 var types = $('input:checkbox:checked.type-checkbox').map(function () {
                    return this.value;
                }).get().join(',');
            $("div.subjects").html('<input type="hidden" value="'+subjects+'" name="subjects"/>');
             $("div.types").html('<input type="hidden" value="'+types+'" name="collection_type"/>');
            
          
          });

            $('#btnAdd').click(function() {
                var num     = $('.clonedInput').length - 1 ; // how many "duplicatable" input fields we currently have
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
                var num = $('.clonedInput').length - 1; // how many "duplicatable" input fields we currently have
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