
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
      <input type="text" name="search-with-no-modifier" class="main-search" id="oversizeNiceInput" />
    <input type="hidden" name="searchdata1" class="searchdata1" />
    <button type="submit" class="lib_button mleft" value="search" onclick="_gaq.push(['_trackEvent', 'neos', 'clicked'])">search</button>
  </li>
</ul>
  </form>
<?php endif?>
  <?php if (file_exists("assets/uploads/slides/".$collection_item['slug'].".jpg")): ?>
	<div class="slider">
    <div id="myCarousel" class="carousel slide">
     
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="/assets/uploads/slides/<?php echo $collection_item['slug']; ?>.jpg"/>
                    <p class='captioning'><?php echo $collection_item['caption1'];?></p>
               
                  </div>
                 
                  <?php 
                  
                    for($i = 0; $i < 6; $i++) {
		                  $image = $collection_item['slug'].$i;
                      $capNum = $i + 1;
                      $captionNum = 'caption'.$capNum;
                      $caption = $collection_item[$captionNum];
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
 <script type="text/javascript">
        $(document).ready(function() {
          $('.lib_button').click(function(){
        $('.searchdata1').val( $('.main-search').val() + ' and <?php echo $collection_item['catalogue_id'] ?>'  );
          });
              });
    </script>