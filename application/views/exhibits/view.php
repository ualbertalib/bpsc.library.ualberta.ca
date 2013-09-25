
 <div class="row top-margin">
 	<div class="span12">
 		<h2><?php echo $exhibit_item['title']; ?><a href="<?php echo $exhibit_item['external_url'] ?>" class="exhibit-button">Go to the <em><?php echo $exhibit_item['title']; ?></em> online exhibit</a></h2>
        
 	</div>
</div>
 	 <div class="row bottom-margin">
<div class="span6">

	<p class="right-padding"><?php echo $exhibit_item['essay']; ?></p>
</div>
<div class="span6"> 
	
	
<?php if ($exhibit_item['exhibitor'] != ''): ?>
<p><strong>collector:</strong> <?php echo $exhibit_item['exhibitor']; ?></p>
<?php endif?>
 <?php if (file_exists("assets/uploads/slides/".$exhibit_item['slug'].".jpg")): ?>
	<div class="slider">
    <div id="myCarousel" class="carousel slide">
       
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="/assets/uploads/slides/<?php echo $exhibit_item['slug']; ?>.jpg"/>
                    <p class='captioning'><?php echo $exhibit_item['caption1'];?></p>
               
                  </div>
                 
                  <?php 
                  
                    for($i = 0; $i < 6; $i++) {
		                  $image = $exhibit_item['slug'].$i;
                      $capNum = $i + 1;
                      $captionNum = 'caption'.$capNum;
                      $caption = $exhibit_item[$captionNum];
		                  if (file_exists("assets/uploads/slides/".$image.".jpg")){
			                   echo (" <div class='item'><img src='/assets/uploads/slides/".$image.".jpg'/><p class='captioning'>".$caption."</p></div>");
		                  }
	                 } 
                 
	               ?>
                
                  </div>
              
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>
            </div>
<?php endif?>

</div>

</div>