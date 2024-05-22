
    <div class="row-fluid slide-area hidden-phone">
    </div>

    <div class="row-fluid main-content">
      <div class="container">
      <div class="span7 front" style='height: 550px'><!-- Height overide  custom.css -->

<p class="welcome">
	Thanks to visionary collectors and generous donors, Bruce Peel Special Collections houses a world-class collection of more than 100,000 rare books and a significant collection of archival materials that explore a range of local and international subjects. The Peel library is open most weekday afternoons during the academic year for students, faculty, staff, and visitors to browse the current exhibition or examine rare materials in the <a href="https://bpsc.library.ualberta.ca/info/visit">reading rooms</a>. TO VIEW MATERIALS HELD IN BRUCE PEEL SPECIAL COLLECTIONS, please write to us at <a href="mailto:bpsc@ualberta.ca">bpsc@ualberta.ca</a> to request an appointment well in advance, listing the requested materials including author, title, and call number for each item (appointments are generally available Tuesday–Friday 1–4pm from September through March each year).
	</p>
	      
<p class="welcome"><strong>The doors are closed at Bruce Peel Special Collections and services significantly reduced from April–August 2024 to allow the team to focus on back end operations. 
	Further information is available <a href='https://bpsclibrarynews.blogspot.com/2021/07/peel-reopens-on-august-16th-with.html'>here</a>. During this period, 
	I hope you will be patient with me while I work on a major project as I only expect to read and respond to email approximately once a week. 
	Full service resumes in September.</strong></p>

              
				
			<p class="welcome">
				Opening in September 2024, back by popular demand--<em><a href='https://bpsc.library.ualberta.ca/exhibits'>Collecting Culinaria: 
				Cookbooks and Domestic Manuals Mainly from the Linda Miron Distad Collection</a></em>--a visually compelling exhibition of books and ephemera relating to the preparation and enjoyment of 
				food over several centuries.
				</p>
  </div>
    <div class="span2 front hidden-phone">

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
