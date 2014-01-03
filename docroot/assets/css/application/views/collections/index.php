<div class="row-fluid">
  <div class="span12 main-content">
    <div class="container">
         <?php if ($this->session->flashdata('message') != ''): ?>
         <script type="text/javascript">
          $(document).ready(function() {  
           $.jGrowl("<?php echo $this->session->flashdata('message') ?>");  
          });
         </script>
      <?php endif ?>
      <h2>Research Collections</h2>
      <ul id="filters">        
        <li><a href="#" data-filter="*"><strong>Show All</strong></a></li>

         <?php foreach ($subjects_array as $sub): ?>
           
        <li><a href="#" data-filter=".<?php echo $sub ?>"><?php echo ucfirst(str_replace('-', ' ', $sub)) ?></a></li>     
         <?php endforeach ?>
      </ul>
    </div>
  </div>
</div>
<div class="row-fluid top-margin">
  <div class="span12 main-content">
    <div class="container" id="collections">
      <?php foreach ($collections as $collection_item): ?>
        <div class="acollection <?php echo str_replace(',', ' ', $collection_item['subjects']) ?> <?php echo $collection_item['collection_type'] ?>">
       
      
         
            <div class="col">
                  <a href="collections/<?php echo $collection_item['slug'] ?>"><img src="/assets/uploads/display/<?php echo $collection_item['slug'] ?>.jpg"/>   </a>
       
              <a href="collections/<?php echo $collection_item['slug'] ?>" class="col-details"><p><?php echo $collection_item['short_description'] ?></p></a>
            </div>
                 <a href="collections/<?php echo $collection_item['slug'] ?>"><h2><?php echo $collection_item['title'] ?></h2></a>
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

