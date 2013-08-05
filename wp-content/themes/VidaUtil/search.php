<?php get_header() ?>

<?php 
    $thumb  = '';
    $width  = 250;
    $height = 150;
    $title  = get_the_title();
    $img    = get_post_image_src($post->ID);
    //d($img);
    $default_attr = array(
        'src'   => $src,
        'class' => "attachment-$size",
        'alt'   => trim(strip_tags( $attachment->post_excerpt )),
        'title' => trim(strip_tags( $attachment->post_title )),
    );
    $thumbnail = get_the_post_thumbnail($width,$height);
    $thumb = $thumbnail["thumb"];
?>       
                
    <div class="container">
        <div class="main-area span9">
            <article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>

                <h1 class="title-search"><span><?php _e('Resultado da pesquisa por: '); ?></span><?php echo esc_attr( get_search_query() ); ?></h1>

                <?php if(have_posts()): while(have_posts()):the_post(); ?>

                    <div class="search-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php                   
                                if(has_post_thumbnail()){
                                    the_crop_image($img, "&amp;w=$width&amp;h=$height&amp;zc=1"); 
                                }else{
                                    $fixeIMG = '    
                                        <img src="'.get_template_directory_uri().'/images/tarj2.jpg" />
                                    ';
                                    print $fixeIMG;
                                }
                            ?>
                        </a>
                    </div> <!-- end .page-thumbnail -->

                    <div class="blogmeta">
                        <ul>
                            <li><?php esc_html_e('Página criada'); ?> <?php esc_html_e('por:'); ?> <?php the_author_posts_link(); ?></li>
                            <li><?php esc_html_e('em:'); ?> <?php the_time(get_option('date_format')); ?></li>
                            <li><?php the_category(', '); ?> </li>
                    </div> <!-- end .blogmeta -->

                    <div class="content-search">
                        <div class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                        <p class="row"><a href="<?php the_permalink(); ?>"><?php the_content_limit('30'); ?></a></p>
                    </div>

                <?php endwhile; else: ?>

                <?php get_template_part('404'); ?>

                <?php endif; wp_reset_query(); ?>

            </article>

        </div>                      
        
        <?php get_sidebar(); ?>

    </div>


<?php get_footer() ?>


