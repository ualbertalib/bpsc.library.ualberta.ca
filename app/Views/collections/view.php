
 <div class="row">
 	<div class="span12">
 		<h2 class="<?php echo $collection_item['slug']; ?>"><?php echo $collection_item['title']; ?></h2>
 	</div>
</div>
 	 <div class="row bottom-margin">
<div class="span6 right-padding info">

	<?php echo $collection_item['essay']; ?>

     <?php 
      $first = true;
      foreach ($collection_item['collection_type'] as $format){
        if ($format != '0'){
          if(!$first) {
          }else{
            echo "<p><strong>Collection Formats</strong>: ";
            $first = false;
          }
          $clean_format = ucwords(str_replace('-', ' ', $format));
          if ($format === end($collection_item['collection_type'])){
            echo ('<a href="/collections#'.$format.'">'.$clean_format.'</a><span class="small"> -- click to see other collections with this format</span>');
          }else{
            echo ('<a href="/collections#'.$format.'">'.$clean_format.'</a>, ');  
          }
        }  
      } ?>
</div>
<div class="span6"> 
   

  <?php if (file_exists("assets/uploads/slides/".$collection_item['slug'].".jpg")): ?>
   <?php if (file_exists("assets/uploads/slides/".$collection_item['slug']."1.jpg")): ?>
	<div class="slider">
    <div id="myCarousel" class="carousel slide">
     
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="/assets/uploads/slides/<?php echo $collection_item['slug']; ?>.jpg"/>
                    <?php if ($collection_item['caption1'] != ''): ?>
                      <p class='captioning'><?php echo $collection_item['caption1'];?></p>
               <?php endif?>
                  </div>
                 
                  <?php 
                  
                    for($i = 0; $i < 6; $i++) {
		                  $image = $collection_item['slug'].$i;
                      $capNum = $i + 1;
                      $captionNum = 'caption'.$capNum;
                      $caption = $collection_item[$captionNum];
		                  if (file_exists("assets/uploads/slides/".$image.".jpg")){
			                   echo (" <div class='item'><img src='/assets/uploads/slides/".$image.".jpg'/>");
                            if ($collection_item[$captionNum] != ''){
                              echo ("<p class='captioning'>".$caption."</p></div>");
                            }
                            else{
                              echo ("</div>");
                            }
		                  }
	                 } 
                 
	               ?>
                
                  </div>
              
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>
            </div>
            <?php else: ?>
            <img src="/assets/uploads/slides/<?php echo $collection_item['slug']; ?>.jpg"/>
                    <p class='captioning'><?php echo $collection_item['caption1'];?></p>
    <?php endif?>
<?php endif?>




<?php if ($collection_item['collector'] != ''): ?>
<p><strong>collector:</strong> <?php echo $collection_item['collector']; ?></p>
<?php endif?>
	

    </p>

  <?php if ($collection_item['catalogue_id'] != ''): ?>
  <div class="col-search row">
  <h3 class="col-search-hd">Search within this collection:</h3>
  <form onsubmit="return (replaceQuotes() );" name="neos" action="http://ualweb.library.ualberta.ca/uhtbin/cgisirsi/x/0/0/57/123/X?user_id=WUAARCHIVE&amp;_search_ui=ilink" method="post" class="searcher">     
    <ul>
      <li>
    <input type="hidden" name="query_type" value="search" > 
      <input type="hidden" name="query_type" value="browse"> 
    </li>
    <li>
      <input type="text" name="search-with-no-modifier" class="main-search" id="oversizeNiceInput" />
    <input type="hidden" name="searchdata1" class="searchdata1" />
    <button type="submit" class="lib_button myButton search-btn" value="search" onclick="_gaq.push(['_trackEvent', 'neos', 'clicked'])">search</button>
  </li>
</ul>
  </form>
</div>
<?php endif?>


</div>


</div>
 <script type="text/javascript">
        $(document).ready(function() {
          $('.lib_button').click(function(){
        $('.searchdata1').val( $('.main-search').val() + ' and <?php echo $collection_item['catalogue_id'] ?>'  );
          });
              });
    </script>
