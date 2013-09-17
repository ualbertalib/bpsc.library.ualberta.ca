
<div class="row-fluid">
  <div class="span12 main-content">
    <div class="container">
        <?php if($this->session->flashdata('message') != ''): ?>
         <script type="text/javascript">
          $(document).ready(function() {  
          $.jGrowl.defaults.position = 'top-left';
           $.jGrowl("<?php echo $this->session->flashdata('message') ?>");  
          });
         </script>
      <?php endif?>
      <h2>Online Exhibits</h2>
      
    </div>
  </div>
</div>
<div class="row-fluid top-margin">
  <div class="span12 main-content">
    <div class="container" id="collections">
      <?php foreach ($exhibits as $exhibit_item): ?>
      	<div class="acollection <?php echo $exhibit_item['subjects'] ?> <?php echo str_replace(',', ' ', $exhibit_item['subjects']) ?> ">
         
         
         
              <?php if($exhibit_item['exhibit_type'] != '1'): ?>
               <div class="col">
                  <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
               <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg"/></a>
                  <?php else: ?>
                <a href="<?php echo $exhibit_item['external_url'] ?>"><img src="/assets/img/noimage.jpg"/></a> 
              <?php endif?>
    
             
              <a href="<?php echo $exhibit_item['external_url'] ?>" class="col-details"> <p><?php echo $exhibit_item['short_description'] ?></p><a>
            </div>

                <a href="<?php echo $exhibit_item['external_url'] ?>">
                <h2><?php echo $exhibit_item['title'] ?></h2></a>
              <?php else: ?>
               <div class="col">
                 <?php if (file_exists("assets/uploads/display/".$exhibit_item['slug'].".jpg")): ?>
                <a href="exhibits/<?php echo $exhibit_item['slug'] ?>"><img src="/assets/uploads/display/<?php echo $exhibit_item['slug'] ?>.jpg"/></a>
              <?php else: ?>
                <a href="exhibits/<?php echo $exhibit_item['slug'] ?>"><img src="/assets/img/noimage.jpg"/></a> 
              <?php endif?>
                 
               <a href="exhibits/<?php echo $exhibit_item['slug'] ?>" class="col-details"> <p><?php echo $exhibit_item['short_description'] ?></p><a>
            </div>

                 <a href="exhibits/<?php echo $exhibit_item['slug'] ?>">
                <h2><?php echo $exhibit_item['title'] ?></h2></a>
           <?php endif?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
<script>
  $(".acollection").hoverIntent(function () {
    $(this).find(".col-details").fadeToggle(600);

    return false;
  });
</script>
 <script>
  $(document).ready(function() {  
    var $container = $('#collections');
    var f=document.URL.split('#')[1];
    if (f!=undefined){
      var selector="."+f;
      if (selector==".american-literature"){
        var ft="Web Exhibits";
      }
      else if (selector==".major"){
        var ft="Major Holdings";
      }
      else if (selector==".other"){
        var ft="Other Collections";
      }
      else if (selector==".new"){
        var ft="New and Current Exhibits";
      }
      $('.filter-title').text(ft);
    }
    else{
      var selector='*';
    }
      // initialize isotope
      $container.isotope({
        filter: selector,
      layoutMode : 'fitRows' 

      });

        // filter items when filter link is clicked
      $('#filters a, #types a').click(function(){
      var selector = $(this).attr('data-filter');
      $container.isotope({ filter: selector });
      return false;
      });
      $('.carousel').carousel({
        interval: 6000
      })
});
  </script>