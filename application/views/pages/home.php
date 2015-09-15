
    <div class="row-fluid slide-area hidden-phone">
    </div>
    
    <div class="row-fluid main-content">
      <div class="span12">
        <div class="container">
        
          <div class="row-fluid">
            <div class="span6 front-column">
                 <p class="welcome">Bruce Peel Special Collections &amp; Archives includes the Peel library, located in the lower level of Rutherford South, and the University Archives, located in the Book and Record Depository (BARD). Thanks to visionary collectors and generous donors, the two locations house a world class collection of more than 100,000 rare books and a significant collection of archival materials which explore a range of local and international subjects.</p>
           
           
            </div>

  <div class="span3">
    <div class="row-fluid ">
      <div class="span12 front-column">
        <h2>EXHIBITION</h2>
          <?php if (!empty($on_now)): ?>
            <?php foreach ($on_now as $on_now_item): ?>
              <?php if ($on_now_item['on_now'] != '0'): ?>
                <?php if($on_now_item['exhibit_type'] != '1'): ?>
                  <a href="<?php echo $on_now_item['external_url'] ?>">
                <?php else: ?>
                  <a href="exhibits/<?php echo $on_now_item['slug'] ?>">
                <?php endif?>  
            
                  <div class="on-now hidden-phone"><img src="/assets/uploads/display/<?php echo $on_now_item['slug']; ?>.jpg"/>
                    <div class="on-now-details">
                      <p>
                        <?php echo $on_now_item['on_now_details']; ?>
                      </p>
                    </div>
                  </div>
                  <h2 class="dates hidden-phone"><?php echo $on_now_item['on_now_dates']; ?> </h2>
                  <p class="visible-phone det"><?php echo $on_now_item['on_now_details']; ?> <?php echo $on_now_item['on_now_dates']; ?></p>
                </a>
                
              <?php endif?>  
            <?php endforeach?>
          <?php else: ?>
            <a href="/exhibits">
              <div class="on-now"><img src="/assets/img/noexhibit.jpg"/>
                <div class="on-now-details">
                  <p>
                    The exhibition program will resume in early 2016 once the renovation is complete.
                  </p>
                </div>
              </div>
            </a>
            <h2 class="dates">Closed for renovations</h2>      
          <?php endif?>  
          
            </div>
          </div>
            </div>
            <div class="span3 front-column">
       
           <h2>News </h2>
           <ul>
           
                <li><a href="https://www.library.ualberta.ca/aboutus/bpsc-closure">Bruce Peel Special Collections will be closed for renovations until early May 2016. Click here for more information.</a></li>
           
               </ul>
           
            </div>
          </div>
        </div>
      </div>
    </div>
 <div>   
 <div> 
  </div>
<script>
$(".on-now").hoverIntent(function () {
  $(".on-now-details").fadeToggle(600);
  return false;
});
</script>

