<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Por favor não carregue esta página diretamente. Obrigado!','ezine'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php echo __('Este post está protegido por senha, informe-a para visualizar os comentários.', 'ezine') ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

	<?php if ( have_comments() ) : // if there are comments ?>
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
		
		<h3 id="comments"  class="bodytitle"><?php comments_number('Nenhum comentário', '1 comentário', '% comentários' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
		
		<ol class="commentlist">
        <?php wp_list_comments('type=comment&avatar_size=50&callback=ezine_comment'); ?>
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		<h3 id="pings" class="bodytitle"><?php echo __('Trackbacks para este post', 'ezine') ?></h3>
		
		<ol class="pinglist">
        <?php wp_list_comments('type=pings&callback=ezine_list_pings'); ?>
        </ol>

        <?php endif; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		
		<?php if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		<p class="nocomments"><?php echo __('Comentários agora estão fechados para este post.', 'ezine') ?></p>
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php echo __('Comments are closed.', 'ezine') ?></p><?php } ?>

        <?php endif; ?>
        
        
<?php endif; ?>


	<?php if ( comments_open() ) : ?>

	<div id="respond">

		<h3 class="bodytitle"><?php comment_form_title( __('Deixe um comentário', 'ezine'), __('Deixe um comentário para %s', 'ezine') ); ?></h3>
	
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'ezine'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
			<?php if ( is_user_logged_in() ) : ?>
		
			<p><?php printf(__('Logado como %1$s. %2$sLog out &raquo;%3$s', 'ezine'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'ezine').'">', '</a>') ?></p>
		
			<?php else : ?>
		
			<div class="wrap"><div class="input-container"><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" /></div>
			<label for="author"><small><?php echo __('Name', 'ezine') ?> <?php if ($req) _e("(required)", 'ezine'); ?></small></label></div>
		
			<div class="wrap"><div class="input-container"><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" /></div>
			<label for="email"><small><?php echo __('Mail (will not be published)', 'ezine') ?> <?php if ($req) _e("(required)", 'ezine'); ?></small></label></div>
		
			<div class="wrap"><div class="input-container"><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /></div>
			<label for="url"><small><?php echo __('Website', 'ezine') ?></small></label></div>
		
			<?php endif; ?>
		
			<div class="wrap"><div class="textarea-container"><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></div></div>
			
			<!-- <p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p> -->
		
			<p><input name="submit" type="submit" id="submit" tabindex="5" value="Enviar comentário" />
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; // If registration required and not logged in ?>
	</div>

	<?php endif; // if you delete this the sky will fall on your head ?>
