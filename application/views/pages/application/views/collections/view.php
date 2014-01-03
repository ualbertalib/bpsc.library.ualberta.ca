
 <div class="row top-margin">
 	<div class="span12">
 		<h2><?php echo $collection_item['title']; ?></h2>
 	</div>
</div>
 	 <div class="row">
<div class="span6">

	<p class="right-padding"><?php echo $collection_item['essay']; ?></p>
</div>
<div class="span6"> 
  <?php if ($collection_item['catalogue_id'] != ''): ?>
  <p>Search within this collection:</p>
  <form onsubmit="return (replaceQuotes() );" name="neos" action="http://ualweb.library.ualberta.ca/uhtbin/cgisirsi/x/0/0/57/123/X?user_id=WUAARCHIVE&amp;_search_ui=ilink" method="post" class="searcher">     
    <ul>
      <li>
    <input type="radio" name="query_type" value="search" checked="checked"> Containing  
      <input type="radio" name="query_type" value="browse"> Starting With
    </li>
    <li>
      <input type="text" name="searchdata1" class="oversize input-text front" id="oversizeNiceInput" >
      <input name="location" id="location" type="hidden" value="<?php echo $collection_item['catalogue_id'] ?>"/>
    <button type="submit" class="lib_button mleft" value="search" onclick="_gaq.push(['_trackEvent', 'neos', 'clicked'])">search</button>
  </li>
</ul>
  </form>
<?php endif?>
  <?php if (file_exists("assets/uploads/slides/".$collection_item['slug'].".jpg")): ?>
	<div class="slider">
    <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="/assets/uploads/slides/<?php echo $collection_item['slug']; ?>.jpg"/>
               
                  </div>
                 
                  <?php 
                  
                    for($i = 0; $i < 6; $i++) {
		                  $image = $collection_item['slug'].$i;
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
	
<?php if ($collection_item['collector'] != ''): ?>
<p><strong>collector:</strong> <?php echo $collection_item['collector']; ?></p>
<?php endif?>
<?php if ($collection_item['collection_type'] != ''): ?>
	<p><strong>type of collection:</strong> <?php echo str_replace(',', ', ', $collection_item['collection_type']); ?></p>
<?php endif?>

<p><strong>subjects</strong>  (click to see related collections): 
  <?php foreach($collection_item['subjects'] as $subject){
  		$clean_subject = ucwords(str_replace('-', ' ', $subject));
  		 if ($subject === end($collection_item['subjects'])){
			echo ('<a href="/collections#'.$subject.'">'.$clean_subject.'</a>');
		}else{
			echo ('<a href="/collections#'.$subject.'">'.$clean_subject.'</a>, ');	
		} 
	} ?></p>




</div>

