
 <div class="row top-margin">
 	<div class="span12">
 		<h2><?php echo $exhibit_item['title']; ?></h2>
        <a href="<?php echo $exhibit_item['external_url'] ?>" class="exhibit-button">View the <?php echo $exhibit_item['title']; ?> exhibit</a>
 	</div>
</div>
 	 <div class="row">
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
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="/assets/uploads/slides/<?php echo $exhibit_item['slug']; ?>.jpg"/>
               
                  </div>
                 
                  <?php 
                  
                    for($i = 0; $i < 6; $i++) {
		                  $image = $exhibit_item['slug'].$i;
		                  if (file_exists("assets/uploads/slides/".$image.".jpg")){
			                   echo (" <div class='item'><img src='/assets/uploads/slides/".$image.".jpg'/></div>");
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