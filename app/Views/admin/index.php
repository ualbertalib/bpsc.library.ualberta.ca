<?php 
	$session = \Config\Services::session();
?>
<div class="row-fluid">
  <div class="span12 admin"> 
    <div class="container">
     <?php if ($session->getFlashdata('message') != ''): ?>
         <script type="text/javascript">
          $(document).ready(function() {  
               $.jGrowl.defaults.position = 'top-left';
           $.jGrowl("<?php echo $session->getFlashdata('message') ?>");  
          });
         </script>
      <?php endif?>

    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="span12 main-content">
    <div class="container">
      <h2>Admin <a href="/logout" class="myButton" id="logout">logout</a> </h2>

    
     
    
    </div>
  </div>
</div>
<?php print_r(validation_list_errors()); ?>
<div class="row-fluid top-margin">
  <div class="span12 main-content">
    <h3>Research Collections</h3>
    
            <a href="admin/collections/create" class="myButton" id="noleftmargin">Create a new Collection</a>
    <ul class="admin-list">
      <?php foreach ($collections as $collection_item): ?>
        <li> 
         
          <a href="/admin/collections/edit/<?php echo $collection_item['slug'] ?>" class="myButton" id="actions">Edit</a> 
          <a href="/admin/collections/delete/<?php echo $collection_item['slug'] ?>" onclick="return confirm('Delete content?');" class="myButton" id="actions">Delete</a>
            <?php if (file_exists("assets/uploads/display/".$collection_item['slug'].".jpg")): ?>
          <a href="collections/<?php echo $collection_item['slug'] ?>"><img src="/assets/uploads/display/<?php echo $collection_item['slug'] ?>.jpg" width="100px"/></a> 
           <?php else: ?>
             <a href="collections/<?php echo $collection_item['slug'] ?>"><img src="/assets/img/noimage.jpg" width="100px"/></a> 
           <?php endif?>
         <h3><a href="collections/<?php echo $collection_item['slug'] ?>"><?php echo $collection_item['title'] ?></a></h3>
        </li> 
      <?php endforeach ?>
    </ul>
  </div>
</div>
<div class="row-fluid top-margin">
  <div class="span12 main-content">
    <h3>Online Exhibits</h3>
             <a href="admin/exhibits/create" class="myButton" id="noleftmargin">Create a new Exhibition</a>
    <ul class="admin-list">
      <?php foreach ($exhibits as $exhibit_item): ?>
        <li>
        
          <a href="/admin/exhibits/edit/<?php echo $exhibit_item['slug'] ?>" class="myButton" id="actions">Edit</a> 
          <a href="/admin/exhibits/delete/<?php echo $exhibit_item['slug'] ?>" onclick="return confirm('Delete content?');" class="myButton" id="actions">Delete</a>
           <?php if($exhibit_item['exhibit_type'] != '1'): ?>
              <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
                <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg" width="100px"/></a> 
              <?php else: ?>
                <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/img/noimage.jpg" width="100px"/></a> 
              <?php endif?>
              <h3><a href="<?php echo $exhibit_item['external_url'] ?>"><?php echo $exhibit_item['title'] ?></a></h3>
            <?php else: ?>
              <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
                <a href="exhibits/<?php echo $exhibit_item['slug'] ?>"><img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg" width="100px"/></a> 
              <?php else: ?>
                <a href="exhibits/<?php echo $exhibit_item['slug'] ?>"><img src="/assets/img/noimage.jpg" width="100px"/></a> 
              <?php endif?>
              <h3><a href="exhibits/<?php echo $exhibit_item['slug'] ?>"><?php echo $exhibit_item['title'] ?></a></h3>
            <?php endif?>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>

