<h2>Previous In-House Exhibitions<a href="/exhibits" class="myButton" id="back">Back to Exhibits</a></h2>

	<?php foreach ($exhibits as $exhibit_item): ?>
       <?php if ($exhibit_item['subjects'] == 'past'): ?>
      		<div class="row-fluid past-ex">
         		<div class="span3">
					<?php if (file_exists("assets/uploads/slides/".$exhibit_item['slug'].".jpg")): ?>
                		<img src="/assets/uploads/slides/<?php echo $exhibit_item['slug'] ?>.jpg"/>
              		<?php else: ?>
                		<img src="/assets/img/noimage.jpg"/>
              		<?php endif?>
                </div>
                <div class="span9 info">
                	<h2><?php echo $exhibit_item['title'] ?></h2>
                        <?php echo $exhibit_item['essay'] ?>
                </div>
            </div>
        <?php endif?>
    <?php endforeach ?>
 
         
   
    