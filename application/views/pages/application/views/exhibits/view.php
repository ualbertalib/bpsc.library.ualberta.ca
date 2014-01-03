
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


</div>

</div>