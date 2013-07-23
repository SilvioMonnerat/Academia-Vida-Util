<?php get_header(); ?>

    <div id="content">             
        <article id="post-<?php the_ID(); ?>" class="container clearfix"> 

            <h1 class="title"><span><?php _e('Search Results for: '); ?></span><?php echo esc_attr( get_search_query() ); ?></h1>
            
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

            <header class="article-header">                            
                <h3 class="search-title">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>       

                <?php _e("Posted"); ?>
                <time class="updated" datetime="<?php echo the_time('j/m/Y'); ?>" pubdate>
                    <?php the_time('F jS, Y'); ?>
                </time> <?php _e("by: "); ?>
                    <span class="author">  
                        <?php the_author_posts_link(); ?>
                    </span>
                <?php the_category(', '); ?>    
            </header> <!-- end article header -->

            <section class="">
                <p class="text row"><a href="<?php the_permalink() ?>"><?php the_content_limit('30'); ?></a></p>
                <p class="readmore row"><?php echo readMore(); ?></p>
            </section> <!-- end article section -->

            <?php endwhile; ?>

            <?php else: ?>

            <?php endif; wp_reset_query(); ?>
        
            <div class="span3">
                <?php get_sidebar(); ?>
            </div>

        </article>
    </div>

    
<?php get_footer(); ?>