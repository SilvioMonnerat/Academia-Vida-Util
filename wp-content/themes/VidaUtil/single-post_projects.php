<?php
get_header(); ?>
    
<!-- main-container -->
<div class="main-container clearfix">

    <div class="container">

        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <?php
            $thumb = '';
            $width = 980;
            $height = 350;
            $title = get_the_title();
        	$terms = get_the_terms($post->ID, 'projects_item_types');
        	$project_cover = get_post_meta($post->ID, 'theme_project_cover', true);
        	$project_tagline = get_post_meta($post->ID, 'theme_project_tagline', true);
        	$project_year = get_post_meta($post->ID, 'theme_project_year', true);
        	$project_socialnetwork = get_post_meta($post->ID, 'theme_project_socialnetwork', true);
            $project_comments = get_post_meta($post->ID, 'theme_project_comments', true);
        	$project_gallery = get_post_meta($post->ID, 'theme_project_gallery', true);
         ?>

        <section id="post-<?php the_ID(); ?>" <?php post_class('noborder'); ?>>
            <h1><?php the_title(); ?></h1>
        	<?php if( $project_cover ) : ?>
            <div class="">
                <?php echo the_crop_image($project_cover, "&amp;w=$width&amp;h=$height&amp;zc=1"); ?>
             <!-- <img class="cover" src="<?php echo $project_cover; ?>" alt="<?php the_title(); ?>"> -->
            </div>
            <?php endif; ?>

            <div class="five columns">
            	<h2 class="intro"><?php echo $project_tagline; ?></h2>
            	<p class="meta">
                    <?php if( $project_year ) : ?><?php echo $options['lang_year']; ?> &mdash; <?php echo $project_year; ?><br/><?php endif; ?>
            	</p>
            	<?php if( $project_socialnetwork ) : ?>
            	<ul id="socialnetwork">
            		<li><div class="fb-like" data-send="false" data-layout="button_count" data-width="250" data-show-faces="false"></div></li>
                    <li><a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $options['theme_twitter_username']; ?>">Tweet</a></li>
            	</ul>		
            	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            	<?php endif; ?>           		
            </div>

            <div class="ten columns">
            	<?php the_content(); ?>
            </div>

            <div class="clearfix"></div>

            <?php if( $project_gallery ) : ?>
            <ul id="gallery" class="fullwidth">
            	<?php foreach( $project_gallery as $item ) : ?>
            		<?php if( $item['theme_project_item_image'] ) : ?>
            			<!-- <li>
            				<img class="scale-with-grid" src="<?php echo $item['theme_project_item_image']; ?>"/>       	
            			</li> -->
                        <li>
                            <!-- <a href="<?php //echo $item['theme_project_item_image']; ?>" rel="lightbox[plants]"> -->
                            <a href="<?php echo $item['theme_project_item_image']; ?>" rel="lightbox[plants]">
                            <img class="scale-with-grid" src="<?php echo $item['theme_project_item_image']; ?>"  alt="" /></a>
                        </li>
            		<?php endif; ?>
            		<?php if( $item['theme_project_item_video'] ) : ?>
                        <li>
                            <?php echo wp_oembed_get( $item['theme_project_item_video'], array('width'=> ''. $item['theme_project_item_size'] .'') ); ?>
                        </li>
                    <?php endif; ?>
            	<?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php comments_template( '', true ); ?>

        </section>
        <?php endwhile; endif; ?>

    </div>

</div>
<!-- // main-container -->

<?php get_footer(); ?>