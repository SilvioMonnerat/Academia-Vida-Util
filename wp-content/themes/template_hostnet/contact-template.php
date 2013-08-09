<?php
/*
Template Name: Contact Form
*/
?>
<?php get_header();?>

<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/contact-form.js"></script>
    
    <!-- Content -->
    <div id="content">

      <?php include (TEMPLATEPATH.'/leftbar.php');?>
      <!-- Main Content -->
      <div id="maincontent" class="grid_10">
        <div class="content">
          <h2><?php the_title();?></h2>
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <div class="infobox">
            <?php
              $map_image= get_option('ezine_info_map');
              $gmap_source = get_option('ezine_gmap_source');
            ?>
              <a href="<?php echo ($gmap_source) ? $gmap_source : "http://maps.google.com/?ie=UTF8&amp;ll=-6.230792,106.825991&amp;spn=0.032167,0.082397&amp;z=15&amp;output=embed";?>?iframe=true&amp;width=680&amp;height=350" rel="prettyPhoto[iframes]">
                <img src="<?php echo ($map_image) ? $map_image : get_bloginfo('template_directory').'/images/contacts.png';?>" class="alignright" alt="" />
              </a>
                <?php 
                $info_address = get_option('ezine_info_address');
                $info_phone = get_option('ezine_info_phone');
                $info_fax = get_option('ezine_info_fax');
                $info_email = get_option('ezine_info_email');
                $info_website = get_option('ezine_info_website');
                ?>                            
              <ul class="defailinfo">
                <li>
                  <strong><?php echo __('Endereço','ezine');?>:</strong><br />
                  <?php echo ($info_address) ? stripslashes($info_address) : "";?><br />
                  <strong><?php echo __('Telefone ','ezine');?>:</strong><br />
                  <?php echo ($info_phone) ? $info_phone : "";?>
                </li>
                <li>
                  <strong><?php echo __('Fax ','ezine');?>:</strong><br />
                  <?php echo ($info_fax) ? $info_fax : "";?><br />
                  <strong><?php echo __('Email ');?>:</strong><br />
                  <a href="mailto:<?php echo $info_email;?>"><?php echo ($info_email) ? $info_email : "";?></a><br />
                  <strong><?php echo __('Website ','ezine');?>:</strong><br />
                  <a href="<?php echo ($info_website) ? $info_website : "#";?>"><?php echo ($info_website) ? $info_website : "";?></a>
                </li>
              </ul>
              <div class="clear"></div>
            </div>          
  
            <?php $success_msg  = get_option('ezine_success_msg');?>
            <div class="mailsuccess">
              <?php echo ($success_msg) ? stripslashes($success_msg) : __("Sua mensagem foi enviada com sucesso. Agradecemos se contato !",'ezine');?>
            </div>            
            <div id="maincontactform">
              <!-- Contact Form Start //-->
              
			<fieldset>
				<?php the_content(); ?>
			
		<?php endwhile; endif; ?>
		
				<input type="hidden" name="siteurl" id="siteurl" value="<?php bloginfo('template_directory');?>" />
				<span class="loading" style="display: none;"><?php echo __('Por favor, aguarde..','ezine');?></span>
				<div class="clear"></div>
			</fieldset> 
              
              <!-- Contact Form End //-->
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