
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

       <h1>Exhibitions</h1>
   <p class="top-margin">Bruce Peel Special Collections has offered a fascinating array of exhibitions since moving to the basement of Rutherford South in 1984. Numerous awards, for exhibition catalogues (see <a href="/exhibits/past">previous in-house exhibitions</a>) and for digital exhibitions (<a href="https://omeka.library.ualberta.ca/exhibits/show/tinctor/imagining">Tinctor's Foul Treatise</a> and <a href="https://omeka.library.ualberta.ca/exhibits/show/photograpies/intro">Photographies</a> ) demonstrate that the exhibitions produced by the Peel library are some of the best in North America. Exhibition catalogues are distributed internationally by University of Alberta Press and continue to be actively used by local researchers. For information on past exhibitions, as well as the availability and prices of past exhibition catalogues, follow the link below.</p>
 <a href="/exhibits/past" class="myButton" id="past">Previous In-House Exhibitions</a>

</div>
         <div class="row-fluid">
   <div class="span5 main-content">


      <div class="current-exhibit">
        <h2><a name="current"></a>Current In-House Exhibition</h2>
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
    
    
    
     </div>


  <div class="span7 main-content online-exhibits">
  <h2 class="top-margin">Digital Exhibitions (most recent first)</h2>
     
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

  $(".acollection").hoverIntent(function () {
    $(this).find(".col-details").fadeToggle(600);
    return false;
  });
</script>
