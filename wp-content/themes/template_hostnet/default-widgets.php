        <div class="sidebox">
          <?php include (TEMPLATEPATH.'/newsletter.php');?>
        </div>
        
        <div class="sidebox">
          <?php include (TEMPLATEPATH.'/searchbox.php');?>
        </div>
        
        <div class="sidebox">
          <?php social_profile();?>
        </div>
        
        <!-- Archives Menu -->
        <div class="sidebox">
          <h3>Arquivos</h3>
          <ul class="archivelist">
            <?php wp_get_archives('type=monthly');?>
          </ul>
        </div>
        <!-- Archives Menu End -->
        
        <div class="sidebox">
          <?php twitter_feed("Twitter Update!",5);?>
        </div>
        
        <div class="sidebox">
        <?php 
          $flickr_id = get_option('ezine_flickr_user');
          $flickr_num = (get_option('ezine_flickr_num')) ? get_option('ezine_flickr_num') : 4;
          flickr_gallery("<h3>Galeria do Flickr</h3>",$flickr_id,$flickr_num);
        ?>
        </div>
