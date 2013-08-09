<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2><?php the_title();?></h2>
          <?php 
            if (have_posts()) : while (have_posts()) : the_post();
              the_content();
            endwhile; endif;
          ?>
        </div>
      </div>
      <!-- Content End -->      
      
    <?php wp_reset_query();?>
    <?php get_sidebar();?>
    
  </div>
  <!-- Content End -->

<?php get_footer();?>