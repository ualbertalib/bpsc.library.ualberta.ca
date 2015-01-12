<div class="row-fluid">
  <div class="span12 main-content">
    <div class="container">
         <?php if ($this->session->flashdata('message') != ''): ?>
         <script type="text/javascript">
          $(document).ready(function() {  
                $.jGrowl.defaults.position = 'top-left';
           $.jGrowl("<?php echo $this->session->flashdata('message') ?>");  
          });
         </script>
      <?php endif ?>
      <h2 class="span6">Research Collections<span class="filter-title"></span></h2>

      <div class="collection-search">
        <form id="search" method="post" action="search">
          <input type="text" size="20" name="query" placeholder="search collections"/>
          <input type="submit" value="Search" class="myButton search-btn"/>          
      </form>
    </div>
    
    </div>
  </div>
</div>
<div class="row-fluid top-margin">
  <div class="span12 main-content">
    <?php if (isset($query)): ?>
     <p class="search-results-hd">Your search for <em><strong><?php echo $query ?></strong></em> returned the following results:</p>
   <?php endif ?>
    <div class="container" id="collections">
      <?php foreach ($collections as $collection_item): ?>
        <div class="acollection <?php echo str_replace(',', ' ', $collection_item['collection_type'])?>">
            <div class="col">
              <?php if (file_exists("assets/uploads/display/".$collection_item['slug'].".jpg")): ?>
                <a href="collections/<?php echo $collection_item['slug'] ?>"><img src="/assets/uploads/display/<?php echo $collection_item['slug'] ?>.jpg" alt="image for <?php echo $collection_item['title'] ?>"/>   </a>
              <?php else: ?>
                <a href="<?php echo $collection_item['external_url'] ?>"><img src="/assets/img/noimage.jpg"/></a> 
              <?php endif?>
              <a href="collections/<?php echo $collection_item['slug'] ?>" class="col-details"><p><?php echo $collection_item['short_description'] ?></p></a>
            </div>
                 <a href="collections/<?php echo $collection_item['slug'] ?>"><h2 class="<?php echo $collection_item['slug'] ?>"><?php echo $collection_item['title'] ?></h2></a>
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
      var cleanf=f.replace('-', ' ').toUpperCase();
      $('.filter-title').html(" with the format <strong><em>"+cleanf+"</em></strong>");
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

