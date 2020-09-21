
    <div class="row-fluid slide-area hidden-phone">
    </div>
    
    <div class="row-fluid main-content">
      <div class="container">
      <div class="span7 front">
        
                 <p class="welcome">Thanks to visionary collectors and generous donors, Bruce Peel Special Collections houses a world-class collection of more than 100,000 rare books and a significant collection of archival materials that explore a range of local and international subjects. The Peel library is open on weekday afternoons throughout the year for students, faculty, staff, and visitors to browse the current exhibition or examine rare materials in the <a href="https://bpsc.library.ualberta.ca/info/visit">Gregory Javitch Reading Room</a>.</p>
                   <p class="welcome">

                    Researchers must request materials in advance, either using the “Request This” option in the University of Alberta Libraries <a href="https://www.library.ualberta.ca/">catalogue</a> or by submitting a <a href="https://docs.google.com/forms/d/126ZJ6r6L42AeoWVyOQRWdY9b0SYv7VxUljx6V1d56Po">Retrieval Request Form (for books)</a> or a <a href="https://docs.google.com/forms/d/1-L6cAek91koI7lU5_4j6kpp_4-AUYIhETM26Xjg1uEw">Discover Archives Retrieval Request Form (for archival materials)</a> before 8am on the day of their visit in order to be sure that library materials have been retrieved from storage and are available for their use.</p>
                
                </div>
          
    <div class="span2 front">
     
          <?php if (!empty($on_now)): ?>
            <?php foreach ($on_now as $on_now_item): ?>
              <?php if ($on_now_item['on_now'] != '0'): ?>
                 <h2><?php echo $on_now_item['on_now_details'] ?></h2>
                <?php if($on_now_item['exhibit_type'] != '1'): ?>

                  <a href="<?php echo $on_now_item['external_url'] ?>">
                <?php else: ?>
                  <a href="exhibits/<?php echo $on_now_item['slug'] ?>">
                <?php endif?>  
            
                  <div class="on-now hidden-phone"><img src="/assets/uploads/display/<?php echo $on_now_item['slug']; ?>.jpg"/>
                   
                  </div>
                 
                </a>
                
              <?php endif?>  
            <?php endforeach?>
          <?php else: ?>
            <a href="/exhibits">
              <div class="on-now"><img src="/assets/img/noexhibit.jpg"/>
                <div class="on-now-details">
                  <p>
                ]
                  </p>
                </div>
              </div>
            </a>
            <h2 class="dates">No Current Exhibit</h2>      
          <?php endif?>  
          </div>
            <div class="span3 front">
         

       
           <h2>News</h2>
		   
           <ul>
				<?php 

          foreach($rss_news as $row){
					echo "<li><a href='{$row['link']}'>" . $row['title'] . "</a></li>";
					
				} ?>
             
             
               </ul>

          </div>
      </div>
    </div>
 <div>   
 <div> 
  </div>


