<?php
/*
Template Name: Archives
*/
?>
<?php get_header();?>
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2><?php the_title();?></h2>
					
          <div class="archivelists">
						
						<h4><?php echo __('Últimos 20 Posts', 'ezine') ?></h4>
						
						<ul>
						<?php $latest_20 = get_posts('numberposts=20');
						foreach($latest_20 as $post) : ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a><span class="archivecomm"><?php comments_popup_link(__('0 ','ezine'), __('1 ','ezine'), __('% ','ezine')); ?></span></li>
						<?php endforeach; ?>
						</ul>
						
						<h4><?php echo __('Posts no mês:', 'ezine') ?></h4>
						
						<ul>
							<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
						</ul>
			
						<h4><?php echo __('Posts na categoria:', 'ezine') ?></h4>
						
						<ul>
					 		<?php wp_list_categories( 'title_li=&show_count=1' ); ?>
						</ul>
					</div>
                
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