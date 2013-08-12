<?php
	/*
		Template Name: Contato
	*/

	if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Campo Nome obrigatório!';
			$hasError  = true;
		} else {
			$name = trim($_POST['contactName']);
		}

		if(trim($_POST['contactTel']) === '') {
			$telError = 'Campo telefone obrigatório!';
			$hasError  = true;
		} else {
			$tel = trim($_POST['contactTel']);
		}

		if(trim($_POST['email']) === '')  {
			$emailError = 'Por favor, insira o seu endereço de email.';
			$hasError   = true;
		} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
			$emailError = 'Você digitou um endereço de e-mail inválido.';
			$hasError   = true;
		} else {
			$email = trim($_POST['email']);
		}

		if(trim($_POST['comments']) === '') {
			$commentError = 'Por favor insira uma mensagem.';
			$hasError     = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}

		if(!isset($hasError)) {
			$emailTo = get_option('tz_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[PHP Snippets] From '.$name;
			$body    = "Nome: $name \n\nTelefone: $tel \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

			wp_mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	} 
?>
<?php get_header(); ?>

	<div class="maps">
		<?php echo do_shortcode( '[wpgmza id="1"]' ) ?>
	</div>

	<div class="container">
		<div class="main-area span9">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix'); ?>>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="sucess span5">
								<p>Obrigado, seu contato foi enviado com sucesso.</p>
								<span><a href="<?php the_permalink() ?>">Voltar &raquo;</a> </span>
							</div>
						<?php } else { ?>
							<?php the_content(); ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error span5">Desculpe, um erro ocorreu no envio do email!<p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" class="span5" id="contactForm" method="post">
							<ul class="contactform">
								<li>
									<label for="contactName">Nome:</label>
									<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
									<?php if($nameError != '') { ?>
										<span class="error"><?=$nameError;?></span>
									<?php } ?>
								</li>

								<li>
									<label for="contactName">Telefone:</label>
									<input type="text" name="contactTel" id="contactTel" value="<?php if(isset($_POST['contactTel'])) echo $_POST['contactTel'];?>" class="required requiredField" />
									<?php if($nameError != '') { ?>
										<span class="error"><?=$nameError;?></span>
									<?php } ?>
								</li>

								<li>
									<label for="email">Email:</label>
									<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
									<?php if($emailError != '') { ?>
										<span class="error"><?=$emailError;?></span>
									<?php } ?>
								</li>

								<li><label for="commentsText">Mensagem:</label>
									<textarea name="comments" id="commentsText" rows="10" cols="" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
									<?php if($commentError != '') { ?>
										<span class="error"><?=$commentError;?></span>
									<?php } ?>
								</li>

								<li>
									<input type="submit" value="Enviar" />
								</li>
							</ul>
							<input type="hidden" name="submitted" id="submitted" value="true" />
						</form>
					<?php } ?>
					<div class="info span3">
						<label class="title"><?php echo __('Vida útil - Informações para contato') ?></label class="title">
						<label><strong>Telefone:</strong> 55 + 21 2621-4077</label>
						<label><strong>Celular:</strong> 55 + 21 9617-4887</label>
						<label><strong>Endereço:</strong> Rua da Conceição, 188 / 3° Piso  Niterói - Rio de Janeiro / <span>Niterói Shopping</span></label>
					</div>
				<?php endwhile; endif; ?>
			</article>
		</div>				
		<?php get_sidebar(); ?>
		<?php get_template_part( 'comments' ) ?>
	</div>
<?php get_footer(); ?>