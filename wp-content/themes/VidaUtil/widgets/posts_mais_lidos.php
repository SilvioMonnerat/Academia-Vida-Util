<?php
/*
  Widgets Name: Posts mais lidos
  Description: Lista posts mais comentados
  Version: 0.2
  Author: Silvio Monnerat
  Author URI: http://www.facebook.com/silvio.monnerat
*/

// Posts Mais Quentes
function posts_mais_lidos($args) {
	global $wpdb;

	// Carregar as opções desse widget
	$opcoes = get_option('posts_mais_lidos');

	// Valor padrão, caso nada tenha sido informado
	if(empty($opcoes['quantidade'])) $opcoes['quantidade'] = "5";

	// Recuperando os posts
	$hot_posts = $wpdb->get_results("SELECT ID, post_title, comment_count FROM {$wpdb->posts} ORDER BY comment_count DESC LIMIT {$opcoes['quantidade']}");

	// Usando o modelo de widgets do tema
	print $args['before_widget'];
	print $args['before_title'] . $opcoes['titulo'] . $args['after_title'];
	print "<ul>";

// Listando os posts mais quentes
foreach($hot_posts as $hot_post)
	print "<li><a href='" . get_permalink($hot_post->ID) . "'>{$hot_post->post_title} ({$hot_post->comment_count})</a></li>";
	print "</ul>";
	print $args['after_widget'];
}

// Configurações dos Posts Mais Quentes
function conf_posts_mais_lidos() {
	// Inicializa as variáveis necessárias
	$opcoes = array();

	// Salvando as opções
	if($_POST['save_posts_mais_lidos']) {
		$opcoes['titulo'] = $_POST['title_posts_mails_lidos'];
		$opcoes['quantidade'] = (int) $_POST['quantidade_posts_mais_lidos'];

		// Valor padrão, caso nada tenha sido informado
		if(empty($opcoes['quantidade'])) $opcoes['quantidade'] = "5";

			update_option('posts_mais_lidos', $opcoes);
	}

		// Carregar as opções desse widget
		$opcoes = get_option('posts_mais_lidos');

		// Formulário
?>
	<input type="hidden" name="save_posts_mais_lidos" value="1" />

	<p>
		<label for="title_posts_mails_lidos">Título:</label>
		<input type="text" name="title_posts_mails_lidos" maxlength="26" value="<?php print $opcoes['titulo']; ?>" class="widefat" />
		<label for="quantidade_posts_mais_lidos">Quantidade:</label>
		<input type="text" name="quantidade_posts_mais_lidos" maxlength="2" value="<?php print $opcoes['quantidade']; ?>" class="widefat" />
	</p>
<?php 
	}

	// Ativar o widget
	function posts_mais_lidos_init() {
		// Adicionar o widget
		register_sidebar_widget('Posts Mais Lidos', 'posts_mais_lidos');

		// Adicionar o controle ao widget
		register_widget_control('Posts Mais Lidos', 'conf_posts_mais_lidos');
	}
	// Carregar o widget
	add_action('widgets_init', 'posts_mais_lidos_init');