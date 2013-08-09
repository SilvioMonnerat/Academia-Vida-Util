<?php
/*
Template Name: Full Width
*/
?>
<?php get_header();?>
    <!-- Content -->
    <div id="content">
      <!-- Main Content -->
      <div id="maincontent" class="grid_16">
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
    
  </div>
  <!-- Content End -->
</div>
<!-- Wrapper End -->
<div class="clear"></div>

<?php get_footer();?>