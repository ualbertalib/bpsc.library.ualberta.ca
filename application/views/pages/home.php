
    <div class="row-fluid slide-area hidden-phone">
    </div>
    
    <div class="row-fluid main-content">
      <div class="span12">
        <div class="container">
        
          <div class="row-fluid">
            <div class="span6 front-column">
                 <p class="welcome">The <em>Bruce Peel Special Collections Library</em> is located in the lower level of Rutherford South. Among its 100,000+ volumes are many <a href="http://bpsclibrary.blogspot.ca/2013/04/some-of-our-treasures.html">treasures</a>, including beautiful, rare and unusual books.

Special Collections is a closed stack library. <a href="info/visit">Visitors</a> are always welcome, and the Library has an <a href="exhibits">exhibition</a> program with exceptional opportunities for learning and discovery.</p>
           
           
            </div>
  <div class="span3 hidden-phone">
    <div class="row-fluid ">
      <div class="span12 front-column">
        <h2>ON NOW </h2>
          <?php if (!empty($on_now)): ?>
            <?php foreach ($on_now as $on_now_item): ?>
              <?php if ($on_now_item['on_now'] != '0'): ?>
                <?php if($on_now_item['exhibit_type'] != '1'): ?>
                  <a href="<?php echo $on_now_item['external_url'] ?>">
                <?php else: ?>
                  <a href="exhibits/<?php echo $on_now_item['slug'] ?>">
                <?php endif?>  
                
            
                  <div class="on-now"><img src="/assets/uploads/onnow/<?php echo $on_now_item['slug']; ?>.jpg"/>
                    <div class="on-now-details">
                      <p>
                        <?php echo $on_now_item['on_now_details']; ?>
                      </p>
                    </div>
                  </div>
                </a>
                <h2 class="dates"><?php echo $on_now_item['on_now_dates']; ?> </h2>
              <?php endif?>  
            <?php endforeach?>
          <?php else: ?>
            <a href="http://www.library.ualberta.ca/specialcollections/exhibits">
              <div class="on-now"><img src="/assets/img/noexhibit.jpg"/>
                <div class="on-now-details">
                  <p>
                    Currently there is no exhibit
                  </p>
                </div>
              </div>
            </a>
            <h2 class="dates">new exhibit coming soon</h2>      
          <?php endif?>  
          
            </div>
          </div>
            </div>
            <div class="span3 front-column">
       
           <h2>News </h2>
           <ul>
            <?php foreach($posts_rss as $item): ?>
                <li><a href="<?php echo $item->get_link(); ?>"><h3><?php echo $item->get_title(); ?></h3><p><?php echo substr($item->get_description(), 0, 80); ?></p></a></li>
            <?php endforeach; ?>

               </ul>
               <p class="social"><a href="https://twitter.com"><img src="/assets/img/twitter_32.png"></a><a href="http://www.youtube.com/user/ualibrary2010"><img src="/assets/img/youtube_32.png"></a><a href="http://bpsclibrary.blogspot.ca/"><img src="/assets/img/blogger_32.png"></a></p>
              
            </div>
          </div>
        </div>
      </div>
    </div>
 <div>   
 <div> 
  </div>
<script>
$(".on-now").hover(function () {
  $(".on-now-details").fadeToggle(600);
  return false;
});
</script>

