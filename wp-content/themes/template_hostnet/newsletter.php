        <!-- News Subscription -->
          <h3><?php echo ($newslettertitle) ? $newslettertitle : __("Fique informado",'ezine');?></h3>
          <?php $feedburner_id = ($feedburnerid) ? $feedburnerid : get_option('ezine_feedburner_id');?>
          <ul class="subscribenews">
            <li><a href="http://feeds.feedburner.com/<?php echo $feedburner_id;?>"><?php echo __('Cadastre-se por RSS','ezine');?></a><span><img src="<?php bloginfo('template_directory');?>/images/rss.png" alt="RSS" /></span></li>
            <li><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner_id;?>"><?php echo __('Cadastre-se por Email','ezine');?></a><span><img src="<?php bloginfo('template_directory');?>/images/email.png" alt="Email" /></span></li>
          </ul>
        <!-- News Subscription End -->
        