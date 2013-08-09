        <!-- Search Box -->
          <h3><?php echo ($searchboxtitle) ? $searchboxtitle : __("Buscar",'ezine');?></h3>
          <div id="searchbox">
            <form  method="get" id="search" action="<?php bloginfo('url'); ?>/" >
            <div>
            <input type="text" name="s" id="s" value="<?php echo __('Buscar...','ezine');?>" onblur="if (this.value == ''){this.value = '<?php echo __('Search...','ezine');?>'; }" onfocus="if (this.value == '<?php echo __('Buscar...','ezine');?>') {this.value = ''; }"  class="inputtext"/>
            <input type="submit" class="searchbutton" value="" />
            </div>      						                	
          </form>
          </div>
        <!-- Search Box End -->