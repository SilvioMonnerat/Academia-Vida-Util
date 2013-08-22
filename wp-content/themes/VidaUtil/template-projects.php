<?php
/*
Template Name: Projects Page
*/ 
get_header(); ?>
        
<!-- main-container -->
<div class="main-container clearfix">

    <div class="container">
	
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <section id="post-<?php the_ID(); ?>" <?php post_class('sixteen columns noborder'); ?>>

        <hgroup>
            <h3><?php the_title(); ?></h3>
        </hgroup>

        <?php the_content(); ?>
        <?php theme_get_filter(); ?>
        <?php $projects = new WP_Query( 'post_type=post_projects&posts_per_page=-1' ); ?>
        <?php if( $projects->have_posts() ) : ?>
        <div id="projects">

            <?php while( $projects->have_posts() ) : $projects->the_post(); ?><?php 
                $terms = get_the_terms($post->ID, 'projects_item_types');
            ?>
            <article class="proj <?php if($terms) : foreach($terms as $term) : echo $term->slug. ' '; endforeach; endif; ?>">
                <div class="inner">
                    <div class="media-wrap">
                        <?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail(); ?><?php endif; ?>
                        <a class="url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <span class="padder"><?php the_title(); ?><em><?php if($terms) : foreach($terms as $term) : echo '' . $term->name . '<br/>'; endforeach; endif; ?></em></span>
                        </a>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>

        </div>
        <?php endif; ?>

	</section>
	<?php endwhile; ?>

    </div>

</div>
<!-- //main-container -->

<?php get_footer(); ?>
