<div class="row-fluid">
  <div class="span12 admin"> 
    <div class="container">
     <?php if ($this->session->flashdata('message') != ''): ?>
         <script type="text/javascript">
          $(document).ready(function() {  
               $.jGrowl.defaults.position = 'top-left';
           $.jGrowl("<?php echo $this->session->flashdata('message') ?>");  
          });
         </script>
      <?php endif?>

    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 main-content">
    <div class="container">
      <h2>Admin <a href="auth/logout" class="myButton" id="logout">logout</a> </h2>

    
     
    
    </div>
  </div>
</div>
<div class="row-fluid top-margin">
  <div class="span12 main-content">
    <h3>Research Collections</h3>
    
            <a href="collections/create" class="myButton" id="noleftmargin">Create a new Collection</a>
    <ul class="admin-list">
      <?php foreach ($collections as $collection_item): ?>
        <li> 
         
          <a href="/collections/edit/<?php echo $collection_item['slug'] ?>" class="myButton" id="actions">Edit</a> 
          <a href="/collections/delete/<?php echo $collection_item['slug'] ?>" onclick="return confirm('Delete content?');" class="myButton" id="actions">Delete</a>
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
             <a href="exhibits/create" class="myButton" id="noleftmargin">Create a new link to an Online Exhibit</a>
    <ul class="admin-list">
      <?php foreach ($exhibits as $exhibit_item): ?>
        <li>
        
          <a href="/exhibits/edit/<?php echo $exhibit_item['slug'] ?>" class="myButton" id="actions">Edit</a> 
          <a href="/exhibits/delete/<?php echo $exhibit_item['slug'] ?>" onclick="return confirm('Delete content?');" class="myButton" id="actions">Delete</a>
           <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
            <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg" width="100px"/></a> 
          <?php else: ?>
             <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/img/noimage.jpg" width="100px"/></a> 
           <?php endif?>
          <h3><a href="<?php echo $exhibit_item['external_url'] ?>"><?php echo $exhibit_item['title'] ?></a></h3>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>

