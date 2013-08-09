<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2>Page Not Found!</h2>
		  <?php
			$_404_text = (get_option('ezine_404_text')) ? get_option('ezine_404_text') : __("Apologies, but the page you requested could not be found",'ezine');
		  ?>
		  <h4><?php echo $_404_text;?></h4>
			<?php get_search_form();?>		  
        </div>
      </div>
      <!-- Content End -->      
      
    <?php wp_reset_query();?>
    <?php get_sidebar();?>
    
  </div>
  <!-- Content End -->
</div>
<!-- Wrapper End -->
<div class="clear"></div>

<?php get_footer();?>