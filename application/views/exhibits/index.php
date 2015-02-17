
<div class="row-fluid">
  <div class="span12 main-content">
    <div class="container">
        <?php if($this->session->flashdata('message') != ''): ?>
         <script type="text/javascript">
          $(document).ready(function() {  
          $.jGrowl.defaults.position = 'top-left';
           $.jGrowl("<?php echo $this->session->flashdata('message') ?>");  
          });
         </script>
      <?php endif?>

<div class="row-fluid">
        <div class="span12"><h2>Exhibitions</h2></div>  
    
      </div>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="span12 main-content">

      <div class="current-exhibit">
        <h3><a name="current"></a>Current In-House Exhibition</h3>
         <?php if (!empty($on_now)): ?>
            <?php foreach ($on_now as $on_now_item): ?>
              <?php if ($on_now_item['on_now'] != '0'): ?>
               
                
           <p class="info">
               <?php if($on_now_item['exhibit_type'] != '1'): ?>
                
                <?php endif?>   <img src="/assets/uploads/display/<?php echo $on_now_item['slug']; ?>.jpg" class="on-now-image" />
                   
                     <?php if($on_now_item['exhibit_type'] != '1'): ?>
                 
               
                <?php endif?>   
                <h2><?php echo $on_now_item['title']; ?></h2>
                 <h3 class="dates"><?php echo $on_now_item['on_now_dates']; ?> </h3>
                        <?php echo $on_now_item['essay']; ?>
                       
                      </p>
                 
                 
              
                
              <?php endif?>  
            <?php endforeach?>
              <?php endif?>  
      </div>
    
    </div></div>
     <a href="/exhibits/past" class="myButton top-margin" id="past">Previous In-House Exhibitions</a>
<div class="row-fluid top-margin">
  <div class="span12 main-content">
    <div class="container" id="collections">
      <div class="row-fluid bottom-margin">
         <h3><a name="online"></a>Online Exhibitions</h3>
       </div>
       <div class="container" id="exhibits">
      <?php foreach ($exhibits as $exhibit_item): ?>
       <?php if ($exhibit_item['subjects'] == 'online'): ?>
      	<div class="acollection <?php echo $exhibit_item['subjects'] ?> <?php echo str_replace(',', ' ', $exhibit_item['subjects']) ?> ">
         
         
         
              <?php if($exhibit_item['exhibit_type'] != '1'): ?>
               <div class="col">
                  <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
               <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg"/></a>
                  <?php else: ?>
                <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/img/noimage.jpg"/></a> 
              <?php endif?>
    
             
              <a href="<?php echo $exhibit_item['external_url'] ?>" class="col-details"> <p><?php echo $exhibit_item['short_description'] ?></p><a>
            </div>

                <a href="<?php echo $exhibit_item['external_url'] ?>">
                <h2><?php echo $exhibit_item['title'] ?></h2></a>
              <?php else: ?>
               <div class="col">
                 <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
                <a href="exhibits/<?php echo $exhibit_item['slug'] ?>"><img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg"/></a>
              <?php else: ?>
                <a href="exhibits/<?php echo $exhibit_item['slug'] ?>"><img src="/assets/img/noimage.jpg"/></a> 
              <?php endif?>
                 
               <a href="exhibits/<?php echo $exhibit_item['slug'] ?>" class="col-details"> <p><?php echo $exhibit_item['short_description'] ?></p><a>
            </div>

                 <a href="exhibits/<?php echo $exhibit_item['slug'] ?>">
                <h2><?php echo $exhibit_item['title'] ?></h2></a>
           <?php endif?>
            
        </div>
         <?php endif?> 
      <?php endforeach ?>
    </div>
    </div>
  </div>
</div>

<script>

  var $container = $('#exhibits');
   $container.isotope({
      layoutMode : 'fitRows' 

      });
  $(".acollection").hoverIntent(function () {
    $(this).find(".col-details").fadeToggle(600);
    return false;
  });
</script>
