
    <div class="row-fluid slide-area hidden-phone">
    </div>
    
    <div class="row-fluid main-content">
      <div class="span12">
        <div class="container">
        
          <div class="row-fluid">
            <div class="span6 front-column">
                 <p class="welcome">The <em>Bruce Peel Special Collections Library</em> is located in the lower level of Rutherford South. Among its 100,000+ volumes are many <A href="treasures">treasures</a>, including beautiful, rare and unusual books.

Special Collections is a closed stack library. <a href="visit">Visitors</a> are always welcome, and the Library has an <a href="exhibits">exhibition</a> program with exceptional opportunities for learning and discovery.</p>
           
           
            </div>
            <div class="span3 hidden-phone">
               <div class="row-fluid ">
              <div class="span12 front-column">
           
              <h2>ON NOW </h2>
               <a href="http://www.library.ualberta.ca/specialcollections/exhibits/current/index.cfm">
                <div class="on-now"><img src="/assets/img/miriam.jpg"/>
                  <div class="on-now-details"><p>Discover the fascinating travels and life of Miram Green Ellis.<br/>Monday to Friday noon-4:30pm. Admission is free. <br/>Click for more information.</p></div></div>
              </a>
             <h2 class="dates">March 14 to May 31 2013</h2>
          
          
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
               <p class="social"><a href="https://twitter.com"><img src="/assets/img/twitter_32.png"></a><a href="https://www.facebook.com"><img src="/assets/img/facebook_32.png"></a><a href="http://www.youtube.com"><img src="/assets/img/youtube_32.png"></a><a href="http://wordpress.com/"><img src="/assets/img/wordpress_32.png"></a></p>
              
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

