<aside id="sidebar">
	<form role="search" method="get" id="searchform">
		<div>
			<input type="text" value="" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="Pesquisar" />
		</div>
	</form> 

	<h3>Categorias</h3>
	<ul>
		<?php wp_list_categories('title_li='); ?>
	</ul>


	<h3>Tags</h3>
	<div id="tags">
		<?php wp_tag_cloud(); ?>
	</div>


	<h3>Links</h3>
	<ul>
		<?php wp_list_bookmarks('title_li='); ?>
	</ul>

</aside>